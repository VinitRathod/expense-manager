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
}
?>