<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('administration_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'Administration | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module']    = 'administration';
        $this->data['view_file']      = 'index';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data = array();
        foreach ($this->administration_model->show() as $key => $administration) {
            $sub_array   = array();
            $sub_array[] = "<input type='checkbox' class='administration_checkbox' name='administration_id' value='" . $administration->id . "'>";
            $sub_array[] = $administration->id;
            $sub_array[] = $administration->name;
            $sub_array[] = $administration->username;
            $sub_array[] = $administration->email;
            $sub_array[] = $administration->phone;
            $sub_array[] = "<img src='" . FILE_UPLOAD_PATH . $administration->picture . "' alt='administration logo' height='100px' width='100px'>";
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" data-toggle="modal" data-target="#administration_edit_modal" onclick="edit_administration(' . $administration->id . ')">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_administration(' . $administration->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->administration_model->count_total_row_of_administration(),
            'recordsFiltered' => $this->administration_model->count_total_row_of_administration(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if (isset($_POST)) {
            if ($this->administration_model->duplicate_username($this->input->post('username')) == false) {
                if ($this->administration_model->duplicate_email($this->input->post('email')) == false) {
                    if (isset($_FILES) && !empty($_FILES['administration_image']['tmp_name'])) {
                        $config = image_config('administration');
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('administration_image') == true) {
                            $data       = $this->upload->data();
                            $image_name = 'administration/' . $data['file_name'];
                            resizeImage('../uploads/' . $image_name, 'administration');
                        } else {
                            $image_err = $this->upload->display_errors();
                            header("Content-type: application/json");
                            echo json_encode($image_err);
                            exit();
                            response($image_err);
                        }
                        $input = [
                            'name'     => $this->input->post('name'),
                            'username' => $this->input->post('username'),
                            'email'    => $this->input->post('email'),
                            'phone'    => $this->input->post('phone'),
                            'password' => hashing_password($this->input->post('password')),
                            'picture'  => $image_name,
                        ];
                        $success = $this->administration_model->store($input);
                        if ($success == true) {
                            $data = array('status' => 200, 'message' => 'administration created');
                            header("Content-type: application/json");
                            echo json_encode($data);
                            exit();
                            response('administration created', 200);
                        }
                    } else {
                        $image = "administration/default.png";
                        $input = [
                            'name'     => $this->input->post('name'),
                            'username' => $this->input->post('username'),
                            'email'    => $this->input->post('email'),
                            'phone'    => $this->input->post('phone'),
                            'password' => hashing_password($this->input->post('password')),
                            'picture'  => $image,
                        ];
                        $success = $this->administration_model->store($input);
                        if ($success == true) {
                            response('administration created', 200);
                        }
                    }
                } else {
                    $data = array('email exist');
                    header("Content-type: application/json");
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data = array('username exist');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        }

    }

    public function edit_administration() {
        $id             = $this->input->post('id');
        $administration = $this->administration_model->get($id);
        if (isset($administration)) {
            echo json_encode($administration);
        }
    }

    public function update() {
        $id = $this->input->post('administration_id');
        if (isset($_POST)) {
            if ($this->administration_model->duplicate_username($this->input->post('username'), $id) == false) {
                if ($this->administration_model->duplicate_email($this->input->post('email'), $id) == false) {
                    if (isset($_FILES) && !empty($_FILES['administration_image_edit']['tmp_name'])) {
                        $path = $this->administration_model->get_by_id($id)->picture;
                        if (unlink_file($path) == true) {
                            $config = image_config('administration');
                            $this->load->library('upload', $config);
                            if ($this->upload->do_upload('administration_image_edit') == true) {
                                $data       = $this->upload->data();
                                $image_name = 'administration/' . $data['file_name'];
                                resizeImage('../uploads/' . $image_name, 'administration');
                            } else {
                                $image_err = $this->upload->display_errors();
                                header("Content-type: application/json");
                                echo json_encode($image_err);
                                exit();
                            }
                            $input = [
                                'name'     => $this->input->post('name'),
                                'username' => $this->input->post('username'),
                                'email'    => $this->input->post('email'),
                                'phone'    => $this->input->post('phone'),
                                'picture'  => $image_name,
                            ];
                            $success = $this->administration_model->update($input, $id);
                            if ($success == true) {
                                $data = array('status' => 200, 'message' => 'administration updated');
                                header("Content-type: application/json");
                                echo json_encode($data);
                                exit();
                            }
                        }
                    } else {
                        $input = [
                            'name'     => $this->input->post('name'),
                            'username' => $this->input->post('username'),
                            'email'    => $this->input->post('email'),
                            'phone'    => $this->input->post('phone'),
                        ];
                        $success = $this->administration_model->update($input, $id);
                        if ($success == true) {
                            $data = array('status' => 200, 'message' => 'administration updated');
                            header("Content-type: application/json");
                            echo json_encode($data);
                            exit();
                        }
                    }
                } else {
                    $data = array('email exist');
                    header("Content-type: application/json");
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data = array('username exist');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        }
    }

    public function delete() {
        $id = $this->input->post('administration_id');
        if (is_array($id)) {
            foreach ($id as $key => $ids) {
                $path = $this->administration_model->get_by_id($ids)->picture;
                unlink_file($path);
            }
            if ($this->administration_model->delete($id, true) == true) {
                $data = array('status' => 200, 'message' => 'administration deleted');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        } else {
            $path = $this->administration_model->get_by_id($id)->picture;
            if (unlink_file($path) == true) {
                if ($this->administration_model->delete($id, false) == true) {
                    $data = array('status' => 200, 'message' => 'administration deleted');
                    header("Content-type: application/json");
                    echo json_encode($data);
                    exit();
                }
            }
        }
    }

    // public function check($ds)
    // {
    //     $stored = '$argon2i$v=19$m=2048,t=4,p=3$eXQudmpWVGJ1Q29ZYXMyZQ$9uPSYyThSeeMaysz04mF8WWOi4bKGVYtM+4BmyF+l+s';
    //     if(password_verify($ds, $stored)){
    //         echo "ok";
    //     }else{
    //         echo "no";
    //     }
    // }

}
