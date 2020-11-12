<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function admin_ui($data = NULL) {
        $this->data = $data;
        $this->load->view('_layout_main', $this->data);
    }

    public function admin_login($data = NULL) {
        $this->data = $data;
        $this->load->view('_layout_login', $this->data);
    }

    public function admin_forgot_password($data = NULL) {
        $this->data = $data;
        $this->load->view('_layout_forgot_password', $this->data);
    }
    public function admin_reset_password($data = NULL) {
        $this->data = $data;
        $this->load->view('_layout_reset_password', $this->data);
    }

    public function admin_ui_404($data = NULL) {
        $this->load->view('_404');
    }
}
