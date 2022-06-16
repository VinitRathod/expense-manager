<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{
    private $tbl = "t_users";
    
    public function getAll() {
        return $this->db->get($this->tbl)->result();
    }
}
?>