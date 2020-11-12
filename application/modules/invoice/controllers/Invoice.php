<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('invoice_model');
        $this->load->module('template');

    }

    public function view($order_id) {
        $this->data['title']       = 'My Invoice | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'template';
        $this->data['view_file']   = 'invoice';
        $this->data['order_id']    = $order_id;
        $this->data['order']       = $this->invoice_model->get_order_by_code($order_id);
        $this->template->site_ui_invoice($this->data);
    }

}
