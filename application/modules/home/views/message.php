<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
    .blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: #000;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
</style>
<div class="page-wrapper " style="background-color: ">
    <section class="row gallery-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <table class="table subtotal" style="border: 2px solid #cbd0db">
                    <thead>
                        <tr><th colspan="2" style="text-align: center;background-color: #29af8a">
                            <h3 class="cart_hading" style="font-weight:bold;color: white;">THANKS FOR YOUR ORDER</h3>
                        </th></tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">
                            <td class="blinking" colspan="2" style="text-align: center !important;">We will contact you soon through your mail  ❤️</td>
                        </tr>
                        <tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">
                            <th>Your Order Tracking Link</th>
                            <td><a target="_blank" href="<?php echo base_url('invoice/view/' . $order_id) ?>">View Your Invoice</a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
