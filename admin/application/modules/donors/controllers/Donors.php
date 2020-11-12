<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donors extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('donors_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['table_page']  = TRUE;
        $this->data['view_module'] = 'donors';
        $this->data['view_file']   = 'index';
        $this->data['title']       = 'Administration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function create() {
        $this->data['title']       = 'Administration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'donors';
        $this->data['view_file']   = 'create';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        $data   = array();
        $donors = $this->donors_model->show();
        foreach ($donors as $p_key => $donor) {
            $sub_array = array();
            if ($donor->is_active == 1) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_donor_status(' . $donor->id . ',this)" checked="checked" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="0">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            } else if ($donor->is_active == 0) {
                $is_active = '<div class="switch">
                <div class="onoffswitch">
                <input type="checkbox" onchange="change_donor_status(' . $donor->id . ',this)" class="onoffswitch-checkbox status" id="example' . $p_key . '" value="1">
                <label class="onoffswitch-label" for="example' . $p_key . '">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
                </label>
                </div>
                </div>';
            }
            $sub_array[] = '<img src="' . image_url($donor->donor_photo) . '" alt="donor photo" height="100px" width="100px;" class="view_image"  onclick="view_image(this)" style="cursor:pointer">';
            $sub_array[] = $donor->name;
            $sub_array[] = $donor->email;
            $sub_array[] = $donor->mobile;
            $sub_array[] = $is_active;

            $sub_array[] = '<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
            <li><a class="dropdown-item" href="' . base_url('donors/edit/' . $donor->id) . '">Edit</a></li>
            <li><a class="dropdown-item" onclick="delete_donor(' . $donor->id . ')">Delete</a></li>
            </ul>
            </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->donors_model->count_total_row_of_donors(),
            'recordsFiltered' => $this->donors_model->count_total_row_of_donors(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function registger_new_donor() {
        if (isset($_POST)) {
            if ($this->donors_model->duplicate_email($_POST['email']) == false) {
                if (isset($_FILES) && !empty($_FILES['donor_photo']['name'])) {
                    $this->load->library('upload', image_config('donor'));
                    if ($this->upload->do_upload('donor_photo') == true) {
                        $data        = $this->upload->data();
                        $donor_photo = 'donor/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                    $d_data = [
                        'name'        => $this->input->post('name', TRUE),
                        'email'       => $this->input->post('email', TRUE),
                        'mobile'      => $this->input->post('mobile', TRUE),
                        'donor_photo' => $donor_photo,
                    ];
                    if ($this->donors_model->registger_new_donor($d_data) == true) {
                        response('Donar added, Please activate him/her to show in main site', 200);
                    }
                } else {
                    response('Donor Photo is required');
                }
            } else {
                response('woops! Given is Email Exist', 202);
            }
        }
    }

    public function edit($donors_id) {
        $this->data['donor']       = $this->donors_model->get_donors($donors_id);
        $this->data['view_module'] = 'donors';
        $this->data['view_file']   = 'edit';
        $this->data['title']       = 'Administration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function update_donor() {
        $id     = $this->input->post('donor_id', TRUE);
        $m_data = array();
        if (isset($_POST)) {
            if ($this->donors_model->duplicate_email($_POST['email'], $id) == false) {
                if (!empty($_FILES['donor_photo']['name'])) {
                    $this->load->library('upload', image_config('donor'));
                    $file = $this->donors_model->get_donors($id);
                    if ($file) {
                        @unlink('../uploads/' . $file);
                    }
                    if ($this->upload->do_upload('donor_photo') == true) {
                        $data                  = $this->upload->data();
                        $d_data['donor_photo'] = 'donor/' . $data['file_name'];
                    } else {
                        $image_err = $this->upload->display_errors();
                        response($image_err);
                    }
                }

                $d_data['name']   = $this->input->post('name', TRUE);
                $d_data['email']  = $this->input->post('email', TRUE);
                $d_data['mobile'] = $this->input->post('mobile', TRUE);

                if ($this->donors_model->update_donor($id, $d_data) == true) {
                    response('Donor profile updated', 200);
                }
            } else {
                response('woops! Given is Email Exist', 202);
            }
        }
    }

    public function delete() {
        $donors_id = $this->input->post('id', TRUE);
        $file      = $this->donors_model->get_donors($donors_id)->donor_photo;
        if ($file) {
            @unlink('../uploads/' . $file);
        }
        if ($this->donors_model->delete($donors_id) == true) {
            response('donors deleted', 200);
        } else {
            response('failed to delete donors');
        }
    }

    public function change_donors_status() {
        $donors_id = $this->input->post('donors_id', TRUE);
        if ($this->donors_model->change_status($donors_id) == true) {
            response('donors status changed', 200);
        } else {
            response('donors status can not changed');
        }
    }

}
