<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('setting_model');
        $this->load->module('template');
    }

    public function index() {
        var_dump("nothing here");exit();
    }

    public function slider() {
        $this->data['title']       = 'Slider | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['home_page']   = TRUE;
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'slider';
        $this->template->admin_ui($this->data);
    }

    public function slider_show() {
        $data    = array();
        $sliders = $this->setting_model->slider_show();
        foreach ($sliders as $s_key => $slider) {
            if ($slider->is_active == 1) {
                $is_active = '<div class="switch">
                                <div class="onoffswitch">
                                <input type="checkbox" onchange="change_slider_status(' . $slider->id . ',this)" checked="checked" class="onoffswitch-checkbox slider_status" id="example' . $s_key . '" value="0">
                                <label class="onoffswitch-label" for="example' . $s_key . '">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                                </label>
                                </div>
                                </div>';
            } else if ($slider->is_active == 0) {
                $is_active = '<div class="switch">
                                <div class="onoffswitch">
                                <input type="checkbox" onchange="change_slider_status(' . $slider->id . ',this)" class="onoffswitch-checkbox slider_status" id="example' . $s_key . '" value="1">
                                <label class="onoffswitch-label" for="example' . $s_key . '">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                                </label>
                                </div>
                                </div>';
            }
            $sub_array   = array();
            $sub_array[] = '<input type="checkbox" name="product_id[]" class="slider_checkbox" value="' . $slider->id . '"/>';
            $sub_array[] = "<img src='" . image_url($slider->image) . "' alt='slider' height='100px' width='100px' onclick='view_image(this)''>";
            $sub_array[] = $slider->title;
            $sub_array[] = $slider->description;
            $sub_array[] = $slider->url;
            $sub_array[] = $is_active;
            $sub_array[] = '<div class="btn-group">
                              <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                              <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                              <li><a class="dropdown-item" data-toggle="modal" data-target="#edit_slider_modal" onclick="edit_slider(' . $slider->id . ')">Edit</a></li>
                              <li><a class="dropdown-item" onclick="delete_slider(' . $slider->id . ')">Delete</a></li>
                              </ul>
                              </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->setting_model->count_total_row_of_slider(),
            'recordsFiltered' => $this->setting_model->count_total_row_of_slider(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function slider_add() {
        if (!$_FILES['slider_image']) {
            response('please select a slider image', 201);
        } else {
            if (isset($_POST) && isset($_FILES)) {
                $this->load->library('upload', image_config('slider_image'));
                if ($this->upload->do_upload('slider_image') == true) {
                    $data         = $this->upload->data();
                    $slider_image = 'slider_image/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }

                $slider_data = array();
                foreach ($_POST as $key => $value) {
                    $slider_data[$key] = $value;
                }
                $slider_data['image'] = $slider_image;
                $inserted_data        = $this->setting_model->slider_add($slider_data);
                if ($inserted_data == true) {
                    response('slider added', 200);
                }
            }
        }
    }

    public function slider_delete() {
        $slider_id = $this->input->post('slider_id', TRUE);
        if ($this->setting_model->unlink_slider_image($slider_id) == true) {
            if ($this->setting_model->slider_delete($slider_id) == true) {
                response('slider deleted', 200);
            }
        }
    }

    public function slider_edit() {
        $slider_id = $this->input->post('slider_id', TRUE);
        $slider    = $this->setting_model->get_slider($slider_id);
        if (isset($slider)) {
            echo json_encode($slider);
        }
    }

    public function slider_update() {
        $slider_id = $this->input->post('slider_id', TRUE);
        if (isset($_POST)) {
            if (isset($_FILES)) {
                if ($this->setting_model->unlink_slider_image($slider_id) == true) {
                    $this->load->library('upload', image_config('slider_image'));
                    if ($this->upload->do_upload('slider_image') == true) {
                        $data  = $this->upload->data();
                        $image = 'slider_image/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
            }
            $slider_data = array();
            foreach ($_POST as $key => $value) {
                if ($key == 'slider_id') {
                    continue;
                } else {
                    $slider_data[$key] = $value;
                }
            }
            $slider_data['image'] = $image;
            if ($this->setting_model->slider_update($slider_data, $slider_id) == true) {
                response('slider added', 200);
            }
        }

    }
    public function logo() {
        $this->data['title']       = 'Logo  | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['home_page']   = TRUE;
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'logo';
        $this->template->admin_ui($this->data);
    }

    public function logo_add() {
        if (!$_FILES['logo_image']) {
            response('please select a logo image', 201);
        } else {
            if (isset($_POST) && isset($_FILES)) {
                $this->load->library('upload', image_config('logo_image'));
                if ($this->upload->do_upload('logo_image') == true) {
                    $data       = $this->upload->data();
                    $logo_image = 'logo_image/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $logo_data = [
                    'config_key' => 'site_logo',
                    'title'      => $this->input->post('title'),
                    'value'      => $logo_image,
                    'status'     => 0,
                ];
                if ($this->setting_model->logo_add($logo_data) == true) {
                    response('logo added', 200);
                }
            }
        }
    }

    public function logo_show() {
        $data  = array();
        $logos = $this->setting_model->logo_show();
        foreach ($logos as $l_key => $logo) {
            $sub_array = array();
            if ($logo->status == 1) {
                $status = '<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" onchange="change_logo_status(' . $logo->id . ',this)" checked="checked" class="onoffswitch-checkbox logo_status" id="example' . $l_key . '" value="0">
                        <label class="onoffswitch-label" for="example' . $l_key . '">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                        </label>
                        </div>
                        </div>';
            } else if ($logo->status == 0) {
                $status = '<div class="switch">
                        <div class="onoffswitch">
                        <input type="checkbox" onchange="change_logo_status(' . $logo->id . ',this)" class="onoffswitch-checkbox logo_status" id="example' . $l_key . '" value="1">
                        <label class="onoffswitch-label" for="example' . $l_key . '">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                        </label>
                        </div>
                        </div>';
            }

            $sub_array[] = '<input type="checkbox" name="logo_id[]" class="logo_checkbox" value="' . $logo->id . '"/>';
            $sub_array[] = "<img src='" . image_url($logo->value) . "' alt='logo' height='100px' width='100px' onclick='view_image(this)''>";
            $sub_array[] = $logo->title;
            $sub_array[] = $status;
            $sub_array[] = '<div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                          <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                          <li><a class="dropdown-item" onclick="delete_logo(' . $logo->id . ')">Delete</a></li>
                          </ul>
                          </div>';

            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->setting_model->count_total_row_of_logo(),
            'recordsFiltered' => $this->setting_model->count_total_row_of_logo(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function logo_delete() {
        $logo_id      = $this->input->post('logo_id');
        $unlink_image = $this->setting_model->unlink_logo_image($logo_id);
        if ($unlink_image == true) {
            if ($this->setting_model->logo_delete($logo_id) == true) {
                response('logo deleted', 200);
            }
        }
    }

    public function change_logo_status() {
        $logo_id       = $this->input->post('logo_id');
        $status        = $this->input->post('status');
        $update_status = $this->setting_model->change_logo_status($logo_id, $status);
        if ($update_status == true) {
            response('status changed', 200);
        }
    }
    ////////////////////////////////////////////////////
    ///about us crud
    public function about_us() {
        $this->data['title']       = 'About Us | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'about_us';
        $this->template->admin_ui($this->data);
    }

    public function about_us_show() {
        $data     = array();
        $about_us = $this->setting_model->about_us_show();
        foreach ($about_us as $key => $about) {
            $sub_array = array();
            if ($about->is_active == 1) {
                $status = '<div class="switch">
                            <div class="onoffswitch">
                            <input type="checkbox" onchange="change_about_us_status(' . $about->id . ',this)" checked="checked" class="onoffswitch-checkbox about_us_status" id="example' . $key . '" value="0">
                            <label class="onoffswitch-label" for="example' . $key . '">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                            </label>
                            </div>
                            </div>';
            } else if ($about->is_active == 0) {
                $status = '<div class="switch">
                            <div class="onoffswitch">
                            <input type="checkbox" onchange="change_about_us_status(' . $about->id . ',this)" class="onoffswitch-checkbox about_us_status" id="example' . $key . '" value="1">
                            <label class="onoffswitch-label" for="example' . $key . '">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                            </label>
                            </div>
                            </div>';
            }

            $sub_array[] = $about->title;
            $sub_array[] = $about->objective;
            $sub_array[] = $about->description;
            $sub_array[] = $status;
            $sub_array[] = '<div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                          <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                          <li><a href="' . base_url('setting/about_us_edit/' . $about->id) . '" class="dropdown-item">Edit</a></li>
                          <li><a class="dropdown-item" onclick="delete_about_us(' . $about->id . ')">Delete</a></li>
                          </ul>
                          </div>';

            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->setting_model->count_total_row_of_about_us(),
            'recordsFiltered' => $this->setting_model->count_total_row_of_about_us(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function about_us_add() {
        if (isset($_POST) && isset($_POST['title']) && isset($_POST['description'])) {
            if ($_POST['title'] == '' && $_POST['description'] == '' && $_POST['objective'] == '') {
                $data = [
                    'title'       => $_POST['title'],
                    'objective'   => $_POST['objective'],
                    'description' => $_POST['description'],
                ];
                if ($this->setting_model->about_us_add($data) == true) {
                    response('about us added', 200);
                }
            } else {
                response('please enter the title and content');
            }
        } else {
            response('please enter the title and content');
        }
    }

    public function about_us_edit($id) {
        $this->data['title']       = 'About Us edit | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['home_page']   = TRUE;
        $this->data['view_module'] = 'setting';
        $this->data['about_us']    = $this->setting_model->about_us_get_by_id($id);
        $this->data['view_file']   = 'about_us_edit';
        $this->template->admin_ui($this->data);
    }

    public function about_us_update() {
        if (isset($_POST) && isset($_POST['title']) && isset($_POST['objective']) && isset($_POST['description']) && isset($_POST['about_us_id'])) {
            if (!empty($_POST['title']) OR !empty($_POST['description']) OR !empty($_POST['about_us_id']) OR !empty($_POST['objective'])) {
                $data = ['title' => $_POST['title'], 'objective' => $_POST['objective'], 'description' => $_POST['description']];
                if ($this->setting_model->about_us_update($_POST['about_us_id'], $data) == true) {
                    response('about us updated', 200);
                }
            } else {
                response('please enter the title and contents');
            }
        } else {
            response('please enter the title and content');
        }
    }

    public function about_us_delete() {
        if ($this->setting_model->about_us_delete($_POST['about_us_id']) == true) {
            response('about us deleted', 200);
        }
    }

    public function change_about_us_status() {
        $about_id = $this->input->post('about_us_id', TRUE);
        if ($this->setting_model->change_about_us_status($about_id) == true) {
            response('status changed', 200);
        }
    }

    ////////////////////////////////////////////////////
    ///Hisoty crud
    public function history() {
        $this->data['title']       = 'Our History | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'history';
        $this->template->admin_ui($this->data);
    }

    public function history_show() {
        $data      = array();
        $histories = $this->setting_model->history_show();
        foreach ($histories as $key => $history) {
            $sub_array = array();
            if ($history->is_active == 1) {
                $status = '<div class="switch">
                            <div class="onoffswitch">
                            <input type="checkbox" onchange="change_history_status(' . $history->id . ',this)" checked="checked" class="onoffswitch-checkbox history_status" id="example' . $key . '" value="0">
                            <label class="onoffswitch-label" for="example' . $key . '">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                            </label>
                            </div>
                            </div>';
            } else if ($history->is_active == 0) {
                $status = '<div class="switch">
                            <div class="onoffswitch">
                            <input type="checkbox" onchange="change_history_status(' . $history->id . ',this)" class="onoffswitch-checkbox history_status" id="example' . $key . '" value="1">
                            <label class="onoffswitch-label" for="example' . $key . '">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                            </label>
                            </div>
                            </div>';
            }

            $sub_array[] = $history->year;
            $sub_array[] = $history->description;
            $sub_array[] = $status;
            $sub_array[] = '<div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                          <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                          <li><a href="' . base_url('setting/history_edit/' . $history->id) . '" class="dropdown-item">Edit</a></li>
                          <li><a class="dropdown-item" onclick="delete_history(' . $history->id . ')">Delete</a></li>
                          </ul>
                          </div>';

            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->setting_model->count_total_row_of_history(),
            'recordsFiltered' => $this->setting_model->count_total_row_of_history(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function history_add() {
        if (isset($_POST) && isset($_POST['year']) && isset($_POST['description'])) {
            if ($_POST['year'] != '' && $_POST['description'] != '') {
                $data = [
                    'year'        => $this->input->post('year', TRUE),
                    'description' => $this->input->post('description', TRUE),
                ];
                if ($this->setting_model->history_add($data) == true) {
                    response('history us added', 200);
                }
            } else {
                response('please enter the year and content');
            }
        } else {
            response('please enter the year and content');
        }
    }

    public function history_edit($id) {
        $this->data['history']     = $this->setting_model->history_get_by_id($id);
        $this->data['title']       = 'Our History | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'history_edit';
        $this->template->admin_ui($this->data);
    }

    public function history_update() {
        if (isset($_POST) && isset($_POST['year']) && isset($_POST['description']) && isset($_POST['history_id'])) {
            if ($_POST['year'] != '' && $_POST['description'] != '' && $_POST['history_id'] != '') {
                $data = [
                    'year'        => $this->input->post('year', TRUE),
                    'description' => $this->input->post('description', TRUE),
                ];
                if ($this->setting_model->history_update($this->input->post('history_id', TRUE), $data) == true) {
                    response('history us updated', 200);
                }
            } else {
                response('please enter the year and content');
            }
        } else {
            response('please enter the year and content');
        }
    }

    public function history_delete() {
        if ($this->setting_model->history_delete($_POST['history_id']) == true) {
            response('history us deleted', 200);
        }
    }

    public function change_history_status() {
        $history_id = $this->input->post('history_id', TRUE);
        if ($this->setting_model->change_history_status($history_id) == true) {
            response('status changed', 200);
        }
    }

    ////////////////////////////
    ///Mission and Vission crud
    public function mission() {
        $this->data['title']       = 'Mission |Vision |Theme Title | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['mission']     = $this->setting_model->get_mission();
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'mission';
        $this->template->admin_ui($this->data);
    }

    public function mission_update() {
        $id          = $this->input->post('mission_id', TRUE);
        $mission     = $this->input->post('mission', TRUE);
        $vision      = $this->input->post('vision', TRUE);
        $theme_title = $this->input->post('theme_title', TRUE);
        if (isset($id) && isset($mission) && isset($vision) && isset($theme_title)) {
            $data = ['mission' => $mission, 'vision' => $vision, 'theme_title' => $theme_title];
            if ($this->setting_model->mission_update($data, $id) == true) {
                response('Mission and Vision updated', 200);
            }
        } else {
            response('please fill up all field is required');
        }
    }

    ///////config value show
    public function config() {
        $this->data['configs']     = $this->setting_model->get_config();
        $this->data['title']       = 'Site Config | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'setting';
        $this->data['view_file']   = 'company_setting';
        $this->template->admin_ui($this->data);
    }

    public function update_config() {
        $config_key   = $this->input->post('config_key', TRUE);
        $config_value = $this->input->post('config_value', TRUE);
        if (!empty($config_key) && !empty($config_value)) {
            if ($this->setting_model->update_config($config_key, $config_value) == true) {
                response('config updated', 200);
            }
        } else {
            response('woops! something went wrong');
        }
    }
}
