<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<footer class="row foooter footer2 ">
    <div class="container">
        <div class="row footer_sidebar">
            <div class="widget widget-about col-sm-6 col-md-3">
                <h5 class="widget-title">about helping hands</h5>
                <p><?php echo footer_about_us(); ?></p>
                <a href="<?php echo base_url('about.html'); ?>" class="btn-primary btn-outline white">know more</a>
            </div>
            <div class="widget widget-recent-posts col-sm-6 col-md-3">
                <h5 class="widget-title">recent posts</h5>
                <ul class="nav recent-posts">
                    <?php
if (footer_news()) {
    foreach (footer_news() as $key => $value) {?>
                            <li><a href="<?php echo base_url('news/view/' . $value->slug . '.html') ?>"><?php echo $value->title; ?></a></li>
                        <?php }}?>
                    </ul>
                </div>
                <div class="widget widget-recent-tweets col-sm-6 col-md-3">
                    <h5 class="widget-title">recent tweets</h5>
                    <div class="tweet m0">
                        <p><a href="#">@Ymodita</a>  hey, please send me a msg through the contact form on my profile page at themeforest <br>
                            <span class="time_past">2 months ago</span></p>
                        </div>
                        <a href="#" class="btn-primary btn-outline white">follow us now</a>
                    </div>
                    <div class="widget widget-contact col-sm-6 col-md-3">
                        <h5 class="widget-title">CONTACT HELPING HANDS</h5>
                        <address>
                            <?php echo $this->config->item('company_city'); ?>,
                            <?php echo $this->config->item('company_address'); ?><br>
                            <?php echo $this->config->item('company_country'); ?>.
                            <br><br>
                            <span>Phone</span> :  <?php echo $this->config->item('company_phone'); ?><br>
                            <span>Email</span> : <a href="mailto:<?php echo $this->config->item('company_email'); ?>"><?php echo $this->config->item('company_email'); ?></a>
                        </address>
                    </div>
                </div>
            </div>
            <div class="row copyright_area m0">
                <div class="container">
                    <div class="copy_inner row">
                        <div class="col-md-7 col-sm-12 ">Copyright <?php echo date('Y'); ?>. All Rights Reserved by  SSC 2002 & HSC 2004 Bangladesh Foundation. Developed by <a href="http://www.analytiq.xyz">AnalytiQ</a>.</div>
                        <div class="col-md-5 col-sm-12 text-center">
                            <ul class="nav mr-auto">
                                <li><a href="<?php echo base_url('terms.html') ?>">Terms of Use</a></li>
                                <li><a href="<?php echo base_url('privacy.html') ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo base_url('desclaimer.html') ?>">Desclaimer</a></li>
                                <li><a href="<?php echo base_url('faq.html') ?>">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>



    <div class="modal fade" id="donation_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h3 class="text-center">ENTER YOUR DONATION AMOUNT</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row" style="padding: 5px">
                    <form method="post" class="row m0 donate_form" id="donate_form">
                        <input type="radio" name="donate_amount" id="donate_amount01" value="<?php echo $this->config->item('donation_first_amount') ?>">
                        <label for="donate_amount01">
                            <strong>DONATE <span>$<?php echo $this->config->item('donation_first_amount') ?></span></strong>
                        </label>
                        <input type="hidden" name="cause_id" id="cause_id_from_footer" value="">
                        <input type="hidden" name="cause_type" id="cause_type_from_footer" value="causes">
                        <input type="radio" name="donate_amount" id="donate_amount02" value="<?php echo $this->config->item('donation_second_amount') ?>">
                        <label for="donate_amount02">
                            <strong>DONATE <span>$<?php echo $this->config->item('donation_second_amount') ?></span></strong>
                        </label>

                        <input type="radio" name="donate_amount" id="donate_amount03" value="<?php echo $this->config->item('donation_third_amount') ?>">
                        <label for="donate_amount03">
                            <strong>DONATE <span>$<?php echo $this->config->item('donation_third_amount') ?></span></strong>
                        </label>

                        <input type="radio" name="donate_amount" id="donate_amount04" value="<?php echo $this->config->item('donation_fourth_amount') ?>">
                        <label for="donate_amount04">
                            <strong>DONATE <span>$<?php echo $this->config->item('donation_fourth_amount') ?></span></strong>
                        </label>
                        <input type="radio" name="donate_amount" id="donate_amount05" value="<?php echo $this->config->item('donation_fifth_amount') ?>">
                        <label for="donate_amount05">
                            <strong>DONATE <span>$<?php echo $this->config->item('donation_fifth_amount') ?></span></strong>
                        </label>
                        <h5>ENTER CUSTOM AMOUNT</h5>

                        <div class="input-group">
                            <span class="input-group-addon left">$</span>
                            <input type="number" class="form-control" name="donate_custom_amount">
                            <span class="input-group-addon right">
                                <button type="submit" id="donate_submit" class="btn-primary">donate now</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Donate Form-->


