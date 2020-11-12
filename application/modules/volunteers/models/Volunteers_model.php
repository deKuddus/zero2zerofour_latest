<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_volunteers($name = '') {
        if($name){
            return $this->db->where('is_active', 1)->like('name', $name, 'both')->order_by('id', 'ASC')->get('volunteers')->result();
        }else{
            return $this->db->where('is_active', 1)->order_by('id', 'ASC')->get('volunteers')->result();
        }
    }

    public function registger_new_vounteer($v_data) {
        if ($this->db->insert('volunteers', $v_data)) {
            return true;
        }
    }

    public function duplicate_email($email) {
        $result = $this->db->where('email', $email)->get('volunteers')->num_rows();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_voluteer_by_v_id($v_id)
    {
         return $this->db->where(['v_id' => $v_id])->get('volunteers')->row();
    }
}
