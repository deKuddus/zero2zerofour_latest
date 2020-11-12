<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_image extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->module('template');
        $this->load->model('header_image_model');

    }

    public function index() {
        $this->data['title']         = 'Header Image | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']   = 'header_image';
        $this->data['view_file']     = 'manage';
        $this->data['header_images'] = $this->header_image_model->get_header_image();
        $this->template->admin_ui($this->data);
    }

    public function edit($id) {
        $this->data['title']        = 'Header Image | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['id']           = $id;
        $this->data['view_module']  = 'header_image';
        $this->data['view_file']    = 'edit';
        $this->data['header_image'] = $this->header_image_model->get_header_image($id);
        $this->template->admin_ui($this->data);
    }

    public function update($header_image_id) {
        if (isset($_POST)) {
            if (isset($_FILES) && !empty($_FILES['header_image']['name'])) {
                if ($this->unlink_header_image($header_image_id) == true) {
                    $this->load->library('upload', image_config('header_image'));
                    if ($this->upload->do_upload('header_image') == true) {
                        $data         = $this->upload->data();
                        $header_image = 'header_image/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
                if ($this->header_image_model->store(['image' => $header_image], $header_image_id) == true) {
                    redirect('header_image');
                }
            } else {
                $this->form_validation->set_rules('header_image', 'Header Image', 'required');
                if ($this->form_validation->run() === FALSE) {
                    $this->edit($header_image_id);
                }
            }
        } else {
            $this->form_validation->set_rules('header_image', 'Header Image', 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->edit($header_image_id);
            }
        }
    }

    public function delete($id) {
        if ($this->header_image_model->delete($id)) {
            redirect('header_image');
        }
    }

    public function change_header_image_status() {
        $id = $this->input->post('header_image_id', TRUE);
        if (isset($id)) {
            $status = $this->header_image_model->get_header_image($id)->status;
            if ($status == 1) {
                $change = 0;
            } else if ($status == 0) {
                $change = 1;
            }
            if ($this->header_image_model->store(['status' => $change], $id) == true) {
                response('status changed', 200);
            }
        }
    }

    public function unlink_header_image($id) {
        $file = $this->header_image_model->get_header_image($id)->image;
        if ($file) {
            if (unlink('../uploads/' . $file)) {
                return true;
            }
        } else {
            return true;
        }
    }
}
