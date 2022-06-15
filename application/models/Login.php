<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Model
{
    private $tbl = "t_users";
    public function getAllUsers() {
        return $this->db->get($this->tbl)->result();
    }
}
?>