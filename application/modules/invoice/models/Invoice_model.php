<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends MY_Model {

    protected $_table_name       = 'orders';
    protected $_table_order_list = 'order_lists';

    public function __construct() {
        parent::__construct();
    }

    public function get_order_by_code($order_id) {
        $order       = $this->db->where('order_id', $order_id)->get($this->_table_name)->row();
        $order_list  = $this->db->where('order_id', $order_id)->get($this->_table_order_list)->result();
        return $data = ['order' => $order, 'order_list' => $order_list];
    }
}