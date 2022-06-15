<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $data = array(
        'c_username' => "",
        'c_fname' => "",
        'c_lname' => "",
        'c_email' => "",
        'c_password' => "",
        'c_phoneno' => ""
    );
    public function index() {
        $all_users = $this->login->getAllUsers();
        $user_email = $this->input->post("email");
        $user_pass = $this->input->post("password");
        $enc_pass = sha1($user_pass);
        $response = array(
            'error' => "",
            'success' => ""
        );

        foreach($all_users as $user) {
            if($user->c_email == $user_email && $user->c_password == $enc_pass) {
                $response['success'] = true;
                break;
            }
        }

        if($response['success'] != true) {
            $response['error'] = true;
        }

        echo json_encode($response);
    }
	
}
?>
