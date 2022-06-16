<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PayoutVendor extends CI_Model
{
    private $tbl = "t_vendorpayout";
    public function getAll() {
        $this->db->select("*");
        $this->db->from('t_vendors');
        $this->db->join($this->tbl,$this->tbl.'.c_id = t_vendors.c_venid');
        return $this->db->get()->result();
    }
}
?>