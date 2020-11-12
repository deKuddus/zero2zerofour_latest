<?php
class AppConfigModel extends CI_Model {

    protected $table;

    public function __construct() {
        $this->table = 'config';
    }

    public function get_configurations() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function header_image() {
        $query = $this->db->get('header_image');
        return $query->result();
    }
}