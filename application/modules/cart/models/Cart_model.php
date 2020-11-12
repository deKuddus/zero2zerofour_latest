<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_product_by_id($product_id) {
        return $this->db->select('*')->from('products')->where('id', $product_id)->get()->row();
    }

    public function insert_cart($data) {
        if ($this->db->insert('carts', $data)) {
            return true;
        }
    }

    public function update_cart($data, $product_id, $order_id, $type) {
        if ($this->db->where(['product_id' => $product_id, 'order_id' => $order_id, 'type' => $type])->update('carts', $data)) {
            return true;
        }
    }

    public function product_already_added_to_cart($product_id, $order_id, $type = '') {
        $query = $this->db->where(['product_id' => $product_id, 'order_id' => $order_id, 'type' => $type])->get('carts');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function count_cart($customer_id, $order_id, $details = false) {
        $where = "customer_id = $customer_id AND order_id = '$order_id' ";
        $query = $this->db->where($where)->get('carts');
        if ($details == false) {
            return $query->num_rows();
        } else {
            return $query->result();
        }
    }

    public function single_remove($cart_id) {
        if ($this->db->where('id', $cart_id)->delete('carts')) {
            return true;
        }
    }

    public function get_cart_content_by_id($id) {
        return $this->db->where('id', $id)->get('carts')->row();
    }

    public function update_whole_cart($data, $id) {
        if ($this->db->where('id', $id)->update('carts', $data)) {
            return true;
        }
    }

    public function get_membership($id)
    {
        return $this->db->where('id',$id)->get('membership_config')->row();
    }
}
