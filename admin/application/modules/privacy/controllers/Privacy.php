<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->module('template');
        $this->load->model('privacy_model');

    }

    public function index() {

        $this->data['title']       = 'Privacy | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'privacy';
        $this->data['view_file']   = 'manage';
        $this->data['privacy']     = $this->privacy_model->get_privacy();
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']       = 'Privacy create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'privacy';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function view_privacy() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $privacy = $this->privacy_model->get_privacy($id);
            $array   = ['heading' => $privacy->privacy_heading, 'content' => htmlspecialchars_decode($privacy->privacy)];
            echo json_encode($array);
        }
    }
    public function store() {
        if (isset($_POST)) {
            $privacy_heading = $this->input->post('privacy_heading');
            $privacy         = $this->input->post('privacy');
            if ($this->privacy_model->store(['privacy_heading' => $privacy_heading, 'privacy' => htmlspecialchars($privacy)]) == true) {
                redirect('privacy');
            }
        }
    }

    public function edit($id) {
        $this->data['title']       = 'Privacy edit | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['id']          = $id;
        $this->data['view_module'] = 'privacy';
        $this->data['view_file']   = 'edit';
        $this->data['privacy']     = $this->privacy_model->get_privacy($id);
        $this->template->admin_ui($this->data);
    }

    public function update() {
        if (isset($_POST)) {
            $privacy_id = $this->input->post('privacy_id', TRUE);
            $privacy    = [
                'privacy_heading' => $this->input->post('privacy_heading', TRUE),
                'privacy'         => htmlspecialchars($this->input->post('privacy', TRUE)),
            ];
            if ($this->privacy_model->store($privacy, $privacy_id) == true) {
                redirect('privacy');
            }
        }
    }

    public function delete($id) {
        if ($this->privacy_model->delete($id)) {
            redirect('privacy');
        }
    }

    public function change_privacy_status() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $status = $this->privacy_model->get_privacy($id)->status;
            if ($status == 1) {
                $change = 0;
            } else if ($status == 0) {
                $change = 1;
            }
            if ($this->privacy_model->store(['status' => $change], $id) == true) {
                response('status changed');
            }
        }
    }

}
