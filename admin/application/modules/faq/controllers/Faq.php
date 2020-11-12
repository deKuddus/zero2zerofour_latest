<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->module('template');
        $this->load->model('faq_model');

    }

    public function index() {

        $this->data['title']       = 'F A Q | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'faq';
        $this->data['view_file']   = 'manage';
        $this->data['faqs']        = $this->faq_model->get_faq();
        $this->template->admin_ui($this->data);
    }

    public function create() {

        $this->data['title']       = 'F A Q | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'faq';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function view_faq() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $faq   = $this->faq_model->get_faq($id);
            $array = ['heading' => $faq->faq_heading, 'content' => htmlspecialchars_decode($faq->faq)];
            echo json_encode($array);
        }
    }
    public function store() {
        if (isset($_POST['faq_heading']) && isset($_POST['faq'])) {
            $faq_heading = $this->input->post('faq_heading', TRUE);
            $faq         = $this->input->post('faq', TRUE);
            if ($this->faq_model->store(['faq_heading' => $faq_heading, 'faq' => htmlspecialchars($faq)]) == true) {
                redirect('faq');
            }
        }
    }

    public function edit($id) {
        $this->data['title']       = 'F A Q | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['id']          = $id;
        $this->data['view_module'] = 'faq';
        $this->data['view_file']   = 'edit';
        $this->data['faq']         = $this->faq_model->get_faq($id);
        $this->template->admin_ui($this->data);
    }

    public function update() {
        if (isset($_POST['faq']) && isset($_POST['faq_id']) && isset($_POST['faq_heading'])) {
            $faq         = $this->input->post('faq', TRUE);
            $faq_id      = $this->input->post('faq_id', TRUE);
            $faq_heading = $this->input->post('faq_heading', TRUE);
            if ($this->faq_model->store(['faq_heading' => $faq_heading, 'faq' => htmlspecialchars($faq)], $faq_id) == true) {
                redirect('faq');
            }
        }
    }

    public function delete($id) {
        if ($this->faq_model->delete($id)) {
            redirect('faq');
        }
    }

    public function change_faq_status() {
        $id = $this->input->post('id', TRUE);

        if (isset($id)) {
            $status = $this->faq_model->get_faq($id)->status;
            if ($status == 1) {
                $change = 0;
            } else if ($status == 0) {
                $change = 1;
            }
            if ($this->faq_model->store(['status' => $change], $id) == true) {
                echo true;
            }
        }
    }

}
