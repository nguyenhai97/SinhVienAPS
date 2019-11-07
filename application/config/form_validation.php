<?php
$config = array(
    'addMember' => array(
        array(
            'field' => 'fullname',
            'label' => 'Họ và tên',
            'rules' => 'required|max_length[150]',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự'
            )
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[150]|valid_email|is_unique[Student.email]',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự',
                'valid_email' => '%s nhập vào không hợp lệ',
                'is_unique' => '%s đã được sử dụng vui lòng nhập Email khác'
            )
        ),
        array(
            'field' => 'address',
            'label' => 'Địa chỉ',
            'rules' => 'required|max_length[250]',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 250 ký tự'
            )
        ),
        array(
            'field' => 'course',
            'label' => 'Lớp',
            'rules' => 'required|max_length[150]',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 150 ký tự'
            )
        ),
        array(
            'field' => 'phone',
            'label' => 'Số điện thoại',
            'rules' => 'required|max_length[10]|numeric',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc',
                'max_length' => 'Trường %s chỉ nhận tối đa 10 chữ số',
                'numeric' => 'Chỉ chấp nhận dữ liệu kiểu số'
            )
        ),
        array(
            'field' => 'dob',
            'label' => 'Ngày tháng năm sinh',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Trường %s là bắt buộc'
            )
        )
    )
);