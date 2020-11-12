<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('members_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['table_page']  = TRUE;
        $this->data['view_module'] = 'members';
        $this->data['view_file']   = 'index';
        $this->data['title']       = 'Members  | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']            = 'Members create | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['designations']     = $this->members_model->get_member_designation();
        $this->data['get_member_order'] = $this->members_model->get_member_order();
        $this->data['view_module']      = 'members';
        $this->data['view_file']        = 'create';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        global $status;
        $data         = array();
        $designations = $this->members_model->get_member_designation();
        $members      = $this->members_model->show();
        foreach ($members as $p_key => $members) {
            $sub_array = array();
            foreach ($designations as $key => $d_name) {
                if ($members->designation == $d_name->id) {
                    $designation = $d_name->designation_name;
                } else {
                    $designation = '';
                }
            }
            if ($members->is_active == 1) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_members_status(' . $members->id . ',this)" checked="checked" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($members->is_active == 0) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_members_status(' . $members->id . ',this)" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<img src="' . image_url($members->member_photo) . '" alt="members photo" height="100px" width="100px;" class="view_image"  onclick="view_image(this)" style="cursor:pointer">';
            $sub_array[] = $members->member_id;
            $sub_array[] = $members->name;
            $sub_array[] = $designation;
            $sub_array[] = $members->email;
            $sub_array[] = $members->mobile;
            $sub_array[] = $members->date_of_birth;
            $sub_array[] = $members->street_address;
            $sub_array[] = $members->police_station;
            $sub_array[] = $members->state;
            $sub_array[] = $members->post_code;
            $sub_array[] = $members->country;
            $sub_array[] = $is_active;
            $sub_array[] = '<img src="' . image_url($members->registration_card) . '" alt="members national id card" height="100px" width="100px;" class="view_nid"  onclick="view_image(this)" style="cursor:pointer">';
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" href="' . base_url('members/view?id=' . $members->id) . '">View</a></li>
            <li><a class="dropdown-item" href="' . base_url('members/edit/' . $members->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_members(' . $members->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->members_model->count_total_row_of_members(),
            'recordsFiltered' => $this->members_model->count_total_row_of_members(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function registger_new_member() {
        if (isset($_POST)) {
            if ($this->members_model->duplicate_email($_POST['email']) == false) {
                response('woops! Given is Email Exist', 202);
            }
            if (isset($_FILES) && !empty($_FILES['member_photo']['name']) && !empty($_FILES['registration_card']['name'])) {
                response('National id card Photo and your photo is required');
            }
            $this->load->library('upload', image_config('member'));
            if ($this->upload->do_upload('member_photo') == true) {
                $data         = $this->upload->data();
                $member_photo = 'member/' . $data['file_name'];
                resizeImage('../uploads/' . $member_photo, 'member');
                if ($member_photo) {
                    $this->load->library('upload', image_config('member'));
                    if ($this->upload->do_upload('registration_card') == true) {
                        $data              = $this->upload->data();
                        $registration_card = 'member/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }
            } else {
                $image_err = $this->upload->display_errors();
                response($image_err);
            }
            $m_data = [
                'name'              => $this->input->post('name', TRUE),
                'email'             => $this->input->post('email', TRUE),
                'mobile'            => $this->input->post('mobile', TRUE),
                'date_of_birth'     => $this->input->post('date_of_birth', TRUE),
                'street_address'    => $this->input->post('street_address', TRUE),
                'police_station'    => $this->input->post('police_station', TRUE),
                'post_code'         => $this->input->post('post_code', TRUE),
                'country'           => $this->input->post('country', TRUE),
                'state'             => $this->input->post('state', TRUE),
                'password'          => hashing_password($this->input->post('password', TRUE)),
                'member_photo'      => $member_photo,
                'registration_card' => $registration_card,
                'member_id' => 'MID-'.date('Y').'-'.date('m').'-'.$this->member_model->get_last_sequence()
            ];
            if (!empty($designation)) {
                $m_data['designation']        = $designation;
                $m_data['board_member_order'] = $this->input->post('board_member_order');
            }
            if ($this->members_model->registger_new_member($m_data) == true) {
                response('Registration success, Pleas Wait For Admin Verification', 200);
            }
        }
    }

    public function edit($members_id) {
        $this->data['designations']     = $this->members_model->get_member_designation();
        $this->data['member']           = $this->members_model->get_members($members_id);
        $this->data['view_module']      = 'members';
        $this->data['view_file']        = 'edit';
        $this->data['title']            = 'Members edit | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['get_member_order'] = $this->members_model->get_member_order();
        $this->template->admin_ui($this->data);
    }

    public function update_member() {
        $id          = $this->input->post('member_id');
        $designation = $this->input->post('designation', TRUE);
        $m_data      = array();
        if (isset($_POST)) {
            if ($this->members_model->duplicate_email($_POST['email'], $id) == false) {
                if (isset($_FILES)) {
                    $this->load->library('upload', image_config('member'));
                    $data = $this->upload_member_documents($_FILES, $id);
                    // var_dump($data);exit();
                    if (isset($data['member_photo'])) {
                        $m_data['member_photo'] = $data['member_photo'];
                    }
                    if (isset($data['registration_card'])) {
                        $m_data['registration_card'] = $data['registration_card'];
                    }
                }
                $m_data['name']           = $this->input->post('name', TRUE);
                $m_data['email']          = $this->input->post('email', TRUE);
                $m_data['mobile']         = $this->input->post('mobile', TRUE);
                $m_data['date_of_birth']  = $this->input->post('date_of_birth', TRUE);
                $m_data['street_address'] = $this->input->post('street_address', TRUE);
                $m_data['police_station'] = $this->input->post('police_station', TRUE);
                $m_data['post_code']      = $this->input->post('post_code', TRUE);
                if (isset($_POST['country']) && $_POST['country'] != '' && $_POST['country'] != '-1') {
                    $m_data['country'] = $this->input->post('country', TRUE);
                    $m_data['state']   = $this->input->post('state', TRUE);
                }
                if (isset($_POST['password']) && $_POST['password'] != '') {
                    $m_data['password'] = hashing_password($this->input->post('password', TRUE));
                }
                if (!empty($designation)) {
                    $m_data['designation']        = $designation;
                    $m_data['board_member_order'] = $this->input->post('board_member_order');
                }
                // var_dump($m_data);exit;
                if ($this->members_model->update_member($id, $m_data) == true) {
                    response('Member profile updated', 200);
                }
            } else {
                response('woops! Given is Email Exist', 202);
            }
        }
    }

    public function upload_member_documents($files, $id) {
        $d_data = array();
        $_FILES = $files;
        if (!empty($_FILES['member_photo']['name'])) {
            if ($this->unlink_file($id, 'photo') == true) {
                if ($this->upload->do_upload('member_photo') == true) {
                    $data                   = $this->upload->data();
                    $d_data['member_photo'] = 'member/' . $data['file_name'];
                    resizeImage('../uploads/' . $d_data['member_photo'], 'member');
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
            }
        }
        if (!empty($_FILES['registration_card']['name'])) {
            if ($this->unlink_file($id, 'card') == true) {
                if ($this->upload->do_upload('registration_card') == true) {
                    $data                        = $this->upload->data();
                    $d_data['registration_card'] = 'member/' . $data['file_name'];
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
            }
        }

        return $d_data;
    }
    public function delete() {
        $members_id = $this->input->post('id', TRUE);
        if ($this->unlink_file($members_id, 'all') == true) {
            if ($this->members_model->delete($members_id) == true) {
                response('members deleted', 200);
            } else {
                response('failed to delete members');
            }
        }
    }

    public function change_members_status() {
        $members_id = $this->input->post('members_id', TRUE);
        if ($this->members_model->change_status($members_id) == true) {
            response('members status changed', 200);
        } else {
            response('members status can not changed');
        }
    }

    public function view() {
        $id                   = $this->input->get('id', TRUE);
        $this->data['member'] = $this->members_model->get_members($id);
        if (!empty($this->data['member'])) {
            $this->data['view_module'] = 'members';
            $this->data['view_file']   = 'view';
            $this->data['title']       = 'Members view | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->template->admin_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->admin_ui($this->data);
        }
    }

    public function unlink_file($id, $type) {
        if ($type == 'photo') {
            $file = $this->members_model->get_members($id)->member_photo;
            if ($file) {
                @unlink('../uploads/' . $file);
            }
            return true;
        } elseif ($type == 'all') {
            $data = $this->members_model->get_members($id);
            if ($data->member_photo) {
                @unlink('../uploads/' . $data->member_photo);
            }
            if ($data->registration_card) {
                @unlink('../uploads/' . $data->registration_card);
            }
            return true;
        } else {
            $file = $this->members_model->get_members($id)->registration_card;
            if ($file) {
                unlink('../uploads/' . $file);
            }
            return true;
        }
    }

    //// Designation crud started

    public function designation() {
        $this->data['view_module'] = 'members';
        $this->data['view_file']   = 'designation';
        $this->data['title']       = 'Members designation | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function designation_show() {
        global $status;
        $data = array();
        foreach ($this->members_model->get_member_designation() as $p_key => $designation) {
            $sub_array   = array();
            $name        = "'" . $designation->designation_name . "'";
            $sub_array[] = $designation->id;
            $sub_array[] = $designation->designation_name;
            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">

            <li><a class="dropdown-item" onclick="edit_designation(' . $designation->id . ',' . $name . ')" >Edit</a></li>
            <li><a class="dropdown - item" onclick="delete_designation(' . $designation->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->members_model->count_total_row_of_designation(),
            'recordsFiltered' => $this->members_model->count_total_row_of_designation(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function store_designation() {
        $name = $this->input->post('designation_name');
        if (isset($name) && $name != '') {
            if ($this->members_model->store_designation(['designation_name' => $name]) == true) {
                response('Designation Name Created', 200);
            } else {
                response('woops! something went wrong');
            }
        }
    }

    public function update_designation() {
        $name = $this->input->post('designation_name');
        $id   = $this->input->post('designation_id');
        if (isset($name) && $name != '') {
            if ($this->members_model->store_designation(['designation_name' => $name], $id) == true) {
                response('Designation Name Created', 200);
            } else {
                response('woops! something went wrong');
            }
        }
    }

    public function delete_designation() {

        $id = $this->input->post('id');
        if ($this->members_model->delete_designation($id) == true) {
            response('designation deleted', 200);
        } else {
            response('failed to delete designation');
        }
    }
}
