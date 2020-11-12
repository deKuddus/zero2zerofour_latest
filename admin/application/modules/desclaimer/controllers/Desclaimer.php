<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desclaimer extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->module('template');
        $this->load->model('desclaimer_model');

    }

    public function index() {
        $this->data['title']       = 'Desclaimer | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'desclaimer';
        $this->data['view_file']   = 'manage';
        $this->data['desclaimer']  = $this->desclaimer_model->get_desclaimer();
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']       = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'desclaimer';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function view_desclaimer() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $desclaimer = $this->desclaimer_model->get_desclaimer($id);
            $array      = ['heading' => $desclaimer->desclaimer_heading, 'content' => htmlspecialchars_decode($desclaimer->desclaimer)];
            echo json_encode($array);
        }
    }
    public function store() {
        if (isset($_POST)) {
            $desclaimer_heading = $this->input->post('desclaimer_heading', TRUE);
            $desclaimer         = $this->input->post('desclaimer', TRUE);
            if ($this->desclaimer_model->store(['desclaimer_heading' => $desclaimer_heading, 'desclaimer' => htmlspecialchars($desclaimer)]) == true) {
                redirect('desclaimer');
            }
        }
    }

    public function edit($id) {
        $this->data['title']       = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['id']          = $id;
        $this->data['view_module'] = 'desclaimer';
        $this->data['view_file']   = 'edit';
        $this->data['desclaimer']  = $this->desclaimer_model->get_desclaimer($id);
        $this->template->admin_ui($this->data);
    }

    public function update() {
        if (isset($_POST['desclaimer']) && isset($_POST['desclaimer_id'])) {
            $desclaimer         = $this->input->post('desclaimer', TRUE);
            $desclaimer_id      = $this->input->post('desclaimer_id', TRUE);
            $desclaimer_heading = $this->input->post('desclaimer_heading', TRUE);
            if ($this->desclaimer_model->store(['desclaimer_heading' => $desclaimer_heading, 'desclaimer' => htmlspecialchars($desclaimer)], $desclaimer_id) == true) {
                redirect('desclaimer');
            }
        }
    }

    public function delete($id) {
        if ($this->desclaimer_model->delete($id)) {
            redirect('desclaimer');
        }
    }

    public function change_desclaimer_status() {
        $id = $this->input->post('id', TRUE);
        if (isset($id)) {
            $status = $this->desclaimer_model->get_desclaimer($id)->status;
            if ($status == 1) {
                $change = 0;
            } else if ($status == 0) {
                $change = 1;
            }
            if ($this->desclaimer_model->store(['status' => $change], $id) == true) {
                redirect('status changed', 200);
            }
        }
    }

}
