<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('dashboard_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['contact_message']      = $this->dashboard_model->get_contact_message();
        $this->data['total_members']        = $this->dashboard_model->get_total_members();
        $this->data['total_volunteer']      = $this->dashboard_model->get_total_volunteer();
        $this->data['total_donor']          = $this->dashboard_model->get_total_donor();
        $this->data['total_causes']         = $this->dashboard_model->get_total_causes();
        $this->data['total_event']          = $this->dashboard_model->get_total_event();
        $this->data['total_post']           = $this->dashboard_model->get_total_post();
        $this->data['total_pendig_orders']  = $this->dashboard_model->get_total_orders();
        $this->data['total_confirm_orders'] = $this->dashboard_model->get_total_confirm_orders();
        $this->data['title']                = 'Dashboard | Helping Hand Charity Foundation by Zero2Zero4';
        $this->data['view_module']          = 'dashboard';
        $this->data['view_file']            = 'manage';
        $this->template->admin_ui($this->data);

    }

    public function delete_contact_message() {
        $message_id = $this->input->post('message_id');
        if ($this->dashboard_model->delete_contact_message($message_id) == true) {
            $data = array('status' => 200, 'message' => 'message deleted');
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        }
    }

    public function reply_contact_message() {
        if (isset($_POST)) {

            $this->email->initialize(eamil_config());
            $this->email->from($this->config->item('company_email'), 'Kuddus');
            $this->email->to($_POST['reply_to']);
            $this->email->subject($_POST['repey_subject']);
            $this->email->message($_POST['reply_message']);
            if ($this->email->send()) {
                $data = array('status' => 200, 'message' => 'message sent');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            } else {
                $data = array('status' => 201, 'message' => 'Failed to send message');
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        }
    }

}
