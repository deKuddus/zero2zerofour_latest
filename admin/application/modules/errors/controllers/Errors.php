<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('errors_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = '404 page not found error | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'errors';
        $this->data['view_file']   = 'error';
        $this->template->admin_ui_404($this->data);
    }

}
