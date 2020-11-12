<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_about() {
        return $this->db->where('is_active', 1)->order_by('id', 'DESC')->limit(1)->get('about_us')->row();
    }

    public function get_history() {
        return $this->db->where('is_active', 1)->order_by('id', 'DESC')->get('history')->result();
    }

    public function get_mission() {
        return $this->db->where('id', 1)->get('mission_vision')->row();
    }

    public function get_board_of_directors() {
        return $query = $this->db->where('designation !=', 0)->where('board_member_order !=', 1)->where('board_member_order !=', NULL)->order_by('board_member_order', 'ASC')->get('members')->result();
    }

    public function get_member_designation() {
        return $this->db->where('is_active', 1)->get('member_designation')->result();
    }

    public function get_member_head_board_director() {
        return $query = $this->db->where('designation !=', 0)->where('board_member_order', 1)->get('members')->row();
    }
}
