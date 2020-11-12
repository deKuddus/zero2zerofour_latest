<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends MY_Model {

    protected $_table_name        = 'members';
    protected $_table_designation = 'member_designation';

    public function __construct() {
        parent::__construct();
    }

    public function get_members($id = 0) {
        if ($id == 0) {
            return $this->db->get($this->_table_name)->result();
        } else {
            return $this->db->where('id', $id)->get($this->_table_name)->row();
        }
    }
    public function show() {
        $column = array('name', 'email', 'mobile', 'police_station', 'country', 'post_code', 'state');
        $query  = "SELECT * FROM " . $this->_table_name;
        if (isset($_POST['search']['value'])) {
            $query .= '
            WHERE id LIKE "%' . $_POST['search']['value'] . '%"
            OR name LIKE "%' . $_POST['search']['value'] . '%"
            OR email LIKE "%' . $_POST['search']['value'] . '%"
            OR mobile LIKE "%' . $_POST['search']['value'] . '%"
            OR police_station LIKE "%' . $_POST['search']['value'] . '%"
            OR country LIKE "%' . $_POST['search']['value'] . '%"
            OR post_code LIKE "%' . $_POST['search']['value'] . '%"
            OR state LIKE "%' . $_POST['search']['value'] . '%"
            ';
        }

        if (isset($_POST['order'])) {
            $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY board_member_order ASC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }

    public function registger_new_member($m_data) {
        if ($this->db->insert($this->_table_name, $m_data)) {
            return true;
        }
    }

    public function duplicate_email($email, $id = '') {
        if ($id != '') {
            $query = $this->db->where(['id !=' => $id, 'email' => $email])->get($this->_table_name)->num_rows();
        } else {
            $query = $this->db->where('email', $email)->get($this->_table_name)->num_rows();
        }
        if ($query > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_member($members_id, $data) {
        if ($this->db->where('id', $members_id)->update($this->_table_name, $data)) {
            return true;
        }
    }

    public function delete($members_id) {
        if ($this->db->delete($this->_table_name, array('id' => $members_id))) {
            return true;
        }
    }

    public function change_status($members_id) {
        $status = $this->db->where('id', $members_id)->get('members')->row()->is_active;
        if ($status == 1) {
            $change = 0;
        } else {
            $change = 1;
        }
        if ($this->db->where('id', $members_id)->update($this->_table_name, ['is_active' => $change])) {
            return true;
        }
    }

    public function count_total_row_of_members() {
        $query = $this->db->get($this->_table_name);
        return $query->num_rows();
    }

    public function get_member_order() {
        $count = $this->db->get('members')->num_rows();
        $data  = array();
        if ($count > 0) {
            for ($i = 1; $i <= $count; $i++) {
                array_push($data, $i);
            }
        }
        return $data;
    }

//// designation crud
    public function get_member_designation($id = 0) {
        if ($id == 0) {
            return $this->db->where('is_active', 1)->get('member_designation')->result();
        } else {
            return $this->db->where(['id' => $id, 'is_active' => 1])->get('member_designation')->row();
        }
    }
    public function store_designation($d_data, $id = 0) {
        if ($id == 0) {
            if ($this->db->insert($this->_table_designation, $d_data)) {
                return true;
            }
        } else {
            if ($this->db->where('id', $id)->update($this->_table_designation, $d_data)) {
                return true;
            }
        }
    }

    public function count_total_row_of_designation() {
        return $this->db->where('is_active', 1)->get('member_designation')->num_rows();
    }

    public function delete_designation($id) {
        if ($this->db->where('id', $id)->delete($this->_table_designation)) {
            return true;
        }
    }

     public function get_last_sequence()
    {
       $query = $this->db->order_by('id','DESC')->limit(1)->get($this->table)->row()->member_id;
       $sequence = explode('-', $query);
       if(sizeof($sequence) > 2 ){
            return $sequence[3] + 1;
       }else{
        return 1001;
       }
    }
}
