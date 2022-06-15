<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payout extends CI_Model
{
    public $payout = "https://api.razorpay.com/v1/payouts";

    public function curlPayoutReq($data, $url)
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
}
// curl -u "rzp_test_kfinzduUHtfEu8":"4Hmo4HjuS2LsKvmUKk57kzZO" \
// -X POST https://api.razorpay.com/v1/payouts \
// -H "Content-Type: application/json" \
// -d '{
// "account_number": "7878780080316316",
// "fund_account_id": "fa_00000000000001",
// "amount": 1000000,
// "currency": "INR",
// "mode": "IMPS",
// "purpose": "refund",
// "queue_if_low_balance": true,
// "reference_id": "Acme Transaction ID 12345",
// "narration": "Acme Corp Fund Transfer",
// "notes": {
// "notes_key_1":"Tea, Earl Grey, Hot",
// "notes_key_2":"Tea, Earl Grey… decaf."
// }
// }'
