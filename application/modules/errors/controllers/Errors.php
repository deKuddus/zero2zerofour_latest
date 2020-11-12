<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('errors_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['home_page']   = TRUE;
        $this->data['title']       = '404 page not found error | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module'] = 'errors';
        $this->data['view_file']   = 'error';
        $this->template->site_ui($this->data);
    }

}
