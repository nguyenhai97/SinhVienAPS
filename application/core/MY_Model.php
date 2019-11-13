<?php
class MY_Model extends CI_Model
{
    private $tableName = '';

    public function __construct($table_name)
    {
        $this->load->database();
        $this->tableName = $table_name;
    }
    public function getNewest($data)
    {
        $this->db->order_by($data['sortColName'], $data['sortDirection']);
        if(!empty($data['searchTerm'])) {
            $this->db->like('fullname', $data['searchTerm']);
        }
        $query = $this->db->get($this->tableName, $data['length'], $data['start']);
        return $query->result();
    }
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }
    public function addItem($data)
    {
        if ($this->db->insert($this->tableName, $data)) {
            return true;
        }
        return false;
    }
    public function updateItem($data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->tableName, $data)) {
            return true;
        }
        return false;
    }
    public function totalRow()
    {
        return $this->db->count_all($this->tableName);
    }
    //DONE: them delete vao day
    public function delete($id = null)
    {
        if(empty($id)) {
            return false;
        }
        if($this->db->delete($this->tableName, array('id' => $id))) {
            return true;
        }
        return false;
    }
}
