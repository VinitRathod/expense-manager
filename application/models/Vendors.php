<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendors extends CI_Model
{
    public function __construct()
    {
        $this->load->database('default');
        $this->load->library('session');

        parent::__construct();
    }

    public function insert($data)
    {
        if ($this->db->insert('t_vendors', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVen()
    {
        $emps = $this->db->get('t_vendors');
        if ($emps) {
            return $emps->result();
        }
    }

    public function getSingleVen($id)
    {
        $this->db->where('c_id', $id);
        $view = $this->db->get('t_vendors');

        if ($view) {
            return $view->row();
        }
    }
}
