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

    public function insertEmpPay($data)
    {
        if ($this->db->insert('t_emppayout', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBasic($id, $data)
    {
        $this->db->where('c_id', $id);
        return $this->db->update('t_employees', $data);
    }

    public function getEmpPay()
    {
        $this->db->select("*");
        $this->db->from('t_employees');
        // to show Employee ID i have implemented joins
        $this->db->join('t_emppayout', 't_emppayout.c_empid = t_employees.c_id', 'right');
        $emps = $this->db->get();
        if ($emps) {
            return $emps->result();
        }
    }

    public function getEmpPayLatest()
    {
        $this->db->select("*");
        $this->db->from('t_employees');
        // to show Employee ID i have implemented joins
        $this->db->join('t_emppayout', 't_emppayout.c_empid = t_employees.c_id', 'right');

        $this->db->order_by("modified_at", "desc");
        $emps = $this->db->get();
        if ($emps) {
            return $emps->result();
        }
    }

    public function updateStatus($id)
    {
        $this->db->where('c_id', $id);
        $arr = array(
            'c_status' => "paid",
            'modified_at' => date("Y-m-d H:i:s", time()),
        );
        $this->db->update('t_emppayout', $arr);
    }

    public function checkBank($id)
    {
        $this->db->where("c_bank", $id);
        $rows = $this->db->get('t_emppayout')->result();
        if (empty($rows)) {
            return false;
        } else {
            return true;
        }
    }

    public function getBanks($id)
    {
        $this->db->where('c_id', $id);
        return $this->db->get('t_employees')->row()->c_banks;
    }

    public function setBanks($id, $data)
    {
        $this->db->where('c_id', $id);
        $this->db->update('t_employees', $data);
    }

    public function checkEmpId($empid, $id)
    {
        if ($id != 0) {
            return $this->db->where(array('c_empid' => $empid, 'c_id !=' => $id))->get('t_employees')->num_rows();
        } else {
            return $this->db->where('c_empid', $empid)->get('t_employees')->num_rows();
        }
    }
}
