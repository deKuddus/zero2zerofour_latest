<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends MY_Model {

    public $table = 'members';
    public function __construct() {
        parent::__construct();
    }

    public function registger_new_member($m_data) {
        if ($this->db->insert($this->table, $m_data)) {
            return true;
        }
    }
    public function get_members($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->table)->result();
        } else {
            return $this->db->where('id', $id)->get($this->table)->row();
        }
    }
    public function duplicate_email($email, $id = '') {
        if ($id != '') {
            $query = $this->db->where(['id !=' => $id, 'email' => $email])->get($this->table)->num_rows();
        } else {
            $query = $this->db->where('email', $email)->get($this->table)->num_rows();
        }
        if ($query > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function update_member($members_id, $data) {
        if ($this->db->where('id', $members_id)->update($this->table, $data)) {
            return true;
        }
    }
    public function check_account_exist($email, $password) {
        $query = $this->db->where(['email' => $email])->get('members')->row();
        if ($query) {
            if (password_verify($password, $query->password)) {
                return $query;
            } else {
                return [];
            }
        } else {
            return false;
        }
    }

    public function get_member($id, $email = '') {
        if ($email == '') {
            return $this->db->where('id', $id)->get($this->table)->row();
        } else {
            $member = $this->db->where('email', $email)->get($this->table)->row();
            if ($member) {
                return $member;
            } else {
                return false;
            }
        }
    }
    public function get_member_by_email_code($code, $email) {
        $member = $this->db->where(['email' => $email, 'password_reset_code' => $code])->get($this->table)->row();
        if ($member) {
            return $member;
        } else {
            return false;
        }
    }

    public function get_member_order($id) {
        return $this->db->where('customer_id', $id)->get('orders')->result();
    }
    public function update_user_reset_code($email, $code) {
        if ($this->db->where('email', $email)->update($this->table, ['password_reset_code' => $code])) {
            return true;
        }
    }

    public function update_user_password($email, $password) {
        if ($this->db->where('email', $email)->update($this->table, ['password' => hashing_password($password)])) {
            return true;
        }
    }
    public function get_order_by_code($order_id) {
        $query1     = $this->db->where('order_id', $order_id)->get('orders');
        $order      = $query1->row();
        $query2     = $this->db->where('order_id', $order_id)->get('order_lists');
        $order_list = $query2->result();
        if ($order && $order_list) {
            return $data = ['order' => $order, 'order_list' => $order_list];
        } else {
            return false;
        }
    }

    public function get_last_sequence() {
        $query    = $this->db->order_by('id', 'DESC')->limit(1)->get($this->table)->row()->member_id;
        $sequence = explode('-', $query);
        if (sizeof($sequence) > 2) {
            return $sequence[3] + 1;
        } else {
            return 1001;
        }
    }

    public function get_membership($id) {
        return $this->db->where('id', $id)->get('membership_config')->row();
    }
}