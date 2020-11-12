<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <section class="floating-button ">
        <div class="btn-cart ">
            <a href="<?php echo base_url('cart') ?>">
                <div class="count-wrapper">
                   <i style="font-size: 18px;" class="fa fa-shopping-cart"></i>
                    <div class="js--cart-quantity count one-digit" style="visibility: inherit; opacity: 1;" id="cart_quantity_sidebar">0</div>
                </div>
                <p class="text">Cart</p>
            </a>
        </div>
        <div class="btn-wishlist">
            <a href="<?php //echo base_url('wishlist'); ?>">
                <div class="count-wrapper">
                   <i style="font-size: 18px;" class="fa fa-heart"></i>
                    <div class="count one-digit">0</div>
                </div>
                <p class="text">Wishlist</p>
            </a>
        </div>
    </section>
<section class="row page-header" style="background: url('<?php echo image_url($this->config->item('cart_page')); ?>');">
    <div class="container">
        <h4>our foundation</h4>
    </div>
</section>
<div class="page-wrapper ">
    <section class="row gallery-content">
        <div class="container">
            <form action="<?php echo base_url('cart/update_whole_cart.html'); ?>" method="post" >
            <div class="row" id="carts">

            </div>
            <form>

        </div>
    </section>
