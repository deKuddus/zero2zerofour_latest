<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model {

    protected $_table_name     = 'products';
    protected $_table_category = 'categories';
    protected $_table_colors   = 'colors';
    protected $_table_sizes    = 'sizes';
    protected $_table_type     = 'types';
    protected $_primary_key    = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by       = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_product($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('name', 'quantity', 'purchase_price', 'sale_price', 'feature_image');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
            WHERE id LIKE "%' . $_POST['search']['value'] . '%"
            OR name LIKE "%' . $_POST['search']['value'] . '%"
            OR sku LIKE "%' . $_POST['search']['value'] . '%"
            OR purchase_price LIKE "%' . $_POST['search']['value'] . '%"
            OR sale_price LIKE "%' . $_POST['search']['value'] . '%"
            OR discount LIKE "%' . $_POST['search']['value'] . '%"
            OR discount_type LIKE "%' . $_POST['search']['value'] . '%"
            OR tax LIKE "%' . $_POST['search']['value'] . '%"
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

    public function duplicate_slug_check($slug, $id = 0) {
        if ($id == 0) {
            $query = $this->db->where('slug', $slug)->get($this->_table_name)->num_rows();
        } else {
            $query = $this->db->where(['id !=' => $id, 'slug' => $slug])->get($this->_table_name)->num_rows();
        }
        if ($query > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function store($data) {
        if ($insert = $this->db->insert($this->_table_name, $data)) {
            return $insert ? $this->db->insert_id() : false;
        }
    }

    public function update($product_id, $data) {
        if ($this->db->where('id', $product_id)->update($this->_table_name, $data)) {
            return true;
        }
    }

    public function delete($product_id) {
        if (is_array($product_id)) {
            $id    = implode(',', $product_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_name)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_name, array('id' => $product_id))) {
                return true;
            }
        }
    }

    public function get_all_category($condition = '') {
        $query = $this->db->where('is_active', 1)->get($this->_table_category);
        if (!empty($condition)) {
            $category = array();
            foreach ($query->result() as $key => $value) {
                $category[$value->id] = $value->category_name;
            }
            return $category;
        } else {
            return $query->result();
        }
    }

    public function get_all_brands($condition = '') {
        $query = $this->db->where('is_active', 1)->get($this->_table_brand);
        if (!empty($condition)) {
            $brands = array();
            foreach ($query->result() as $key => $value) {
                $brands[$value->id] = $value->name;
            }
            return $brands;
        } else {
            return $query->result();
        }
    }
    public function get_all_units($condition = '') {
        if (!$condition) {
            return $this->db->where('is_active', 1)->get($this->_table_units)->result();
        } else {
            $query = $this->db->where('is_active', 1)->get($this->_table_units);
            $units = array();
            foreach ($query->result() as $key => $value) {
                $units[$value->id] = $value->name;
            }
            return $units;
        }
    }
    public function get_all_tags($condition = '') {
        if (!$condition) {
            return $this->db->where('is_active', 1)->get($this->_table_tags)->result();
        } else {
            $query = $this->db->where('is_active', 1)->get($this->_table_tags);
            $tags  = array();
            foreach ($query->result() as $key => $value) {
                $tags[$value->id] = $value->name;
            }
            return $tags;
        }
    }
    public function get_all_colors($condition = '') {
        if (!$condition) {
            return $this->db->where('is_active', 1)->get($this->_table_colors)->result();
        } else {
            $query  = $this->db->where('is_active', 1)->get($this->_table_colors);
            $colors = array();
            foreach ($query->result() as $key => $value) {
                $colors[$value->id] = $value->value;
            }
            return $colors;
        }
    }
    public function get_all_sizes($condition = '') {
        if (!$condition) {
            return $this->db->where('is_active', 1)->get($this->_table_sizes)->result();
        } else {
            $query = $this->db->where('is_active', 1)->get($this->_table_sizes);
            $sizes = array();
            foreach ($query->result() as $key => $value) {
                $sizes[$value->id] = $value->value;
            }
            return $sizes;
        }
    }
    public function get_sub_category($category_id) {
        return $this->db->where(['pid' => $category_id, 'is_active' => 1])->get($this->_table_category)->result();
    }

    public function get_tax_discount_type($condition = '') {
        if (!$condition) {
            return $this->db->get($this->_table_type)->result();
        } else {
            $query = $this->db->get($this->_table_type);
            $types = array();
            foreach ($query->result() as $key => $value) {
                $types[$value->id] = $value->symbol;
            }
            return $types;
        }
    }

    public function change_status($product_id, $status) {
        if ($this->db->where('id', $product_id)->update($this->_table_name, ['is_active' => $status])) {
            return true;
        } else {
            return false;
        }

    }

    public function count_total_row_of_product() {
        return $this->db->get($this->_table_name)->num_rows();
    }

    public function get_quantity_by_id($id) {
        return $this->db->select('quantity')->where('id', $id)->get($this->_table_name)->row();
    }

    public function update_product_quantity($id, $quantity) {
        if ($this->db->where('id', $id)->update($this->_table_name, ['quantity' => $quantity])) {
            return true;
        }
    }

    public function get_product_discount_by_id($product_id) {
        return $this->db->select('discount,discount_type')->where('id', $product_id)->get($this->_table_name)->row();
    }

    public function upload_multiple_image($data) {
        foreach ($data as $key => $value) {
            $this->db->insert('product_pictures', $value);
        }
        return true;
    }

    public function get_product_pictures($product_id) {
        return $this->db->where('product_id', $product_id)->get('product_pictures')->result();
    }

    public function get_image_optional_image($id) {
        return $this->db->where('product_id', $id)->get('product_pictures')->result();
    }

    public function delete_single_image_optional($id) {
        $image = $this->db->where('id', $id)->get('product_pictures')->row();
        if (!empty($image->picture)) {
            unlink('../uploads/' . $image->picture);
        }
        if ($this->db->where('id', $id)->delete('product_pictures')) {
            return true;
        }
    }

    //// category curd

    public function show_category() {
        return $this->db->get($this->_table_category)->result();
    }

    public function count_total_row_of_category() {
        return $this->db->get($this->_table_category)->num_rows();
    }

    public function store_category($data) {
        if ($this->db->insert($this->_table_category, $data)) {
            return true;
        }
    }

    public function update_category($data, $id) {
        if ($this->db->where('id', $id)->update($this->_table_category, $data)) {
            return true;
        }
    }

    public function delete_product_category($product_category_id) {
        if (is_array($product_category_id)) {
            $id    = implode(',', $product_category_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_category)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_category, array('id' => $product_category_id))) {
                return true;
            }
        }
    }

    public function change_category_status($product_category_id, $status) {
        if ($this->db->where('id', $product_category_id)->update($this->_table_category, ['is_active' => $status])) {
            return true;
        } else {
            return false;
        }
    }

    public function get_blog_by_category_id($blog_id) {
        return $this->db->where('category', $blog_id)->get($this->_table_name)->result();
    }

    public function get_sub_category_by_parent_category($product_category_id) {
        if (is_array($product_category_id)) {
            $id    = implode(',', $product_category_id);
            $where = "pid IN ($id)";
            return $this->db->where($where)->get($this->_table_category)->result();
        } else {
            return $this->db->where('pid', $product_category_id)->get($this->_table_category)->result();
        }
    }

}
