<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserManagement extends CI_Controller
{
    public function usrManagement() {
        $this->load->view('header');
        $this->load->view('user_management');
    }

    public function getAllUsers() {
        $output = "";
        $allUsers = $this->usr->getAll();
        foreach($allUsers as $user) {
            if($this->session->userdata('username') == $user->c_fname." ".$user->c_lname) {
                $output .= "";
            } else {
                $output .= '<tr>
                            <td>'.$user->c_fname.' '.$user->c_lname.'</td>
                            <td>'.$user->c_phoneno.'</td>
                            <td>'.$user->c_email.'</td>
                            <td>Buttons</td>
                        </tr>';
            }
        }
        echo $output;
    }
}
?>