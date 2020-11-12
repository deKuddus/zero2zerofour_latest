<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounts_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'accounts';
        $this->data['view_file']   = 'profile';
        $this->template->site_ui($this->data);
    }

}
