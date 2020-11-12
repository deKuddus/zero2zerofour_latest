<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes_model extends MY_Model {

    protected $_table_name            = 'causes';
    protected $_table_causes_category = 'causes_category';
    protected $_primary_key           = 'id';
    protected $_primary_filter        = 'intval';
    protected $_order_by              = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_causes($id = 0) {
        if (!$id) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('title', 'slug');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
            WHERE title LIKE "%' . $_POST['search']['value'] . '%"
            OR slug LIKE "%' . $_POST['search']['value'] . '%"
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

    public function store($data, $id = 0) {
        if ($id == 0) {
            if ($this->db->insert($this->_table_name, $data)) {
                return true;
            }
        } else {
            if ($this->db->where('id', $causes_id)->update($this->_table_name, $data)) {
                return 200;
            }
        }
    }

    public function delete($causes_id) {
        if (is_array($causes_id)) {
            $id    = implode(',', $causes_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_name)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_name, array('id' => $causes_id))) {
                return true;
            }
        }
    }

    public function get_all_category($condition = '') {
        $query = $this->db->where('is_active', 1)->get($this->_table_causes_category);
        if (!empty($condition)) {
            $category = array();
            foreach ($query->result() as $key => $value) {
                $category[$value->id] = $value->name;
            }
            return $category;
        } else {
            return $query->result();
        }
    }

    public function change_status($causes_id, $status) {
        if ($this->db->where('id', $causes_id)->update($this->_table_name, ['is_active' => $status])) {
            return true;
        } else {
            return false;
        }
    }

    public function change_causes_featured_status($causes_id, $status) {
        if ($this->db->where('id', $causes_id)->update($this->_table_name, ['is_featured' => $status])) {
            return true;
        } else {
            return false;
        }
    }

    public function count_total_row_of_causes() {
        return $this->db->get($this->_table_name)->num_rows();
    }

    public function check_causes_slug_duplicate($slug, $id = '') {
        if (empty($id)) {
            $query = $this->db->where('slug', $slug)->get($this->_table_name)->num_rows();
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $query = $this->db->where(['id !=' => $id, 'slug' => $slug])->get($this->_table_name)->num_rows();
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)->get($this->_table_name)->row();
    }

    ////////////category module

    //// category curd

    public function show_category() {
        return $this->db->get($this->_table_causes_category)->result();
    }

    public function count_total_row_of_category() {
        return $this->db->get($this->_table_causes_category)->num_rows();
    }

    public function store_category($data) {
        if ($this->db->insert($this->_table_causes_category, $data)) {
            return true;
        }
    }

    public function update_category($data, $id) {
        if ($this->db->where('id', $id)->update($this->_table_causes_category, $data)) {
            return true;
        }
    }

    public function delete_causes_category($causes_category_id) {
        if (is_array($causes_category_id)) {
            $id    = implode(',', $causes_category_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_causes_category)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_causes_category, array('id' => $causes_category_id))) {
                return true;
            }
        }
    }

    public function get_causes_by_category_id($blog_id) {
        return $this->db->where('category', $blog_id)->get($this->_table_name)->result();
    }

}