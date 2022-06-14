<?php 

class Expense extends CI_Model {
    public function __construct() 
    {
        $this->load->database('default');
        $this->load->library('session');

        parent::__construct();
    }

    public function insert($data) {
        if($this->db->insert('t_expcategories',$data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data,$id) {
        $this->db->where("c_expid",$id);
        return $this->db->update('t_expcategories',$data);
    }

    public function getAll() {
        $expense = $this->db->get('t_expcategories');
        if($expense) {
            return $expense->result();
        }
    }

    public function getSingleExp($id) {
        $this->db->where('c_expid', $id);
        $query = $this->db->get('t_expcategories');

        if ($query) {
            return $query->row();
        }
    }

    public function deleteExp($id) {
        $this->db->where('c_expid',$id);
        return $this->db->delete('t_expcategories');
    }

    public function getAllExpOf($whom) {
        $this->db->where('c_type',$whom);
        return $this->db->get('t_expcategories')->result();
    }
}

?>