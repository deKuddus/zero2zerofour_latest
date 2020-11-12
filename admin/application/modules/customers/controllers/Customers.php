<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('customers_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['dashboard_page'] = TRUE;
        $this->data['title']          = 'customer | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module']    = 'customers';
        $this->data['view_file']      = 'index';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data = array();
        foreach ($this->customers_model->show() as $key => $customer) {
            $sub_array   = array();
            $sub_array[] = "<input type='checkbox' class='customer_checkbox' name='customer_id' value='" . $customer->id . "'>";
            $sub_array[] = $customer->id;
            $sub_array[] = $customer->name;
            $sub_array[] = $customer->username;
            $sub_array[] = $customer->email;
            $sub_array[] = $customer->phone;
            $sub_array[] = $customer->address;
            $sub_array[] = "<img src='" . FILE_UPLOAD_PATH . $customer->picture . "' alt='customer logo' height='100px' width='100px'>";
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" data-toggle="modal" data-target="#customer_edit_modal" onclick="edit_customer(' . $customer->id . ')">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_customer(' . $customer->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->customers_model->count_total_row_of_customer(),
            'recordsFiltered' => $this->customers_model->count_total_row_of_customer(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store() {
        if (isset($_POST)) {
            if ($this->customers_model->duplicate_username($this->input->post('username')) == false) {
                if ($this->customers_model->duplicate_email($this->input->post('email')) == false) {
                    if (isset($_FILES) && !empty($_FILES['customer_image']['tmp_name'])) {
                        $config = image_config('customer');
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('customer_image') == true) {
                            $data       = $this->upload->data();
                            $image_name = 'customer/' . $data['file_name'];
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
                            'address'  => $this->input->post('address'),
                            'password' => hashing_password($this->input->post('password')),
                            'picture'  => $image_name,
                        ];
                        $success = $this->customers_model->store($input);
                        if ($success == true) {
                            $data = array('status' => 200, 'message' => 'customer created');
                            header("Content-type: application/json");
                            echo json_encode($data);
                            exit();
                        }
                    } else {
                        $image = "customer/default.png";
                        $input = [
                            'name'     => $this->input->post('name'),
                            'username' => $this->input->post('username'),
                            'email'    => $this->input->post('email'),
                            'phone'    => $this->input->post('phone'),
                            'address'  => $this->input->post('address'),
                            'password' => hashing_password($this->input->post('password')),
                            'picture'  => $image,
                        ];
                        $success = $this->customers_model->store($input);
                        if ($success == true) {
                            $data = array('status' => 200, 'message' => 'customer created');
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

    public function edit_customer() {
        $id       = $this->input->post('id');
        $customer = $this->customers_model->get($id);
        if (isset($customer)) {
            echo json_encode($customer);
        }
    }

    public function update() {
        $id = $this->input->post('customer_id');
        if (isset($_POST)) {
            if ($this->customers_model->duplicate_username($this->input->post('username'), $id) == false) {
                if ($this->customers_model->duplicate_email($this->input->post('email'), $id) == false) {
                    if (isset($_FILES) && !empty($_FILES['customer_image_edit']['tmp_name'])) {
                        $path = $this->customers_model->get_by_id($id)->picture;
                        if (unlink_file($path) == true) {
                            $config = image_config('customer');
                            $this->load->library('upload', $config);
                            if ($this->upload->do_upload('customer_image_edit') == true) {
                                $data       = $this->upload->data();
                                $image_name = 'customer/' . $data['file_name'];
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
                                'address'  => $this->input->post('address'),
                                'picture'  => $image_name,
                            ];
                            $success = $this->customers_model->update($input, $id);
                            if ($success == true) {
                                $data = array('status' => 200, 'message' => 'customer updated');
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
                            'address'  => $this->input->post('address'),
                        ];
                        $success = $this->customers_model->update($input, $id);
                        if ($success == true) {
                            $data = array('status' => 200, 'message' => 'customer updated');
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
        $id = $this->input->post('customer_id');
        if (is_array($id)) {
            foreach ($id as $key => $ids) {
                $path = $this->customers_model->get_by_id($ids)->picture;
                unlink_file($path);
            }
            if ($this->customers_model->delete($id, true) == true) {
                $data = array('status' => 200, 'message' => 'customer deleted');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        } else {
            $path = $this->customers_model->get_by_id($id)->picture;
            if (unlink_file($path) == true) {
                if ($this->customers_model->delete($id, false) == true) {
                    $data = array('status' => 200, 'message' => 'customer deleted');
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
