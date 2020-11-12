<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration_model extends MY_Model {

    protected $_table_name     = 'administration';
    protected $_primary_key    = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function show() {
        $column = array('id', 'name', 'username', 'email', 'phone');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $query .= '
         WHERE id LIKE "%' . $_POST['search']['value'] . '%"
         OR name LIKE "%' . $_POST['search']['value'] . '%"
         OR username LIKE "%' . $_POST['search']['value'] . '%"
         OR email LIKE "%' . $_POST['search']['value'] . '%"
         OR phone LIKE "%' . $_POST['search']['value'] . '%"
         ';
        }

        if (isset($_POST['order']) && !empty($_POST['order'])) {
            $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY ' . $this->_order_by . ' DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $result = $this->db->query($query . $query1);
        return $result->result();
    }

    public function count_total_row_of_administration() {
        $query = $this->db->get($this->_table_name);
        return $query->num_rows();
    }

    public function store($input) {
        if ($this->db->insert($this->_table_name, $input)) {
            return true;
        }
    }

    public function update($input, $id) {
        if ($this->db->where('id', $id)->update($this->_table_name, $input)) {
            return true;
        }
    }

    public function get_by_id($id) {
        $query = $this->db->where('id', $id)->get($this->_table_name);
        return $query->row();
    }

    public function delete($id, $array = false) {
        if ($array == false) {
            if ($this->db->delete($this->_table_name, ['id' => $id])) {
                return true;
            }
        } else {
            $_id   = implode(',', $id);
            $where = "id IN ($_id)";
            if ($this->db->where($where)->delete($this->_table_name)) {
                return true;
            }
        }
    }

    public function duplicate_username($username, $id = 0) {
        if ($id != 0) {
            $query = $this->db->where(['id != ' => $id, 'username' => $username])->get($this->_table_name);
        } else {
            $query = $this->db->where('username', $username)->get($this->_table_name);
        }
        $data = $query->result();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function duplicate_email($email, $id = 0) {
        if ($id != 0) {
            $query = $this->db->where(['id != ' => $id, 'email' => $email])->get($this->_table_name);
        } else {
            $query = $this->db->where('email', $email)->get($this->_table_name);
        }
        $data = $query->result();
        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

}
