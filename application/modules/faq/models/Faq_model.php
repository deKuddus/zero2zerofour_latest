<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends MY_Model {

    protected $_table_name = 'faqs';

    public function __construct() {
        parent::__construct();
    }

    public function get_faq() {
        return $this->db->order_by('id', 'ASC')->get($this->_table_name)->result();
    }

}