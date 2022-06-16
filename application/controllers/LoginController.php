<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    private $user_data = array(
        'c_username' => "",
        'c_fname' => "",
        'c_lname' => "",
        'c_email' => "",
        'c_password' => "",
        'c_phoneno' => ""
    );

    public function login()
    {
        $logindata = $this->session->userdata('username');
        if(isset($logindata)) {
            // not yet logged out...
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function index()
    {
        $_user = "";
        $all_users = $this->login->getAllUsers();
        $user_email = $this->input->post("email");
        $user_pass = $this->input->post("password");
        $enc_pass = sha1($user_pass);
        $response = array(
            'error' => "",
            'success' => ""
        );

        foreach ($all_users as $user) {
            if ($user->c_email == $user_email && $user->c_password == $enc_pass) {
                $_user = array(
                    'username' => $user->c_fname." ".$user->c_lname,
                );
                $response['success'] = true;
                break;
            }
        }

        if ($response['success'] != true) {
            $response['error'] = true;
        } else {
            $this->session->set_userdata($_user);
        }
        echo json_encode($response);
    }

    public function logout()
    {
        $_newUser = array(
            'username' => "",
        );
        $this->session->unset_userdata($_newUser);
        $this->session->sess_destroy();

        redirect('/');
    }
}
