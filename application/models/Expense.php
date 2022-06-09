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

    public function getAll() {
        $expense = $this->db->get('t_expcategories');
        if($expense) {
            return $expense->result();
        }
    }
}

?>