<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends MY_Model {

    public $table_order      = 'orders';
    public $table_order_list = 'order_lists';
    public function __construct() {
        parent::__construct();
    }

    public function count_cart($customer_id, $order_id) {
        $where = "customer_id = $customer_id OR order_id = '$order_id' ";
        $query = $this->db->where($where)->get('carts');
        return $query->result();
    }

    public function save_order($data) {
        if ($this->db->insert($this->table_order, $data)) {
            return true;
        }
    }

    public function save_order_list($data) {
        if ($this->db->insert($this->table_order_list, $data)) {
            return true;
        }
    }

    public function get_member_by_id($id) {
        return $this->db->where('id', $id)->get('members')->row();
    }
    public function register($data) {
        if ($this->db->insert('customers', $data)) {
            return $this->db->insert_id();
        }
    }

    public function destroy_cart($customer_id, $order_id) {
        $where = "customer_id = $customer_id OR order_id = '$order_id' ";
        if ($this->db->where($where)->delete('carts')) {
            return true;
        }
    }

    public function save_transaction($data,$table) {
        if ($this->db->insert($table, $data)) {
            return true;
        }
    }
}
