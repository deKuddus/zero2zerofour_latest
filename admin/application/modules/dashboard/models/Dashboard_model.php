<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_contact_message() {
        $query = $this->db->order_by('id', 'desc')->get('contacts');
        return $query->result();
    }

    public function delete_contact_message($message_id) {
        if ($this->db->where('id', $message_id)->delete('contacts')) {
            return true;
        }
    }

    public function get_total_volunteer() {
        return $this->db->where('is_active', 1)->get('volunteers')->num_rows();
    }
    public function get_total_members() {
        return $this->db->where('is_active', 1)->get('members')->num_rows();
    }
    public function get_total_donor() {
        return $this->db->where('is_active', 1)->get('donors')->num_rows();
    }
    public function get_total_causes() {
        return $this->db->where('is_active', 1)->get('causes')->num_rows();
    }
    public function get_total_event() {
        return $this->db->where('is_active', 1)->get('events')->num_rows();
    }
    public function get_total_post() {
        return $this->db->where('is_active', 1)->get('blogs')->num_rows();
    }
    public function get_total_orders() {
        return $this->db->where('is_active', 0)->get('orders')->num_rows();
    }
    public function get_total_confirm_orders() {
        return $this->db->where('is_active', 1)->get('orders')->num_rows();
    }
}
