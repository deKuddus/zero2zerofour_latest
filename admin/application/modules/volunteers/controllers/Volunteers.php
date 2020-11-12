<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('volunteers_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['title']       = 'Volunteers | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'volunteers';
        $this->data['view_file']   = 'index';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']       = 'Volunteer create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'volunteers';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        global $status;
        $data      = array();
        $volunteer = $this->volunteers_model->show();
        foreach ($volunteer as $p_key => $volunteers) {
            $sub_array = array();

            if ($volunteers->is_active == 1) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_volunteers_status(' . $volunteers->id . ',this)" checked="checked" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($volunteers->is_active == 0) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_volunteers_status(' . $volunteers->id . ',this)" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<img src="' . image_url($volunteers->volunteer_photo) . '" alt="volunteers photo" height="100px" width="100px;" class="view_image"  onclick="view_image(this)" style="cursor:pointer">';
            $sub_array[] = $volunteers->name;
            $sub_array[] = $volunteers->email;
            $sub_array[] = $volunteers->mobile;
            $sub_array[] = $volunteers->date_of_birth;
            $sub_array[] = $volunteers->street_address;
            $sub_array[] = $volunteers->police_station;
            $sub_array[] = $volunteers->post_code;
            $sub_array[] = $volunteers->state;
            $sub_array[] = $volunteers->country;
            $sub_array[] = $is_active;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" href="' . base_url('volunteers/view?id=' . $volunteers->id) . '">View</a></li>
            <li><a class="dropdown-item" href="' . base_url('volunteers/edit/' . $volunteers->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_volunteers(' . $volunteers->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->volunteers_model->count_total_row_of_volunteers(),
            'recordsFiltered' => $this->volunteers_model->count_total_row_of_volunteers(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function registger_new_vounteer() {
        if (isset($_POST)) {
            if ($this->volunteers_model->duplicate_email($this->input->post('email', TRUE)) == true) {
                response('woops! Given is Email Exist', 202);
            }
            if (isset($_FILES) && !empty($_FILES['volunteer_photo']['name'])) {
                $this->load->library('upload', image_config('volunteer'));
                if ($this->upload->do_upload('volunteer_photo') == true) {
                    $data            = $this->upload->data();
                    $volunteer_photo = 'volunteer/' . $data['file_name'];
                    resizeImage('../uploads/' . $volunteer_photo, 'volunteer');
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $v_data = [
                    'name'            => $this->input->post('name', TRUE),
                    'email'           => $this->input->post('email', TRUE),
                    'mobile'          => $this->input->post('mobile', TRUE),
                    'date_of_birth'   => $this->input->post('date_of_birth', TRUE),
                    'street_address'  => $this->input->post('street_address', TRUE),
                    'police_station'  => $this->input->post('police_station', TRUE),
                    'post_code'       => $this->input->post('post_code', TRUE),
                    'occupation'      => $this->input->post('occupation', TRUE),
                    'country'         => $this->input->post('country', TRUE),
                    'state'           => $this->input->post('state', TRUE),
                    'volunteer_photo' => $volunteer_photo,
                     'v_id' => '0204-v-'.date('Y').'-'.date('m').'-'.time()
                ];
                if ($this->volunteers_model->registger_new_vounteer($v_data) == true) {
                    response('Registration success, To activate profile need admin verification', 200);
                }
            } else {
                response('National id card Photo and your photo is required');
            }
        }
    }

    public function edit($volunteer_id) {
        $this->data['volunteer']   = $this->volunteers_model->get_volunteers($volunteer_id);
        $this->data['title']       = 'volunteer edit | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'volunteers';
        $this->data['view_file']   = 'edit';
        $this->template->admin_ui($this->data);
    }

    public function update_volunteer() {
        $id     = $this->input->post('volunteer_id');
        $m_data = array();
        if (isset($_POST)) {
            if ($this->volunteers_model->duplicate_email($this->input->post('email', TRUE), $id) == true) {
                response('woops! Given is Email Exist', 202);
            }
            if (isset($_FILES) && !empty($_FILES['volunteer_photo']['name'])) {
                $this->load->library('upload', image_config('volunteer'));
                if ($this->unlink_file($id) == true) {
                    if ($this->upload->do_upload('volunteer_photo') == true) {
                        $data                      = $this->upload->data();
                        $m_data['volunteer_photo'] = 'volunteer/' . $data['file_name'];
                        resizeImage('../uploads/' . $m_data['volunteer_photo'], 'volunteer');
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
            }

            $m_data['name']           = $this->input->post('name', TRUE);
            $m_data['email']          = $this->input->post('email', TRUE);
            $m_data['mobile']         = $this->input->post('mobile', TRUE);
            $m_data['date_of_birth']  = $this->input->post('date_of_birth', TRUE);
            $m_data['street_address'] = $this->input->post('street_address', TRUE);
            $m_data['police_station'] = $this->input->post('police_station', TRUE);
            $m_data['post_code']      = $this->input->post('post_code', TRUE);
            $m_data['occupation']     = $this->input->post('occupation', TRUE);
            $country                  = $this->input->post('country', TRUE);
            if (isset($country) && $country != '' && $country != '-1') {
                $m_data['country'] = $country;
                $m_data['state']   = $this->input->post('state', TRUE);
            }
            if ($this->volunteers_model->update_volunteer($id, $m_data) == true) {
                response('Volunteer profile updated', 200);
            }
        }
    }

    public function delete() {
        $volunteers_id = $this->input->post('id', TRUE);
        if ($this->unlink_file($volunteers_id) == true) {
            if ($this->volunteers_model->delete($volunteers_id) == true) {
                response('volunteers deleted', 200);
            } else {
                response('failed to delete volunteers');
            }
        }
    }

    public function change_volunteers_status() {
        $volunteers_id = $this->input->post('volunteers_id', TRUE);
        if ($this->volunteers_model->change_status($volunteers_id) == true) {
            response('volunteers status changed', 200);
        } else {
            response('volunteers status can not changed');
        }
    }

    public function view() {
        $id                      = $this->input->get('id', TRUE);
        $this->data['volunteer'] = $this->volunteers_model->get_volunteers($id);
        if (!empty($this->data['volunteer'])) {
            $this->data['title']       = 'Administration | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->data['view_module'] = 'volunteers';
            $this->data['view_file']   = 'view';
            $this->template->admin_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->admin_ui($this->data);
        }
    }

    public function unlink_file($id) {
        $file = $this->volunteers_model->get_volunteers($id)->volunteer_photo;
        if ($file) {
            @unlink('../uploads/' . $file);
        }
        return true;
    }
}
