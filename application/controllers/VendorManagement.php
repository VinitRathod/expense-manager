<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorManagement extends CI_Controller
{
	private $ven_id_regx = "/[a-zA-Z]+[0-9]+/mxi";
	private $ven_name_regx = "/[a-zA-Z]{3,10} [a-zA-Z]{3,10}/s";
	private $ven_nick_name_regx = "/[a-zA-Z]{3,}/xm";
	private $gst_regx = "/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/xm";
	private $panno_regx = "/[A-Z]{5}[0-9]{4}[A-Z]{1}/xm";
	private $ifsc_regx = "/[A-Z]{4}[0-9]{7}/xm";
	private $accno_regx = "/[0-9]{9,18}/xm";
	private $address_regx = "/[a-zA-Z0-9\s,.]{3,100}/xm";
	private $email_regx = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/xm";
	private $phoneno_regx = "/[0-9]{10}/xm";
	private $error_add_ven = array(
		'ven_id' => '',
		'ven_name' => '',
		'ven_nick_name' => '',
		'address' => '',
		'gst_no' => '',
		'pan_no' => '',
		'email' => '',
		'mobileno' => '',
		'document' => '',
		'contact_id' => '',
		'funds_id' => '',
	);

	private $error_edit_ven = array(
		'edit_ven_name' => '',
		'edit_ven_nickname' => '',
		'GStE' => '',
		'lblPANCardE' => '',
		'edit_email' => '',
	);

	public function validate($data, &$e_array, $contact)
	{
		$error = false;
		if (empty($data['c_venid']) || !preg_match($this->ven_id_regx, $data['c_venid'])) {
			$e_array['ven_id'] = '*Invalid Vendor ID';
			$error = true;
		}

		if (empty($data['c_fname']) || empty($data['c_lname']) || $data['c_fname'] == "" || $data['c_lname'] == "") {
			$e_array['ven_name'] = '*Invalid Vendor Name';
			$error = true;
		}

		if (!preg_match($this->ven_name_regx, $data['c_fname'] . " " . $data['c_lname'])) {
			$e_array['ven_name'] = '*Invalid Vendor Name';
			$error = true;
		}

		if (empty($data['c_nickname']) || !preg_match($this->ven_nick_name_regx, $data['c_nickname'])) {
			$e_array['ven_nick_name'] = '*Invalid Vendor Nick Name';
			$error = true;
		}

		if (empty($data['c_address']) || !preg_match($this->address_regx, $data['c_address'])) {
			$e_array['address'] = '*Invalid Address';
			$error = true;
		}

		if (empty($data['c_gstno']) || !preg_match($this->gst_regx, $data['c_gstno'])) {
			$e_array['gst_no'] = '*Invalid GST No';
			$error = true;
		}

		if (empty($data['c_panno']) || !preg_match($this->panno_regx, $data['c_panno'])) {
			$e_array['pan_no'] = '*Invalid PAN No';
			$error = true;
		}

		if (empty($data['c_email']) || !preg_match($this->email_regx, $data['c_email'])) {
			$e_array['email'] = '*Invalid Email';
			$error = true;
		}

		foreach ($contact as $c) {
			if (empty($c) || !preg_match($this->phoneno_regx, $c)) {
				$e_array['mobileno'] = '*Invalid Mobile No';
				$error = true;
			}
		}

		return $error;
	}

	public function validateEdit($data, &$e_array)
	{
		$error = false;

		if (empty($data['c_fname']) || empty($data['c_lname']) || $data['c_fname'] == "" || $data['c_lname'] == "") {
			$e_array['edit_ven_name'] = '*Invalid Vendor Name';
			$error = true;
		}

		if (!preg_match($this->ven_name_regx, $data['c_fname'] . " " . $data['c_lname'])) {
			$e_array['edit_ven_name'] = '*Invalid Vendor Name';
			$error = true;
		}

		if (empty($data['c_nickname']) || !preg_match($this->ven_nick_name_regx, $data['c_nickname'])) {
			$e_array['edit_ven_nickname'] = '*Invalid Vendor Nick Name';
			$error = true;
		}

		if (empty($data['c_gstno']) || !preg_match($this->gst_regx, $data['c_gstno'])) {
			$e_array['GStE'] = '*Invalid GST No';
			$error = true;
		}

		if (empty($data['c_panno']) || !preg_match($this->panno_regx, $data['c_panno'])) {
			$e_array['lblPANCardE'] = '*Invalid PAN No';
			$error = true;
		}

		if (empty($data['c_email']) || !preg_match($this->email_regx, $data['c_email'])) {
			$e_array['edit_email'] = '*Invalid Email';
			$error = true;
		}

		return $error;
	}


	// ajax will take contents from this functions, only select * query...
	public function index()
	{
		$data['ven_details'] = $this->ven->getAllVen();

		$output = "";
		foreach ($data['ven_details'] as $ven) {
			$doc = "";
			if (!empty($ven->c_document)) {
				$doc = '<td style="text-align: center;">
						<a href="' . base_url() . 'DOCS/' . $ven->c_document . '" download >  
						<img id="downloadIcon" src="' . base_url() . 'assets/icons/download.svg" width="50%" height="50%">  
						</a>
					</td>';
			} else {
				$doc = "<td>No Document Uploaded</td>";
			}

			$output .= '<tr>
						<td>' . $ven->c_venid . '</td>
						<td>' . $ven->c_fname . ' ' . $ven->c_lname . '</td>

						<td>' . $ven->c_address . '</td>
						<td>' . $ven->c_gstno . '</td>

						<td>' . $ven->c_panno . '</td>
						' . $doc . '
						<td>' . $ven->c_designation . '</td>

						<td><button id="color-x" type="button" class="btn btn-x" data-toggle="modal" data-target="#bank" onclick="bankDetails(`' . $this->sec->encryptor('e', $ven->c_id) . '`)">
								BankDetails
							</button></td>
						<td><button id="color-x" type="button" class="btn btn-x" data-toggle="modal" data-target="#contact" onclick="contactDetails(`' . $this->sec->encryptor('e', $ven->c_id) . '`)">
								ContactDetails
							</button></td>
						<td><a href="#" class="btn btn-danger" onclick="venDelete(`' . $this->sec->encryptor('e', $ven->c_id) . '`)">Delete</a><a href="#" class="btn btn-success" data-toggle="modal" data-target="#editVen" onclick="venUpdate(`' . $this->sec->encryptor('e', $ven->c_id) . '`)" >Edit</a></td>
						
					</tr>';
		}
		echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
	}

	public function venManagement()
	{
		$name = $this->session->userdata('username');
		if (isset($name)) {
			$this->load->view('header');
			$this->load->view('vm');
		} else {
			redirect('LoginController/login');
		}
	}

	public function addVendor()
	{
		$name = explode(" ", $this->input->post('c_name'));
		$lname = '';
		if (count($name) >= 2) {
			$lname = $name[1];
		}
		$contact = $this->input->post('c_contacts');
		$contacts = implode(", ", $contact);
		$data = array(
			'c_venid' => $this->input->post('vendorid'),
			'c_fname' => $name[0],
			'c_lname' => $lname,
			'c_nickname' => $this->input->post('c_nickname'),
			'c_tags' => $this->input->post('c_tags'),
			'c_designation' => $this->input->post('c_designation'),
			'c_address' => $this->input->post('c_address'),
			'c_contacts' => $contact,
			'c_email' => $this->input->post('c_email'),
			'c_gstno' => $this->input->post('c_gstno'),
			// 'c_banks' => implode(', ', $banks),
			'c_panno' => $this->input->post('c_panno'),
		);
		$error = $this->validate($data, $this->error_add_ven, $contact);
		if ($error) {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_add_ven));
			return;
		}

		// contact id generation...
		$details = array(
			'name' => $this->input->post('c_name'),
			'email' => $this->input->post('c_email'),
			'contact' => $this->input->post('c_contacts')[0],
			'type' => "vendor",
		);
		$res = $this->bank->curlReq(html_escape($details), $this->bank->contactURL);
		$contactID = '';
		if (isset($res['id'])) {
			$contactID = $res['id'];
		} else {
			$this->error_add_ven['contact_id'] = "Operation failed!, Please check following details: name, email, mobile no.";
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_add_ven));
			return;
		}
		// contact id generated sucessfully...

		$bankname = $this->input->post('c_bankname');
		$banks = array();
		for ($i = 0; $i < count($bankname); $i++) {
			// funds id generation for this bank with respected contact id...
			$details = array(
				"contact_id" => "$contactID",
				"account_type" => "bank_account",
				"bank_account" => array(
					"name" => $this->input->post('c_name'),
					"ifsc" => $this->input->post('c_ifsc')[$i],
					"account_number" => $this->input->post('c_accountno')[$i]
				)
			);
			$result = $this->bank->curlReq(html_escape($details), $this->bank->fundURL);
			$fundID = '';
			if (isset($result['id'])) {
				$fundID =  $result['id'];
			} else {
				$this->error_add_ven['funds_id'] = "Operation failed!, Please check following details: name, IFSC code, account number.";
				echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_add_ven));
				return;
			}
			// funds id generation overe here...

			// now, inserting this bank details into database...
			$bankDetails = array(
				'c_bankname' => $this->input->post('c_bankname')[$i],
				'c_ifsc' => $this->input->post('c_ifsc')[$i],
				'c_accountno' => $this->input->post('c_accountno')[$i],
				'c_status' => $this->input->post('c_status')[$i],
				'c_contactid' => $contactID,
				'c_fundsid' => $fundID
			);
			$lastID = $this->bank->insert(html_escape($bankDetails));
			array_push($banks, $lastID);
			// insertion over here...
		}


		$doc_name = $_FILES['c_document']['name'];
		$tmp_name = $_FILES['c_document']['tmp_name'];
		$img_error = $_FILES['c_document']['error'];

		$error = false;
		if ($img_error == 0) {
			// echo "\nInside img if";
			$doc_ex = pathinfo($doc_name, PATHINFO_EXTENSION);
			$doc_ex_lc = strtolower($doc_ex);

			$allowed_exs = array('pdf');
			if (in_array($doc_ex_lc, $allowed_exs)) {
				$new_doc_name = uniqid("DOC-", true) . '.' . $doc_ex_lc;
				$img_upload_path = "DOCS/" . $new_doc_name;
				move_uploaded_file($tmp_name, $img_upload_path);
				$data = array(
					'c_venid' => $this->input->post('vendorid'),
					'c_fname' => $name[0],
					'c_lname' => $lname,
					'c_nickname' => $this->input->post('c_nickname'),
					'c_tags' => $this->input->post('c_tags'),
					'c_designation' => $this->input->post('c_designation'),
					'c_address' => $this->input->post('c_address'),
					'c_contacts' => $contacts,
					'c_email' => $this->input->post('c_email'),
					'c_gstno' => $this->input->post('c_gstno'),
					'c_banks' => implode(', ', $banks),
					'c_panno' => $this->input->post('c_panno'),
					'c_document' => $new_doc_name
				);
				$error = $this->validate($data, $this->error_add_ven, $contact);
			} else {
				$data = array(
					'c_venid' => $this->input->post('vendorid'),
					'c_fname' => $name[0],
					'c_lname' => $lname,
					'c_nickname' => $this->input->post('c_nickname'),
					'c_tags' => $this->input->post('c_tags'),
					'c_designation' => $this->input->post('c_designation'),
					'c_address' => $this->input->post('c_address'),
					'c_contacts' => $contacts,
					'c_email' => $this->input->post('c_email'),
					'c_gstno' => $this->input->post('c_gstno'),
					'c_banks' => implode(', ', $banks),
					'c_panno' => $this->input->post('c_panno'),
				);
				$this->error_add_ven['document'] = "*Please upload a valid document";
				$error = $this->validate($data, $this->error_add_ven, $contact);
			}
		} else {
			$data = array(
				'c_venid' => $this->input->post('vendorid'),
				'c_fname' => $name[0],
				'c_lname' => $lname,
				'c_nickname' => $this->input->post('c_nickname'),
				'c_tags' => $this->input->post('c_tags'),
				'c_designation' => $this->input->post('c_designation'),
				'c_address' => $this->input->post('c_address'),
				'c_contacts' => $contacts,
				'c_email' => $this->input->post('c_email'),
				'c_gstno' => $this->input->post('c_gstno'),
				'c_banks' => implode(', ', $banks),
				'c_panno' => $this->input->post('c_panno'),
			);
			$error = $this->validate($data, $this->error_add_ven, $contact);
		}
		if (!$error) {
			$insert = $this->ven->insert(html_escape($data));
			if ($insert) {
				echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
			} else {
				echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
			}
		} else {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_add_ven));
		}
	}

	public function getContactDetails($id)
	{
		$result = $this->ven->getSingleVen($this->sec->encryptor('d', $id));
		$output = "";
		$contacts = explode(",", $result->c_contacts);
		foreach ($contacts as $con) {
			$output .= "<tr class='contacts'>
							<td>" . $con . "</td>
						</tr>";
		}
		echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
	}

	public function venDelete($id)
	{
		$result = $this->ven->getSingleVen($this->sec->encryptor('d', $id));
		$banks = explode(",", $result->c_banks);
		foreach ($banks as $bk) {
			$this->bank->deleteBank($bk);
		}

		$res = $this->ven->deleteSingleVen($id);
		if ($res) {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
		} else {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
		}
	}

	public function fetchVen($id)
	{
		$result = $this->ven->getSingleVen($this->sec->encryptor('d', $id));
		$result->c_id = $this->sec->encryptor('e', $result->c_id);
		$result->csrf = $this->security->get_csrf_hash();

		echo json_encode($result);
	}

	public function editVendor()
	{
		$id = $this->sec->encryptor('d', $this->input->post('ven'));
		$name = explode(" ", $this->input->post('c_name'));
		$lname = "";
		if(count($name) > 1){
			$lname = $name[1];
		}
		$data = array(
			'c_fname' => $name[0],
			'c_lname' => $lname,
			'c_nickname' => $this->input->post('c_nickname'),
			'c_address' => $this->input->post('c_address'),
			'c_gstno' => $this->input->post('c_gstno'),
			'c_panno' => $this->input->post('c_panno'),
			'c_email' => $this->input->post('c_email'),
			'c_designation' => $this->input->post('c_designation'),
			'c_tags' => $this->input->post('c_tags')
		);

		$error = $this->validateEdit($data, $this->error_edit_ven);
		if ($error) {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_edit_ven));
		} else {
			$updateBasicResult = $this->ven->updateBasic($id, html_escape($data));
			if ($updateBasicResult) {
				echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
			} else {
				echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
			}
		}
	}

	public function editContacts()
	{
		$contacts = $this->input->post('contacts');
		$id = $this->sec->encryptor('d', $this->input->post('c_id'));
		$data = array(
			'c_contacts' => $contacts,
		);
		if ($this->ven->updateContacts($id, html_escape($data))) {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
		} else {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
		}
	}

	public function checkBank()
	{
		if ($this->ven->checkBankNotInPayout($this->sec->encryptor('d', $this->input->post('c_id')))) {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'BANK NOT IN PAYOUT'));
		} else {
			echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'BANK IN PAYOUT'));
		}
	}

	public function getBankDetails($id)
	{
		$banks = $this->ven->getBanks($this->sec->encryptor('d', $id));
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
		echo json_encode(array('response' => $output, 'csrf' => $this->security->get_csrf_hash()));
	}

	public function setBankDetails($id, $bank)
	{
		$data = array(
			'c_banks' => implode(",", $bank),
		);
		$this->ven->setBanks($id, $data);
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
		$banks = explode(",", $this->ven->getBanks($id));
		foreach ($banks as $bank) {
			if (!in_array($bank, $existing_banks)) {
				$this->bank->deleteBank($bank);
			} else {
				array_push($exist, $bank);
			}
		}

		// contact id generation...
		$vendor = $this->ven->getSingleVen($id);
		// print_r($vendor);
		$details = array(
			'name' => $vendor->c_fname . " " . $vendor->c_lname,
			'email' => $vendor->c_email,
			'contact' => explode(',', $vendor->c_contacts)[0],
			'type' => "vendor",
		);
		$res = $this->bank->curlReq(html_escape($details), $this->bank->contactURL);
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
				// print_r( $data);

				$details = array(
					"contact_id" => "$contactID",
					"account_type" => "bank_account",
					"bank_account" => array(
						"name" => $vendor->c_fname . " " . $vendor->c_lname,
						"ifsc" => $data['c_ifsc'],
						"account_number" => $data['c_accountno']
					)
				);
				$result = $this->bank->curlReq(html_escape($details), $this->bank->fundURL);
				$fundID = $result['id'];
				$bankDetails = array(
					'c_bankname' => $data['c_bankname'],
					'c_ifsc' => $data['c_ifsc'],
					'c_accountno' => $data['c_accountno'],
					'c_status' => $data['c_status'],
					'c_contactid' => $contactID,
					'c_fundsid' => $fundID
				);
				$lastID = $this->bank->insert(html_escape($bankDetails));
				array_push($exist, $lastID);
			}
		}

		// print_r($exist);
		$this->setBankDetails($id, $exist);
		echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
	}
}
