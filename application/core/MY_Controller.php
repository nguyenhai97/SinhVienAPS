<?php
class MY_Controller extends CI_Controller {
    public function __contruct()
    {
        parent::__contruct();
    }
    public function view($data = '')
    {
        $this->load->view('partical/head', $data);
        $this->load->view('partical/master_layout', $data);
        $this->load->view('partical/foot', $data);
    }
    public function pagination($base_url)
    {
        $this->load->library('pagination');

        $config['base_url'] = $base_url;
        $config['total_rows'] = $this->student_model->num_row();
        $config['per_page'] = 5;

        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        
        return $this->pagination->create_links();
    }
    public function image_upload($input_name)
    {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['upload_path']   = 'upload';
        $config['max_size']      = 1024;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($input_name)) {
            return false;
        } else {
            $image = $this->upload->data();
            return $image['file_name'];
        }
        return false;
    }
}