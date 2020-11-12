<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.sd-page-top {
    background-color: #f9fafb;
    border-bottom: 1px solid #e6e8ea;
    padding: 25px 0;
}
</style>
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
<!--      <section class="row page-header" style="background: url('<?php //echo image_url(header_image_config('merchandise_page')); ?>');">
        <div class="container">
            <h4>our foundation</h4>
        </div>
    </section> -->
    <div class="sd-page-top clearfix ">
        <div class="container">
            <h1 class="hhh h3"><?php echo $product->name; ?></h1>
        </div>
    </div>
    <section class="row gallery-content" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-lg-push-9 shop-sidebar sidebar">
                    <form action="#" class="input-group shop-search" method="get" role="search">
                        <input type="search" class="form-control" placeholder="search">
                        <span class="input-group-addon"><button type="submit"><i class="fa fa-search"></i></button></span>
                    </form>

                    <!-- <div class="row m0 widget widget-categories">
                        <h4 class="widget-title">categories</h4>
                        <ul class="nav">
                            <?php //foreach ($all_category as $key => $value) {?>
                                <li><a href="<?php //echo base_url('merchandise/?category='.$value->id) ?>"><?php //echo $value->category_name; ?></a></li>
                            <?php //} ?>
                        </ul>
                    </div> -->

                   <!--  <div class="row m0 widget widget-price-filter">
                        <div class="price-filter-inner row m0">
                            <h4 class="widget-title">price filter</h4>
                            <form action="#" class="price-range">
                                <div class="slider-range"></div>
                                <div class="row m0">
                                    <input type="submit" value="filter" class="btn-primary btn-md pull-left">
                                    <input type="text" class="range-amount pull-right" readonly>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row m0 widget widget-recent-posts">
                        <h4 class="widget-title">recent post</h4>
                        <div class="media recent-post">
                            <div class="media-left"><a href="single-product.html"><img src="images/pp1.png" alt=""></a></div>
                            <div class="media-body">
                                <h5 class="title"><a href="#">yellow top</a></h5>
                                <h5 class="price">
                                    <del>$89.99</del>$65.43
                                </h5>
                                <div class="row m0 proRating">
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="media recent-post">
                            <div class="media-left"><a href="single-product.html"><img src="images/pp1.png" alt=""></a></div>
                            <div class="media-body">
                                <h5 class="title"><a href="#">cool blue top</a></h5>
                                <h5 class="price">
                                    <del>$89.99</del>$65.43
                                </h5>
                                <div class="row m0 proRating">
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="media recent-post">
                            <div class="media-left"><a href="single-product.html"><img src="images/pp1.png" alt=""></a></div>
                            <div class="media-body">
                                <h5 class="title"><a href="#">gray t-shirt</a></h5>
                                <h5 class="price">
                                    <del>$89.99</del>$65.43
                                </h5>
                                <div class="row m0 proRating">
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star starred"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <div class="col-lg-9 col-lg-pull-3 products single-product">

                    <div class="media product-specification">
                        <div class="media-left">

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
                                <img src="<?php echo FILE_UPLOAD_PATH . $product->feature_picture; ?>" alt="product image">
                            <?php }?>
                            <!-- <img src="images/product.jpg" alt=""> -->
                            <!-- <div class="sale-tag"><span class="amount">25<span>%</span></span>off</div> -->
                        </div>
                        <div class="media-body">
                            <h4 class="hhh h2"><?php echo $product->name; ?></h4>
                            <div class="row m0 pricing-rating">
                                <div class="price">
                                    <!-- <h6 class="hhh h5"><del>$99.99</del></h6> -->
                                    <h2><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo $product->sale_price; ?></h2>
                                </div>
                            <!--     <div class="rating">
                                    <h6 class="hhh h5">ratings</h6>
                                    <div class="row m0 stars">
                                        <i class="fa fa-star starred"></i>
                                        <i class="fa fa-star starred"></i>
                                        <i class="fa fa-star starred"></i>
                                        <i class="fa fa-star starred"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row m0 availablity speciface">
                                <div class="this-title">availablity</div>
                                <div class="this-opt"><button class="btn-primary btn-md">in stock</button></div>
                            </div>
                            <div class="row m0 quantity speciface">
                                <!-- <div class="this-title">quantity</div> -->
                                <button type="button" class="sd-quantity-input cart-minus" onclick="decrement(this,'-')">-</button>
                                <input type="text" class="sd-quantity-input single_page_quantity" min="1" value="1" id="quantity" >
                                <button type="button" class="sd-quantity-input cart-plus" onclick="increment(this,'+')">+</button>
                                <button class="btn-primary add2cart" onclick="
                                var quantity = document.getElementById('quantity').value;
                                add_to_cart(<?php echo $product->id; ?>,'product',quantity)">add to cart</button>
                            </div>

                            <p><strong>Category : </strong><?php foreach ($all_category as $key => $category) {
    if ($category->id == $product->category_id) {
        echo $category->category_name;
    }
}?></p>


                        </div>
                    </div>

                    <div class="row tabs-row m0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs hhh-tab shop-tab" role="tablist">
                            <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">description</a></li>
                            <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">reviews</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content hhh-tab-content shop-tab-content">
                            <div role="tabpanel" class="tab-pane active" id="description">
                                <h4 class="description-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sed sollicitud eget mollis tellus. Vivamus iaculis porttitor ante</h4>
                                <p><?php echo $product->description; ?></p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="reviews">

                                <div class="row">
                                    <div class="row m0 comments">
                                        <h4 class="this-title">Reviews</h4>

                                        <div id="display_reviews"></div>

                                    </div>

                                    <form id="review_form" method="post" class="row m0 comment-form contact-form">
                                        <h4>Leave a Review</h4>
                                        <h6 id="review_success" class="hhh h6 alert alert-success" style="display: none;"></h6>
                                        <input type="hidden" name="product_id"  value="<?php echo $product->id; ?>">
                                        <script type="text/javascript">product_id = '<?php echo $product->id; ?>';</script>
                                        <input type="hidden" name="member_id"  value="<?php echo $this->session->userdata('member_id'); ?>">
                                        <div class="form-group">
                                            <input type="radio" id="star1" name="rating" value="1">
                                            <label class="custom-control-label" for="star1"><i class="fa fa-star" style="color: orange"></i></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="star2" name="rating" value="2">
                                            <label class="custom-control-label" for="star2"><i class="fa fa-star" style="color: orange"></i></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="star3" name="rating" value="3">
                                            <label class="custom-control-label" for="star3"><i class="fa fa-star" style="color: orange"></i></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="star4" name="rating" value="4">
                                            <label class="custom-control-label" for="star4"><i class="fa fa-star" style="color: orange"></i></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" id="star5" name="rating" value="5">
                                            <label class="custom-control-label" for="star5"><i class="fa fa-star" style="color: orange"></i></label>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="review" id="review" placeholder="review" class="form-control"></textarea>
                                            <div class="form-error" style="color: red;"></div>
                                        </div>
                                        <input type="submit" value="submit" class="btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (sizeof($related_product) > 0): ?>
                       <!-- Related product start -->
                       <div class="row">
                        <div class="col-sm-12"><h4 class="hhh h2">similar products</h4></div>
                        <?php foreach ($related_product as $product) {
    ?>
                            <!--Product-->
                            <div class="col-sm-6 col-md-4 product">
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

                             <a href="javascript:void(0)" class="btn-primary" onclick="add_to_cart(<?php echo $product->id ?>)" >add to cart</a>

                         </div>
                         <div class="product_excerpts row m0">
                            <h4 class="pro_title"><a href="<?php echo base_url('merchandise/product/' . $product->id) ?>"><?php echo $product->name; ?></a></h4>
                            <div class="row fund_raises m0 price_ratings">
                                <div class="pull-left raised amount_box">
                                    <h6>10% OFF</h6>
                                    <h3>$<?php echo $product->sale_price; ?></h3>
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
            <!-- Related product end -->
        <?php endif?>
    </div>
</div>
</div>
</section>
