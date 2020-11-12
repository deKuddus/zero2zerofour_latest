<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_model extends MY_Model {

    protected $_table_name = 'faqs';

    public function __construct() {
        parent::__construct();
    }

    public function get_faq($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }

    public function store($faq, $id = 0) {
        if ($id == 0) {
            if ($this->db->insert($this->_table_name, $faq)) {
                return true;
            }
        } else {
            if ($this->db->where('id', $id)->update($this->_table_name, $faq)) {
                return true;
            }
        }
    }

    public function delete($id) {
        if ($this->db->delete($this->_table_name, array('id' => $id))) {
            return true;
        }
    }

}