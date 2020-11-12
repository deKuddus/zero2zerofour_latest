<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donors_model extends MY_Model {

    protected $_table_name = 'donors';

    public function __construct() {
        parent::__construct();
    }

    public function get_donors($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('name', 'email', 'mobile', 'city', 'country', 'post_code', 'state');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
            WHERE id LIKE "%' . $_POST['search']['value'] . '%"
            OR name LIKE "%' . $_POST['search']['value'] . '%"
            OR email LIKE "%' . $_POST['search']['value'] . '%"
            OR mobile LIKE "%' . $_POST['search']['value'] . '%"            ';
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

    public function registger_new_donor($m_data) {
        if ($this->db->insert($this->_table_name, $m_data)) {
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

    public function update_donor($donors_id, $data) {
        if ($this->db->where('id', $donors_id)->update($this->_table_name, $data)) {
            return true;
        }
    }

    public function delete($donors_id) {
        if ($this->db->delete($this->_table_name, array('id' => $donors_id))) {
            return true;
        }
    }

    public function change_status($donors_id) {
        $status = $this->db->where('id', $donors_id)->get('donors')->row()->is_active;
        if ($status == 1) {
            $change = 0;
        } else {
            $change = 1;
        }
        if ($this->db->where('id', $donors_id)->update($this->_table_name, ['is_active' => $change])) {
            return true;
        }
    }

    public function count_total_row_of_donors() {
        return $this->db->get($this->_table_name)->num_rows();
    }
}
