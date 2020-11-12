<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['latest']      = $this->projects_model->get_project('latest');
        $this->data['projects']    = $this->projects_model->get_project();
        $this->data['title']       = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'projects';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);
    }

    public function view($slug) {
        $project = $this->projects_model->get_by_slug($slug);
        if (!empty($project)) {
            $this->data['title']           = $project->title;
            $this->data['view_module']     = 'projects';
            $this->data['view_file']       = 'project_view';
            $this->data['project']         = $project;
            $this->data['related_project'] = $this->projects_model->get_related_projects($project->category, $project->id);
            $this->data['all_project']     = $this->projects_model->get_projects($this->data['project']->id);
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }

}
