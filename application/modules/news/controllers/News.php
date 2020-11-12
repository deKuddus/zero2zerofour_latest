<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']       = 'Our News | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'news';
        $this->data['view_file']   = 'manage';
        $this->data['all_news']    = $this->news_model->get_all_news();
        $this->template->site_ui($this->data);

    }

    public function view($slug) {
        $this->data['news'] = $this->news_model->get_news_by_slug(xss_clean($slug));
        if (!empty($this->data['news'])) {
            $this->data['related_news']  = $this->news_model->get_news_by_limit($this->data['news']->category);
            $this->data['comments']      = $this->news_model->get_news_comment_by_news_id($this->data['news']->id, 'all');
            $this->data['customer_data'] = $this->news_model->get_customer_data();
            $this->data['all_tags']      = $this->news_model->get_tags();
            $this->data['latest_news']   = $this->news_model->get_all_news('latest_news');
            $this->data['page_title']    = $this->data['news']->slug;
            $this->data['view_module']   = 'news';
            $this->data['view_file']     = 'view';
            $this->data['title']         = $this->data['news']->title . ' | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }

    public function save_comment() {
        $comment_data = [
            'post_id'   => $this->input->post('post_id'),
            'name'      => $this->input->post('name'),
            'email'     => $this->input->post('email'),
            'website'   => $this->input->post('website'),
            'message'   => $this->input->post('message'),
            'parent_id' => $this->input->post('comment_id'),
        ];
        if ($this->news_model->save_comment($comment_data) == true) {
            response('comment submitted', 200);
        }

    }

    public function get_news_tags() {
        $tags = $this->news_model->get_tags();
        if (sizeof($tags) > 0) {
            echo json_encode($tags);
        } else {
            echo json_encode('null');
        }
    }

    public function get_popular_post() {
        $posts = $this->news_model->popular_news_by_limit();
        if (sizeof($posts) > 0) {
            echo json_encode($posts);
        } else {
            echo json_encode('null');
        }
    }

    public function get_news_category() {
        $posts = $this->news_model->get_news_category();
        if (sizeof($posts) > 0) {
            echo json_encode($posts);
        } else {
            echo json_encode('null');
        }
    }

    public function news_in_cat($category_id) {
        $this->data['newss']       = $this->news_model->bolg_by_category($category_id);
        $this->data['view_module'] = 'news';
        $this->data['view_file']   = 'news_in_category';
        $this->data['page_title']  = 'Blog in category | shilpaolic.com';
        $this->template->_shop_ui($this->data);
    }

    public function get_comment() {
        $news_id  = $this->input->post('news_id');
        $comments = $this->news_model->get_news_comment_by_news_id($news_id);
        $html     = '';
        foreach ($comments as $key => $value) {
            $html .= '<div class="media comment">';
            $html .= '<div class="media-left">';
            $html .= '<a href="#">';
            $html .= '<img src="' . base_url('public/assets/') . 'images/post2/comment1.jpg" alt="">';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="media-body">';
            $html .= '<h4>';
            $html .= ' <a href="#">' . $value->name . '</a> <small>' . $this->timeAgo($value->created_at) . '</small>';
            $html .= '</h4>';
            $html .= '<h6>';
            $html .= '<a href="#">' . date_format(date_create($value->created_at), 'd-M-Y') . '</a>';
            $html .= '</h6>';
            $html .= '<p>' . $value->message . '</p>';

            $html .= '<a href="javascript:void(0)" class="btn-primary btn-outline dark btn-sm" onclick="give_reply(this)" id="' . $value->id . '">reply</a>';
            $html .= $this->get_comment_reply($value->id, $news_id);
            $html .= '</div>';

        }
        $html .= '</div>';

        echo $html;
    }

    public function get_comment_reply($comment_id, $news_id, $margin = 0, $prevous_value = 0) {
        $replies = $this->news_model->get_comment_reply($comment_id, $news_id);
        if ($replies) {
            $html   = '';
            $keys   = 0;
            $margin = $margin + $prevous_value;
            foreach ($replies as $key => $value) {
                $keys = ($keys + $key + $margin);
                $html .= '<div class="media comment reply" style="margin-left:' . $margin . 'px">';
                $html .= '<div class="media-left">';
                $html .= '<a href="#">';
                $html .= '<img src="' . base_url('public/assets/') . 'images/post2/comment1.jpg" alt="">';
                $html .= '</a>';
                $html .= '</div>';
                $html .= '<div class="media-body">';
                $html .= '<h4>';
                $html .= ' <a href="#">' . $value->name . '</a> <small>' . $this->timeAgo($value->created_at) . '</small>';
                $html .= '</h4>';
                $html .= '<h6>';
                $html .= '<a href="#">' . date_format(date_create($value->created_at), 'd-M-Y') . '</a>';
                $html .= ' </h6>';

                $html .= '<p>' . $value->message . '</p>';
                $html .= '<a href="javascript:void(0)" class="btn-primary btn-outline dark btn-sm" onclick="give_reply(this)" id="' . $value->id . '">reply</a>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= $this->get_comment_reply($value->id, $news_id, ($keys + 10), $keys);
            }

            return $html;
        }
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
