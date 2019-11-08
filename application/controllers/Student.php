<?php
class Student extends MY_Controller
{
    private $err = array();
    private $fields = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('student_model');
        $this->load->helper(array('form', 'url', 'page'));
    }
    public function index($current_page = 1)
    {
        $data['title'] = "Danh sách sinh viên";
        $data['students'] = $this->student_model->get_student_info(item_index(5, $current_page));
        $data['pagination'] = parent::pagination('http://localhost/SinhVienAPS/page/');
        $data['page_layout'] = $this->load->view('student/index', $data, true);

        parent::view($data);
    }
    public function process_input()
    {
        // Loop through input and validate
        $result = array();
        $field = $this->input->post();

        foreach ($field as $key => $value) {
            $result = array_merge($result, array($key => $value));
        }
        // Remove submit input
        array_pop($result);

        return $result;
    }
    public function create()
    {
        $this->fields = $this->process_input();
        if ($this->isValid()) {
            $isUploaded = parent::image_upload('avatar');
            $this->fields['image'] = ($isUploaded === false) ? 'fallback.png' : $isUploaded;

            // Remove duplicate date of birth
            unset($this->fields['dob_holder']);
            if ($this->student_model->add_student($this->fields)) {
                $result = array(
                    'type' => 'success',
                    'message' => 'add success',
                );
            } else {
                $result = array(
                    'type' => 'error',
                    'message' => 'add error',
                );
            }
        } else {
            $result = $this->err;
        }

        echo json_encode($result);
    }
    private function isValid()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        foreach ($this->fields as $field => $value) {
            switch ($field) {
                case 'phone':
                    $this->form_validation->set_rules(
                        'phone',
                        'Số điện thoại',
                        'required|max_length[10]|numeric',
                        array(
                            'required' => 'Trường %s là bắt buộc',
                            'max_length' => 'Trường %s chỉ nhận tối đa 10 chữ số',
                            'numeric' => 'Chỉ chấp nhận dữ liệu kiểu số',
                        )
                    );
                    break;
                case 'email':
                    $this->form_validation->set_rules(
                        $field,
                        $field,
                        'required|max_length[150]|valid_email|is_unique[Student.email]',
                        array(
                            'required' => 'Trường %s là bắt buộc',
                            'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                            'valid_email' => '%s nhập vào không hợp lệ',
                            'is_unique' => '%s đã được sử dụng vui lòng nhập Email khác',
                        )
                    );
                    break;
                case 'address':
                    $this->form_validation->set_rules(
                        'address',
                        'Địa chỉ',
                        'required|max_length[250]',
                        array(
                            'required' => 'Trường %s là bắt buộc',
                            'max_length' => 'Trường %s chỉ nhận tối đa 250 ký tự',
                        )
                    );
                    break;
                default:
                    $this->form_validation->set_rules(
                        $field,
                        $field,
                        'required|max_length[150]',
                        array(
                            'required' => 'Trường %s là bắt buộc',
                            'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                        )
                    );
                    break;
            }
        }

        if ($this->form_validation->run()) {
            return true;
        }

        $this->err = array(
            'type' => 'error',
            'message' => 'validate error',
            'validate' => $this->generateErrorLog()
        );

        return false;
    }
    private function generateErrorLog()
    {
        $result = array();
        foreach($this->fields as $field => $value) {
            $result = array_merge($result, array($field => form_error($field)));
        }
        return $result;
    }
}
