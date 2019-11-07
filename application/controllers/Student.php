<?php
class Student extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
        $this->load->helper(array('form', 'url', 'page'));
    }
    public function index($current_page=1)
    {
        $data['title'] = "Danh sách sinh viên";
        $data['students'] = $this->student_model->get_student_info(item_index(5,$current_page));
        $data['pagination'] = parent::pagination('http://localhost/SinhVienAPS/page/');
        $data['page_layout'] = $this->load->view('student/index', $data, TRUE);

        parent::view($data);
    }
    public function create()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run('addMember')) {
            $isUploaded = parent::image_upload('avatar');
            $field['image'] = ($isUploaded === false) ? 'fallback.png' : $isUploaded;

            if($this->student_model->add_student(parent::process_input($field))) {
                $result = array('status'=>'ok');
            } else {
                $result = array('status' => 'add_error');
            }
        } else {
            $result = array(
                'status'    => 'valid_error',
                'track_err' => array(
                    'fullname'  => form_error('fullname'),
                    'email'     => form_error('email'),
                    'address'   => form_error('address'),
                    'course'    => form_error('course'),
                    'phone'    => form_error('phone'),
                    'dob'       => form_error('dob'),
                )
            );
        }
        echo json_encode($result);
    }
}