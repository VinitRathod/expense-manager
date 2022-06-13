<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends CI_Model
{
    public function __construct()
    {
        $this->load->database('default');
        $this->load->library('session');

        parent::__construct();
    }

    public function insert($data)
    {
        if ($this->db->insert('t_employees', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllEmp()
    {
        $emps = $this->db->get('t_employees');
        if ($emps) {
            return $emps->result();
        }
    }

    public function getSingleEmp($id)
    {
        $this->db->where('c_id', $id);
        $view = $this->db->get('t_employees');

        if ($view) {
            return $view->row();
        }
    }

    public function deleteEmp($id)
    {
        $this->db->where('c_id', $id);
        return $this->db->delete('t_employees');
    }
}
