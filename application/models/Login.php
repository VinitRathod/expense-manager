<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Model
{
    private $tbl = "t_users";
    public function getAllUsers() {
        return $this->db->get($this->tbl)->result();
    }

    public function getUser($e,$p) {
        $this->db->where('c_email', $e);
        $this->db->where('c_password', $p);
        return $this->db->get($this->tbl)->row();
    }
}
?>