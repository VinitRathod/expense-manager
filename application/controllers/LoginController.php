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
        if (isset($logindata)) {
            // not yet logged out...
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function index()
    {
        $user_email = $this->input->post("email");
        $user_pass = $this->input->post("password");
        $enc_pass = sha1($user_pass);
        $response = array(
            'error' => "",
            'success' => "",
            'csrf' => $this->security->get_csrf_hash(),
        );
        $get_user = $this->login->getUser($user_email,$enc_pass);
        
        if($get_user) {
            $this->session->set_userdata('username',$get_user->c_fname." ".$get_user->c_lname );
            $response['success'] = true;
        }

        if ($response['success'] != true) {
            $response['error'] = true;
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

        redirect('dashboard');
    }
}
