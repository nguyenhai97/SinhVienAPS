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
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        if($this->form_validation->run('addMember')) {
            if($this->student_model->add_student($this->process_input())) {
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