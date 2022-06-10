<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExpenseManagement extends CI_Controller
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
    public function index() {
		$data['exp_details'] = $this->exp->getAll();
		$this->load->view('exp_views',$data);
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

	public function edit_Exp($id) {
		$data['exp_details'] = $this->exp->getSingleExp($id);
		$this->load->view('edit_Exp',$data);
	}

	// expanse management code ends here =================================================
}
