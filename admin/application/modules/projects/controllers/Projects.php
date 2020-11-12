<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('projects_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Project | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'projects';
        $this->data['view_file']      = 'index';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Project Create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'projects';
        $this->data['view_file']      = 'create';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data     = array();
        $projects = $this->projects_model->show();
        foreach ($projects as $key => $project) {
            $sub_array   = array();
            $sub_array[] = "<input type='checkbox' class='project_checkbox' name='project_id' value='" . $project->id . "'>";
            $sub_array[] = "<img src='" . image_url($project->picture) . "' alt='project logo' height='100px' width='100px' onclick='view_image(this)'>";
            $sub_array[] = $project->title;
            $sub_array[] = textShort($project->objective, 50);
            $sub_array[] = $project->created_at;
            $sub_array[] = $project->goal_fund;
            $sub_array[] = $project->location;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a href="' . base_url('projects/edit/' . $project->id) . '" class="dropdown-item">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_project(' . $project->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->projects_model->count_total_row_of_project(),
            'recordsFiltered' => $this->projects_model->count_total_row_of_project(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if (isset($_POST)) {
            if ($this->projects_model->duplicate_slug($this->input->post('slug', TRUE)) == true) {
                if (isset($_FILES) && !empty($_FILES['project_image']['name'])) {
                    $config = image_config('projects');
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('project_image') == true) {
                        $data       = $this->upload->data();
                        $image_name = 'projects/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                    $input = [
                        'title'       => $this->input->post('title', TRUE),
                        'slug'        => $this->input->post('slug', TRUE),
                        'objective'   => $this->input->post('objective', TRUE),
                        'created_at'  => $this->input->post('created_at', TRUE),
                        'description' => $this->input->post('description', TRUE),
                        'location'    => $this->input->post('location', TRUE),
                        'goal_fund'   => $this->input->post('goal_fund', TRUE),
                        'picture'     => $image_name,
                    ];
                    if ($this->projects_model->store($input) == true) {
                        response('Project created', 200);
                    }
                } else {
                    response('upload project image');
                }
            } else {
                response('project title exist');
            }
        }

    }

    public function edit($id) {
        $this->data['project']     = $this->projects_model->get_by_id($id);
        $this->data['title']       = 'Project | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'projects';
        $this->data['view_file']   = 'edit';
        $this->template->admin_ui($this->data);

    }

    public function update() {
        $id = $this->input->post('project_id', TRUE);
        if (isset($_POST)) {
            if ($this->projects_model->duplicate_slug($this->input->post('slug', TRUE), $id) == true) {
                if (isset($_FILES) && !empty($_FILES['project_image_edit']['tmp_name'])) {
                    $path = $this->projects_model->get_by_id($id)->picture;
                    if ($path) {
                        @unlink('../uploads/' . $path);
                    }
                    $config = image_config('projects');
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('project_image_edit') == true) {
                        $data       = $this->upload->data();
                        $image_name = 'projects/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
                $input = [
                    'title'       => $this->input->post('title', TRUE),
                    'slug'        => $this->input->post('slug', TRUE),
                    'category'    => $this->input->post('category', TRUE),
                    'objective'   => $this->input->post('objective', TRUE),
                    'created_at'  => $this->input->post('created_at', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'location'    => $this->input->post('location', TRUE),
                    'goal_fund'   => $this->input->post('goal_fund', TRUE),
                    'picture'     => $image_name,
                ];

                if ($this->projects_model->update($input, $id) == true) {
                    response('Project updated', 200);
                }
            } else {
                response('project title exist');
            }
        }
    }

    public function delete() {
        $id = $this->input->post('project_id');
        if (is_array($id)) {
            foreach ($id as $key => $ids) {
                $path = $this->projects_model->get_by_id($ids)->picture;
                if ($path) {
                    @unlink('../uploads/' . $path);
                }
            }
            if ($this->projects_model->delete($id, true) == true) {
                response('Project deleted', 200);
            }
        } else {
            $path = $this->projects_model->get_by_id($id)->picture;
            if ($path) {
                @unlink('../uploads/' . $path);
            }
            if ($this->projects_model->delete($id, false) == true) {
                response('Project deleted', 200);
            }
        }
    }

}
