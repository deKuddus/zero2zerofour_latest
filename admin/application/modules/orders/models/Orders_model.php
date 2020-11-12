<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends MY_Model {

    protected $_table_name       = 'orders';
    protected $_table_order_list = 'order_lists';
    protected $_primary_key      = 'id';
    protected $_primary_filter   = 'intval';
    protected $_order_by         = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_orders($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show($status = 0) {
        $column = array('order_id');
        $query  = "SELECT * FROM " . $this->_table_name . " WHERE is_active = $status";
        if (isset($_POST['search']['value'])) {
            $query .= ' AND order_id LIKE "%' . $_POST['search']['value'] . '%"';
        }

        if (isset($_POST['order'])) {
            $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }

    public function store($data) {

        if ($insert = $this->db->insert($this->_table_name, $data)) {
            return $insert ? $this->db->insert_id() : false;
        }
    }

    public function delete($orders_id) {
        if (is_array($orders_id)) {
            $id    = implode(',', $orders_id);
            $where = "id IN ($id)";
            if ($this->db->where($where)->delete($this->_table_name)) {
                return true;
            }
        } else {
            if ($this->db->delete($this->_table_name, array('id' => $orders_id))) {
                return 200;
            }
        }
    }

    public function get_order_by_code($order_id) {
        $order       = $this->db->where('order_id', $order_id)->get($this->_table_name)->row();
        $order_list  = $this->db->where('order_id', $order_id)->get($this->_table_order_list)->result();
        return $data = ['order' => $order, 'order_list' => $order_list];
    }

    public function count_total_row_of_orders() {
        return $this->db->where('is_active', 0)->get($this->_table_name)->num_rows();
    }

    public function count_total_row_of_confirm_orders() {
        return $this->db->where('is_active', 1)->get($this->_table_name)->num_rows();
    }

    public function confirmed_order($order_id) {
        if ($this->db->where('order_id', $order_id)->update($this->_table_name, ['is_active' => 1])) {
            return true;
        }
    }

    public function get_transaction($table) {
        return $this->db->get($table)->result();
    }
}
