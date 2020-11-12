<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends MY_Model {
    protected $_blog                = 'blogs';
    protected $_blog_comments       = 'blog_comments';
    protected $_table_customer      = 'customers';
    protected $_table_blog_tags     = 'blog_tags';
    protected $_table_blog_category = 'blog_category';

    public function get_all_news($conditon = 5) {
        if ($conditon == '') {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->get($this->_blog)->result();
        } else {
            return $this->db->where('is_active', 1)->order_by('id', 'desc')->limit($conditon)->get($this->_blog)->result();
        }
    }

    public function get_news_by_slug($slug) {
        if ($this->count_news_view($slug) == true) {
            return $this->db->where(['is_active' => 1, 'slug' => $slug])->get($this->_blog)->row();
        }
    }

    public function get_news_by_limit($category = '') {
        return $this->db->where(['category' => $category, 'is_active' => 1])->limit(20)->get($this->_blog)->result();
    }

    public function count_news_view($slug) {
        $data = $this->db->where(['is_active' => 1, 'slug' => $slug])->get($this->_blog)->row();
        if ($data) {
            $count = $data->counter + 1;
            $this->db->where(['slug' => $slug])->update($this->_blog, ['counter' => $count]);
            return true;
        } else {
            return false;
        }
    }

    public function popular_news_by_limit() {
        return $this->db->where(['is_active' => 1])->order_by('counter', 'desc')->limit(1)->get($this->_blog)->result();
    }

    public function save_comment($comment_data) {
        $id = $this->db->insert($this->_blog_comments, $comment_data);
        if ($id) {
            return true;
        }
    }

    public function get_news_comment_by_news_id($news_id, $conditon = '') {
        if ($conditon == '') {
            return $this->db->where(['is_active' => 1, 'post_id' => $news_id, 'parent_id' => 0])->get($this->_blog_comments)->result();
        } else {
            return $this->db->where(['is_active' => 1, 'post_id' => $news_id])->get($this->_blog_comments)->result();
        }
    }

    public function get_comment_reply($comment_id, $news_id) {
        return $this->db->where(['is_active' => 1, 'post_id' => $news_id, 'parent_id' => $comment_id])->get($this->_blog_comments)->result();
    }

    public function get_customer_data() {
        $id = $this->session->userdata('id');
        return $this->db->where(['id' => $id])->get($this->_table_customer)->row();
    }
    public function get_tags() {
        return $this->db->where('is_active', 1)->order_by('id', 'RANDOM')->limit(9)->get($this->_table_blog_tags)->result();
    }

    public function get_news_category() {
        return $this->db->where('is_active', 1)->get($this->_table_blog_category)->result();
    }

    public function news_by_category($category_id) {
        return $this->db->where(['is_active' => 1, 'category' => $category_id])->get($this->_blog)->result();
    }
}