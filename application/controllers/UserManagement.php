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
                            <td style="width:11vw""><a href="#" class="btn btn-success mr-2" data-toggle="modal" data-target="#editUserModal" onclick="usrEdit(`'.$this->sec->encryptor('e',$user->c_id).'`)">Edit</a><a href="#" class="btn btn-danger" onclick="usrDelete(`'.$this->sec->encryptor('e',$user->c_id).'`)">Delete</a></td>
                        </tr>';
            }
        }
        echo json_encode(array('response'=>$output,'csrf'=>$this->security->get_csrf_hash()));
    }

    public function addUser() {
        // print_r($_POST); // to just debug some things...
        $name = explode(" ",$this->input->post('c_name'));
        $data = array(
            'c_fname' => $name[0],
            'c_lname' => $name[1],
            'c_email' => $this->input->post('c_email'),
            'c_password' => sha1($this->input->post('c_password')),
            'c_phoneno' => $this->input->post('c_phoneno')
        );
        if($this->usr->insertUser($data)) {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
        } else {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'QUERY FAILED'));
        }
    }

    public function deleteUser($id) {
        $res = $this->usr->deleteUser($this->sec->encryptor('d',$id));
        if($res) {
            echo json_encode(array('csrf'=>$this->security->get_csrf_hash(), 'response'=>'SUCCESS'));
        } else {
            echo json_encode(array('csrf'=>$this->security->get_csrf_hash(), 'response'=>'ERROR'));
        }
    }

    public function editUsr($id) {
        $data = $this->usr->getSingleUser($this->sec->encryptor('d',$id));
        $data->c_id = $this->sec->encryptor('e',$data->c_id);
        echo json_encode($data);
    }

    public function updateUsr($id) {
        $name = explode(" ",$this->input->post('c_name'));
        $data = array(
            'c_fname' => $name[0],
            'c_lname' => $name[1],
            'c_email' => $this->input->post('c_email'),
            'c_phoneno' => $this->input->post('c_phoneno')
        );
        $response = $this->usr->updateUser($this->sec->encryptor('d',$id), $data);
        if($response) {
            echo "SUCCESS";
        } else {
            echo "QUERY FAILED";
        }
    }
}
?>