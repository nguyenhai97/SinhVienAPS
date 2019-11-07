<?php
class Student_model extends MY_Model {
    public function __construct()
    {
        parent::__construct("Student");
    }
    public function get_student_info($start_index)
    {

        return parent::getNewest(5,$start_index);
    }
    public function add_student($data)
    {
        if(parent::addItem($data)) {
            return true;
        }
        return false;
    }
    public function num_row()
    {
        return parent::totalRow();
    }

}