<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers_model extends MY_Model {

    protected $_table_name = 'volunteers';

    public function __construct() {
        parent::__construct();
    }

    public function get_volunteers($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('name', 'email', 'mobile', 'police_station', 'country', 'post_code', 'state');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
                WHERE id LIKE "%' . $_POST['search']['value'] . '%"
                OR name LIKE "%' . $_POST['search']['value'] . '%"
                OR email LIKE "%' . $_POST['search']['value'] . '%"
                OR mobile LIKE "%' . $_POST['search']['value'] . '%"
                OR police_station LIKE "%' . $_POST['search']['value'] . '%"
                OR country LIKE "%' . $_POST['search']['value'] . '%"
                OR post_code LIKE "%' . $_POST['search']['value'] . '%"
                OR state LIKE "%' . $_POST['search']['value'] . '%"
            ';
        }

        if (isset($_POST['order'])) {
            $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }

    public function registger_new_vounteer($v_data) {
        if ($this->db->insert('volunteers', $v_data)) {
            return true;
        }
    }

    public function duplicate_email($email, $id = '') {
        if ($id != '') {
            $query = $this->db->where(['id !=' => $id, 'email' => $email])->get($this->_table_name)->num_rows();
        } else {
            $query = $this->db->where('email', $email)->get($this->_table_name)->num_rows();
        }

        if ($query > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_volunteer($id, $data) {
        if ($this->db->where('id', $id)->update($this->_table_name, $data)) {
            return true;
        }
    }

    public function delete($volunteers_id) {
        if ($this->db->delete($this->_table_name, array('id' => $volunteers_id))) {
            return 200;
        }
    }

    public function change_status($volunteers_id) {
        $status = $this->db->where('id', $volunteers_id)->get('volunteers')->row()->is_active;
        if ($status == 1) {
            $change = 0;
        } else {
            $change = 1;
        }
        if ($this->db->where('id', $volunteers_id)->update($this->_table_name, ['is_active' => $change])) {
            return true;
        }
    }

    public function count_total_row_of_volunteers() {
        return $this->db->get($this->_table_name)->num_rows();
    }
}
