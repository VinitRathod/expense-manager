<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PayoutVendor extends CI_Model
{
    private $tbl = "t_vendorpayout";
    public function getAll() {
        $this->db->select("*");
        $this->db->from($this->tbl);
        $this->db->join('t_vendors','t_vendors.c_id = '.$this->tbl.'.c_venid');
        return $this->db->get()->result();
    }
}
?>