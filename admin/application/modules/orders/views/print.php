<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title ?></title>

    <link href="<?php echo base_url() ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>public/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
    <div class="wrapper wrapper-content p-xl">
        <div class="ibox-content p-xl">
            <div class="row">
                <div class="col-sm-4">
                    <h5>From:</h5>
                        <address>
                            <strong><?php echo $this->config->item('company_name'); ?></strong><br>
                            <?php echo $this->config->item('company_address'); ?><br>
                            <?php echo $this->config->item('company_city'); ?><br>
                            <?php echo $this->config->item('company_country'); ?></br>
                            <abbr title="Phone">P:</abbr> <?php echo $this->config->item('company_phone'); ?>
                        </address>
                </div>
                <div class="col-sm-4 text-center">
                <img src="<?php echo base_url() ?>/public/img/logo.png" alt="logo" height="80px" width="80px;">
                    <h4>Invoice No.</h4>
                    <h4 class="text-navy">INV-<?php echo $order_id; ?></h4>
                    <p>
                        <span><strong>Order Date:</strong> <?php echo dateFormater($order['order']->order_at); ?></span><br/>
                        <!-- <span><strong>Due Date:</strong> March 24, 2014</span> -->
                    </p>
                </div>
                <div class="col-sm-4 text-right">
                    <span>To:</span>
                        <address>
                            <strong><?php echo $order['order']->customer_name; ?></strong><br>
                            <?php echo $order['order']->customer_address1; ?><br>
                            <?php echo $order['order']->customer_zipp_code; ?>,<?php echo $order['order']->customer_city; ?><br>
                            <?php echo $order['order']->customer_state; ?>, <?php echo $order['order']->customer_country; ?></br>
                            <abbr title="Phone">P:</abbr> <?php echo $order['order']->customer_phone; ?>
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
                    <tbody>
                        <?php
$total_tax = 0;
$sub_total = 0;

foreach ($order['order_list'] as $key => $product) {
    ?>
                               <tr>
                                <td><div><strong><?php echo $product->product_name; ?></strong></div></td>
                                <td><?php echo $product->product_total_quantity; ?></td>
                                <td>$ <?php echo $product->product_price; ?></td>
                                <td>$ <?php echo $product->product_tax; ?></td>
                                <td>$ <?php echo (($product->product_price) * ($product->product_total_quantity)); ?></td>
                            </tr>
                            <?php
$total_tax = $total_tax + $product->product_tax;
    $sub_total = $sub_total + (($product->product_price) * ($product->product_total_quantity));
}?>

                    </tbody>
                </table>
            </div><!-- /table-responsive -->

            <table class="table invoice-total">
                <tbody>
                    <tr>
                        <td><strong>Sub Total :</strong></td>
                        <td>$ <?php echo $sub_total; ?></td>
                    </tr>
                    <tr>
                        <td><strong>TAX :</strong></td>
                        <td>$ <?php echo $total_tax; ?></td>
                    </tr>
                    <tr>
                        <td><strong>TOTAL :</strong></td>
                        <td>$ <?php echo ($total_tax + $sub_total); ?></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <table class="table invoice-total">
                <tbody>

                    <tr>
                       <td><strong>Sign :</strong></td>
                       <td>_____________________</td>
                   </tr>
               </tbody>
           </table>
       </div>

   </div>

   <!-- Mainly scripts -->
   <script src="<?php echo base_url() ?>public/js/jquery-3.1.1.min.js"></script>
   <script src="<?php echo base_url() ?>public/js/popper.min.js"></script>
   <script src="<?php echo base_url() ?>public/js/bootstrap.js"></script>
   <script src="<?php echo base_url() ?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>

   <!-- Custom and plugin javascript -->
   <script src="<?php echo base_url() ?>public/js/inspinia.js"></script>

   <script type="text/javascript">
    window.print();
</script>

</body>

</html>
