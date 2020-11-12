<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends MY_Model {

    protected $table = 'contacts';
    public function __construct() {
        parent::__construct();
    }

    public function save_message($data) {
        if ($this->db->insert($this->table, $data)) {
            return true;
        }
    }

}
