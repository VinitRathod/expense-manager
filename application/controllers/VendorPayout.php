<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorPayout extends CI_Controller
{
    public function venPayout()
    {
        $this->load->view('header');
        $this->load->view('ven_payout');
    }

    public function getAllVen()
    {
        $output = '<option value="null"> --SELECT VENDOR-- </option>';
        $allVen = $this->ven->getAllVen();
        foreach ($allVen as $vendor) {
            $output .= '<option value="' . $this->sec->encryptor('e', $vendor->c_id) . '">' . $vendor->c_fname . ' ' . $vendor->c_lname . ' - ' . $vendor->c_id . '</option>';
        }
        echo $output;
    }

    public function getVendorBanks($id)
    {
        $output = '<option value="null"> --SELECT BANK-- </option>';
        $vendor = $this->ven->getSingleVen($this->sec->encryptor('d', $id));
        if ($vendor) {
            $banks = explode(",", $vendor->c_banks);
            foreach ($banks as $bid) {
                $bankDetails = $this->bank->getSingleBankDetail($bid);
                $output .= '<option value="' . $this->sec->encryptor('e', $bankDetails->c_id) . '">' . $bankDetails->c_bankname . '</option>';
            }
        }
        echo $output;
    }

    public function getExpCat() {
        $result = $this->exp->getAllExpOf("vendor");
        $output = '<option value="null"> --SELECT EXPENSE CATEGORY-- </option>';
        if($result) {
            foreach($result as $cat) {
                $output .= '<option value="'.$this->sec->encryptor('e',$cat->c_expid).'"> '.$cat->c_category.' </option>';
            }
        }
        echo $output;
    }

    public function addVenPay() {
        $data = array(
            'c_invoiceno' => $this->input->post("invoice"),
            'c_venid' => $this->sec->encryptor('d',$this->input->post("c_venid")),
            'c_expcategory' => $this->sec->encryptor('d',$this->input->post("c_category")),
            'c_amount' => $this->input->post("amount"),
            'c_bankid' => $this->sec->encryptor('d',$this->input->post("c_banks")),
            'c_scheduledDate' => $this->input->post("paypd"),
            "c_reference" => $this->input->post("references"),
            'c_document' => "NULL.pdf",
            'c_status' => "unpaid",
            'c_tags' => $this->input->post("Tags"),
            'c_paymentmode' => $this->input->post("pay_mode")
        );
        if($this->ven->insertVenPay($data)) {
            echo "SUCCESS";
        }
    }
}
