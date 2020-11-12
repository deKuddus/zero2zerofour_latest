<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('terms_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['title']       = 'Terms of Use | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['terms']       = $this->terms_model->get_terms_condtiton();
        $this->data['view_module'] = 'terms';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);

    }

}
