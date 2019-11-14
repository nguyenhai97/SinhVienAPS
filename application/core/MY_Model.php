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
        // Cache the previous clause
        $this->db->start_cache();
        $this->db->order_by($data['sortColName'], $data['sortDirection']);
        if(!empty($data['searchTerm'])) {
            $this->db->like('fullname', $data['searchTerm']);
        }
        foreach ($data['filters'] as $key => $value) {
            if($value !== '') {
                $this->db->where($key, $value);
            }
        }
        $this->db->stop_cache();
        $queryNoLimit =$this->db->get($this->tableName);
        $query = $this->db->get($this->tableName, $data['length'], $data['start']);
        $result = array(
            'num_rows' => $queryNoLimit->num_rows(),
            'data' => $query->result()
        );
        $this->db->flush_cache();
        return $result;
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
