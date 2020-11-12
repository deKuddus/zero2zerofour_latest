<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | SSOFTBD </title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url('public/admin_theme/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo site_url('public/admin_theme/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo site_url('public/admin_theme/vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">

    <?php
        if (isset($form_page)) {
    ?>
            <!-- bootstrap-wysiwyg -->
            <link href="<?php echo site_url('public/admin_theme/vendors/google-code-prettify/bin/prettify.min.css') ?>" rel="stylesheet">
            <!-- Select2 -->
            <link href="<?php echo site_url('public/admin_theme/vendors/select2/dist/css/select2.min.css') ?>" rel="stylesheet">
            <!-- Switchery -->
            <link href="<?php echo site_url('public/admin_theme/vendors/switchery/dist/switchery.min.css') ?>" rel="stylesheet">
            <!-- starrr -->
            <link href="<?php echo site_url('public/admin_theme/vendors/starrr/dist/starrr.css') ?>" rel="stylesheet">
    <?php
        }
    ?>

    <?php
        if (isset($form_advanced_page)) {
    ?>
            <!-- Ion.RangeSlider -->
            <link href="<?php echo site_url('public/admin_theme/vendors/normalize-css/normalize.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/ion.rangeSlider/css/ion.rangeSlider.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css') ?>" rel="stylesheet">
            <!-- Bootstrap Colorpicker -->
            <link href="<?php echo site_url('public/admin_theme/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') ?>" rel="stylesheet">

            <link href="<?php echo site_url('public/admin_theme/vendors/cropper/dist/cropper.min.css') ?>" rel="stylesheet">
    <?php
        }
    ?>

    <?php
        if (isset($form_upload_page)) {
    ?>
            <!-- Dropzone.js -->
            <link href="<?php echo site_url('public/admin_theme/vendors/dropzone/dist/min/dropzone.min.css') ?>" rel="stylesheet">
    <?php
        }
    ?>

    <?php
        if (isset($tables_dynamic_page)) {
    ?>
            <!-- Datatables -->
            <link href="<?php echo site_url('public/admin_theme/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
            <link href="<?php echo site_url('public/admin_theme/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">
    <?php
        }
    ?>

    <?php
        if (isset($other_charts_page)) {
    ?>
            <!-- jVectorMap -->
            <link href="<?php echo site_url('public/admin_theme/css/maps/jquery-jvectormap-2.0.3.css') ?>" rel="stylesheet"/>
    <?php
        }
    ?>

    <!-- Custom Theme Style -->
    <link href="<?php echo site_url('public/admin_theme/css/custom.css') ?>" rel="stylesheet">
  </head>

  <body class="nav-md">