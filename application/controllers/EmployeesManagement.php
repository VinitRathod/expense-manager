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

    // public function __construct()
    // {
    // 	parent::__construct();
    // 	$this->load->model('Employees');
    // }
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
                <td><a href="#" class="btn btn-primary" data-toggle="modal" bank_details" onclick="bankDetails(' . $emps->c_banks . ')" data-target="#bank">View Bank Details</a>
                            
				<td><a href="#" onclick="empEdit(' . $emps->c_id . ')" data="modal" data-target="editEMPModal" class="btn btn-success">Edit</a>
					<a href="#" class="btn btn-danger" onclick="empDelete(`' . $this->sec->encryptor('e', $emps->c_id) . '`)">Delete</a>
				</td>
			</tr>';
        }
        echo $output;
    }

    public function empManagement()
    {
        $this->load->view('header');
        $this->load->view('em');
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
        // if ($insert) {
        //     redirect('/');
        // }
        // }
    }

    public function edit_Emp($id)
    {
        $data['emp_details'] = $this->emp->getSingleEmp($id);
        echo json_encode($data['emp_details']);
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
            echo "SUCCESS";
        }
    }

    public function expUpdate($id)
    {
        if ($this->input->post("submit")) {
            $data = array(
                'fname' => $this->input->post('expCode'),
                'c_category' => $this->input->post('expCat'),
                'c_type' => $this->input->post('expType'),
                'c_description' => $this->input->post('expDesc')
            );
            $update = $this->exp->update($data, $id);
            if ($update) {
                redirect('ExpenseManagement/expManagement');
            }
        }
    }

    // expanse management code ends here =================================================

    // Employee Payout Code Starts Here ==================================================

    public function addEmpPay()
    {
        $data = array(
            'c_empid' => $this->input->post('empId'),
            'c_expcategory' => $this->input->post('pay_expCat'),
            'c_amount' => $this->input->post('amount'),
            // 'c_duedate' => $this->input->post('paydd'),
            'c_paymentmode' => $this->input->post('pay_mode'),
            'c_scheduleddate' => $this->input->post('paypd'),
            'c_tags' => $this->input->post('Tags'),
            'c_status' => "Unpaid",
            'c_approval' => $this->input->post('approvalDoc'),
        );

        if ($this->emp->insertEmpPay($data)) {
            echo "SUCCESS";
        }
    }

    public function getEmpId()
    {
        $empIds = $this->emp->getAllEmp();
        $output = "";
        $output .= '<option>Select Employee Id</option>';
        foreach ($empIds as $empId) {

            $output .= '<option value=' . $empId->c_id . '>' . $empId->c_empid . '</option>';
        }
        echo $output;
    }
    // Employee Payout Code Ends Here ==================================================
}
