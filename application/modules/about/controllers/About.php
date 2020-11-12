<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('about_model');
        $this->load->module('template');
    }

    public function index() {
        $this->manage();
    }

    public function manage() {
        $this->data['home_page']      = TRUE;
        $this->data['title']          = 'About Our Foundation| SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'about';
        $this->data['view_file']      = 'manage';
        $this->data['mission']        = $this->about_model->get_mission();
        $this->data['about']          = $this->about_model->get_about();
        $this->data['history']        = $this->about_model->get_history();
        $this->data['designations']   = $this->about_model->get_member_designation();
        $this->data['board_director'] = $this->about_model->get_board_of_directors();
        $this->data['board_head']     = $this->about_model->get_member_head_board_director();
        $this->template->site_ui($this->data);
    }

}
