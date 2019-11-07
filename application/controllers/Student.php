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
        $this->setValidRules();
        if($this->form_validation->run()) {
            $isUploaded = parent::image_upload('avatar');
            $field['image'] = ($isUploaded === false) ? 'fallback.png' : $isUploaded;
            $data = parent::process_input($field);

            // Remove duplicate date of birth
            unset($data['dob_holder']);
            if($this->student_model->add_student($data)) {
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
    private function setValidRules()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules(
            'fullname',
            'Họ và tên',
            'required|max_length[150]',
            array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự'
            )
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|max_length[150]|valid_email|is_unique[Student.email]',
            array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                'valid_email' => '%s nhập vào không hợp lệ',
                'is_unique' => '%s đã được sử dụng vui lòng nhập Email khác'
            )
        );
        $this->form_validation->set_rules(
            'address',
            'Địa chỉ',
            'required|max_length[250]',
            array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 250 ký tự'
            )
        );
        $this->form_validation->set_rules(
            'course',
            'Lớp',
            'required|max_length[150]',
            array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự'
            )
        );
        $this->form_validation->set_rules(
            'phone',
            'Số điện thoại',
            'required|max_length[10]|numeric',
            array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 10 chữ số',
                'numeric' => 'Chỉ chấp nhận dữ liệu kiểu số'
            )
        );
        $this->form_validation->set_rules(
            'dob',
            'Ngày tháng năm sinh',
            'required',
            array(
                'required' => 'Trường %s là bắt buộc'
            )
        );
    }
}