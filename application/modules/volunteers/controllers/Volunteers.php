<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('volunteers_model');
        $this->load->module('template');
    }

    public function index() {
        $name = $this->input->post('name');
        if(isset($name) && !empty($name)){
            $this->data['volunteers']  = $this->volunteers_model->get_volunteers($name);
        }else{
            $this->data['volunteers']  = $this->volunteers_model->get_volunteers();
        }
        $this->data['home_page']   = TRUE;
        $this->data['title']       = 'Our Volunteers | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'volunteers';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);
    }

    public function register() {
        $this->data['home_page']   = TRUE;
        $this->data['title']       = 'Volunteers Registration | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module'] = 'volunteers';
        $this->data['view_file']   = 'register';
        $this->template->site_ui($this->data);
    }

    public function registger_new_vounteer() {
        if (isset($_POST)) {
            if ($this->volunteers_model->duplicate_email($_POST['email']) == true) {
                response('woops! Given is Email Exist', 202);
            }
            if (isset($_FILES) && !empty($_FILES['volunteer_photo']['name'])) {
                $this->load->library('upload', image_config('volunteer'));
                if ($this->upload->do_upload('volunteer_photo') == true) {
                    $data            = $this->upload->data();
                    $volunteer_photo = 'volunteer/' . $data['file_name'];
                    $this->resizeImage('uploads/' . $volunteer_photo);
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $v_data = [
                    'name'            => $_POST['name'],
                    'email'           => $_POST['email'],
                    'mobile'          => $_POST['mobile'],
                    'street_address'  => $_POST['street_address'],
                    'police_station'  => $_POST['police_station'],
                    'post_code'       => $_POST['post_code'],
                    'country'         => $_POST['country'],
                    'date_of_birth'   => $_POST['date_of_birth'],
                    'state'           => $_POST['state'],
                    'volunteer_photo' => $volunteer_photo,
                    'v_id' => '0204-v-'.date('Y').'-'.date('m').'-'.time()
                ];
                if ($this->volunteers_model->registger_new_vounteer($v_data) == true) {
                    response('Registration success, Please wait for admin verification', 200);
                }
            }
        }
    }

    public function resizeImage($filename) {
        $target_path  = $_SERVER['DOCUMENT_ROOT'] . '/uploads/volunteer/';
        $config_manip = array(
            'image_library'  => 'gd2',
            'source_image'   => $filename,
            'maintain_ratio' => TRUE,
            'width'          => 192,
            'height'         => 192,
        );

        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            $image_err = $this->image_lib->display_errors();
            response($image_err);
        }
        $this->image_lib->clear();
        return true;
    }

    public function profile($v_id){
        if($v_id){
            $this->data['volunteer'] = $this->volunteers_model->get_voluteer_by_v_id($v_id);
            $this->data['title']       = 'Volunteer Profile | Helping Hand Charity Foundation by Zero2Zero4';
            $this->data['view_module'] = 'volunteers';
            $this->data['view_file']   = 'profile';
            $this->template->site_ui($this->data);
        }
    }
}