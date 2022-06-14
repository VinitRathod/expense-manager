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
}
