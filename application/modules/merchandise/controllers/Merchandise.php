<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchandise extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('merchandise_model');
        $this->load->module('template');
    }

    public function index() {
        if (is_loggedin() == FALSE) {
            redirect('member/login');
        }
        $limit_per_page = $this->config->item('product_per_page');
        $start_index    = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records  = $this->merchandise_model->count_products();
        if ($total_records > 0) {
            $this->data['results'] = $this->merchandise_model->get_current_page_records($limit_per_page, $start_index);
            $config                = $this->pagination_config($total_records, $limit_per_page);

            $this->pagination->initialize($config);
            $this->data['start']        = $start_index;
            $this->data['limit']        = $limit_per_page;
            $this->data['total']        = $total_records;
            $this->data['title']        = 'Products | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->data['view_module']  = 'merchandise';
            $this->data['view_file']    = 'manage';
            $this->data['all_category'] = $this->merchandise_model->all_category();
            $this->data['links']        = $this->pagination->create_links();
            $this->template->site_ui($this->data);

        }
    }

    public function pagination_config($total_records, $limit_per_page) {

        $config['base_url']        = base_url() . 'merchandise/index';
        $config['total_rows']      = $total_records;
        $config['per_page']        = $limit_per_page;
        $config["uri_segment"]     = 3;
        $config['full_tag_open']   = '<ul class="gallery-pagination list-unstyled">';
        $config['full_tag_close']  = '</ul>';
        $config['num_tag_open']    = '<li class="page-no last-no">';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = '<li class="page-no first-no active"><a href="javascript:void(0)">';
        $config['cur_tag_close']   = '</a></li>';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['prev_link']       = 'Previous Page';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = 'Next Page</i>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        return $config;
    }

    public function product($slug) {
        if (is_loggedin() == FALSE) {
            redirect('member/login');
        }
        $this->data['product'] = $this->merchandise_model->product_by_slug($slug);
        if (!empty($this->data['product'])) {
            $this->data['related_product'] = $this->merchandise_model->related_product($this->data['product']->category_id);
            $this->data['all_category']    = $this->merchandise_model->all_category();
            $this->data['title']           = $this->data['product']->name . ' | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->data['view_module']     = 'merchandise';
            $this->data['view_file']       = 'product';
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }

///review code
    public function save_review() {
        $review_data = [
            'product_id' => $this->input->post('product_id'),
            'member_id'  => $this->input->post('member_id'),
            'review'     => $this->input->post('review'),
            'rating'     => $this->input->post('rating'),
        ];
        if ($this->merchandise_model->save_review($review_data) == true) {
            response('review added, will be approved by admin', 200);
        }
    }

    public function get_review() {
        $product_id = $this->input->post('product_id');
        $reviews    = $this->merchandise_model->get_product_review_by_id($product_id);
        // var_dump($product_id);exit();
        $html = '';
        foreach ($reviews as $key => $value) {
            $html .= '<div class="media comment">' . "\n";
            $html .= '<div class="media-left">' . "\n";
            $html .= '<a href="#">';
            $html .= '<img src="' . base_url('public/assets/') . 'images/post2/comment1.jpg" alt="">';
            $html .= '</a>' . "\n";
            $html .= '</div>' . "\n";
            $html .= '<div class="media-body">' . "\n";
            $html .= '<h4>';
            $html .= ' <a href="#">' . $this->merchandise_model->member_name($value->member_id) . '</a> <small>' . $this->timeAgo($value->created_at) . '</small>';
            $html .= '</h4>' . "\n";
            $html .= '<h6>' . "\n";
            $html .= '<a href="#">' . date_format(date_create($value->created_at), 'd-M-Y') . '</a>';
            $html .= '</h6>' . "\n";
            $html .= '<p>' . $value->review . '</p>' . "\n";
            $html .= '</div>' . "\n";
            $html .= '</div>' . "\n";
        }
        echo $html;
    }

    public function timeAgo($timestamp) {
        $datetime1 = new DateTime("now");
        $datetime2 = date_create($timestamp);
        $diff      = date_diff($datetime1, $datetime2);
        $timemsg   = '';
        if ($diff->y > 0) {
            $timemsg = $diff->y . ' year' . ($diff->y > 1 ? "'s" : '');

        } else if ($diff->m > 0) {
            $timemsg = $diff->m . ' month' . ($diff->m > 1 ? "'s" : '');
        } else if ($diff->d > 0) {
            $timemsg = $diff->d . ' day' . ($diff->d > 1 ? "'s" : '');
        } else if ($diff->h > 0) {
            $timemsg = $diff->h . ' hour' . ($diff->h > 1 ? "'s" : '');
        } else if ($diff->i > 0) {
            $timemsg = $diff->i . ' minute' . ($diff->i > 1 ? "'s" : '');
        } else if ($diff->s > 0) {
            $timemsg = $diff->s . ' second' . ($diff->s > 1 ? "'s" : '');
        }

        $timemsg = $timemsg . ' ago';
        return $timemsg;
    }
}
