<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Invoice #<?php echo $order_id; ?></title>
    <style>
        body {
            color: #2B2000;
            font-family: 'Helvetica';
        }
        .invoice-box {
            width: 100%;
            height: 297mm;
            margin: auto;
            padding: 4mm;
            border: 0;
            font-size: 14px;
            line-height: 16px;
            color: #000;
        }

        table {
            width: 100%;
            line-height: 16px;
            text-align: left;
            border-collapse: collapse;
        }

        .plist tr td {
            line-height: 12px;
        }

        .subtotal tr td {
            line-height: 10px;
            padding: 6px;
        }

        .subtotal tr td {
            border: 1px solid #ddd;
        }

        .sign {
            text-align: right;
            font-size: 10px;
            margin-right: 110px;
        }

        .sign1 {
            text-align: right;
            font-size: 10px;
            margin-right: 90px;
        }

        .sign2 {
            text-align: right;
            font-size: 10px;
            margin-right: 115px;
        }

        .sign3 {
            text-align: right;
            font-size: 10px;
            margin-right: 115px;
        }

        .terms {
            font-size: 9px;
            line-height: 16px;
            margin-right:20px;
        }

        .invoice-box table td {
            padding: 10px 4px 8px 4px;
            vertical-align: top;

        }

        .invoice-box table.top_sum td {
            padding: 0;
            font-size: 12px;
        }

      /*  .party tr td:nth-child(3) {
            text-align: center;
        }*/

        .invoice-box table tr.top table td {
            padding-bottom: 20px;

        }

        table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #555;
        }

        table tr.information table td {
            padding-bottom: 20px;
        }

        table tr.heading td {
            background: #515151;
            color: #FFF;
            padding: 6px;

        }

        table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border: 1px solid #ddd;
        }

        table tr.b_class td{
            border-bottom: 1px solid #ddd;
        }

        table tr.b_class.last td{
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #fff;
            font-weight: bold;
        }

        .myco {
            width: 400px;
        }

        .myco2 {
            width: 300px;
        }

        .myw {
            width: 240px;
            font-size: 14px;
            line-height: 14px;

        }

        .mfill {
            background-color: #eee;
        }

        .descr {
            font-size: 10px;
            color: #515151;
        }

        .tax {
            font-size: 10px;
            color: #515151;
        }

        .t_center {
            text-align: right;

        }
        .party {
            border: #ccc 2px solid;
        }


    </style>
</head>

<body>

<div class="invoice-box">
    <table>
        <tr>
            <td class="myco">
                <img src="<?php echo base_url('public/img/logo.png'); ?>" style="max-width:260px;">
            </td>
            <td>

            </td>
            <td class="myw">
                <table class="top_sum">
                   <tr>
                       <td colspan="1" class="t_center"><h2 ><?php echo 'Invoice'; ?></h2><br><br></td>
                    </tr>
                    <tr>
                        <td><?php echo 'Invoice'; ?></td><td><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $order_id; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "Invoice Date"; ?></td><td><?php echo dateFormater($order['order']->order_at); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo "Due Date"; ?></td><td><?php echo dateFormater($order['order']->order_at); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br>
    <table class="party">
        <thead>
            <tr class="heading">
                <td> <?php echo "From"; ?>:</td>

                <td><?php echo "To"; ?>:</td>
                <td><?php echo "Shipping Address"; ?>:</td>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td><h3><?php echo $this->config->item('company_name'); ?></h3>
                <?php echo $this->config->item('company_address') . '<br>' . $this->config->item('company_city') . ',' . $this->config->item('company_country') . '<br>' . 'Phone' . ': ' . $this->config->item('company_phone') . '<br>  ' . 'Email' . ' : ' . $this->config->item('company_email');
?>
            </td>

            <td>
                     <?php echo '<strong>' . $order['order']->customer_name . '</strong><br>';
if ($order['order']->company_name) {
    echo $order['order']->company_name . '<br>';
}

echo $order['order']->customer_address1 . '<br>' . $order['order']->customer_city . ', ' . $order['order']->customer_state . '<br>' . $order['order']->customer_zipp_code . '-' . $order['order']->customer_country . '<br>' . 'Phone' . ': ' . $order['order']->customer_phone . '<br>' . 'Email' . ' : ' . $order['order']->customer_email;
?>
            </td>
                            <td>
                    <?php
echo $order['order']->customer_name . '</strong><br>';
echo $order['order']->customer_address1 . ' ' . $order['order']->customer_address2 . '<br>' . $order['order']->customer_city . ', ' . $order['order']->customer_state . '<br>' . $order['order']->customer_country . '-' . $order['order']->customer_zipp_code . '<br> ' . 'Phone' . ': ' . $order['order']->customer_phone . '<br> ' . 'Email' . ': ' . $order['order']->customer_email;

?>
                </td>
        </tr>

        </tbody>
    </table>
    <br>
    <table class="plist" cellpadding="0" cellspacing="0">


        <tr class="heading">
            <td>
                <?php echo "Description"; ?>
            </td>

            <td>
                <?php echo "Price"; ?>
            </td>
            <td>
                <?php echo "Qty"; ?>
            </td>
            <td>
                <?php echo "Tax"; ?>
            </td>
            <td>
                <?php echo "SubTotal"; ?>
            </td>
        </tr>

        <?php $i = 1;
$fill            = true;
foreach ($order['order_list'] as $product) {

    $cols = 3;
    if ($fill == true) {
        $flag = ' mfill';
    } else {
        $flag = '';
    }
    echo '<tr class="item' . $flag . '">
                            <td>' . $product->product_name . '</td>
                            <td style="width:12%;">' . $product->product_price . '</td>
                            <td style="width:6%;">' . $product->product_total_quantity . '</td>   ';
    //if ($product->product_tax > 0) {
    echo '<td style="width:16%;">' . $product->product_tax . ' <span class="tax">(in%)</span></td>';
    $cols++; //}
    echo ' <td style="width:16%;">' . (($product->product_price) * ($product->product_total_quantity) + $product->product_tax) . '</td>
                        </tr>';
    $fill = !$fill;
    $i++;
}
if ($product->product_tax > 0) {
    $cols = 5;
} else {
    $cols = 4;
}
?>


    </table>
    <table class="subtotal">
        <thead>
        <tbody>
        <tr>
            <td class="myco2" rowspan="<?php echo $cols ?>"><br><br><br>
                <p><?php echo '<strong> Status : ' . ($order['order']->is_active == 0) ? "Due" : "Paid" . '</strong></p><br><p> Total Amount : ' . $order['order']->price . '</p><br><p> Paid Amount : ' . ($order['order']->paid_amount) ? $order['order']->paid_amount : 0 . '</p><br>'; ?>
            </td>
            <td><strong><?php echo "Summary"; ?>:</strong></td>
            <td></td>


        </tr>
        <tr>


            <td><?php echo "SubTotal"; ?>:</td>

            <td><?php echo $order['order']->price; ?></td>
        </tr>
        <?php if ($order['order']->tax > 0) {
    echo '<tr>

            <td>Total Tax  :</td>

            <td>' . $order['order']->tax . '</td>
        </tr>';
}?>



        <tr>


            <td><?php echo "Amount Due"; ?> :</td>

            <td><strong><?php echo (($order['order']->price + $order['order']->tax) - $order['order']->paid_amount);
echo '</strong></td>
        </tr>
        </tbody>
        </table>
        <br>
        <div class="sign">Authorized person</div>';
?></div>
</div>
</body>
</html>
