<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_model extends MY_Model {

    protected $_table_name = 'privacy_policy';

    public function __construct() {
        parent::__construct();
    }

    public function get_privacy_policy() {
        $query = $this->db->get($this->_table_name);
        return $query->result();
    }

}