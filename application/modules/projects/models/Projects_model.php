<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends MY_Model {
    protected $table = 'projects';
    public function __construct() {
        parent::__construct();
    }

    public function get_project($condition = '') {
        if ($condition == '') {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->get($this->table)->result();
        } else {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->limit(1)->get($this->table)->row();
        }
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function get_by_slug($slug) {
        return $this->db->where('slug', $slug)->get($this->table)->row();
    }

    public function get_related_projects($category, $id) {
        return $this->db->where(['is_active' => 1, 'id !=' => $id, 'category' => $category])->order_by('id', 'DESC')->limit(3)->get($this->table)->result();
    }

    public function get_projects($id) {
        return $this->db->where(['is_active' => 1, 'id !=' => $id])->order_by('id', 'DESC')->limit(3)->get($this->table)->result();
    }
}
