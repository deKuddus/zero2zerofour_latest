<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.dt-buttons{
  float: right;
}
</style>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Transaction</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>manage</strong>
        </li>
      </ol>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="transaction_list" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Item Name</th>
              <th>Item Price</th>
              <th>Item Quantity</th>
              <th>Merchant Trx Id</th>
              <th>Pay Time</th>
              <th>Bank Transaction</th>
              <th>Card Number</th>
              <th>Card Holder</th>
              <th>Card Type</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transaction as $key => $transaction) {?>
            <tr>
              <td><?php echo $transaction->order_id ?></td>
              <td><?php echo $transaction->item_name ?></td>
              <td><?php echo $transaction->item_total_quantity ?></td>
              <td><?php echo $transaction->item_price ?></td>
              <td><?php echo $transaction->mer_txnid ?></td>
              <td><?php echo $transaction->pay_time ?></td>
              <td><?php echo $transaction->bank_txn ?></td>
              <td><?php echo $transaction->card_number ?></td>
              <td><?php echo $transaction->card_holder ?></td>
              <td><?php echo $transaction->card_type ?></td>
            </tr>
          <?php }?>
          </tbody>
          <tfoot>
            <tr>
             <th>Order ID</th>
              <th>Item Name</th>
              <th>Item Price</th>
              <th>Item Quantity</th>
              <th>Merchant Trx Id</th>
              <th>Pay Time</th>
              <th>Bank Transaction</th>
              <th>Card Number</th>
              <th>Card Holder</th>
              <th>Card Type</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal inmodal fade" id="full_invoice" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content " style="width: 1228px;left: -26%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-8">
            <h2 class="text-left" >Invoice</h2>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('/dashboard') ?>">Home</a>
              </li>
              <li class="breadcrumb-item active">
                <strong>Invoice</strong>
              </li>
            </ol>
          </div>
          <div class="col-lg-4">
            <div class="title-action">
              <a href="" id="modal_pring_button" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Invoice </a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
              <div class="ibox-content p-xl">
                <div class="row">
                  <div class="col-sm-4">
                    <h5>From:</h5>
                    <address>
                      <strong id="from_name"></strong><br>
                      <span id="from_address"></span><br>
                      <abbr title="Phone">P:</abbr> <span id="from_phone"></span>
                    </address>
                  </div>
                  <div class="col-sm-4 text-center">
                    <h4>Invoice No.</h4>
                    <h4 class="text-navy" id="invoice_no"></h4>
                    <p>
                      <span ><strong>Invoice Date:</strong> <p id="sales_at"></p></span><br/>
                    </p>
                  </div>
                  <div class="col-sm-4 text-right">
                    <span>To:</span>
                    <address>
                      <strong id="to_name"></strong><br>
                      <span id="to_address"></span><br>
                      <abbr title="Phone">P:</abbr> <span id="to_phone"></span>
                    </address>

                  </div>
                </div>

                <div class="table-responsive m-t">
                  <table class="table invoice-table">
                    <thead>
                      <tr>
                        <th>Item List</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Tax</th>
                        <th>Total Price</th>
                      </tr>
                    </thead>
                    <tbody id="item_list">
                    </tbody>
                  </table>
                </div>

                <table class="table invoice-total">
                  <tbody>
                    <tr>
                      <td><strong>Sub Total :</strong></td>
                      <td id="sub_total"></td>
                    </tr>
                    <tr>
                      <td><strong>TAX :</strong></td>
                      <td id="total_tax"></td>
                    </tr>
                    <tr>
                      <td><strong>TOTAL :</strong></td>
                      <td id="total"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>