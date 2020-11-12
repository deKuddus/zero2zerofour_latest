<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('privacy_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = 'Our Privacy Policy | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'privacy';
        $this->data['view_file']   = 'manage';
        $this->data['privacy']     = $this->privacy_model->get_privacy_policy();
        $this->template->site_ui($this->data);
    }

}
