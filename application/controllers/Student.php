<?php
class Student extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
        $this->load->helper(array('form', 'url'));
    }
    public function index($current_page=1)
    {
        $step = 5;
        $item_index = $current_page * $step - $step;
        $data['title'] = "Danh sách sinh viên";
        $data['students'] = $this->student_model->get_student_info($item_index);
        $data['pagination'] = parent::pagination('http://localhost/SinhVienAPS/page/');
        $page_layout = $this->load->view('student/index', $data, TRUE);

        parent::view($page_layout);
    }
    public function process_input()
    {
        $input_name = 'avatar';
        return array(
            "image"    => (parent::image_upload($input_name) != false) ? parent::image_upload($input_name) : 'fallback.png',
            "fullname" => $this->input->post('fullname'),
            "address"  => $this->input->post('address'),
            "course"   => $this->input->post('course'),
            "email"    => $this->input->post('email'),
            "phone"    => $this->input->post('phone'),
            "dob"      => $this->input->post('dob'),
            "bio"      => $this->input->post('bio')
        );
    }
    public function create()
    {
        if($this->student_model->add_student($this->process_input())) {
            echo '{"status": "ok"}';
        } else {
            echo '{"status": "error","reason": "Lỗi khi thêm dữ liệu"}';
        }
    }
}