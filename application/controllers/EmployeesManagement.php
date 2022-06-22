<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeesManagement extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    // expanse management code goes here =================================================
    public function index()
    {
        $data['emp_details'] = $this->emp->getAllEmp();

        $output = "";
        foreach ($data['emp_details'] as $emps) {
            $output .= '<tr>
                <td>' . $emps->c_empid . '</td>
				<td>' . $emps->c_fname . ' ' . $emps->c_lname . '</td>
				<td>' . $emps->c_panno . '</td>
				<td>' . $emps->c_contactno . '</td>
                <td><a href="#" class="btn btn-x" data-toggle="modal" bank_details" onclick="bankDetails(`' . $this->sec->encryptor('e', $emps->c_id)  . '`)" data-target="#bank">View Bank Details</a>
                            
				<td><a href="#" onclick="empEdit(`' . $this->sec->encryptor('e', $emps->c_id) . '`)" data-toggle="modal" data-target="#editEMPModal" class="btn btn-success">Edit</a>
					<a href="#" class="btn btn-danger" onclick="empDelete(`' . $this->sec->encryptor('e', $emps->c_id) . '`)">Delete</a>
				</td>
			</tr>';
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function empManagement()
    {
        $name = $this->session->userdata('username');
        if (isset($name)) {
            $this->load->view('header');
            $this->load->view('em');
        } else {
            redirect('LoginController/login');
        }
    }

    public function addEmp()
    {

        $ids = array();
        // echo "Hello from add";
        // if ($this->input->post('submit')) {
        $emp_name = $this->input->post('employeename');
        $emp_name = explode(" ", $emp_name);
        // in array key name same as the database column name

        // contact id generation...
        $details = array(
            'name' => $this->input->post('employeename'),
            'email' => $this->input->post('c_email'),
            'contact' => $this->input->post('mobile'),
            'type' => "employee",
        );
        $res = $this->bank->curlReq($details, $this->bank->contactURL);
        $contactID = $res['id'];
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        // contact id generated sucessfully...

        $bankName = $this->input->post('bankname');
        $ifsc = $this->input->post('ifsc');
        $accountno = $this->input->post('accno');
        $acc_status = $this->input->post('AccStatus');

        // $this->emp->insert($data);
        for ($i = 0; $i < count($bankName); $i++) {
            $details = array(
                "contact_id" => "$contactID",
                "account_type" => "bank_account",
                "bank_account" => array(
                    "name" => $this->input->post('employeename'),
                    "ifsc" => $ifsc[$i],
                    "account_number" => $accountno[$i]
                )
            );
            $result = $this->bank->curlReq($details, $this->bank->fundURL);
            $fundID = $result['id'];
            $data = array(
                'c_bankname' => $bankName[$i],
                'c_ifsc' => $ifsc[$i],
                'c_accountno' => $accountno[$i],
                'c_status' => $acc_status[$i],
                'c_contactid' => $contactID,
                'c_fundsid' => $fundID,
            );
            $lastID = $this->bank->insert($data);
            array_push($ids, $lastID);
        }
        $data = array(
            'c_empid' => $this->input->post('empid'),
            'c_fname' => $emp_name[0],
            'c_lname' => $emp_name[1],
            'c_panno' => $this->input->post('pan'),
            'c_contactno' => $this->input->post('mobile'),
            'c_banks' => implode(',', $ids),
            'c_email' => $this->input->post("c_email")
        );

        $this->emp->insert($data);
        echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
        // if ($insert) {
        //     redirect('/');
        // }
        // }
    }

    public function edit_Emp($id)
    {
        $res = $this->emp->getSingleEmp($this->sec->encryptor('d', $id));
        $res->c_id = $this->sec->encryptor('e', $res->c_id);
        $res->c_banks = $this->sec->encryptor('e', $res->c_banks);
        echo json_encode(array('result' => $res, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function editEmpBasic()
    {
        $id =  $this->sec->encryptor('d', $this->input->post('EmpID'));
        $name = explode(" ", $this->input->post('employeename'));
        $data = array(
            'c_empid' => $this->input->post('empid'),
            'c_fname' => $name[0],
            'c_lname' => $name[1],
            'c_panno' => $this->input->post('pan'),
            'c_contactno' => $this->input->post('mobile'),
            'c_email' => $this->input->post('c_email'),
        );
        $updateBasicResult = $this->emp->updateBasic($id, $data);
        if ($updateBasicResult) {
            echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
        } else {
            echo "ERROR";
        }
        // echo json_encode($this->input->post('employeename'));
    }

    public function empDelete($id)
    {
        $id = $this->sec->encryptor('d', $id);
        $result = $this->emp->getSingleEmp($id);
        // print_r($result);
        $banks = explode(",", $result->c_banks);
        foreach ($banks as $bk) {
            $this->bank->deleteBank($bk);
        }
        $result = $this->emp->deleteEmp($id);
        if ($result) {
            // echo "SUCCESS";
            echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
        }
    }

    // expanse management code ends here =================================================

    // Employee Payout Code Starts Here ==================================================
    public function empPayout()
    {

        $name = $this->session->userdata('username');
        if (isset($name)) {
            $this->load->view('header');
            $this->load->view('emp_payout');
        } else {
            redirect('LoginController/login');
        }
    }

    public function getEmpName($id)
    {
        $res = $this->emp->getSingleEmp($this->sec->encryptor('d', $id));
        $output = '<input type="text" name="pay_emp_name" pattern="[a-z A-Z]{3,}" minlength="3" value="' . $res->c_fname . ' ' . $res->c_lname . '" class="form-control" id="employeename" autocomplete="off" required />';
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }
    public function addEmpPay()
    {
        if (isset($_FILES['approvalDoc'])) {
            $doc_name = $_FILES['approvalDoc']['name'];
            $tmp_name = $_FILES['approvalDoc']['tmp_name'];
            $doc_error = $_FILES['approvalDoc']['error'];
            if ($doc_error == 0) {
                // echo "\nInside img if";
                $doc_ex = pathinfo($doc_name, PATHINFO_EXTENSION);
                $doc_ex_lc = strtolower($doc_ex);

                $allowed_exs = array('pdf');
                if (in_array($doc_ex_lc, $allowed_exs)) {
                    $new_doc_name = uniqid("DOC-", true) . '.' . $doc_ex_lc;
                    $doc_upload_path = "DOCS-PAYOUT/EMP-PAYOUTS/" . $new_doc_name;
                    move_uploaded_file($tmp_name, $doc_upload_path);
                    $data = array(
                        'c_empid' => $this->sec->encryptor('d', $this->input->post('empId')),
                        'c_bank' => $this->sec->encryptor('d', $this->input->post('c_banks')),
                        'c_expcategory' => $this->sec->encryptor('d', $this->input->post('expId')),
                        'c_amount' => $this->input->post('amount'),
                        'c_duedate' => $this->input->post('paydd'),
                        'c_paymentmode' => $this->input->post('pay_mode'),
                        'c_scheduleddate' => $this->input->post('paypd'),
                        'c_tags' => $this->input->post('Tags'),
                        'c_status' => "Unpaid",
                        'c_approval' => $new_doc_name,
                        'created_at' => date("Y-m-d  H:i:s", time()),
                        'modified_at' => date("Y-m-d  H:i:s", time()),
                    );
                }
            }
        } else {
            $data = array(
                'c_empid' => $this->sec->encryptor('d', $this->input->post('empId')),
                'c_bank' => $this->sec->encryptor('d', $this->input->post('c_banks')),
                'c_expcategory' => $this->sec->encryptor('d', $this->input->post('expId')),
                'c_amount' => $this->input->post('amount'),
                'c_duedate' => $this->input->post('paydd'),
                'c_paymentmode' => $this->input->post('pay_mode'),
                'c_scheduleddate' => $this->input->post('paypd'),
                'c_tags' => $this->input->post('Tags'),
                'c_status' => "Unpaid",
                // 'c_approval' => $this->input->post('approvalDoc'),
                'created_at' => date("Y-m-d  H:i:s", time()),
                'modified_at' => date("Y-m-d  H:i:s", time()),
            );
        }


        if ($this->emp->insertEmpPay($data)) {
            echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
        }
    }

    public function getEmpId()
    {
        $empIds = $this->emp->getAllEmp();
        $output = "";
        $output .= '<option value="">Select Employee Id</option>';
        foreach ($empIds as $empId) {

            $output .= '<option value=' . $this->sec->encryptor('e', $empId->c_id) . '>' . $empId->c_empid . '</option>';
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function showEmpPay()
    {
        $data['empPay'] = $this->emp->getEmpPay();
        // echo json_encode($data['empPay']);
        $action = "";
        $date = "";
        $output = "";
        foreach ($data['empPay'] as $emps) {
            if ($emps->c_paymentmode == "manual" && strtolower($emps->c_status) == "unpaid") {
                $action = '<button type="button" class="btn btn-x mr-5 payout" id="' . $this->sec->encryptor('e', $emps->c_id) . '" > Pay now </button>';
            } else if ($emps->c_paymentmode == "schedule" && strtolower($emps->c_status) == "unpaid") {
                $action = '<button type="button" class="btn btn-outline-warning" disabled> Scheduled </button>';
            } else if (strtolower($emps->c_status) == "paid") {
                $action = '<button type="button" class="btn btn-outline-success" disabled> Payment Done </button>';
            }

            if (!empty($emps->c_scheduleddate)) {
                $date = $emps->c_scheduleddate;
            } else {
                $date = "Payment Is Manual";
            }
            $output .= '<tr>
                <td>' . $emps->c_fname . ' ' . $emps->c_lname . '</td>
        		<td>' . $emps->c_amount . '</td>
        		<td>' . $date . '</td>
        		<td>' . $emps->c_paymentmode . '</td>
                <td>' . $emps->c_status . '</td>           
        		<td>
                 ' . $action . '
        		</td>
        	</tr>';
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function getExpCat()
    {
        $result = $this->exp->getAllExpOf("employee");
        $output = '<option value="null"> --SELECT EXPENSE CATEGORY-- </option>';
        if ($result) {
            foreach ($result as $cat) {
                if ($cat->c_category == "Other") {
                    continue;
                }
                $output .= '<option value="' . $this->sec->encryptor('e', $cat->c_expid) . '"> ' . $cat->c_category . ' </option>';
            }
            $output .= '<option value="' . $this->sec->encryptor('e', '1') . '"> Other </option>';
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function getEmpBanks($id)
    {
        $output = '<option value=""> --SELECT BANK-- </option>';
        $employee = $this->emp->getSingleEmp($this->sec->encryptor('d', $id));
        // echo $employee;
        if ($employee) {
            $banks = explode(",", $employee->c_banks);
            foreach ($banks as $bid) {
                $bankDetails = $this->bank->getSingleBankDetail($bid);
                $output .= '<option value="' . $this->sec->encryptor('e', $bankDetails->c_id) . '">' . $bankDetails->c_bankname . '</option>';
            }
        }
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }
    // Employee Payout Code Ends Here ==================================================

    // Dashboard Code Starts Here

    public function dashEmpPay()
    {
        $data['empPay'] = $this->emp->getEmpPayLatest();
        // echo json_encode($data['empPay']);
        $date = "";
        $output = "";
        foreach ($data['empPay'] as $emps) {

            if (!empty($emps->c_scheduleddate)) {
                $date = $emps->c_scheduleddate;
            } else {
                $date = "Payment Is Manual";
            }
            $output .= '<tr>
                <td>' . $emps->c_fname . ' ' . $emps->c_lname . '</td>
        		<td>' . $emps->c_amount . '</td>
        		<td>' . $date . '</td>
        	</tr>';
        }
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    // Dashboard Code Ends Here

    public function checkBank()
    {
        if (!$this->emp->checkBank($this->sec->encryptor('d', $this->input->post('c_id')))) {
            // echo "SUCCESS";
            echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
        }
    }

    public function getBankDetails($id)
    {
        $banks = $this->emp->getBanks($this->sec->encryptor('d', $id));
        $output = "";
        $id = explode(",", $banks);
        for ($i = 0; $i < count($id); $i++) {
            // echo $id[$i];
            $bDetails = $this->bank->getSingleBankDetail($id[$i]);
            // print_r($bDetails);
            $output .= "<tr class='banks'>
                    <td style='display: none; visibility: hidden;'>" . $this->sec->encryptor('e', $id[$i]) . "</td>
                    <td>" . $bDetails->c_bankname . "</td>
                    <td>" . $bDetails->c_ifsc . "</td>
                    <td>" . $bDetails->c_accountno . "</td>
                    <td>" . $bDetails->c_status . "</td>
                </tr>";
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function editBanks()
    {
        $id = $this->sec->encryptor('d', $this->input->post('c_id'));
        $existing_banks = explode(",", $this->input->post('existing_bank'));
        for ($i = 0; $i < count($existing_banks); $i++) {
            $existing_banks[$i] = $this->sec->encryptor('d', $existing_banks[$i]);
        }
        $other_banks = explode(",", $this->input->post('other_banks'));

        $exist = array();
        $banks = explode(",", $this->emp->getBanks($id));
        foreach ($banks as $bank) {
            if (!in_array($bank, $existing_banks)) {
                $this->bank->deleteBank($bank);
            } else {
                array_push($exist, $bank);
            }
        }

        // contact id generation...
        $employee = $this->emp->getSingleEmp($id);
        // print_r($employee);
        $details = array(
            'name' => $employee->c_fname . " " . $employee->c_lname,
            'email' => $employee->c_email,
            'contact' => $employee->c_contactno,
            'type' => "employee",
        );
        $res = $this->bank->curlReq($details, $this->bank->contactURL);
        $contactID = $res['id'];
        // this is contact id...

        for ($i = 3; $i <= count($other_banks); $i++) {
            if ($i % 4 == 3) {
                $data = array(
                    'c_bankname' => $other_banks[$i - 3],
                    'c_ifsc' => $other_banks[$i - 2],
                    'c_accountno' => $other_banks[$i - 1],
                    'c_status' => $other_banks[$i]
                );
                // print_r($data);

                $details = array(
                    "contact_id" => "$contactID",
                    "account_type" => "bank_account",
                    "bank_account" => array(
                        "name" => $employee->c_fname . " " . $employee->c_lname,
                        "ifsc" => $data['c_ifsc'],
                        "account_number" => $data['c_accountno']
                    )
                );
                $result = $this->bank->curlReq($details, $this->bank->fundURL);
                $fundID = $result['id'];
                $bankDetails = array(
                    'c_bankname' => $data['c_bankname'],
                    'c_ifsc' => $data['c_ifsc'],
                    'c_accountno' => $data['c_accountno'],
                    'c_status' => $data['c_status'],
                    'c_contactid' => $contactID,
                    'c_fundsid' => $fundID
                );
                $lastID = $this->bank->insert($bankDetails);
                array_push($exist, $lastID);
            }
        }

        // print_r($exist);
        $this->setBankDetails($id, $exist);
        // echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
    }
    public function setBankDetails($id, $bank)
    {
        $data = array(
            'c_banks' => implode(",", $bank),
        );
        $this->emp->setBanks($id, $data);
        echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
    }
}
