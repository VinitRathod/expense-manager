<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserManagement extends CI_Controller
{
    private $usrname_regx = "/^[a-zA-Z]{3,20} [a-zA-Z]{3,20}$/";
    private $phoneno_regx = "/^[0-9]{10}$/";
    private $error_array_add_usr = [
        'warn_c_name' => '',
        'warn_c_email' => '',
        'warn_c_password' => '',
        'warn_c_phoneno' => ''
    ];
    public function usrManagement()
    {
        $this->load->view('header');
        $this->load->view('user_management');
    }

    public function getAllUsers()
    {
        $output = "";
        $allUsers = $this->usr->getAll();
        foreach ($allUsers as $user) {
            if ($this->session->userdata('username') == $user->c_fname . " " . $user->c_lname) {
                $output .= "";
            } else {
                $output .= '<tr>
                            <td>' . $user->c_fname . ' ' . $user->c_lname . '</td>
                            <td>' . $user->c_phoneno . '</td>
                            <td>' . $user->c_email . '</td>
                            <td style="width:11vw""><a href="#" class="btn btn-success mr-2" data-toggle="modal" data-target="#editUserModal" onclick="usrEdit(`' . $this->sec->encryptor('e', $user->c_id) . '`)">Edit</a><a href="#" class="btn btn-danger" onclick="usrDelete(`' . $this->sec->encryptor('e', $user->c_id) . '`)">Delete</a></td>
                        </tr>';
            }
        }
        echo json_encode(array('response' => $output, 'csrf' => $this->security->get_csrf_hash()));
    }

    public function addUser()
    {
        // print_r($_POST); // to just debug some things...
        $name = explode(" ", $this->input->post('c_name'));
        $lname = '';
        if(count($name) >= 2) {
            $lname = $name[1];
        }
        $data = array(
            'c_fname' => $name[0],
            'c_lname' => $lname,
            'c_email' => $this->input->post('c_email'),
            'c_password' => sha1($this->input->post('c_password')),
            'c_phoneno' => $this->input->post('c_phoneno')
        );
        $error = false;
        if(count($name) > 2 || count($name) < 2 || !preg_match($this->usrname_regx, $name[0].' '.$name[1])) {
            $this->error_array_add_usr['warn_c_name'] = '*Invalid Name';
            $error = true;
        }
        
        if($this->usr->checkUsrnameExist($name[0],$data['c_lname'])) {
            $this->error_array_add_usr['warn_c_name'] = '*Duplicate User Name Is Not Allowed';
            $error = true;
        }
        
        if(!preg_match($this->phoneno_regx, $data['c_phoneno'])) {
            $this->error_array_add_usr['warn_c_phoneno'] = '*Invalid Phone Number';
            $error = true;
        }
        
        if(!filter_var($data['c_email'], FILTER_VALIDATE_EMAIL)) {
            $this->error_array_add_usr['warn_c_email'] = '*Invalid Email Address';
            $error = true;
        } 
        
        if($this->usr->checkEmailExist($data['c_email'])) {
            $this->error_array_add_usr['warn_c_email'] = '*Email Address Must Be Unique';
            $error = true;
        }
        
        if(!$error) {
            if ($this->usr->insertUser(html_escape($data))) {
                echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
            } else {
                echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'QUERY FAILED'));
            }
        } else {
            echo json_encode(array('error' => $this->error_array_add_usr, 'csrf' => $this->security->get_csrf_hash()));
        }
    }

    public function deleteUser($id)
    {
        $res = $this->usr->deleteUser($this->sec->encryptor('d', $id));
        if ($res) {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
        } else {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
        }
    }

    public function editUsr()
    {
        $data = $this->usr->getSingleUser($this->sec->encryptor('d', $this->input->post('id')));
        $data->c_id = $this->sec->encryptor('e', $data->c_id);
        $data->csrf = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function updateUsr($id)
    {
        $name = explode(" ", $this->input->post('c_name'));
        $data = array(
            'c_fname' => $name[0],
            'c_lname' => $name[1],
            'c_email' => $this->input->post('c_email'),
            'c_phoneno' => $this->input->post('c_phoneno')
        );
        $response = $this->usr->updateUser($this->sec->encryptor('d', $id), html_escape($data));
        if ($response) {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'SUCCESS'));
        } else {
            echo json_encode(array('csrf' => $this->security->get_csrf_hash(), 'response' => 'ERROR'));
        }
    }
}
