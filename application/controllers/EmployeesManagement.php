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
				<td>' . $emps->c_fname . ' ' . $emps->c_lname . '</td>
				<td>' . $emps->c_panno . '</td>
				<td>' . $emps->c_contactno . '</td>
                <td><a href="#" class="btn btn-primary" data-toggle="modal" id="' . $emps->c_banks . ' bank_details" onclick="bank_details(' . $emps->c_banks . ')" data-target="#bank">View Bank Details</a>
                            
				<td><a href="' . base_url() . 'ExpenseManagement/editExp/' . $emps->c_id . ' " class="btn btn-success">Edit</a>
					<a href="#" class="btn btn-danger" onclick="empDelete(' . $emps->c_id . ')">Delete</a>
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


        $bankName = $this->input->post('bankname');
        $ifsc = $this->input->post('ifsc');
        $accountno = $this->input->post('accno');
        $acc_status = $this->input->post('AccStatus');

        // $this->emp->insert($data);
        for ($i = 0; $i < count($bankName); $i++) {
            $data = array(
                'c_bankname' => $bankName[$i],
                'c_ifsc' => $ifsc[$i],
                'c_accountno' => $accountno[$i],
                'c_status' => $acc_status[$i]
            );
            $lastID = $this->bank->insert($data);
            array_push($ids, $lastID);
        }
        $data = array(
            'c_fname' => $emp_name[0],
            'c_lname' => $emp_name[1],
            'c_panno' => $this->input->post('pan'),
            'c_contactno' => $this->input->post('mobile'),
            'c_banks' => implode('_', $ids)
        );

        $this->emp->insert($data);
        // if ($insert) {
        //     redirect('/');
        // }
        // }
    }

    public function edit_Exp($id)
    {
        $data['exp_details'] = $this->exp->getSingleExp($id);
        $this->load->view('edit_Exp', $data);
    }

    public function expDelete($id)
    {
        $result = $this->exp->deleteExp($id);
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
}
