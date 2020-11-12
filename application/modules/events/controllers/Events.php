<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('events_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['latest']      = $this->events_model->get_event('latest');
        $this->data['events']      = $this->events_model->get_event();
        $this->data['title']       = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'events';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);
    }

    public function view($slug) {
        $event = $this->events_model->get_by_slug($slug);
        if (!empty($event)) {
            $this->data['title']         = $event->title;
            $this->data['view_module']   = 'events';
            $this->data['view_file']     = 'event_view';
            $this->data['event']         = $event;
            $this->data['related_event'] = $this->events_model->get_related_events($event->category, $event->id);
            $this->data['all_event']     = $this->events_model->get_events($this->data['event']->id);
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }

}
