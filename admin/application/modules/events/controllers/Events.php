<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('events_model');
        $this->load->module('template');
        $this->load->module('event_categories');
    }

    public function index() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'events';
        $this->data['view_file']      = 'index';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Events Create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']    = 'events';
        $this->data['view_file']      = 'create';
        $this->data['categories']     = $this->events_model->get_event_categories();
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data   = array();
        $events = $this->events_model->show();
        foreach ($events as $key => $event) {
            $sub_array   = array();
            $sub_array[] = "<input type='checkbox' class='event_checkbox' name='event_id' value='" . $event->id . "'>";
            $sub_array[] = "<img src='" . FILE_UPLOAD_PATH . $event->picture . "' alt='event logo' height='100px' width='100px' onclick='view_image(this)'>";
            $sub_array[] = $event->title;
            $sub_array[] = $event->category;
            $sub_array[] = textShort($event->objective, 50);
            $sub_array[] = $event->start_date;
            $sub_array[] = $event->end_date;
            $sub_array[] = $event->ticket_price;
            $sub_array[] = $event->location;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a href="' . base_url('events/edit/' . $event->id) . '" class="dropdown-item">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_event(' . $event->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->events_model->count_total_row_of_event(),
            'recordsFiltered' => $this->events_model->count_total_row_of_event(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if (isset($_POST)) {
            if ($this->events_model->duplicate_slug($this->input->post('slug', TRUE)) == true) {
                if (isset($_FILES) && !empty($_FILES['event_image']['name'])) {
                    $config = image_config('events');
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('event_image') == true) {
                        $data       = $this->upload->data();
                        $image_name = 'events/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                    $input = [
                        'title'        => $this->input->post('title', TRUE),
                        'slug'         => $this->input->post('slug', TRUE),
                        'category'     => $this->input->post('category', TRUE),
                        'objective'    => $this->input->post('objective', TRUE),
                        'start_date'   => $this->input->post('start_date', TRUE),
                        'end_date'     => $this->input->post('end_date', TRUE),
                        'description'  => $this->input->post('description', TRUE),
                        'location'     => $this->input->post('location', TRUE),
                        'ticket_price' => $this->input->post('ticket_price', TRUE),
                        'picture'      => $image_name,
                    ];
                    if ($this->events_model->store($input) == true) {
                        response('Events created', 200);
                    }
                } else {
                    response('upload event image');
                }
            } else {
                response('event title exist');
            }
        }

    }

    public function edit($id) {
        $this->data['event']       = $this->events_model->get_by_id($id);
        $this->data['title']       = 'Events | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'events';
        $this->data['view_file']   = 'edit';
        $this->data['categories']  = $this->events_model->get_event_categories();
        $this->template->admin_ui($this->data);

    }

    public function update() {
        $id = $this->input->post('event_id', TRUE);
        if (isset($_POST)) {
            if ($this->events_model->duplicate_slug($this->input->post('slug', TRUE), $id) == true) {
                if (isset($_FILES) && !empty($_FILES['event_image_edit']['tmp_name'])) {
                    $path = $this->events_model->get_by_id($id)->picture;
                    if ($path) {
                        @unlink('../uploads/' . $path);
                    }
                    $config = image_config('events');
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('event_image_edit') == true) {
                        $data       = $this->upload->data();
                        $image_name = 'events/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
                $input = [
                    'title'        => $this->input->post('title', TRUE),
                    'slug'         => $this->input->post('slug', TRUE),
                    'category'     => $this->input->post('category', TRUE),
                    'objective'    => $this->input->post('objective', TRUE),
                    'start_date'   => $this->input->post('start_date', TRUE),
                    'end_date'     => $this->input->post('end_date', TRUE),
                    'description'  => $this->input->post('description', TRUE),
                    'location'     => $this->input->post('location', TRUE),
                    'ticket_price' => $this->input->post('ticket_price', TRUE),
                    'picture'      => $image_name,
                ];

                if ($this->events_model->update($input, $id) == true) {
                    response('Events updated', 200);
                }
            } else {
                response('event title exist');
            }
        }
    }

    public function delete() {
        $id = $this->input->post('event_id');
        if (is_array($id)) {
            foreach ($id as $key => $ids) {
                $path = $this->events_model->get_by_id($ids)->picture;
                if ($path) {
                    @unlink('../uploads/' . $path);
                }
            }
            if ($this->events_model->delete($id, true) == true) {
                response('Events deleted', 200);
            }
        } else {
            $path = $this->events_model->get_by_id($id)->picture;
            if ($path) {
                @unlink('../uploads/' . $path);
            }
            if ($this->events_model->delete($id, false) == true) {
                response('Events deleted', 200);
            }
        }
    }

}
