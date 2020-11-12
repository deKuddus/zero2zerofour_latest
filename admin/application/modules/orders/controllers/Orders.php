<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
        $this->load->model('orders_model');
        $this->load->module('template');

    }

    public function index() {
        $this->data['table_page']  = TRUE;
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'index';
        $this->data['title']       = 'New Orders | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function ajax_show() {
        global $category, $subcategory, $status;
        $data = array();
        foreach ($this->orders_model->show() as $o_key => $order) {
            $sub_array   = array();
            $order_id    = "'" . $order->order_id . "'";
            $sub_array[] = $o_key + 1;
            $sub_array[] = '<span><strong>Name</strong> :' . $order->customer_name . '</span><br><span><strong>Phone</strong> :' . $order->customer_phone . '</span><br><span><strong>Email</strong> :' . $order->customer_email . '</span><br>';
            $sub_array[] = '<a href="' . base_url('order/view/' . $order->order_id) . '">' . $order->order_id . '</a>';
            $sub_array[] = $order->price;
            $sub_array[] = $order->tran_id;
            $sub_array[] = $order->paid_amount;
            $sub_array[] = $order->payment_status;
            $sub_array[] = $order->quantity;
            $sub_array[] = $order->tax;
            $sub_array[] = 'Pending';
            $sub_array[] = '<div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                  <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                    <li><a class="dropdown-item" target="_blank" href="' . base_url('orders/prints/' . $order->order_id) . '">Print</a></li>
                    <li><a class="dropdown-item" onclick="confrm_order(' . $order_id . ')">Confirm</a></li>
                    <li><a class="dropdown-item" onclick="view_full_invoice(' . $order_id . ')">View</a></li>
                    <li><a class="dropdown-item" onclick="delete_orders(' . $order->id . ')">Delete</a></li>
                  </ul>
                </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->orders_model->count_total_row_of_orders(),
            'recordsFiltered' => $this->orders_model->count_total_row_of_orders(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function confirmed() {
        $this->data['table_page']  = TRUE;
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'confirm';
        $this->data['title']       = 'Confirmed Orders | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }
    public function all_confirmed_orders() {
        global $category, $subcategory, $status;
        $data = array();
        foreach ($this->orders_model->show(1) as $o_key => $order) {
            $sub_array   = array();
            $order_id    = "'" . $order->order_id . "'";
            $sub_array[] = $o_key + 1;
            $sub_array[] = '<span><strong>Name</strong> :' . $order->customer_name . '</span><br><span><strong>Phone</strong> :' . $order->customer_phone . '</span><br><span><strong>Email</strong> :' . $order->customer_email . '</span><br>';
            $sub_array[] = '<a href="' . base_url('order/view/' . $order->order_id) . '">' . $order->order_id . '</a>';
            $sub_array[] = $order->price;
            $sub_array[] = $order->tran_id;
            $sub_array[] = $order->paid_amount;
            $sub_array[] = $order->payment_status;
            $sub_array[] = $order->quantity;
            $sub_array[] = $order->tax;
            $sub_array[] = 'Pending';
            $sub_array[] = '<div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                  <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                    <li><a class="dropdown-item" target="_blank" href="' . base_url('orders/prints/' . $order->id) . '">Print</a></li>
                    <li><a class="dropdown-item" onclick="view_full_invoice(' . $order_id . ')">View</a></li>
                    <li><a class="dropdown-item" onclick="delete_orders(' . $order->id . ')">Delete</a></li>
                  </ul>
                </div>';
            $data[] = $sub_array;
        }
        $output = array(
            'draw'            => intval($_POST['draw']),
            'recordsTotal'    => $this->orders_model->count_total_row_of_confirm_orders(),
            'recordsFiltered' => $this->orders_model->count_total_row_of_confirm_orders(),
            'data'            => $data,
        );
        echo json_encode($output);
    }

    public function get_order_by_code() {
        $order_id = $this->input->post('order_id');
        echo json_encode($this->orders_model->get_order_by_code($order_id));
    }

    public function prints($order_id) {
        $this->data['order']       = $this->orders_model->get_order_by_code($order_id);
        $this->data['order_id']    = $order_id;
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'print';
        $this->data['title']       = 'Orders print | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function confirmed_order() {
        $order_id = $this->input->post('order_id');
        if ($this->orders_model->confirmed_order($order_id) == true) {
            $data['order']    = $this->orders_model->get_order_by_code($order_id);
            $data['order_id'] = $order_id;
            // $this->data['view_module'] = 'orders';
            // $this->data['view_file']   = 'mail2';
            // $this->data['title']       = 'Orders print | SSC 2002 & HSC 2004 Bangladesh Foundation';
            // $this->template->admin_ui($this->data);
            $mail = $data['order']['order']->customer_email;
            $html = $this->load->view('mail2', $data, true);
            $this->email->initialize(eamil_config(true));
            $this->email->from($this->config->item('company_email'), '0204bangladesh');
            $this->email->to($mail);
            $this->email->subject('Your Purchase Invoice');
            $this->email->message('Hello there, here is your purchase invoice from 0204bangladesh');
            $this->email->attach($this->pdf($html), 'attachment', 'invoice.pdf', 'application/pdf');

            $this->email->send();

            response('order confrimed', 200);
            // $this->pdf($html);
        }
    }

    public function pdf($html) {

        $dompdf = new Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Get the generated PDF file contents
        return $dompdf->output();

        // $dompdf->stream();

    }

    public function product_transaction() {
        $this->data['transaction'] = $this->orders_model->get_transaction('product_transaction');
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'transaction';
        $this->data['title']       = 'Product Transaction | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function cause_transaction() {
        $this->data['transaction'] = $this->orders_model->get_transaction('cause_transaction');
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'transaction';
        $this->data['title']       = 'Causes Transaction | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }

    public function event_transaction() {
        $this->data['transaction'] = $this->orders_model->get_transaction('event_transaction');
        $this->data['view_module'] = 'orders';
        $this->data['view_file']   = 'transaction';
        $this->data['title']       = 'Event Transaction | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->template->admin_ui($this->data);
    }
}
