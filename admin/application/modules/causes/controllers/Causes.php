<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('causes_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['view_module'] = 'causes';
        $this->data['view_file']   = 'manage';
        $this->data['title']       = 'Causes | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['category']    = $this->causes_model->get_all_category('dropdown');
        $this->data['view_module'] = 'causes';
        $this->data['view_file']   = 'create';
        $this->data['title']       = 'Causes | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function show() {
        global $category, $sub_category;
        $data           = array();
        $category_array = $this->causes_model->get_all_category();
        $causes_all     = $this->causes_model->show();
        foreach ($causes_all as $b_key => $causes) {
            $sub_array = array();
            foreach ($category_array as $key => $cat) {
                if ($causes->category == $cat->id) {
                    $category = $cat->name;
                }
            }

            if ($causes->is_active == 1) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_causes_status(' . $causes->id . ',this)" checked="checked" class="onoffswitch-checkbox causes_status" id="example' . $b_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($causes->is_active == 0) {
                $status = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_causes_status(' . $causes->id . ',this)" class="onoffswitch-checkbox causes_status" id="example' . $b_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            if ($causes->is_featured == 1) {
                $is_featured = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_causes_featured_status(' . $causes->id . ',this)" checked="checked" class="onoffswitch-checkbox causes_featured_status" id="example_featured' . $b_key . '" value="0">
                <label class="onoffswitch-label" for="example_featured' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($causes->is_featured == 0) {
                $is_featured = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_causes_featured_status(' . $causes->id . ',this)" class="onoffswitch-checkbox causes_featured_status" id="example_featured' . $b_key . '" value="1">
                <label class="onoffswitch-label" for="example_featured' . $b_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<input type="checkbox" name="causes_id[]" class="causes_checkbox" value="' . $causes->id . '"/>';
            $sub_array[] = '<img src="' . FILE_UPLOAD_PATH . $causes->images . '" alt="causes image" height="100px" width="100px;" onclick="view_image(this)">';
            $sub_array[] = $causes->title;
            $sub_array[] = $causes->slug;
            $sub_array[] = $category;
            $sub_array[] = $causes->goal_fund;
            $sub_array[] = $causes->current_fund;
            $sub_array[] = $status;
            $sub_array[] = $is_featured;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" data-toggle="modal" data-target="#full_causes" onclick="view_causes(' . $causes->id . ')" >View</a></li>
            <li><a class="dropdown-item" href="' . base_url('causes/edit/' . $causes->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_causes(' . $causes->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->causes_model->count_total_row_of_causes(),
            'recordsFiltered' => $this->causes_model->count_total_row_of_causes(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if ($this->causes_model->check_causes_slug_duplicate(clean_special_character($_POST['slug'])) == false) {
            if (!empty($_FILES['causes_images']['name'])) {
                $config = image_config('causes_images');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('causes_images') == true) {
                    $data  = $this->upload->data();
                    $image = 'causes_images/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }

            } else {
                response('upload a cause image');
            }
            $causes_data = [
                'title'             => $this->input->post('title', TRUE),
                'slug'              => clean_special_character($this->input->post('slug', TRUE)),
                'category'          => $this->input->post('category', TRUE),
                'goal_fund'         => $this->input->post('goal_fund', TRUE),
                'short_description' => $this->input->post('short_description', TRUE),
                'content'           => $this->input->post('content', TRUE),
                'images'            => $image,
            ];
            if ($this->causes_model->store($causes_data) == true) {
                response('causes added', 200);
            }
        } else {
            response('slug already exist, it should be unique', 700);
        }
    }

    public function edit($causes_id) {
        $this->data['causes']      = $this->causes_model->get_causes($causes_id);
        $this->data['category']    = $this->causes_model->get_all_category('dropdown');
        $this->data['view_module'] = 'causes';
        $this->data['view_file']   = 'edit';
        $this->data['title']       = 'Causes | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function update() {
        if ($this->causes_model->check_causes_slug_duplicate(clean_special_character($_POST['slug']), $_POST['causes_id']) == false) {
            $causes_data = array();
            if (!empty($_FILES['causes_images']['name'])) {
                $config = image_config('causes_images');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('causes_images') == true) {
                    $file = $this->causes_model->get_by_id($_POST['causes_id'])->images;
                    if ($file) {
                        @unlink('../uploads/' . $file);
                    }
                    $data                  = $this->upload->data();
                    $image                 = 'causes_images/' . $data['file_name'];
                    $causes_data['images'] = $image;
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
            }
            $causes_data['title']             = $this->input->post('title', TRUE);
            $causes_data['slug']              = clean_special_character($this->input->post('slug', TRUE));
            $causes_data['category']          = $this->input->post('category', TRUE);
            $causes_data['goal_fund']         = $this->input->post('goal_fund', TRUE);
            $causes_data['short_description'] = $this->input->post('short_description', TRUE);
            $causes_data['content']           = $this->input->post('content', TRUE);
            if ($this->causes_model->store($causes_data, $_POST['causes_id']) == true) {
                response('causes updated', 200);
            }
        } else {
            response('slug already exist,it should be unique', 700);
        }
    }

    public function delete() {
        $causes_id = $this->input->post('causes_id');
        if (!is_array($causes_id)) {
            $file = $this->causes_model->get_by_id($causes_id)->images;
            if ($file) {
                @unlink('../uploads/' . $file);
            }
            if ($this->causes_model->delete($causes_id) == true) {
                response('causes deleted', 200);
            } else {
                response('failed to delete causes', 200);
            }
        } else {
            foreach ($causes_id as $key => $b_id) {
                $file = $this->causes_model->get_by_id($b_id)->images;
                if ($file) {
                    @unlink('../uploads/' . $file);
                }
            }
            if ($this->causes_model->delete($causes_id) == true) {
                response('causes deleted', 200);
            } else {
                response('failed to delete causes', 200);
            }
        }
    }

    public function get_sub_category() {
        $category_id  = $this->input->post('category_id', TRUE);
        $sub_category = $this->causes_model->get_sub_category($category_id);
        if (!empty($sub_category)) {
            echo json_encode($sub_category);
        } else {
            echo json_encode($sub_category);
        }
    }

    public function change_status() {
        $causes_id = $this->input->post('causes_id', TRUE);
        $status    = $this->input->post('status', TRUE);
        if ($this->causes_model->change_status($causes_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed', 200);
        }
    }

    public function change_causes_featured_status() {
        $causes_id = $this->input->post('causes_id', TRUE);
        $status    = $this->input->post('status', TRUE);
        if ($this->causes_model->change_causes_featured_status($causes_id, $status) == true) {
            response('status changed', 200);
        } else {
            response('status not changed', 200);
        }
    }

    public function view_causes() {
        $id = $this->input->post('causes_id', TRUE);
        global $category;
        $category_array = $this->causes_model->get_all_category();
        $causes         = $this->causes_model->get_by_id($id);

        foreach ($category_array as $key => $cat) {
            if ($causes->category == $cat->id) {
                $category = $cat->name;
            }
        }

        $html = '';
        $html .= ' <table id="causes_list" class="table table-striped table-bordered table-hover" >';
        $html .= ' <tbody>';
        $html .= ' <tr><th>Title</th><td>' . $causes->title . '</td></tr>';
        $html .= ' <tr><th>Slug</th><td>' . $causes->slug . '</td></tr>';
        $html .= ' <tr><th>Category</th><td>' . $category . '</td></tr>';
        $html .= ' <tr><th>Goal Fund</th><td>' . $causes->goal_fund . '</td></tr>';
        $html .= ' <tr><th>Raised Fund</th><td>' . $causes->current_fund . '</td></tr>';
        $html .= ' <tr><th>Image</th><td><img src="' . image_url($causes->images) . '" alt="causes image"></td></tr>';
        $html .= ' <tr><th>Short Description</th><td>' . $causes->short_description . '</td></tr>';
        $html .= ' <tr><th>Content</th><td>' . $causes->content . '</td></tr>';
        $html .= ' </tbody>';
        $html .= ' </table>';

        echo $html;
    }

    //// cause module
    public function category() {
        $this->data['view_module'] = 'causes';
        $this->data['view_file']   = 'category';
        $this->data['title']       = 'Causes Category | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function show_category() {

        $data = array();
        foreach ($this->causes_model->show_category() as $c_key => $category) {
            $sub_array = array();
            $name      = "'" . $category->name . "'";

            $sub_array[] = '<input type="checkbox" name="category_id[]" class="causes_category_checkbox" value="' . $category->id . '"/>';
            $sub_array[] = $category->name;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" onclick="edit_causes_category(' . $category->id . ',' . $name . ')" >Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_causes_category(' . $category->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->causes_model->count_total_row_of_category(),
            'recordsFiltered' => $this->causes_model->count_total_row_of_category(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store_category() {
        $name        = $this->input->post('category_name', TRUE);
        $unique_name = str_replace(' ', '_', strtolower($name));
        if ($this->causes_model->store_category(['name' => $name, 'unique_name' => $unique_name]) == true) {
            response('category created', 200);
        }
    }

    public function update_category() {
        $name        = $this->input->post('category_name', TRUE);
        $category_id = $this->input->post('category_id', TRUE);
        $unique_name = str_replace(' ', '_', strtolower($name));
        if ($this->causes_model->update_category(['name' => $name, 'unique_name' => $unique_name], $category_id) == true) {
            response('category created', 200);
        }
    }

    public function delete_causes_category($causes_category_id) {
        // $causes_category_id = $this->input->post('causes_category_id');
        if (!is_array($causes_category_id)) {
            $this->unlink_causes_image_related_to_category($causes_category_id);
            $delete_causes = $this->causes_model->delete_causes_category($causes_category_id);
            if ($delete_causes == true) {
                response('causes category deleted', 200);
            } else {
                response('failed to delete causes category', 200);
            }
        } else {
            foreach ($causes_category_id as $key => $value) {
                $this->unlink_causes_image_related_to_category($value);
                $delete_causes = $this->causes_model->delete_causes_category($value);
            }
            if ($delete_causes == true) {
                response('causes deleted', 200);
            } else {
                response('failed to delete causes', 200);
            }
        }
    }

    public function unlink_causes_image_related_to_category($causes_category_id) {
        if (!is_array($causes_category_id)) {
            $causes_image = $this->causes_model->get_causes_by_category_id($causes_category_id);
            foreach ($causes_image as $key => $value) {
                if ($value->images) {
                    unlink('../uploads/' . $value->images);
                }
            }
            return true;
        } else {
            foreach ($causes_category_id as $key => $id) {
                $causes_image = $this->causes_model->get_causes_by_category_id($causes_category_id);
                foreach ($causes_image as $key => $value) {
                    if ($value->images) {
                        unlink('../uploads/' . $value->images);
                    }
                }
            }
            return true;
        }
    }

}
