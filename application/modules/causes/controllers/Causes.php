<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causes extends MY_Controller {

    public $customer_id = 0;
    public $quantity    = 1;

    public function __construct() {
        parent::__construct();
        $this->load->model('causes_model');
        $this->load->module('cart');
        $this->load->module('template');
    }

    public function index() {
        $this->data['title']                 = 'Our Causes | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module']           = 'causes';
        $this->data['view_file']             = 'manage';
        $this->data['all_causes_categories'] = $this->causes_model->get_causes_category();
        // $this->data['all_causes']            = $this->all_cause_in_category();
        $this->template->site_ui($this->data);

    }

    public function all_cause_in_category() {
        $html = '';
        foreach ($this->causes_model->get_causes_category() as $key => $category) {
            $html .= '<div class="col-sm-6 col-md-4 cause-item ' . $category->unique_name . '">';
            foreach ($this->causes_model->all_cause_by_category($category->id) as $key => $value) {
                $_causes = "'cause'";
                $html .= '<div class="images_row row m0" >';
                $html .= '<img src="' . FILE_UPLOAD_PATH . $value->images . '" alt="cause images">';
                $html .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#donation_modal" class="btn-primary" onclick="donate_to_cause(' . $value->id . ',' . $_causes . ')">donate now</a>';
                $html .= '</div>';
                $html .= ' <div class="cause_excepts row m0" style="margin-bottom:10px">';
                $html .= ' <h4 class="cuase_title"><a href="' . base_url('causes/view/' . $value->slug . '.html') . '">' . $value->title . '</a></h4>';
                $html .= ' <p style="text-align:justify;">' . $value->short_description . '</p>';
                $html .= '<div class="row fund_progress m0">';
                $html .= '<div class="progress">';
                $html .= '<div class="progress-bar" role="progressbar" aria-valuenow="' . $value->current_fund . '" aria-valuemin="0" aria-valuemax="' . $value->goal_fund . '">';
                $html .= '<div class="percentage"><span class="counter">' . $this->calculate($value->goal_fund, $value->current_fund) . '</span>%</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="row fund_raises m0">';
                $html .= '<div class="pull-left raised amount_box">';
                $html .= '<h6>raised</h6>';
                $html .= '<h3>$' . $value->current_fund . '</h3>';
                $html .= '</div>';
                $html .= '<div class="pull-left goal amount_box">';
                $html .= ' <h6>goal</h6>';
                $html .= '<h3>$' . $value->goal_fund . '</h3>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        return $html;
    }

    public function calculate($goal_fund, $current_fund) {
        $percentage      = $goal_fund / 100;
        $current_percent = $current_fund / $percentage;
        return $current_percent;
    }
    public function view($slug) {
        $this->data['causes'] = $this->causes_model->get_causes_by_slug($slug);
        if (!empty($this->data['causes'])) {
            $this->data['related_causes'] = $this->causes_model->get_causes_by_limit($this->data['causes']->category);
            $this->data['category']       = $this->causes_model->get_causes_category();
            $this->data['page_title']     = $this->data['causes']->slug;
            $this->data['title']          = $this->data['causes']->title;
            $this->data['view_module']    = 'causes';
            $this->data['view_file']      = 'view';
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }
    public function category($category) {
        $this->data['causes'] = $this->causes_model->all_cause_by_category($category);
        if ($this->data['causes'] != '') {
            $this->data['view_module'] = 'causes';
            $this->data['view_file']   = 'cause_in_category';
            $this->data['title']       = 'Cause by Category | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->template->site_ui($this->data);
        } else {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        }
    }

    public function get_causes_category() {
        $category = $this->causes_model->get_causes_category();
        if (isset($category)) {
            response($category);
        }
    }

    public function donate() {
        $amount               = $this->input->post('donate_amount', TRUE);
        $cause_id             = $this->input->post('cause_id', TRUE);
        $type                 = $this->input->post('cause_type', TRUE);
        $donate_custom_amount = $this->input->post('donate_custom_amount', TRUE);
        // dump($amount);
        if (empty($amount) && empty($donate_custom_amount)) {
            response('please select an amount or write an amount', 600);

        } elseif (isset($donate_custom_amount) && $donate_custom_amount != '') {
            $donation_amount = $donate_custom_amount;
        } else if (isset($amount)) {
            $donation_amount = $amount;
        }

        $quantity = $this->input->post('quantity');
        if (isset($quantity) && $quantity != '') {
            $this->quantity = $quantity;
        }
        if ($previous = $this->cart_model->product_already_added_to_cart($cause_id, get_cookie('order_id'), $type)) {
            $qty  = ($previous->product_quantity + $this->quantity);
            $data = array(
                'product_quantity' => $qty,
                'product_price'    => $previous->product_price + $donation_amount,
                'discount'         => 0,
                'discount'         => 0,
                'subtotal'         => (($previous->product_price + $donation_amount) * $qty),
            );
            if ($this->cart_model->update_cart($data, $cause_id, get_cookie('order_id'), $type) == true) {
                response('donation added to your cart', 200);
            }
        }
        $cause = $this->causes_model->get_causes_by_id($cause_id);

        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }

        $data = array(
            'order_id'         => get_cookie('order_id'),
            'customer_id'      => $this->customer_id,
            'product_id'       => $cause->id,
            'product_quantity' => $this->quantity,
            'product_price'    => $donation_amount,
            'product_name'     => $cause->title,
            'picture'          => $cause->images,
            'tax'              => 0,
            'discount'         => 0,
            'subtotal'         => ($donation_amount * $this->quantity),
            'type'             => $type,
        );

        if ($this->cart_model->insert_cart($data) == true) {
            response('donation added to your cart', 200);
        } else {
            response('Failed added to your cart', 404);
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
