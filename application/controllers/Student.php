<?php
class Student extends MY_Controller
{
    private $fields = array();

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('form_validation', 'vi');
        $this->load->model('student_model');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['title'] = "Danh sách sinh viên";
        $data['page_layout'] = $this->load->view('student/index', $data, true);

        parent::view($data);
    }
    private function isValid($action = 'add')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        if($action == 'add') {
            $rules = array(
                'phone' => array(
                    'field' => 'phone',
                    'label' => 'lang:phone',
                    'rules' => 'required|max_length[10]|numeric',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 10 chữ số',
                        'numeric' => 'Chỉ chấp nhận dữ liệu kiểu số',
                    )
                ),
                'email' => array(
                    'field' => 'email',
                    'label' => 'lang:email',
                    //DONE: dung tham số id truyền vào update
                    'rules' => 'required|max_length[150]|valid_email|is_unique[Student.email]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                        'valid_email' => '%s nhập vào không hợp lệ',
                        'is_unique' => '%s đã được sử dụng vui lòng nhập địa chỉ khác',
                    )
                ),
                'address' => array(
                    'field' => 'address',
                    'label' => 'lang:address',
                    'rules' => 'required|max_length[250]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 250 ký tự',
                    )
                ),
                'fullname' => array(
                    'field' => 'fullname',
                    'label' => 'lang:fullname',
                    'rules' => 'required|max_length[150]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                    )
                ),
                'course' => array(
                    'field' => 'course',
                    'label' => 'lang:course',
                    'rules' => 'required|max_length[150]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                    )
                ),
                'dob' => array(
                    'field' => 'dob',
                    'label' => 'lang:dob',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc'
                    )
                )
            );
        } else {
            $rules = array(
                'phone' => array(
                    'field' => 'phone',
                    'label' => 'lang:phone',
                    'rules' => 'required|max_length[10]|numeric',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 10 chữ số',
                        'numeric' => 'Chỉ chấp nhận dữ liệu kiểu số',
                    )
                ),
                'email' => array(
                    'field' => 'email',
                    'label' => 'lang:email',
                    'rules' => 'required|max_length[150]|valid_email',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                        'valid_email' => '%s nhập vào không hợp lệ',
                        'is_unique' => '%s đã được sử dụng vui lòng nhập địa chỉ khác',
                    )
                ),
                'address' => array(
                    'field' => 'address',
                    'label' => 'lang:address',
                    'rules' => 'required|max_length[250]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 250 ký tự',
                    )
                ),
                'fullname' => array(
                    'field' => 'fullname',
                    'label' => 'lang:fullname',
                    'rules' => 'required|max_length[150]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                    )
                ),
                'course' => array(
                    'field' => 'course',
                    'label' => 'lang:course',
                    'rules' => 'required|max_length[150]',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc',
                        'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                    )
                ),
                'dob' => array(
                    'field' => 'dob',
                    'label' => 'lang:dob',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Trường %s là bắt buộc'
                    )
                )
            );
        }

        foreach ($rules as $rule) {
            $this->form_validation->set_rules(
                $rule['field'],
                $rule['label'],
                $rule['rules'],
                $rule['error']
            );
        }

        if ($this->form_validation->run()) {
            return true;
        }

        $err = array(
            'type' => 'error',
            'message' => 'validate error',
            'validate' => $this->generateErrorLog($rules)
        );
        echo json_encode($err);
        die();
    }
    private function generateErrorLog($fields)
    {
        $result = array();
        foreach($fields as $item) {
            $result = array_merge($result, array($item['field'] => form_error($item['field'])));
        }
        return $result;
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
    public function newestData()
    {
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length')) ? intval($this->input->get('length')) : 0;
        $order = $this->input->get('order');
        $searchTerm = $this->input->get('search')['value'];
        $bioFilter = $this->input->get('bio_filter');
        $courseFilter = $this->input->get('course_filter');

        $sortColIndex = 0;
        $sortDirection = 'asc';

        if(!empty($order)) {
            $sortColIndex = $order[0]['column'];
            $sortDirection = $order[0]['dir'];
        }

        $index2ColName = array(
            0=>'fullname',
            1=>'phone',
            2=>'address',
            3=>'bio',
            4=>'dob',
            5=>'course'
        );

        $data['start'] = $start;
        $data['length'] = $length;
        $data['sortColName'] = $index2ColName[$sortColIndex];
        $data['sortDirection'] = $sortDirection;
        if(!empty($searchTerm)) {
            $data['searchTerm'] = $searchTerm;
        }

        $filters = array(
            "bio" => $bioFilter,
            "course" => $courseFilter
        );
        

        $data['filters'] = $filters;

        $callbackData = $this->student_model->get_student_info($data);

        $result = array(
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => $this->student_model->num_row(),
            "recordsFiltered" => $callbackData['num_rows'],
            "data" => $callbackData['data']
        );
        echo json_encode($result);
    }
    public function listCourse()
    {
        $data = $this->student_model->getCourse();
        echo json_encode($data);
    }
    public function create()
    {
        $this->fields = $this->process_input();
        // Remove duplicate date of birth
        unset($this->fields['dob_holder']);
        
        if ($this->isValid()) {
            $isUploaded = parent::image_upload('avatar');
            $this->fields['image'] = ($isUploaded === false) ? 'fallback.png' : $isUploaded;

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
        }

        echo json_encode($result);
    }
    public function info($id) {
        $userInfo = $this->student_model->get_student($id)[0];
        $date = new DateTime($userInfo->dob);
        $userInfo->dob = $date->format('d/m/Y');
        echo json_encode($userInfo);
    }
    public function update($id = NULL)
    {
        if(empty($id)) {
            die();
        }
        $this->fields = $this->process_input();
        // Remove duplicate date of birth
        unset($this->fields['dob_holder']);
        
        if ($this->isValid('update')) {
            $isUploaded = parent::image_upload('avatar');
            // Only change image if user submit one
            if($isUploaded !== false) {
                $this->fields['image'] = $isUploaded;
            }
            unset($this->fields['avatar']);

            if ($this->student_model->update_student($this->fields, $id)) {
                $result = array(
                    'type' => 'success',
                    'message' => 'update success',
                );
            } else {
                $result = array(
                    'type' => 'error',
                    'message' => 'update error',
                );
            }
        }

        echo json_encode($result);
    }
    public function delete($id) {
        $result = array(
            'type' => 'error',
            'message' => 'delete error',
        );
        // DONE: gọi delete của MY_model
        if($this->student_model->delete($id)) {
            $result = array(
                'type' => 'success',
                'message' => $id .' is deleted',
            );
        }
        echo json_encode($result);
    }
}
