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
	public function index()
	{
		$data['exp_details'] = $this->exp->getAll();
		
		$output = "";
		foreach ($data['exp_details'] as $exps) {

			$output.='<tr>
				<td>'.$exps->c_expcode.'</td>
				<td>'.$exps->c_category.'</td>
				<td>'.$exps->c_description.'</td>
				<td>'.$exps->c_type.'</td>
				<td><a href="'.base_url().'ExpenseManagement/editExp/'.$exps->c_expid.' " class="btn btn-success">Edit</a>
					<a href="#" class="btn btn-danger" onclick="expDelete('.$exps->c_expid.')">Delete</a>
				</td>
			</tr>';

		}
		echo $output;
	}

	public function expManagement() {
		$this->load->view('header');
		$this->load->view('exp_management');
	}

	public function addExpCat()
	{

		$data = array(
			'c_expcode' => $this->input->post('expCode'),
			'c_category' => $this->input->post('expCat'),
			'c_type' => $this->input->post('expType'),
			'c_description' => $this->input->post('expDesc')
		);
		$insert = $this->exp->insert($data);
		if ($insert) {
			
		}
	}

	public function edit_Exp($id)
	{
		$data['exp_details'] = $this->exp->getSingleExp($id);
		$this->load->view('edit_Exp', $data);
	}

	public function expDelete($id) {
		$result = $this->exp->deleteExp($id);
		if($result) {
			echo "SUCCESS";
		}
	}

	// expanse management code ends here =================================================
}
