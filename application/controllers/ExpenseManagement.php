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
				<td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#editEXPModal" onclick="expEdit(' . $exps->c_expid . ')">Edit</a>
					<a href="#" class="btn btn-danger" onclick="expDelete(' . $exps->c_expid . ')">Delete</a>
				</td>
			</tr>';
		}
		echo $output;
	}

	public function expManagement()
	{
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
		// if ($insert) {

		// }
	}

	public function edit_Exp($id)
	{
		$data['exp_details'] = $this->exp->getSingleExp($id);
		$response = $data['exp_details'];
		// $selectGroup = '<div class="form-group">
		// 				<label for="exptype"> Select Expense Type :</label>
		// 				<select id="expType" name="expType">
		// 					<option value="vendor">Vendor</option>
		// 					<option value="employee" selected>Employee</option>
		// 				</select>
		// 				<span id="warnExpType" class="text-danger font-weight-regular"> </span>
		// 			</div>';
		// if($response->c_type == "vendor") {
		// 	$selectGroup = '<div class="form-group">
		// 				<label for="exptype"> Select Expense Type :</label>
		// 				<select id="expType" name="expType">
		// 					<option value="vendor" selected>Vendor</option>
		// 					<option value="employee">Employee</option>
		// 				</select>
		// 				<span id="warnExpType" class="text-danger font-weight-regular"> </span>
		// 			</div>';
		// }
		// $output = '<div class="modal-dialog">
		// 				<div class="modal-content">

		// 					<div class="modal-header">
		// 						<h5 class="modal-title" id="exampleModalLabel">Edit Expense</h5>
		// 						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		// 							<span aria-hidden="true">&times;</span>
		// 						</button>
		// 					</div>

		// 					<div class="modal-body">

		// 						<form action="'.base_url()."ExpenseManagement/expUpdate/".$response->c_expid.'" onsubmit="return validation()" id="add_exp" class="bg-light" method="post">
		// 							<div class="form-group">
		// 								<label for="expid" class="font-weight-regular"> Expense Code </label>
		// 								<input type="text" name="expCode" class="form-control" id="expCode" autocomplete="off" required value="' . $response->c_expcode . '"/>
		// 								<span id="warnExpCode" class="text-danger font-weight-regular">

		// 								</span>
		// 							</div>

		// 							<div class="form-group">
		// 								<label for="expcode" class="font-weight-regular">
		// 									Expense Category
		// 								</label>
		// 								<input type="text" name="expCat" pattern="[a-z A-Z0-9]{1,}" class="form-control" id="expCat" autocomplete="off" required value="' . $response->c_category . '" />
		// 								<span id="warnFExpCat" class="text-danger font-weight-regular">

		// 								</span>
		// 							</div>
									
		// 							<div class="form-group">
		// 								<label for="expdesc" class="font-weight-regular"> Expense Description </label>
		// 								<br />
		// 								<textarea id="expDesc" rows="4" cols="50" name="expDesc" required>' . $response->c_description . '</textarea>
		// 							</div>

		// 							' . $selectGroup . '

		// 							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
		// 							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
		// 						</form>
		// 					</div>
		// 				</div>
		// 			</div>';
		echo json_encode($response);
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
		// if ($this->input->post("submit")) {
			$data = array(
				'c_expcode' => $this->input->post('expCode'),
				'c_category' => $this->input->post('expCat'),
				'c_type' => $this->input->post('expType'),
				'c_description' => $this->input->post('expDesc')
			);
			$update = $this->exp->update($data, $id);
			if ($update) {
				redirect('ExpenseManagement/expManagement');
			}
		// }
	}

	// expanse management code ends here =================================================
}
