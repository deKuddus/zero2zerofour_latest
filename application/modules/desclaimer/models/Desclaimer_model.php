<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desclaimer_model extends MY_Model {

    protected $_table_name = 'desclaimer';

    public function __construct() {
        parent::__construct();
    }

    public function get_desclaimer() {
        return $this->db->get($this->_table_name)->result();
    }

}