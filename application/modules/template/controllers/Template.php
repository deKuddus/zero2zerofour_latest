<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function site_ui($data = NULL) {
        $this->data = $data;
        $this->load->view('layout_main', $this->data);
    }

    public function site_login($data = NULL) {
        $this->data = $data;
        $this->load->view('layout_login', $this->data);
    }

    public function site_ui_invoice($data = NULL) {
        $this->data = $data;
        $this->load->view('invoice', $this->data);
    }

}
