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
	private $expCodeRegex = "/[a-zA-z]+[0-9]+/xim";
	private $error_add_exp = array('warnExpCode' => "", 'warnExpCat' => "");
	private $error_edit_exp = array('warnEditExpCode' => "", 'warnEditExpCat' => "");
	public function index()
	{
		$data['exp_details'] = $this->exp->getAll();

		$output = "";
		foreach ($data['exp_details'] as $exps) {
			if ($exps->c_expcode == "OTH") {
				continue;
			}

			$output .= '<tr>
				<td>' . $exps->c_expcode . '</td>
				<td>' . $exps->c_category . '</td>
				<td>' . $exps->c_description . '</td>
				<td>' . $exps->c_type . '</td>
				<td style="width:11vw"><a href="#" class="btn btn-success mr-2" data-toggle="modal" data-target="#editEXPModal" onclick="expEdit(`' . $this->sec->encryptor('e', $exps->c_expid) . '`)">Edit</a>
				<a href="#" class="btn btn-danger" onclick="expDelete(`' . $this->sec->encryptor('e', $exps->c_expid) . '`)">Delete</a></td>
			</tr>';
		}
		echo json_encode(array('response' => $output, 'csrf' => $this->security->get_csrf_hash()));
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

	public function validate($data, &$e_error, $id = 0)
	{
		$error = false;
		$edit = "";
		if ($id != 0) {
			$edit = "Edit";
		}
		if (empty($data['c_expcode'])) {
			$e_error['warn' . $edit . 'ExpCode'] = "*Please Fill Expense Code";
			$error = true;
		}
		if (!preg_match($this->expCodeRegex, $data['c_expcode'])) {
			$e_error['warn' . $edit . 'ExpCode'] = "*Invalid Expense Code";
			$error = true;
		}
		if ($this->exp->checkExpCode($data['c_expcode'], $id)) {
			$e_error['warn' . $edit . 'ExpCode'] = "*Expense Code Must Be Unique";
			$error = true;
		}
		if (empty($data['c_category'])) {
			$e_error['warn' . $edit . 'ExpCat'] = "*Please Fill Category";
			$error = true;
		}

		return $error;
	}

	public function addExpCat()
	{

		$data = array(
			'c_expcode' => $this->input->post('expCode'),
			'c_category' => $this->input->post('expCat'),
			'c_type' => $this->input->post('expType'),
			'c_description' => $this->input->post('expDesc')
		);

		if (!$this->validate($data, $this->error_add_exp)) {
			$insert = $this->exp->insert(html_escape($data));
			if ($insert) {
				echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
			}
		} else {
			echo json_encode(array('error' => $this->error_add_exp, 'csrf' => $this->security->get_csrf_hash()));
		}
	}

	public function edit_Exp($id)
	{
		$data['exp_details'] = $this->exp->getSingleExp($this->sec->encryptor('d', $id));
		$response = $data['exp_details'];
		$response->c_expid = $this->sec->encryptor('e', $response->c_expid);
		// echo json_encode($response);
		echo json_encode(array('result' => $response, 'csrf' => $this->security->get_csrf_hash()));
	}

	public function expDelete($id)
	{
		$result = $this->exp->deleteExp($this->sec->encryptor('d', $id));
		if ($result) {
			// echo "SUCCESS";
			echo json_encode(array('output' => "SUCCESS", 'csrf' => $this->security->get_csrf_hash()));
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
		if (!$this->validate($data, $this->error_edit_exp, $this->sec->encryptor('d', $id))) {
			$update = $this->exp->update(html_escape($data), $this->sec->encryptor('d', $id));
			if ($update) {
				// redirect('ExpenseManagement/expManagement');
				echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
			} else {
			}
		} else {
			echo json_encode(array('error' => $this->error_edit_exp, 'csrf' => $this->security->get_csrf_hash()));
		}

		// }
	}

	// expanse management code ends here =================================================
}
