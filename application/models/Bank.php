<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Model
{
    public $contactURL = "https://api.razorpay.com/v1/contacts";
    public $fundURL = "https://api.razorpay.com/v1/fund_accounts";

    public function curlReq($data, $url)
    {
        $apiKEY = "rzp_test_kfinzduUHtfEu8";
        $apiSecret = "4Hmo4HjuS2LsKvmUKk57kzZO";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "$apiKEY:$apiSecret");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return json_decode(curl_exec($ch), true);
    }

    public function __construct()
    {
        $this->load->database('default');
        $this->load->library('session');

        parent::__construct();
    }

    public function insert($data)
    {
        if ($this->db->insert('t_bank', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getSingleBankDetail($id)
    {
        $this->db->where("c_id", $id);
        return $this->db->get('t_bank')->row();
    }

    public function deleteBank($id) {
        $this->db->where("c_id",$id);
        return $this->db->delete('t_bank');
    }
}
