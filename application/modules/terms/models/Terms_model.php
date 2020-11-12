<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_model extends MY_Model {

    protected $_table_name = 'terms_conditons';

    public function __construct() {
        parent::__construct();
    }

    public function get_terms_condtiton() {
        return $this->db->get($this->_table_name)->result();
    }

}