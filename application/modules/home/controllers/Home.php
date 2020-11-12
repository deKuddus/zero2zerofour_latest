<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->module('template');
        $this->load->module('events');
        $this->load->module('news');
    }

    public function index() {

        $this->data['title']        = 'Home | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']  = 'home';
        $this->data['view_file']    = 'index';
        $this->data['latest']       = $this->events_model->get_event('latest');
        $this->data['events']       = $this->events_model->get_event();
        $this->data['causes']       = $this->home_model->get_all_featured_causes(1);
        $this->data['non_featured'] = $this->home_model->get_all_featured_causes();
        $this->data['qoutes']       = $this->home_model->get_all_donors_qoute();
        $this->data['news']         = $this->news_model->get_all_news(4);
        $this->template->site_ui($this->data);

    }

    public function message($order_id) {
        $this->data['title']       = 'Thankyou | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'home';
        $this->data['view_file']   = 'message';
        $this->data['order_id']    = $order_id;
        $this->template->site_ui($this->data);
    }

}
