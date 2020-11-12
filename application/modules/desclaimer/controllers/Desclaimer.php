<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desclaimer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('desclaimer_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['title']       = 'Our Desclaimer | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module'] = 'desclaimer';
        $this->data['view_file']   = 'manage';
        $this->data['desclaimer']  = $this->desclaimer_model->get_desclaimer();
        $this->template->site_ui($this->data);

    }

}
