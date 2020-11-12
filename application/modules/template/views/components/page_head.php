<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (get_cookie('order_id') == NULL) {
    set_cookie('order_id', uniqid(), time() + ((86400 * 365) * 30), 'localhost', '/');
}
$class = $this->uri->segment(1);
if ($class == 'home' OR $class == '') {
    $css_home = 'active';
} else if ($class == 'about') {
    $css_about = 'active';
} else if ($class == 'causes') {
    $css_causes = 'active';
} else if ($class == 'contacts') {
    $css_contacts = 'active';
} else if ($class == 'events') {
    $css_events = 'active';
} else if ($class == 'merchandise') {
    $css_merchandise = 'active';
} else if ($class == 'news') {
    $css_news = 'active';
} else if ($class == 'volunteers') {
    $css_volunteers = 'active';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo isset($title) ? $title : '404 Not Found Error'; ?></title>
    <link rel="icon" href="<?php echo base_url('public/assets/images/logo.png') ?>">

    <!--Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700italic,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--Bootstrap-->
    <?php echo link_tag("public/assets/css/bootstrap.min.css") ?>
    <?php echo link_tag("public/assets/css/bootstrap-theme.min.css") ?>
    <?php echo link_tag("public/assets/vendors/bootstrap-select/css/bootstrap-select.min.css") ?>
    <?php echo link_tag("public/assets/css/font-awesome.min.css") ?>
    <?php echo link_tag("public/assets/vendors/owl.carousel/owl.carousel.css") ?>
    <?php echo link_tag("public/assets/vendors/jquery-ui/jquery-ui.min.css") ?>
    <?php echo link_tag("public/assets/vendors/magnific-popup/magnific-popup.css") ?>
    <?php echo link_tag("public/assets/css/hover-min.css") ?>
    <?php echo link_tag("public/assets/css/toastr/toastr.min.css") ?>
    <?php echo link_tag("public/assets/css/timecircle.css") ?>
    <?php echo link_tag("public/assets/css/style.min.css") ?>
    <?php echo link_tag("public/assets/css/theme.min.css") ?>
    <?php link_tag("public/assets/css/yellow-theme.min.css", "alternate stylesheet", '', 'yellow-theme')?>
    <?php link_tag("public/assets/css/blue-theme.min.css", "alternate stylesheet", '', 'blue-theme')?>
    <?php link_tag("public/assets/css/red-theme.min.css", "alternate stylesheet", '', 'red-theme')?>
    <?php link_tag("public/assets/css/purple-theme.min.css", "alternate stylesheet", '', 'purple-theme')?>
    <?php echo link_tag("public/assets/css/orange-theme.min.css", "alternate stylesheet", '', 'orange-theme') ?>
    <?php echo link_tag("public/assets/css/sweet-alert.min.css") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.min.css" integrity="sha256-rxais37anKUnpL5QzSYte+JnIsmkGmLG+ZhKSkZkwVM=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css.map">

    <!--[if lt IE 9]>
        <link rel="stylesheet" href="vendors/rs-plugin/css/settings-ie8.css">
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
        var url =  window.location.href;
        var image_url = '<?php echo FILE_UPLOAD_PATH; ?>';
        var shiping_charge  = <?php echo config('shipping_charge'); ?>;
        var total_cart;
        var news_id;
        var product_id;
    </script>
<style type="text/css">
    .modal-dialog {
  position: relative;
  width: auto;
  margin: 10px;
}
</style>
</head>
<body class="home-page-2">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=475095052888682&autoLogAppEvents=1"></script>


    <nav class="navbar navbar-default navbar-static-top navbar2">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="nav navbar-nav">
                    <li class="<?php echo isset($css_home) ? $css_home : ''; ?>"><a href="<?php echo base_url('home.html') ?>">Home</a></li>
                    <li class="<?php echo isset($css_about) ? $css_about : '' ?>"><a href="<?php echo base_url('about.html') ?>">About Us</a></li>
                    <li class="<?php echo isset($css_volunteers) ? $css_volunteers : '' ?>"><a href="<?php echo base_url('volunteers.html') ?>">Volunteers</a></li>
                    <li class="<?php echo isset($css_news) ? $css_news : '' ?>"><a href="<?php echo base_url('news.html') ?>">News</a></li>
                    <li class="<?php echo isset($css_causes) ? $css_causes : '' ?>"><a href="<?php echo base_url('causes.html') ?>">Causes</a></li>
                    <li class="<?php echo isset($css_merchandise) ? $css_merchandise : '' ?>"><a href="<?php echo base_url('merchandise.html') ?>">Merchandise</a></li>
                    <li class="<?php echo isset($css_events) ? $css_events : '' ?>"><a href="<?php echo base_url('events.html') ?>">Events</a></li>
                    <li class="<?php echo isset($css_contacts) ? $css_contacts : '' ?>"><a href="<?php echo base_url('contacts.html') ?>">Contacts</a></li>

                    <?php if ($this->session->userdata('login') == true) {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member
                           <i class="fa fa-angle-down" style=""></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('member/accounts') ?>">Profile</a></li>
                            <li><a href="<?php echo base_url('member/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php } else if ($this->session->userdata('login') != true) {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member
                           <i class="fa fa-angle-down" style=""></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('member'); ?>">Registration </a></li>
                            <li><a href="<?php echo base_url('member/login') ?>">Login</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <li class="sd-minicart-icon mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page" data-toggle="modal" data-target="#exampleModal">
                        <a class="sd-minicart-link" href="#" title="View cart content">Cart
                            <i style="font-size: 18px;" class="fa fa-shopping-cart"></i>
                            <span class="sd-nr sidr-class-sd-nr" >
                                <span class="sd-items-count" id="cart_quantity">0</span>
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="nav social_navbar navbar-right">
                    <li><a href="<?php echo 'https://www.facebook.com/' . $this->config->item('fb_link'); ?>"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="<?php echo 'https://www.twitter.com/' . $this->config->item('twt_link'); ?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="<?php echo 'https://www.linkedin.com/company/' . $this->config->item('linkedin_link'); ?>"><i class="fa fa-linkedin"></i></a></li>
<!--                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="#" method="get" role="form" class="search_form">
                                    <input type="search" class="form-control" placeholder="Type and press enter">
                                </form>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <header class="row header1">
        <div class="container">
            <div class="logo pull-left">
                <a href="<?php echo base_url('/') ?>"><img src="<?php echo image_url($this->config->item('site_logo')) ?>" alt="SSC 2002 & HSC 2004 Bangladesh Foundation"></a>
            </div>
            <a href="<?php echo base_url('volunteers/register'); ?>" class="btn-primary btn-outline hidden-sm hidden-xs pull-right">Become Volunteer</a>

            <div class="pull-right emergency-contact">
                <div class="pull-left">
                    <span><i class="fa fa-envelope-o"></i></span>
                    <div class="infos_col">
                        <h6>email us at</h6>
                        <a href="mailto:<?php echo $this->config->item('company_email'); ?>"><h5><?php echo $this->config->item('company_email'); ?></h5></a>
                    </div>
                </div>
                <div class="pull-left">
                    <span class="rotate"><i class="fa fa-phone"></i></span>
                    <div class="infos_col">
                        <h6>call us now</h6>
                        <h4><?php echo $this->config->item('company_phone'); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </header>