<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorManagement extends CI_Controller
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

	// ajax will take contents from this functions, only select * query...
	public function index()
	{
		$data['ven_details'] = $this->ven->getAllVen();

		$output = "";
		foreach ($data['ven_details'] as $ven) {
			$doc = "";
			if(!empty($ven->c_document)) {
				$doc = '<td style="text-align: center;">
						<a href="'.base_url().'DOCS/'.$ven->c_document.'" download >  
						<img id="downloadIcon" src="'.base_url().'assets/icons/download.svg" width="50%" height="50%">  
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
						'.$doc.'
						<td>' . $ven->c_designation . '</td>

						<td><button id="color-x" type="button" class="btn btn-primary" data-toggle="modal" data-target="#bank" onclick="bankDetails('.$ven->c_banks.')">
								BankDetails
							</button></td>
						<td><button id="color-x" type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact" onclick="contactDetails('.$ven->c_id.')">
								ContactDetails
							</button></td>
						<td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#editVen" onclick="venUpdate(`'.$this->sec->encryptor('e',$ven->c_id).'`)" >Edit</a>
							<a href="#" class="btn btn-danger" onclick="venDelete(`'.$this->sec->encryptor('e',$ven->c_id).'`)">Delete</a>
						</td>
					</tr>';
		}
		echo $output;
	}

	public function venManagement()
	{
		$this->load->view('header');
		$this->load->view('vm');
	}

	public function addVendor()
	{
		// contact id generation...
		$details = array(
			'name' => $this->input->post('c_name'),
			'email' => $this->input->post('c_email'),
			'contact' => $this->input->post('c_contacts')[0],
			'type' => "vendor",
		);
		$res = $this->bank->curlReq($details, $this->bank->contactURL);
		$contactID = $res['id'];
		// contact id generated sucessfully...

		$bankname = $this->input->post('c_bankname');
		$banks = array();
		for ($i = 0; $i < count($bankname); $i++) {
			$details = array(
				"contact_id" => "$contactID",
				"account_type" => "bank_account",
				"bank_account" => array(
					"name" => $this->input->post('c_name'),
					"ifsc" => $this->input->post('c_ifsc')[$i],
					"account_number" => $this->input->post('c_accountno')[$i]
				)
			);
			$result = $this->bank->curlReq($details, $this->bank->fundURL);
			$fundID = $result['id'];
			$bankDetails = array(
				'c_bankname' => $this->input->post('c_bankname')[$i],
				'c_ifsc' => $this->input->post('c_ifsc')[$i],
				'c_accountno' => $this->input->post('c_accountno')[$i],
				'c_status' => $this->input->post('c_status')[$i],
				'c_contactid' => $contactID,
				'c_fundsid' => $fundID
			);
			$lastID = $this->bank->insert($bankDetails);
			array_push($banks, $lastID);
		}

		$name = explode(" ", $this->input->post('c_name'));
		$contact = $this->input->post('c_contacts');
		$contacts = implode(", ", $contact);

		$doc_name = $_FILES['c_document']['name'];
		$tmp_name = $_FILES['c_document']['tmp_name'];
		$img_error = $_FILES['c_document']['error'];


		if ($img_error == 0) {
			echo "\nInside img if";
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
					'c_lname' => $name[1],
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
			}
		} else {
			$data = array(
				'c_venid' => $this->input->post('vendorid'),
				'c_fname' => $name[0],
				'c_lname' => $name[1],
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
		}
		$insert = $this->ven->insert($data);
	}

	public function getContactDetails($id) {
        $result = $this->ven->getSingleVen($id);
		$output = "";
		$contacts = explode(",",$result->c_contacts);
        foreach($contacts as $con) {
			$output .= "<tr>
							<td>".$con."</td>
						</tr>";
		}
		echo $output;
    }

	public function venDelete($id) {
		$result = $this->ven->getSingleVen($this->sec->encryptor('d',$id));
		$banks = explode(",",$result->c_banks);
		foreach($banks as $bk) {
			$this->bank->deleteBank($bk);
		}
		
		$res = $this->ven->deleteSingleVen($id);
		if($res) {
			echo "SUCCESS";
		}
	}

	public function fetchVen($id) {
		$result = $this->ven->getSingleVen($this->sec->encryptor('d',$id));
		
		$output = json_encode($result);
		echo $output;
	}
}
