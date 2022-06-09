<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
	public function index()
	{
		$data['emp_details'] = $this->emp->getAllEmp();
		$this->load->view('welcome_message', $data);
	}

	public function vendorManagement()
	{
		$this->load->view('vm');
	}

	public function employeeManagement()
	{
		$this->load->view('em');
	}

	public function vendorPayout()
	{
		$this->load->view('ven_payout');
	}

	public function employeePayout()
	{
		$this->load->view('emp_payout');
	}

	public function expenseManagement()
	{
		$this->load->view('exp_management');
	}

	public function add()
	{
		// echo "Hello from add";
		if ($this->input->post('submit')) {
			$emp_name = $this->input->post('employeename');
			$emp_name = explode(" ", $emp_name);
			// in array key name same as the database column name
			$data = array(
				'c_fname' => $emp_name[0],
				'c_lname' => $emp_name[1],
				'c_panno' => $this->input->post('pan'),
				'c_contactno' => $this->input->post('mobile')
			);
			$insert = $this->emp->insert($data);

			if ($insert) {
				redirect('/');
			}
		}
	}

	public function addExpCat() {
		if($this->input->post('submit')) {
			$data = array(
				'c_category' => $this->input->post('expCat'),
				'c_type' => $this->input->post('expType'),
				'c_description' => $this->input->post('expDesc')
			);
			$insert = $this->exp->insert($data);
			if($insert) {
				redirect('expGetAll');
			}
		}
	}

	public function expGetAll() {
		$data['exp_details'] = $this->exp->getAll();
		$this->load->view('exp_views',$data);
	}
}
