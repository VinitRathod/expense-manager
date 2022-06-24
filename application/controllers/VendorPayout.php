<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorPayout extends CI_Controller
{
    private $error_ven_payout = [
        'warn_amount' => '',
        'warn_invoice' => '',
        'warn_ref' => '',
        'warn_tags' => '',
        'warn_c_banks' => '',
        'warn_c_venid' => '',
        'warn_doc' => '',
        'warn_category' => '',

    ];
    public function venPayout()
    {
        $name = $this->session->userdata('username');
        if (isset($name)) {
            $this->load->view('header');
            $this->load->view('ven_payout');
        } else {
            redirect('LoginController/login');
        }
    }

    public function getAllVen()
    {
        $output = '<option value="null"> --SELECT VENDOR-- </option>';
        $allVen = $this->ven->getAllVen();
        foreach ($allVen as $vendor) {
            $output .= '<option value="' . $this->sec->encryptor('e', $vendor->c_id) . '">' . $vendor->c_fname . ' ' . $vendor->c_lname . ' - ' . $vendor->c_id . '</option>';
        }
        echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
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
        echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
    }

    public function getExpCat()
    {
        $result = $this->exp->getAllExpOf("vendor");
        $output = '<option value="null"> --SELECT EXPENSE CATEGORY-- </option>';
        if ($result) {
            foreach ($result as $cat) {
                $output .= '<option value="' . $this->sec->encryptor('e', $cat->c_expid) . '"> ' . $cat->c_category . ' </option>';
            }
        }
        echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
    }

    public function validate($data,&$e_array,$id=0) {
        $error = false;
        if (empty($data['c_amount']) || $data['c_amount'] <= 0) {
            $e_array['warn_amount'] = "*Amount is invalid or empty!";
            $error = true;
        }

        if (empty($data['c_invoiceno']) || $data['c_invoiceno'] == "" || $data['c_invoiceno'] == null) {
            $e_array['warn_invoice'] = "*Invoice is invalid or empty!";
            $error = true;
        }

        if ($data['c_invoiceno'] != "" && $this->venPay->checkInvoiceExist($data['c_invoiceno'],$id)) {
            $e_array['warn_invoice'] = "*Duplicate invoice is not allowed!";
            $error = true;
        }

        if (empty($data['c_reference']) || $data['c_reference'] == "" || $data['c_reference'] == null) {
            $e_array['warn_ref'] = "*Reference is invalid or empty!";
            $error = true;
        }

        if (empty($data['c_tags']) || $data['c_tags'] == "" || $data['c_tags'] == null) {
            $e_array['warn_tags'] = "Tags are invalid or empty!";
            $error = true;
        }

        if(empty($data['c_bankid']) || $data['c_bankid'] == "" || $data['c_bankid'] == null) {
            $e_array['warn_c_banks'] = "*Bank is invalid or not selected!";
            $error = true;
        }

        if(empty($data['c_venid']) || $data['c_venid'] == "" || $data['c_venid'] == null) {
            $e_array['warn_c_venid'] = "*Vendor is invalid or not selected!";
            $error = true;
        }

        if(empty($data['c_expcategory']) || $data['c_expcategory'] == "" || $data['c_expcategory'] == null) {
            $e_array['warn_category'] = "*Expense category is invalid or not selected!";
            $error = true;
        }

        return $error;
    }

    public function addVenPay()
    {
        $doc_name = $_FILES['document']['name'];
        $tmp_name = $_FILES['document']['tmp_name'];
        $img_error = $_FILES['document']['error'];
        $data = array();
        if ($img_error == 0) {
            // echo "\nInside img if";
            $doc_ex = pathinfo($doc_name, PATHINFO_EXTENSION);
            $doc_ex_lc = strtolower($doc_ex);

            $allowed_exs = array('pdf');
            if (in_array($doc_ex_lc, $allowed_exs)) {
                $new_doc_name = uniqid("DOC-", true) . '.' . $doc_ex_lc;
                $img_upload_path = "DOCS-PAYOUT/VEN-PAYOUTS/" . $new_doc_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $data = array(
                    'c_invoiceno' => $this->input->post("invoice"),
                    'c_venid' => $this->sec->encryptor('d', $this->input->post("c_venid")),
                    'c_expcategory' => $this->sec->encryptor('d', $this->input->post("c_category")),
                    'c_amount' => $this->input->post("amount"),
                    'c_bankid' => $this->sec->encryptor('d', $this->input->post("c_banks")),
                    'c_scheduledDate' => $this->input->post("paypd"),
                    "c_reference" => $this->input->post("references"),
                    'c_document' => $new_doc_name,
                    'c_status' => "unpaid",
                    'c_tags' => $this->input->post("Tags"),
                    'c_paymentmode' => $this->input->post("pay_mode"),
                    'created_at' => date("Y-m-d  H:i:s", time()),
                    'modified_at' => date("Y-m-d  H:i:s", time()),
                );
            } else {
                $data = array(
                    'c_invoiceno' => $this->input->post("invoice"),
                    'c_venid' => $this->sec->encryptor('d', $this->input->post("c_venid")),
                    'c_expcategory' => $this->sec->encryptor('d', $this->input->post("c_category")),
                    'c_amount' => $this->input->post("amount"),
                    'c_bankid' => $this->sec->encryptor('d', $this->input->post("c_banks")),
                    'c_scheduledDate' => $this->input->post("paypd"),
                    "c_reference" => $this->input->post("references"),
                    'c_status' => "unpaid",
                    'c_tags' => $this->input->post("Tags"),
                    'c_paymentmode' => $this->input->post("pay_mode"),
                    'created_at' => date("Y-m-d  H:i:s", time()),
                    'modified_at' => date("Y-m-d  H:i:s", time()),
                );
                $this->error_ven_payout['warn_doc'] = "*Invalid file type!";
            }
        } else {
            $data = array(
                'c_invoiceno' => $this->input->post("invoice"),
                'c_venid' => $this->sec->encryptor('d', $this->input->post("c_venid")),
                'c_expcategory' => $this->sec->encryptor('d', $this->input->post("c_category")),
                'c_amount' => $this->input->post("amount"),
                'c_bankid' => $this->sec->encryptor('d', $this->input->post("c_banks")),
                'c_scheduledDate' => $this->input->post("paypd"),
                "c_reference" => $this->input->post("references"),
                'c_status' => "unpaid",
                'c_tags' => $this->input->post("Tags"),
                'c_paymentmode' => $this->input->post("pay_mode"),
                'created_at' => date("Y-m-d  H:i:s", time()),
                'modified_at' => date("Y-m-d  H:i:s", time()),
            );
        }
        $error = $this->validate($data,$this->error_ven_payout);
        if(!$error) {
            if ($this->ven->insertVenPay(html_escape($data))) {
                echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
            }
        } else {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'error' => $this->error_ven_payout));
        }
    }

    public function getAllPayouts()
    {
        $allPayouts = $this->venPay->getAll();
        // echo "<pre>";
        // print_r($allPayouts);
        // echo "</pre>";
        $action = "";
        $date = "";
        $output = "";
        foreach ($allPayouts as $pay) {
            if ($pay->c_paymentmode == "manual" && $pay->c_status == "unpaid") {
                $action = '<button type="button" class="btn btn-x mr-5 payout" id="' . $this->sec->encryptor('e', $pay->c_id) . '" > Pay now </button>';
                // $action = '<a href="#"><img class="payout" id="' . $this->sec->encryptor('e', $pay->c_id) . '" src="' . base_url() . 'assets/icons/cash-stack.svg" width="60%" height="60%" alt="pay-now" data-bs-toggle="tooltip" title="Pay-Now"></a>';
            } else if ($pay->c_paymentmode == "schedule" && $pay->c_status == "unpaid") {
                $action = '<button type="button" class="btn btn-outline-warning" disabled> Scheduled </button>';
            } else if ($pay->c_status == "paid") {
                $action = '<button type="button" class="btn btn-outline-success" disabled> Payment Done </button>';
            }

            if (!empty($pay->c_scheduledDate)) {
                $date = $pay->c_scheduledDate;
            } else {
                $date = "Payment Is Manual";
            }
            $output .= '<tr>
                            <td>' . $pay->c_fname . ' ' . $pay->c_lname . '</td>
                            <td>' . $pay->c_amount . '</td>
                            <td>' . $date . '</td>
                            <td>' . $pay->c_paymentmode . '</td>
                            <td>' . $pay->c_status . '</td>
                            <td>
                                ' . $action . '
                            </td>
                        </tr>';
        }
        echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => $output));
    }

    public function getAllPayoutsLatest()
    {
        $allPayouts = $this->venPay->getAllLatest();
        $date = "";
        $output = "";
        foreach ($allPayouts as $pay) {

            if (!empty($pay->c_scheduledDate)) {
                $date = $pay->c_scheduledDate;
            } else {
                $date = "Payment Is Manual";
            }
            $output .= '<tr>
                            <td>' . $pay->c_fname . ' ' . $pay->c_lname . '</td>
                            <td>' . $pay->c_amount . '</td>
                            <td>' . $date . '</td>
                        </tr>';
        }
        // echo $output;
        echo json_encode(array('output' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }
}
