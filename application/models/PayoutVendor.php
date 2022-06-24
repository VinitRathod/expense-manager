<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PayoutVendor extends CI_Model
{
    private $tbl = "t_vendorpayout";
    public function getAll() {
        $this->db->select("*");
        $this->db->from('t_vendors');
        $this->db->join($this->tbl,'t_vendors.c_id = '.$this->tbl.'.c_venid');
        return $this->db->get()->result();
    }

    public function getAllLatest()
    {
        $this->db->select("*");
        $this->db->from($this->tbl);
        $this->db->join('t_vendors', 't_vendors.c_id = ' . $this->tbl . '.c_venid');
        $this->db->order_by("modified_at","desc");
        return $this->db->get()->result();
    }

    public function updateStatus($id) {
        $this->db->where('c_id',$id);
        $arr = array(
            'c_status' => "paid",
            'modified_at' => date("Y-m-d H:i:s",time()),
        );
        $this->db->update($this->tbl,$arr);
    }

    public function checkInvoiceExist($invoice,$id) {
        if($id != 0) {
            return $this->db->where('c_invoiceno',$invoice)->get($this->tbl)->num_rows();
        } else {
            return $this->db->where(array('c_invoiceno'=>$invoice,'c_id !=' => $id))->get($this->tbl)->num_rows();
        }
    }
}
