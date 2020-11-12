<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public $customer_id = 0;
    public $quantity    = 1;
    public $discount    = 0;
    public function __construct() {
        parent::__construct();
        $this->load->model('checkout_model');
        $this->load->module('template');
    }

    public function index() {
        $customer_id = $this->session->userdata('member_id');
        if (isset($customer_id) && !is_null($customer_id)) {
            $member = $this->checkout_model->get_member_by_id($customer_id);
        } else {
            $member                 = new StdClass;
            $member->name           = '';
            $member->email          = '';
            $member->street_address = '';
            $member->address_line   = '';
            $member->city           = '';
            $member->country        = '';
            $member->state          = '';
            $member->post_code      = '';
            $member->mobile         = '';
        }
        $this->data['form_data']   = $member;
        $this->data['title']       = 'My Checkout | Zero2zero4';
        $this->data['view_module'] = 'checkout';
        $this->data['view_file']   = 'manage';
        $this->data['cartdata']    = $this->cart_amount();
        $this->template->site_ui($this->data);
    }

    public function cart_amount() {
        if ($this->session->userdata('member_id') != NULL OR $this->session->userdata('customer_id') != '') {
            $this->customer_id = $this->session->userdata('member_id');
        }
        $cartdata = $this->checkout_model->count_cart($this->customer_id, get_cookie('order_id'));

        $subtotal = 0;
        $tax      = 0;
        $total    = 0;
        foreach ($cartdata as $key => $value) {
            $subtotal = $subtotal + $value->subtotal;
            $tax      = $tax + $value->tax;
        }
        $total = $subtotal + $tax;

        return $cartdata = ['subtotal' => $subtotal, 'tax' => $tax, 'total' => $total];
    }

    public function proced_to_checkout() {

        //var_dump($_POST['password']);exit();
        if (isset($_POST) && !empty($_POST)) {
            $amount = $this->total_amount();
            // $currency = $this->input->post('currency');
            // if($currency == "USD"){

            // }
            $fields = array(
                'store_id'      => $this->config->item('aamarpay_store_id'),
                'amount'        => $amount['subtotal'],
                'payment_type'  => 'VISA',
                'currency'      => 'BDT',
                'tran_id'       => $this->rand_string(10),
                'cus_name'      => $this->input->post('name'),
                'cus_email'     => $this->input->post('email'),
                'cus_add1'      => $this->input->post('street_address1'),
                'cus_add2'      => $this->input->post('street_address2'),
                'cus_city'      => $this->input->post('town_city'),
                'cus_state'     => $this->input->post('state'),
                'cus_postcode'  => $this->input->post('zip_code'),
                'cus_country'   => $this->input->post('country'),
                'cus_phone'     => $this->input->post('phone'),
                'cus_fax'       => 'Not-Applicable',
                'desc'          => $this->load->view('checkout/product_description', ['order_id' => get_cookie('order_id')], true),
                'success_url'   => base_url('checkout/success'),
                'fail_url'      => base_url('checkout/fail'),
                'cancel_url'    => base_url('checkout/cancel'),
                'opt_a'         => get_cookie('order_id'),
                'trx_id'        => uniqid() . time(),
                'amount_tax'    => $amount['tax'],
                'signature_key' => $this->config->item('aamarpay_signature_key'),
            );

            $new_array = array(
                'tran_id'             => $this->rand_string(10),
                'customer_name'       => $this->input->post('name'),
                'customer_email'      => $this->input->post('email'),
                'customer_address1'   => $this->input->post('street_address1'),
                'customer_address2  ' => $this->input->post('street_address2'),
                'customer_city'       => $this->input->post('town_city'),
                'customer_state'      => $this->input->post('state'),
                'customer_zipp_code'  => $this->input->post('zip_code'),
                'customer_country'    => $this->input->post('country'),
                'company_name'        => $this->input->post('company_name'),
                'customer_phone'      => $this->input->post('phone'),
            );
            $this->session->set_userdata('order_user_info', $new_array);
            $this->payment($fields);

        } else {
            $status = array('status' => 404, 'message' => 'Please Fill Up Your Billing Form');
            header("Content-type: application/json");
            echo json_encode($status);
            exit();
        }
    }

    public function success() {

        if ($_POST['pay_status'] == "Successful") {
            $merTxnId = $_POST['mer_txnid'];

        }
        $store_id      = $this->config->item('store_id');
        $signature_key = $this->config->item('signature_key');
        $curl_handle   = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "https://secure.aamarpay.com/api/v1/trxcheck/request.php?request_id=$merTxnId&store_id=$store_id&signature_key=$signature_key&type=json");

        curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $return_data = (array) json_decode($buffer);

        $card_type  = $return_data['card_type'];
        $amount     = $return_data['amount'];
        $pay_status = $return_data['pay_status'];

        $order_id = get_cookie('order_id');
        if ($this->process_and_save_order($card_type, $amount, $pay_status, $return_data)) {
            $this->checkout_model->destroy_cart($this->customer_id, get_cookie('order_id'));
            if (get_cookie('order_id') != NULL) {
                delete_cookie('order_id');
                set_cookie('order_id', uniqid(), time() + ((86400 * 365) * 30), 'localhost', '/');
            }
            redirect('home/message/' . $order_id);
        }

    }
    public function register_customer($data) {
        $register_data = [
            'name'            => $data['name'],
            'phone'           => $data['phone'],
            'email'           => $data['email'],
            'town_city'       => $data['town_city'],
            'state'           => $data['state'],
            'country'         => $data['country'],
            'zip_code'        => $data['zip_code'],
            'street_address1' => $data['street_address1'],
            'street_address2' => $data['street_address2'],
            'password'        => hashing_password($data['password']),
        ];

        if ($id = $this->checkout_model->register($register_data)) {
            return true;
        }
    }

    public function process_and_save_order($card_type = '', $amount = '', $pay_status = '', $return_data) {
        $customer_id = $this->session->userdata('member_id');
        if (isset($customer_id) && $customer_id != NULL) {
            $this->customer_id = $customer_id;
        }

        $trx_array = array(
            'order_id'     => $return_data['opt_a'] ?? '',
            'mer_txnid'    => $return_data['mer_txnid'] ?? '',
            'store_amount' => $return_data['store_amount'] ?? '',
            'pay_time'     => $return_data['pay_time'] ?? '',
            'bank_txn'     => $return_data['bank_txn'] ?? '',
            'card_number'  => $return_data['card_number'] ?? '',
            'card_holder'  => $return_data['card_holder'] ?? '',
            'card_type'    => $return_data['card_type'] ?? '',
        );

        $quantity = 0;
        $subtotal = 0;
        $tax      = 0;
        $order_id = '';
        $cartData = $this->checkout_model->count_cart($this->customer_id, get_cookie('order_id'));
        foreach ($cartData as $key => $value) {
            $subtotal = $subtotal + $value->subtotal;
            $tax      = $tax + $value->tax;
            $quantity = $quantity + $value->product_quantity;
            $order_id = $value->order_id;
        }

        $order_array                   = $this->session->userdata('order_user_info');
        $order_array['order_id']       = $order_id;
        $order_array['customer_id']    = $this->customer_id;
        $order_array['price']          = ($subtotal + $tax);
        $order_array['quantity']       = $quantity;
        $order_array['order_notes']    = $this->input->post('message');
        $order_array['tax']            = $tax;
        $order_array['payment_method'] = $card_type;
        $order_array['paid_amount']    = $amount;
        $order_array['payment_status'] = $pay_status;

        if ($this->checkout_model->save_order($order_array) == true) {
            foreach ($cartData as $key => $value) {
                $data = [
                    'order_id'               => $value->order_id,
                    'product_name'           => $value->product_name,
                    'product_id'             => $value->product_id,
                    'product_total_quantity' => $value->product_quantity,
                    'product_price'          => $value->product_price,
                    'product_tax'            => $value->tax,
                    'product_discount'       => $value->discount,
                    'coupon'                 => ($value->coupon) ? $value->coupon : '',
                    'coupon_amount'          => ($value->coupon_amount) ? $value->coupon_amount : 0,
                    'type'                   => $value->type,
                ];
                $this->checkout_model->save_order_list($data);

                $trx_array['product_name']           = $value->product_name;
                $trx_array['product_total_quantity'] = $value->product_total_quantity;
                $trx_array['product_price']          = $value->product_price;
                switch ($value->type) {
                case 'product':
                    $table = 'product_transaction';
                    break;
                case 'cause':
                    $table = 'cause_transaction';
                    break;
                case 'event':
                    $table = 'event_transaction';
                    break;
                case 'membership':
                    $table = 'membership_transaction';
                    break;
                case 'previlege':
                    $table = 'previlegecard_transaction';
                    break;
                case 'project':
                    $table = 'project_transaction';
                    break;

                default:
                    $table = '';
                    break;
                }
                $this->checkout_model->save_transaction($trx_array, $table);
            }

        }
        return $order_id;
    }

    public function total_amount() {
        $cartData = $this->checkout_model->count_cart($this->customer_id, get_cookie('order_id'));
        $subtotal = 0;
        $tax      = 0;
        foreach ($cartData as $key => $value) {
            $subtotal = $subtotal + $value->subtotal;
            $tax      = $tax + $value->tax;
        }
        return ['subtotal' => $subtotal, 'tax' => $tax];
    }
    public function payment($fields) {
        $this->data['title']       = 'My Checkout | Zero2zero4';
        $this->data['view_module'] = 'checkout';
        $this->data['view_file']   = 'payment';
        $this->data['fields']      = $fields;
        $this->template->site_ui($this->data);
    }

    public function fail() {
        $this->data['title']       = 'My Checkout | Zero2zero4';
        $this->data['view_module'] = 'checkout';
        $this->data['view_file']   = 'fail';
        $this->data['cartdata']    = $this->cart_amount();
        $this->template->site_ui($this->data);
    }

    public function cancel() {
        $this->data['title']       = 'Cancel Checkout | Zero2zero4';
        $this->data['view_module'] = 'checkout';
        $this->data['view_file']   = 'cancel';
        $this->template->site_ui($this->data);
    }

    public function rand_string($length) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size  = strlen($chars);
        $str   = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }
}
