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

			$output .= '<tr>
				<td>' . $exps->c_expcode . '</td>
				<td>' . $exps->c_category . '</td>
				<td>' . $exps->c_description . '</td>
				<td>' . $exps->c_type . '</td>
				<td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#editEXPModal" onclick="expEdit(`' . $this->sec->encryptor('e', $exps->c_expid) . '`)">Edit</a>
					<a href="#" class="btn btn-danger" onclick="expDelete(`' . $this->sec->encryptor('e', $exps->c_expid) . '`)">Delete</a>
				</td>
			</tr>';
		}
		echo $output;
	}

	public function expManagement()
	{

		$name = $this->session->userdata('username');
		if (isset($name)) {
			$this->load->view('header');
			$this->load->view('exp_management');
		} else {
			redirect('LoginController/login');
		}
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
	}

	public function edit_Exp($id)
	{
		$data['exp_details'] = $this->exp->getSingleExp($this->sec->encryptor('d', $id));
		$response = $data['exp_details'];
		$response->c_expid = $this->sec->encryptor('e', $response->c_expid);
		echo json_encode($response);
	}

	public function expDelete($id)
	{
		$result = $this->exp->deleteExp($this->sec->encryptor('d', $id));
		if ($result) {
			echo "SUCCESS";
		}
	}

	public function expUpdate($id)
	{
		// if ($this->input->post("submit")) {
		$data = array(
			'c_expcode' => $this->input->post('expCode'),
			'c_category' => $this->input->post('expCat'),
			'c_type' => $this->input->post('expType'),
			'c_description' => $this->input->post('expDesc')
		);
		$update = $this->exp->update($data, $this->sec->encryptor('d', $id));
		if ($update) {
			redirect('ExpenseManagement/expManagement');
		}
		// }
	}

	// expanse management code ends here =================================================
}
