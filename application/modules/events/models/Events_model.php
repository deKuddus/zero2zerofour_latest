<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_event($condition = '') {
        if ($condition == '') {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->get('events')->result();
        } else {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->limit(1)->get('events')->row();
        }
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)->get('events')->row();
    }

    public function get_by_slug($slug) {
        return $this->db->where('slug', $slug)->get('events')->row();
    }

    public function get_related_events($category, $id) {
        return $this->db->where(['is_active' => 1, 'id !=' => $id, 'category' => $category])->order_by('id', 'DESC')->limit(3)->get('events')->result();
    }

    public function get_events($id) {
        return $this->db->where(['is_active' => 1, 'id !=' => $id])->order_by('id', 'DESC')->limit(3)->get('events')->result();
    }
}
