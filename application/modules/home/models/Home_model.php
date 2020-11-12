<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model {

    protected $_causes = 'causes';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_featured_causes($is_featured = 0) {
        if ($is_featured == 1) {
            return $this->db->where(['is_active' => 1, 'is_featured' => 1])->order_by('id', 'desc')->get($this->_causes)->result();
        } else {
            return $this->db->where(['is_active' => 1, 'is_featured' => 0])->order_by('id', 'desc')->get($this->_causes)->result();
        }
    }

    public function get_all_donors_qoute() {
        return $this->db->where('is_active', 1)->get('donors_qoute')->result();
    }

}