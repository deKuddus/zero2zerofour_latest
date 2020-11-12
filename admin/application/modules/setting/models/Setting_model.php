<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model {

    protected $_table_slider      = 'slider';
    protected $_table_logo        = 'logo';
    protected $_table_config      = 'config';
    protected $_table_discount_on = 'discount_on';
    protected $_primary_key       = 'id';
    protected $_primary_filter    = 'intval';
    protected $_order_by          = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function slider_show() {
        $column = array('id', 'title', 'description', 'url');
        $query  = "SELECT * FROM " . $this->_table_slider;
        if (isset($_POST['search']['value'])) {
            $query .= '
               WHERE id LIKE "%' . $_POST['search']['value'] . '%"
               OR title LIKE "%' . $_POST['search']['value'] . '%"
               OR description LIKE "%' . $_POST['search']['value'] . '%"
               OR url LIKE "%' . $_POST['search']['value'] . '%"
               ';
        }

        if (isset($_POST['order'])) {
            $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }
    public function count_total_row_of_slider() {
        return $this->db->get($this->_table_slider)->num_rows();
    }

    public function slider_add($slider_data) {
        if ($this->db->insert($this->_table_slider, $slider_data)) {
            return true;
        }
    }

    public function slider_update($slider_data, $slider_id) {
        if ($this->db->where('id', $slider_id)->update($this->_table_slider, $slider_data)) {
            return true;
        }
    }

    public function get_slider($slider_id = '') {
        if ($slider_id) {
            return $this->db->where('id', $slider_id)->get($this->_table_slider)->row();
        } else {
            return $this->db->get($this->_table_slider)->result();
        }
    }

    public function unlink_slider_image($slider_id) {
        if (!is_array($slider_id)) {
            $slider = $this->get_slider($slider_id);
            if ($slider->image) {
                @unlink('../uploads/' . $slider->image);
            }
            return true;
        } else {
            $slider_id = implode(',', $slider_id);
            $where     = "id IN ($slider_id)";
            $query     = $this->db->where($where)->get($this->_table_slider)->result();
            foreach ($query as $key => $value) {
                if ($value->image) {
                    @unlink('../uploads/' . $value->image);
                }
            }
            return true;
        }
    }

    public function slider_delete($slider_id) {
        if (!is_array($slider_id)) {
            if ($this->db->delete($this->_table_slider, ['id' => $slider_id])) {
                return true;
            }
        } else {
            $slider_id = implode(',', $slider_id);
            $where     = "id IN ($slider_id)";
            if ($this->db->where($where)->delete($this->_table_slider)) {
                return true;
            }
        }
    }

    public function logo_add($logo_data) {
        if ($this->db->insert($this->_table_config, $logo_data)) {
            return true;
        }
    }

    public function logo_show() {
        $column = array('id', 'title', 'value');
        $query  = "SELECT * FROM " . $this->_table_config . " WHERE config_key = 'site_logo'";
        if (isset($_POST['search']['value'])) {
            $query .= '
               AND ( id LIKE "%' . $_POST['search']['value'] . '%"
               OR title LIKE "%' . $_POST['search']['value'] . '%"
               OR value LIKE "%' . $_POST['search']['value'] . '%"
               )';
        }

        if (isset($_POST['order'])) {
            $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }

    public function count_total_row_of_logo() {
        return $this->db->where(['config_key' => 'site_logo'])->get($this->_table_config)->num_rows();
    }

    public function unlink_logo_image($logo_id) {
        if (!is_array($logo_id)) {
            $query = $this->db->where(['config_key' => 'site_logo', 'id' => $logo_id])->get($this->_table_config)->row();
            if ($query->value) {
                @unlink('../uploads/' . $query->value);
            }
            return true;
        } else {
            $logo_id = implode(',', $logo_id);
            $where   = "config_key = 'site_logo' AND id IN ($logo_id)";
            $query   = $this->db->where($where)->get($this->_table_config)->result();
            foreach ($query as $key => $logo) {
                if ($logo->value) {
                    @unlink('../uploads/' . $logo->value);
                }
            }
            return true;
        }
    }

    public function logo_delete($logo_id) {
        if (!is_array($logo_id)) {
            if ($this->db->delete($this->_table_config, ['config_key' => 'site_logo', 'id' => $logo_id])) {
                return true;
            }
        } else {
            $logo_id = implode(',', $logo_id);
            $where   = "config_key = 'site_logo' AND id IN ($logo_id)";
            if ($this->db->where($where)->delete($this->_table_config)) {
                return true;
            }
        }
    }

    public function change_logo_status($logo_id, $status) {
        if ($this->db->where(['id' => $logo_id, 'config_key' => 'site_logo'])->update($this->_table_config, ['status' => $status])) {
            return true;
        }
    }
    //=================================
    public function discount_on_add($name) {
        if ($this->db->insert($this->_table_discount_on, ['name' => $name])) {
            return true;
        }
    }

    public function discount_on_show() {
        $column = array('id', 'name');
        $query  = "SELECT * FROM " . $this->_table_discount_on;
        if (isset($_POST['search']['value'])) {
            $query .= ' WHERE id LIKE "%' . $_POST['search']['value'] . '%"
                         OR name LIKE "%' . $_POST['search']['value'] . '%" ';
        }

        if (isset($_POST['order'])) {
            $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }
        $query1 = '';
        if ($_POST['length'] != -1) {
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        return $this->db->query($query . $query1)->result();
    }

    public function count_total_row_of_discount_on() {
        return $this->db->get($this->_table_discount_on)->num_rows();
    }

    //////////////////////////////////////////
    ///about us
    ///
    public function about_us_show() {
        return $this->db->get('about_us')->result();
    }

    public function count_total_row_of_about_us() {
        return $this->db->get('about_us')->num_rows();
    }

    public function about_us_add($data) {
        if ($this->db->insert('about_us', $data)) {
            return true;
        }
    }

    public function about_us_delete($id) {
        if ($this->db->where('id', $id)->delete('about_us')) {
            return true;
        }
    }

    public function about_us_update($id, $data) {
        if ($this->db->where('id', $id)->update('about_us', $data)) {
            return true;
        }
    }

    public function about_us_get_by_id($id) {
        return $this->db->where('id', $id)->get('about_us')->row();
    }

    public function change_about_us_status($id) {
        $about = $this->about_us_get_by_id($id);
        if ($about->is_active == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($this->db->where('id', $id)->update('about_us', ['is_active' => $status])) {
            $this->db->where('id !=', $id)->update('about_us', ['is_active' => 0]);
            return true;
        }
    }

    //////////////////////////////////////////
    ///history
    public function history_show() {
        return $this->db->get('history')->result();
    }

    public function count_total_row_of_history() {
        return $this->db->get('history')->num_rows();
    }

    public function history_add($data) {
        if ($this->db->insert('history', $data)) {
            return true;
        }
    }

    public function history_delete($id) {
        if ($this->db->where('id', $id)->delete('history')) {
            return true;
        }
    }

    public function history_update($id, $data) {
        if ($this->db->where('id', $id)->update('history', $data)) {
            return true;
        }
    }

    public function history_get_by_id($id) {
        return $this->db->where('id', $id)->get('history')->row();
    }

    public function change_history_status($id) {
        $history = $this->history_get_by_id($id);
        if ($history->is_active == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($this->db->where('id', $id)->update('history', ['is_active' => $status])) {
            return true;
        }
    }

    ///mission vision section
    public function mission_update($data, $id) {
        if ($this->db->where('id', $id)->update('mission_vision', $data)) {
            return true;
        }
    }
    public function get_mission() {
        return $this->db->get('mission_vision')->row();
    }

    //////////config fetch
    public function get_config() {
        return $this->db->where('config_key !=', 'site_logo')->get($this->_table_config)->result();
    }

    public function update_config($config_key, $config_value) {
        if ($this->db->where('config_key', $config_key)->update($this->_table_config, ['value' => $config_value])) {
            return true;
        }
    }
}