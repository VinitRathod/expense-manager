<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Model
{
    public function __construct()
    {
        $this->load->database('default');
        $this->load->library('session');

        parent::__construct();
    }

    public function insert($data)
    {
        if ($this->db->insert('t_bank', $data)) {
            return $this->db->insert_id();;
        } else {
            return false;
        }
    }
}
