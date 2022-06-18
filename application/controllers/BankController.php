<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BankController extends CI_Controller
{
    public function getBankDetails($ids) {
        $output = "";
        $id = explode("_",$ids);
        for($i = 0; $i<count($id)-1; $i++) {
            // echo $id[$i];
            $bDetails = $this->bank->getSingleBankDetail($id[$i]);
            // print_r($bDetails);
            $output .= "<tr>
                    <td>".$bDetails->c_bankname."</td>
                    <td>".$bDetails->c_ifsc."</td>
                    <td>".$bDetails->c_accountno."</td>
                    <td>".$bDetails->c_status."</td>
                </tr>";
        }
        echo $output;
    }

    public function getJSONBank() {
        $banks = explode(",",$this->input->post('banks_id'));
        $bDetails = $this->bank->getJSON($banks);
        echo json_encode($bDetails);
    }
}
