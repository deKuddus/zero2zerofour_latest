<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->module('template');
        $this->load->model('termsConditions_model');

    }

    public function index() {

        $this->data['title']       = 'Terms and Condtions | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'terms';
        $this->data['view_file']   = 'manage';
        $this->data['terms']       = $this->termsConditions_model->get_terms();
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']       = 'Terms and Condtions create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'terms';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function view_terms() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $terms = $this->termsConditions_model->get_terms($id);
            $array = ['heading' => $terms->terms_heading, 'content' => htmlspecialchars_decode($terms->terms)];
            echo json_encode($array);
        }
    }
    public function store() {
        if (isset($_POST)) {
            $terms_heading = $this->input->post('terms_heading', TRUE);
            $terms         = $this->input->post('terms', TRUE);
            if ($this->termsConditions_model->store(['terms_heading' => $terms_heading, 'terms' => htmlspecialchars($terms)]) == true) {
                redirect('terms');
            }
        }
    }

    public function edit($id) {
        $this->data['id']          = $id;
        $this->data['title']       = 'Terms and Condtions edit | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'terms';
        $this->data['view_file']   = 'edit';
        $this->data['term']        = $this->termsConditions_model->get_terms($id);
        $this->template->admin_ui($this->data);
    }

    public function update() {
        if (isset($_POST)) {
            $terms         = $this->input->post('terms', TRUE);
            $terms_id      = $this->input->post('terms_id', TRUE);
            $terms_heading = $this->input->post('terms_heading', TRUE);
            if ($this->termsConditions_model->store(['terms_heading' => $terms_heading, 'terms' => htmlspecialchars($terms)], $terms_id) == true) {
                redirect('terms');
            }
        }
    }

    public function delete($id) {
        if ($this->termsConditions_model->delete($id)) {
            redirect('terms');
        }
    }

    public function change_terms_status() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $status = $this->termsConditions_model->get_terms($id)->status;
            if ($status == 1) {
                $change = 0;
            } else if ($status == 0) {
                $change = 1;
            }
            if ($this->termsConditions_model->store(['status' => $change], $id) == true) {
                response('status changed');
            }
        }
    }

}
