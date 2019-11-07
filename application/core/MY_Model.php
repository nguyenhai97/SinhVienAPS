<?php
class MY_Model extends CI_Model {
    public function __construct($table_name)
    {
        $this->load->database();
        $GLOBALS['TABLE'] = $table_name;
    }
    public function getNewest($num_of_record, $start_index)
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get($GLOBALS['TABLE'], $num_of_record, $start_index);
        return $query->result();
    }
    public function addItem($data)
    {
        if($this->db->insert($GLOBALS['TABLE'], $data)) {
            return true;
        }
        return false;
    }
    public function totalRow()
    {
        return $this->db->count_all($GLOBALS['TABLE']);
    }
}