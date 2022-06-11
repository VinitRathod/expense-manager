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
		
	}

	public function venManagement() {
		$this->load->view('header');
		$this->load->view('vm');
	}

	public function addVendor() {
        $bankDetails = array(
			'c_banknames' => $this->input->post('c_bankname'),
			'c_ifscs' => $this->input->post('c_ifsc'),
			'c_accountnos' => $this->input->post('c_accountno'),
			'c_status' => $this->input->post('c_status')
		);
		$banks = "";

		$name = explode(" ",$this->input->post('c_name'));
		$contacts = implode(", ",$this->input->post('c_contacts'));
        $data = array(
			'c_fnam' => $name[0],
			'c_lname' => $name[1],
			'c_nickname' => $this->input->post('c_nickname'),
			'c_tags' => $this->input->post('c_tags'),
			'c_designation' => $this->input->post('c_designation'),
			'c_address' => $this->input->post('c_address'),
			'c_contacts' => $contacts,
			'c_email' => $this->input->post('c_email'),
			'c_gstno' => $this->input->post('c_gstno'),
			'c_banks' => $banks,
			'c_panno' => $this->input->post('c_panno'),
			'c_document' => $this->input->post('c_document')
		);
		// $insert = $this->ven->insert($data);
    }
}
