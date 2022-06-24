<?php
defined('BASEPATH') or exit('No direct script access allowed');


class PayoutController extends CI_Controller
{
    public function payOutEmp($id)
    {
        // echo $this->sec->encryptor('d', $id);
        $pay = $this->bank->getBankDetails($this->sec->encryptor('d', $id));

        $data = array(
            'account_number' => $pay->c_accountno,
            'fund_account_id' => $pay->c_fundsid,
            'amount' => $pay->c_amount,
            'currency' => 'INR',
            'mode' => 'NEFT',
            'purpose' => 'salary',
        );

        $result = $this->pout->curlPayoutReq($data);

        if (($result['error'])) {
            echo json_encode(array('error' => $result['error']['code'], 'csrf' => $this->security->get_csrf_hash()));
        } else {
            $this->emp->updateStatus($this->sec->encryptor('d', $id));
            echo json_encode(array('csrf' => $this->security->get_csrf_hash()));
        }
        // echo json_encode(array('result' => $result['error'], 'csrf' => $this->security->get_csrf_hash()));



        // echo json_encode($pay);

        // $this->db->select("*");
        // $this->db->from("t_emppayout");
        // $this->db->join('t_bank', 't_bank.c_id = t_emppayout.c_bank', 'inner');
        // $this->db->where('c_id', $this->sec->encryptor($id));

        // $this->db->get()->row();
        // $this->db->join('t_','','inner');
    }

    public function payOutVen($id)
    {
        // just for id debugging...
        // echo $this->sec->encryptor('d', $id);
        $pay = $this->bank->getBankDetailsVen($this->sec->encryptor('d', $id));
        // just for response debugging...
        // echo json_encode($pay);

        $data = array(
            'account_number' => $pay->c_accountno,
            'fund_account_id' => $pay->c_fundsid,
            'amount' => $pay->c_amount,
            'currency' => 'INR',
            'mode' => 'NEFT',
            'purpose' => 'payout',
        );

        $result = $this->pout->curlPayoutReq($data);

        if (!empty($result)) {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => json_encode($result)));
            $this->venPay->updateStatus($this->sec->encryptor('d', $id));
        } else {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => json_encode($result)));
        }
    }
}