<!--Color Change Setting-->
<!-- <div class="row m0 color_change_setting">
   <div class="setting_box"><i class="fa fa-cog fa-spin" aria-hidden="true"></i></div>
   <div class="row m0 colors_variations">
      <h3 class="hhh h2">Change Color</h3>
      <div class="colors row m0">
         <a href="javascript:chooseStyle('none', 60)" class="default-theme working">1</a>
         <a href="javascript:chooseStyle('yellow-theme', 60)" class="yellow-theme">2</a>
         <a href="javascript:chooseStyle('blue-theme', 60)" class="blue-theme">3</a>
         <a href="javascript:chooseStyle('red-theme', 60)" class="red-theme">4</a>
         <a href="javascript:chooseStyle('purple-theme', 60)" class="purple-theme">5</a>
         <a href="javascript:chooseStyle('orange-theme', 60)" class="orange-theme">6</a>
     </div>
 </div>
</div> -->

<?php echo script_tag("public/assets/js/jquery-2.1.4.min.js", true) ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<?php echo script_tag("public/assets/js/bootstrap.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/jquery-ui/jquery-ui.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/imagesloaded/imagesloaded.pkgd.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/isotope/isotope.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/bootstrap-select/js/bootstrap-select.min.js", true) ?>
<?php echo script_tag("public/assets/js/toastr/toastr.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/magnific-popup/jquery.magnific-popup.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/owl.carousel/owl.carousel.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/couterup/jquery.counterup.min.js", true) ?>
<?php echo script_tag("public/assets/vendors/waypoint/waypoints.min.js", true) ?>

<?php echo script_tag("public/assets/js/min/theme.min.js", true) ?>
<?php echo script_tag("public/assets/js/sweet-alert.min.js", true) ?>
<?php echo script_tag("public/assets/js/timecircle.js", true) ?>
<?php echo script_tag("public/assets/js/styleswitch.js", true) ?>
<?php echo script_tag("public/assets/js/ajax-form.js", true) ?>
<?php echo script_tag("public/assets/js/country.js", true) ?>
<?php echo script_tag("public/assets/js/validate.min.js", true) ?>
<script src="https://cdn.jsdelivr.net/npm/readmore-js@2.2.1/readmore.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<?php echo script_tag("public/assets/js/main.js", true); ?>
<script type="text/javascript">
    $('.history_carousel').slick({
        dots: true,
        slidesToShow: 1,
        speed: 300,
        autoplay:true,
        autoplaySpeed:3000,
    });
    $('.donors_qoute').slick({
        slidesToShow: 1,
        speed: 300,
        autoplay:true,
        autoplaySpeed:5000,
    });

    $("#example").TimeCircles({
        "animation": "smooth",
        "bg_width": 1.2,
        "fg_width": 0.08333333333333333,
        "circle_bg_color": "#60686F",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#ff667b",
                "show": true
            },
            "Hours": {
                "text": "Hours",
                "color": "#99CCFF",
                "show": true
            },
            "Minutes": {
                "text": "Minutes",
                "color": "#BBFFBB",
                "show": true
            },
            "Seconds": {
                "text": "Seconds",
                "color": "#FF9999",
                "show": true
            }
        }
    });

    $('.about_readmore').readmore({ speed: 75, lessLink: '<a href="#">Read less</a>' });
</script>

<script>
  $( function() {
    $( "#date_of_birth" ).datepicker({
        dateFormat:'yy-mm-dd',
          changeMonth:true,
               changeYear:true,
    });
  } );
  </script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row" style="padding: 5px" id="modal_carts">

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="<?php echo base_url('cart'); ?>" class="btn btn-primary">Cart</a>
            <a href="" id="modal_checkout_button" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>