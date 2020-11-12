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
     <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('merchandise_page')); ?>');">
        <div class="container">
            <h4>Our Product</h4>
        </div>
    </section>
    <div class="page-wrapper ">
    <section class="row gallery-content">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-3 col-lg-push-9 foundation-sidebar sidebar">




                </div> -->
                <div class="col-lg-12  products">
                    <div class="row m0 product-filtering">
                        <h5 class="pull-left">Showing <?php echo $start + 1; ?> – <?php echo $total - ($start); ?> of <?php echo $total; ?> results</h5>
                       <!--  <form method="get" id="sorting_form" action=''>
                            <select class="selectpicker pull-right" name="orderby" onchange="this.form.submit()">
                                <option value="menu_order">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating" selected="selected">Sort by average rating</option>
                                <option value="date">Sort by latest</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </form> -->
                    </div>
                    <div class="row product-column">
                        <div class="col-sm-6 col-md-4 product-sizer"></div>
                        <?php foreach ($results as $product) {
    ?>
                        <!--Product-->
                        <div class="col-sm-6 col-md-4  product">
                            <div class="images_row row m0">
                                 <?php
$optional_images = get_optional_images($product->id);
    if ($optional_images) {
        ?>
                                <div id="product_carousel_inner" class="carousel slide" data-ride="carousel" data-interval="3000">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php
$new_image_array = array();
        foreach ($optional_images as $image) {
            $new_image_array[] = $image->picture;
        }
        array_push($new_image_array, $product->feature_picture);
        foreach ($new_image_array as $key => $value) {?>
                                        <div class="item <?php if ($key == 1) {?> active <?php }?>">
                                            <img src="<?php echo FILE_UPLOAD_PATH . $value; ?>" alt="product image">
                                        </div>
                                    <?php }?>
                                    </div>
                                </div>
                            <?php } else {?>
                                 <img src="<?php echo FILE_UPLOAD_PATH . $product->feature_picture; ?>" alt="">
                            <?php }?>

                                <a href="javascript:void(0)" class="btn-primary" onclick="add_to_cart(<?php echo $product->id ?>,'product')" >add to cart</a>
                            </div>
                            <div class="product_excerpts row m0">
                                <h4 class="pro_title"><a href="<?php echo base_url('merchandise/product/' . $product->slug . '.html') ?>"><?php echo $product->name; ?></a></h4>
                                <div class="row fund_raises m0 price_ratings">
                                    <div class="pull-left raised amount_box">
                                        <h6>10% OFF</h6>
                                        <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo $product->sale_price; ?></h3>
                                    </div>
                                    <div class="pull-left goal amount_box">
                                        <h6>ratings</h6>
                                        <h4 class="stars">
                                            <i class="fa fa-star starred"></i>
                                            <i class="fa fa-star starred"></i>
                                            <i class="fa fa-star starred"></i>
                                            <i class="fa fa-star starred"></i>
                                            <i class="fa fa-star"></i>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    </div>

                       <?php echo $links; ?>

                </div>
            </div>
        </div>
    </section>
