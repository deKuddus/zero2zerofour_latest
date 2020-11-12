<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs_model extends MY_Model {

    protected $_table_name          = 'blogs';
    protected $_table_blog_category = 'blog_category';
    protected $_table_blog_tags     = 'blog_tags';
    protected $_primary_key         = 'id';
    protected $_primary_filter      = 'intval';
    protected $_order_by            = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_blog($id = 0) {
        if (!$id) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('title', 'slug', 'author', 'category', 'sub_category', 'content');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
            WHERE title LIKE "%' . $_POST['search']['value'] . '%"
            OR slug LIKE "%' . $_POST['search']['value'] . '%"
            OR author LIKE "%' . $_POST['search']['value'] . '%"
            OR category LIKE "%' . $_POST['search']['value'] . '%"
            OR sub_category LIKE "%' . $_POST['search']['value'] . '%"
            OR content LIKE "%' . $_POST['search']['value'] . '%"
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
            if ($this->db->where('id', $blog_id)->update($this->_table_name, $data)) {
                return true;
            }
        }
    }

    public function delete($blog_id) {
        if (is_array($blog_id)) {
            $id    = implode(',', $blog_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_name)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_name, array('id' => $blog_id))) {
                return true;
            }
        }
    }

    public function get_all_category($condition = '') {
        $query = $this->db->where('is_active', 1)->get($this->_table_blog_category);
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
    public function get_all_sub_category($condition = '') {
        $query = $this->db->where(['is_active' => 1, 'pid !=' => 0])->get($this->_table_blog_category);
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

    public function get_all_tags($condition = '') {
        if (!$condition) {
            return $this->db->where('is_active', 1)->get($this->_table_blog_tags)->result();
        } else {
            $query = $this->db->where('is_active', 1)->get($this->_table_blog_tags);
            $tags  = array();
            foreach ($query->result() as $key => $value) {
                $tags[$value->id] = $value->name;
            }
            return $tags;
        }
    }

    public function get_sub_category($category_id) {
        return $this->db->where(['pid' => $category_id, 'is_active' => 1])->get($this->_table_blog_category)->result();
    }

    public function change_status($blog_id, $status) {
        if ($this->db->where('id', $blog_id)->update($this->_table_name, ['is_active' => $status])) {
            return true;
        } else {
            return false;
        }

    }

    public function count_total_row_of_blog() {
        return $this->db->get($this->_table_name)->num_rows();
    }

    public function delete_blog_comments($id) {
        if ($this->db->where('post_id', $id)->delete('blog_comments')) {
            return true;
        }
    }

    public function check_blog_slug_duplicate($slug, $id = 0) {
        if ($id == 0) {
            $query = $this->db->where('slug', $slug)->get($this->_table_name)->num_rows();
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $query = $this->db->where(['id' => $id, 'slug !=' => $slug])->get($this->_table_name)->num_rows();
            if ($query > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_by_id($id) {
        if (!is_array($id)) {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        } else {
            $id    = implode(',', $id);
            $where = "id IN ($id)";
            return $this->db->where($where)->get($this->_table_name)->result();
        }
    }

    //// category curd

    public function show_category() {
        return $this->db->get($this->_table_blog_category)->result();
    }

    public function count_total_row_of_category() {
        return $this->db->get($this->_table_blog_category)->num_rows();
    }

    public function store_category($data) {
        if ($this->db->insert($this->_table_blog_category, $data)) {
            return true;
        }
    }

    public function update_category($data, $id) {
        if ($this->db->where('id', $id)->update($this->_table_blog_category, $data)) {
            return true;
        }
    }

    public function delete_blogs_category($blogs_category_id) {
        if (is_array($blogs_category_id)) {
            $id    = implode(',', $blogs_category_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_blog_category)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_blog_category, array('id' => $blogs_category_id))) {
                return true;
            }
        }
    }

    public function change_category_status($blogs_category_id, $status) {
        if ($this->db->where('id', $blogs_category_id)->update($this->_table_blog_category, ['is_active' => $status])) {
            return true;
        } else {
            return false;
        }

    }

    public function get_blog_by_category_id($blog_id) {
        return $this->db->where('category', $blog_id)->get($this->_table_name)->result();
    }

    public function get_sub_category_by_parent_category($blogs_category_id) {
        if (is_array($blogs_category_id)) {
            $id    = implode(',', $blogs_category_id);
            $where = "pid IN ($id)";
            return $this->db->where($where)->get($this->_table_blog_category)->result();
        } else {
            return $this->db->where('pid', $blogs_category_id)->get($this->_table_blog_category)->result();
        }
    }
}
