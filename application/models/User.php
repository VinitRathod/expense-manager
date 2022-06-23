<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{
    private $tbl = "t_users";

    public function getAll() {
        return $this->db->get($this->tbl)->result();
    }

    public function insertUser($data) {
        return $this->db->insert($this->tbl,$data);
    }

    public function deleteUser($id) {
        $this->db->where('c_id',$id);
        return $this->db->delete($this->tbl);
    }

    public function getSingleUser($id) {
        $this->db->where('c_id',$id);
        return $this->db->get($this->tbl)->row();
    }

    public function updateUser($id, $data) {
        $this->db->where('c_id',$id);
        return $this->db->update($this->tbl,$data);
    }

    public function checkEmailExist($email,$id) {
        if($id != 0) {
            $this->db->where(array('c_email',$email,'c_id !=',$id))->get($this->tbl)->num_rows();
        } else {
            return $this->db->where('c_email',$email)->get($this->tbl)->num_rows();
        }
    }

    public function checkUsrnameExist($fname,$lname,$id) {
        if($id!=0) {
            $this->db->where(array('c_fname' => $fname,'c_lname' => $lname,'c_id !=',$id))->get($this->tbl)->num_rows();
        } else {
            return $this->db->where(array('c_fname' => $fname,'c_lname' => $lname))->get($this->tbl)->num_rows();
        }
    }
}
?>