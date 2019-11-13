<?php
class Student_model extends MY_Model {
    public function __construct()
    {
        parent::__construct("Student");
    }
    public function get_student_info($data)
    {
        $students = parent::getNewest($data);
        foreach($students as $student) {
            $date = new DateTime($student->dob);
            $student->dob = $date->format('d/m/Y');
        }
        return $students;
    }
    public function get_student($id) {
        return parent::get($id);
    }
    public function add_student($data)
    {
        if(parent::addItem($data)) {
            return true;
        }
        return false;
    }
    public function update_student($data, $id)
    {
        if(parent::updateItem($data, $id)) {
            return true;
        }
        return false;
    }
    public function num_row()
    {
        return parent::totalRow();
    }
    public function delele($id = null) {
        if(parent::delete($id)) {
            return true;
        }
        return false;
    }
}