<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchandise_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function products($id = 0) {
        if ($id == 0) {
            return $this->db->where('is_active', 1)->get('products')->result();
        } else {
            return $this->db->where('id', $id)->get('products')->row();
        }
    }
    public function product_by_slug($slug) {
        return $this->db->where('slug', $slug)->get('products')->row();
    }
    public function related_product($category_id) {
        if ($category_id) {
            return $this->db->where('category_id', $category_id)->get('products')->result();
        }
    }

    public function count_products() {
        return $this->db->count_all("products");
    }

    public function get_current_page_records($limit, $start) {
        $query = $this->db->limit($limit, $start)->get("products")->result();
        if (!empty($query)) {
            foreach ($query as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function all_category() {
        return $this->db->where('is_active', 1)->get('categories')->result();
    }

/////////////////reviews code
    public function save_review($review_data) {
        if ($this->db->insert('product_review', $review_data)) {
            return true;
        }
    }
    public function get_product_review_by_id($product_id) {
        return $this->db->where(['is_active' => 1, 'product_id' => $product_id])->get('product_review')->result();
    }

    public function member_name($member_id) {
        $query = $this->db->where('id', $member_id)->get('members')->row();
        if (!empty($query)) {
            return $query->name;
        } else {
            return 'Random Reviewer';
        }
    }

}
