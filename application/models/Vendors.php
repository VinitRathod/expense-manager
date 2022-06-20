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

    public function deleteSingleVen($id) {
        $this->db->where('c_id',$this->sec->encryptor('d',$id));
        return $this->db->delete('t_vendors');
    }

    public function insertVenPay($data) {
        return $this->db->insert('t_vendorpayout',$data);
    }

    public function updateBasic($id,$data) {
        $this->db->where('c_id',$id);
        return $this->db->update('t_vendors',$data);
    }

    public function updateContacts($id,$data) {
        $this->db->where('c_id',$id);
        return $this->db->update('t_vendors',$data);
    }

    public function checkBankNotInPayout($id) {
        $this->db->where('c_bankid',$id);
        $rows = $this->db->get('t_vendorpayout')->result();
        if(empty($rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function getBanks($id) {
        $this->db->where('c_id',$id);
        return $this->db->get('t_vendors')->row()->c_banks;
    }

    public function setBanks($id,$data) {
        $this->db->where('c_id',$id);
        $this->db->update('t_vendors',$data);
    }
}
