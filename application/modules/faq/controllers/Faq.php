<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('faq_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = 'F A Q | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'faq';
        $this->data['view_file']   = 'manage';
        $this->data['faqs']        = $this->faq_model->get_faq();
        $this->template->site_ui($this->data);

    }

}
