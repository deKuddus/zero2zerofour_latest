<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "404 not found error"; ?></title>
    <?php echo link_tag('public/css/bootstrap.min.css'); ?>
    <?php echo link_tag("public/font-awesome/css/font-awesome.css"); ?>
    <?php echo link_tag("public/css/animate.css"); ?>
    <?php echo link_tag("public/css/plugins/switchery/switchery.css"); ?>
    <?php echo link_tag("public/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css"); ?>
    <?php echo link_tag("public/css/plugins/slick/slick.css"); ?>
    <?php echo link_tag("public/css/plugins/slick/slick-theme.css"); ?>
    <?php echo link_tag("public/css/style.css"); ?>
    <?php echo link_tag("public/css/plugins/toastr/toastr.min.css"); ?>
    <?php echo link_tag("public/css/plugins/chosen/bootstrap-chosen.css"); ?>
    <?php echo link_tag("public/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"); ?>
    <?php echo link_tag("public/css/plugins/jasny/jasny-bootstrap.min.css"); ?>
    <?php echo link_tag("public/css/plugins/datapicker/datepicker3.css"); ?>
    <?php echo link_tag("public/css/plugins/daterangepicker/daterangepicker-bs3.css"); ?>
    <?php echo link_tag("public/css/plugins/select2/select2.min.css"); ?>
    <?php echo link_tag("public/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css"); ?>
    <?php echo link_tag("public/css/plugins/bootstrap-markdown/bootstrap-markdown.min.css"); ?>
    <?php echo link_tag("public/css/plugins/iCheck/custom.css"); ?>
    <?php echo link_tag("public/css/plugins/dataTables/datatables.min.css"); ?>
    <?php echo link_tag("public/css/plugins/jqGrid/ui.jqgrid.css"); ?>
    <?php echo link_tag('public/css/style.css'); ?>
    <?php echo link_tag('public/css/image_view.css'); ?>
    <?php echo link_tag('public/dist/image-uploader.min.css'); ?>
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="<?php echo base_url() ?>public/css/sweet-alert.min.css" />

    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
        var url =  window.location.href;
        var image_url = '<?php echo FILE_UPLOAD_PATH; ?>';
        var product_id_from_edit;
    </script>
    <?php echo script_tag("public/js/jquery-3.1.1.min.js", true); ?>
    <?php echo script_tag("public/js/plugins/ckeditor/ckeditor.js", true); ?>
</head>

<body class="">
<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="rounded-circle" src="<?php
$user_image = user_data('image');
if (!empty($user_image)) {
    echo image_url($user_image);
} else {
    echo image_url('administration/default.png');
}
?>" height="100px" width="100px"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo user_data('username'); ?></span>
                            <span class="text-muted text-xs block">User Role <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <?php foreach (user_role() as $key => $role) {?>
                            <li><a class="dropdown-item" href="#"><?php echo $role->name ?></a></li>
                        <?php }?>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>

                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Administration</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('auth'); ?>"><i class="fa fa-users"></i> <span>Mange </span></a>

                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Orders</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('orders'); ?>"><i class="fa fa-users"></i> <span> Pending Order </span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('orders/confirmed'); ?>"><i class="fa fa-users"></i> <span> Confirmed Order </span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Transaction</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('orders/product_transaction'); ?>"><i class="fa fa-users"></i> <span> Product Transaction </span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('orders/cause_transaction'); ?>"><i class="fa fa-users"></i> <span> Cause Transaction </span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('orders/event_transaction'); ?>"><i class="fa fa-users"></i> <span> Event Transaction </span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Merchendise</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('product'); ?>"><i class="fa fa-puzzle-piece"></i> <span>Proudct</span></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('product/category'); ?>"><i class="fa fa-puzzle-piece"></i> <span>Category</span></a>
                        </li>
                    </ul>
                </li>
                  <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Volunteers</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('volunteers'); ?>"><i class="fa fa-puzzle-piece"></i> <span>manage</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Donors</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('donors'); ?>"><i class="fa fa-puzzle-piece"></i> <span>manage</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i><span class="nav-label">Memebers</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="<?php echo base_url('members'); ?>"><i class="fa fa-puzzle-piece"></i> <span>manage</span></a>
                            <a href="<?php echo base_url('members/designation'); ?>"><i class="fa fa-puzzle-piece"></i> <span>Designation</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" aria-expanded="false"><i class="fa fa-calendar"></i> <span class="nav-label">Events </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li class="">
                            <a href="#" aria-expanded="false"><i class="fa fa-list-ul"></i>Category <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse" aria-expanded="false" style="height: 0px;">
                                <li>
                                    <a href="<?php echo base_url('event_categories'); ?>"><i class="fa fa-sun-o"></i> Manage</a>
                                </li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="#" aria-expanded="false"><i class="fa fa-calendar-o "></i>Events <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level collapse" aria-expanded="false" style="height: 0px;">
                                <li>
                                    <a href="<?php echo base_url('events'); ?>"><i class="fa fa-sun-o"></i>  Manage</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </li>
                  <li>
                    <a href="#" aria-expanded="false"><i class="fa fa-calendar"></i> <span class="nav-label">Projects </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                        <li class="">
                            <a href="<?php echo base_url('projects') ?>" aria-expanded="false"><i class="fa fa-calendar-o "></i>Projects <span class="fa arrow"></span></a>

                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Blog</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('blogs'); ?>">blog</a></li>
                        <li><a href="<?php echo base_url('blogs/category'); ?>">blog category</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Causes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('causes'); ?>">Causes</a></li>
                        <li><a href="<?php echo base_url('causes/category'); ?>">Causes category</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Header Image</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('header_image'); ?>">manage</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('setting/about_us'); ?>">Abut Us</a></li>
                        <li><a href="<?php echo base_url('setting/config'); ?>">Site Config</a></li>
                        <li><a href="<?php echo base_url('setting/slider'); ?>">Slider</a></li>
                        <li><a href="<?php echo base_url('setting/logo'); ?>">Logo</a></li>
                        <li><a href="<?php echo base_url('setting/history'); ?>">History</a></li>
                        <li><a href="<?php echo base_url('setting/mission'); ?>">Mission & Vision</a></li>
                        <li><a href="<?php echo base_url('terms'); ?>">Terms & Conditions</a></li>
                        <li><a href="<?php echo base_url('privacy'); ?>">Privay & Policy</a></li>
                        <li><a href="<?php echo base_url('desclaimer'); ?>">Desclaimer</a></li>
                        <li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </nav>