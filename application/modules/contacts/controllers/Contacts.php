<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = 'Contact Us | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module'] = 'contacts';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);
    }

    public function save_message() {
        if (isset($_POST)) {
            $data = [
                'name'    => xss_clean($_POST['name']),
                'email'   => xss_clean($_POST['email']),
                'subject' => xss_clean($_POST['subject']),
                'message' => xss_clean($_POST['message']),
            ];
            if ($this->contact_model->save_message($data) == true) {
                response('Message was sent successfully', 200);
            }
        }
    }

}
