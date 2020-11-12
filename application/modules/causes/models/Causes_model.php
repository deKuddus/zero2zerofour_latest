<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_model extends MY_Model {
    protected $_causes                = 'causes';
    protected $_table_causes_category = 'causes_category';

    public function get_all_causes($conditon = '') {
        if ($conditon == '') {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->get($this->_causes)->result();
        } else {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->limit(5)->get($this->_causes)->result();
        }
    }

    public function get_causes_by_id($id) {
        return $this->db->where(['is_active' => 1, 'id' => $id])->get($this->_causes)->row();
    }

    public function get_causes_by_slug($slug) {
        return $this->db->where(['is_active' => 1, 'slug' => $slug])->get($this->_causes)->row();
    }

    public function get_causes_by_limit($category = '') {
        return $this->db->where(['category' => $category, 'is_active' => 1])->limit(4)->get($this->_causes)->result();
    }

    public function get_causes_category() {
        return $this->db->where('is_active', 1)->get($this->_table_causes_category)->result();
    }

    public function all_cause_by_category($category_id) {
        return $this->db->where(['is_active' => 1, 'category' => $category_id])->get($this->_causes)->result();
    }
}