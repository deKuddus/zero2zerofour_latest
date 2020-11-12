<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends MY_Model {

    protected $_table_name     = 'projects';
    protected $_primary_key    = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function show() {
        $column = array('id', 'title', 'created_at', 'location');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $query .= '
         WHERE id LIKE "%' . $_POST['search']['value'] . '%"
         OR title LIKE "%' . $_POST['search']['value'] . '%"
         OR created_at LIKE "%' . $_POST['search']['value'] . '%"
         OR location LIKE "%' . $_POST['search']['value'] . '%"
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
        return $this->db->query($query . $query1)->result();
    }

    public function count_total_row_of_project() {
        return $this->db->get($this->_table_name)->num_rows();
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
        return $this->db->where('id', $id)->get($this->_table_name)->row();
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

    public function duplicate_slug($slug, $id = 0) {
        if ($id != 0) {
            $query = $this->db->where(['id != ' => $id, 'slug' => $slug])->get($this->_table_name)->result();
        } else {
            $query = $this->db->where('slug', $slug)->get($this->_table_name)->result();
        }
        if (!empty($query)) {
            return false;
        } else {
            return true;
        }
    }

}
