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
		redirect('dashboard');
	}
	public function dashboard()
	{
		// $data['emp_details'] = $this->emp->getAllEmp();
		$name = $this->session->userdata('username');
		if (isset($name)) {
			$this->load->view('header');
			$this->load->view('dashboard');
		} else {
			redirect('LoginController/login');
		}
	}

	public function login()
	{
		$this->load->view('login');
	}
}
