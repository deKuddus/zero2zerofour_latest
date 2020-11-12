<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    public $customer_id = 0;
    public $quantity    = 1;
    public $discount    = 0;

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->module('events');
        $this->load->module('template');
    }

    public function index() {
        $this->data['view_module'] = 'cart';
        $this->data['title']       = 'My Cart | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_file']   = 'manage';
        $this->template->site_ui($this->data);
    }

    public function add_to_cart() {
        $product_id = $this->input->post('product_id', TRUE);
        $quantity   = $this->input->post('quantity', TRUE);
        $type       = $this->input->post('type', TRUE);
        if ($type == 'product') {
            $this->add_product_to_cart($product_id, $quantity, $type);
        } else if ($type == 'event') {
            $this->add_event_to_cart($product_id, $quantity, $type);
        } else if ($type == 'membership') {
            $this->add_membership_to_cart($product_id, $quantity, $type);
        } else if ($type == 'previlege') {
            $this->add_membership_previlize_to_cart($product_id, $quantity, $type);
        } else {
            response('woops! something went wrong. please try again.');
        }

    }

    public function add_product_to_cart($product_id, $quantity, $type) {
        if (isset($quantity) && $quantity != '') {
            $this->quantity = $quantity;
        }
        if ($previous = $this->cart_model->product_already_added_to_cart($product_id, get_cookie('order_id'), $type)) {
            $qty  = ($previous->product_quantity + $this->quantity);
            $data = array(
                'product_quantity' => $qty,
                'discount'         => ($previous->discount * $qty),
                'subtotal'         => (($previous->product_price * $qty) - ($previous->discount * $qty)),
            );
            if ($this->cart_model->update_cart($data, $product_id, get_cookie('order_id')) == true) {
                response('product added to your cart', 200);
            }
        }
        $product = $this->cart_model->get_product_by_id($product_id);
        global $price;
        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }
        if ($product->discount != 0 OR $product->discount > 0) {
            $this->discount = $product->discount;
        }
        $data = array(
            'order_id'         => get_cookie('order_id'),
            'customer_id'      => $this->customer_id,
            'product_id'       => $product->id,
            'product_quantity' => $this->quantity,
            'product_price'    => $product->sale_price,
            'product_name'     => $product->name,
            'picture'          => $product->feature_picture,
            'tax'              => ($product->sale_price * ($product->tax / 100)),
            'discount'         => $this->discount,
            'type'             => $type,
            'subtotal'         => (($product->sale_price * $this->quantity) - ($this->discount * $this->quantity)),
        );

        if ($this->cart_model->insert_cart($data) == true) {
            response('product added to your cart', 200);
        } else {
            response('Failed added to your cart', 404);
        }
    }

    public function add_event_to_cart($product_id, $quantity, $type) {
        if (isset($quantity) && $quantity != '') {
            $this->quantity = $quantity;
        }
        if ($previous = $this->cart_model->product_already_added_to_cart($product_id, get_cookie('order_id'), $type)) {
            $qty  = ($previous->product_quantity + $this->quantity);
            $data = array(
                'product_quantity' => $qty,
                'subtotal'         => ($previous->product_price * $qty),
            );
            if ($this->cart_model->update_cart($data, $product_id, get_cookie('order_id'), $type) == true) {
                response('event added to your cart', 200);
            }
        }
        $event = $this->events_model->get_by_id($product_id);
        global $price;

        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }

        $data = array(
            'order_id'         => get_cookie('order_id'),
            'customer_id'      => $this->customer_id,
            'product_id'       => $event->id,
            'product_quantity' => $this->quantity,
            'product_price'    => $event->ticket_price,
            'product_name'     => $event->title,
            'picture'          => $event->picture,
            'tax'              => 0,
            'discount'         => $this->discount,
            'type'             => $type,
            'subtotal'         => $event->ticket_price,
        );

        if ($this->cart_model->insert_cart($data) == true) {
            response('event added to your cart', 200);
        } else {
            response('Failed added to your cart', 404);
        }
    }

    public function add_membership_to_cart($product_id, $quantity, $type) {
        if (isset($quantity) && $quantity != '') {
            $this->quantity = $quantity;
        }
        if ($previous = $this->cart_model->product_already_added_to_cart($product_id, get_cookie('order_id'), $type)) {
            response('already added to your cart', 200);
        }
        $membership = $this->cart_model->get_membership($product_id);
        global $price;

        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }

        $data = array(
            'order_id'         => get_cookie('order_id'),
            'customer_id'      => $this->customer_id,
            'product_id'       => $membership->id,
            'product_quantity' => $this->quantity,
            'product_price'    => $membership->price,
            'product_name'     => $membership->member_ship_type,
            'picture'          => 'member/premium-membership.jpg',
            'tax'              => 0,
            'discount'         => $this->discount,
            'type'             => $type,
            'subtotal'         => $membership->price,
        );

        if ($this->cart_model->insert_cart($data) == true) {
            response('membership added to your cart', 200);
        } else {
            response('Failed added to your cart', 404);
        }
    }

    public function add_membership_previlize_to_cart($product_id, $quantity, $type) {
        if (isset($quantity) && $quantity != '') {
            $this->quantity = $quantity;
        }
        if ($previous = $this->cart_model->product_already_added_to_cart($product_id, get_cookie('order_id'), $type)) {
            response('already added to your cart', 200);
        }
        $membership = $this->cart_model->get_membership($product_id);
        global $price;

        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }

        $data = array(
            'order_id'         => get_cookie('order_id'),
            'customer_id'      => $this->customer_id,
            'product_id'       => $membership->id,
            'product_quantity' => $this->quantity,
            'product_price'    => $membership->price,
            'product_name'     => $membership->member_ship_type,
            'picture'          => 'member/privilege-card.jpg',
            'tax'              => 0,
            'discount'         => $this->discount,
            'type'             => $type,
            'subtotal'         => $membership->price,
        );

        if ($this->cart_model->insert_cart($data) == true) {
            response('privilege request added to your cart', 200);
        } else {
            response('Failed added to your cart', 404);
        }
    }

    public function count_cart() {
        if ($this->session->userdata('customer_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('customer_id');
        }
        $size = $this->cart_model->count_cart($this->customer_id, get_cookie('order_id'));
        if ($size > 0) {
            echo $size;
        } else {
            echo 0;
        }
    }

    public function contents() {
        $cart = $this->cart_model->count_cart($this->customer_id, get_cookie('order_id'), true);
        if (!empty($cart)) {
            header("Content-type: application/json");
            echo json_encode(['cart' => $cart, 'coupon' => '']);
            exit();
        } else {
            header("Content-type: application/json");
            echo json_encode(['cart' => 'null', 'coupon' => '']);
            exit();
        }
    }

    public function single_remove() {
        $cart_id = $this->input->post('cart_id', TRUE);
        if (isset($cart_id)) {
            if ($this->cart_model->single_remove($cart_id) == true) {
                response('Product remove from your cart', 200);
            }
        }
    }

    public function update_whole_cart() {
        $cart = $this->cart_model->count_cart($this->customer_id, get_cookie('order_id'), true);
        $size = sizeof($_POST['cart_id']);
        for ($i = 0; $i < $size; $i++) {
            $cart      = $this->cart_model->get_cart_content_by_id($_POST['cart_id'][$i]);
            $cart_data = [
                'product_quantity' => $_POST['cart_quantity'][$i],
                'subtotal'         => $_POST['cart_quantity'][$i] * $cart->product_price,
            ];
            $this->cart_model->update_whole_cart($cart_data, $_POST['cart_id'][$i]);
        }

        redirect('cart');
    }

}
