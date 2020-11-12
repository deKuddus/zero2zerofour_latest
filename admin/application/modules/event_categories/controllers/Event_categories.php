<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_categories extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('event_categories_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Administration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'event_categories';
        $this->data['view_file']      = 'index';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data             = array();
        $event_categories = $this->event_categories_model->show();
        foreach ($event_categories as $key => $categories) {
            $sub_array   = array();
            $sub_array[] = "<input type='checkbox' class='event_categories_checkbox' name='event_categories_id' value='" . $categories->id . "'>";
            $sub_array[] = $categories->id;
            $sub_array[] = $categories->name;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" data-toggle="modal" data-target="#event_categories_edit_modal" onclick="edit_categories(' . $categories->id . ')">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_categories(' . $categories->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->event_categories_model->count_total_row_of_categories(),
            'recordsFiltered' => $this->event_categories_model->count_total_row_of_categories(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if (isset($_POST['name'])) {
            if ($this->event_categories_model->duplicate_name($this->input->post('name')) == false) {
                $input = ['name' => $this->input->post('name', TRUE)];
                if ($this->event_categories_model->store($input) == true) {
                    response('category created', 200);
                }
            } else {
                response('category name exist');
            }
        }

    }

    public function edit_categories() {
        $id       = $this->input->post('id', TRUE);
        $category = $this->event_categories_model->get($id);
        if (isset($category)) {
            echo json_encode($category);
        }
    }

    public function update() {
        $id = $this->input->post('category_id', TRUE);
        if (isset($_POST['name'])) {
            if ($this->event_categories_model->duplicate_name($this->input->post('name'), $id) == false) {
                $input = ['name' => $this->input->post('name', TRUE)];
                if ($this->event_categories_model->update($input, $id) == true) {
                    response('categories updated', 200);
                }
            } else {
                response('category name exist', 200);
            }
        }
    }

    public function delete() {
        $id = $this->input->post('categories_id', TRUE);
        if (is_array($id)) {
            if ($this->event_categories_model->delete($id, true) == true) {
                response('categories deleted', 200);
            }
        } else {
            if ($this->event_categories_model->delete($id, false) == true) {
                response('categories deleted', 200);
            }
        }
    }

}
