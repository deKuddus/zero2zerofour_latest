<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeroTwo ZeroFour | 404 Error</title>
    <?php echo link_tag('public/css/bootstrap.min.css'); ?>
    <?php echo link_tag('public/font-awesome/css/font-awesome.css'); ?>
    <?php echo link_tag('public/css/animate.css'); ?>
    <?php echo link_tag('public/css/style.css'); ?>

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            <a href="<?php echo base_url('/') ?>" class="btn btn-primary btn-outline dark" style="font-size: 25px;"> <i class="fa fa-home"></i> &nbsp;Go Home</a>
        </div>
    </div>

    <!-- Mainly scripts -->
    <?php echo script_tag('public/js/jquery-3.1.1.min.js', true); ?>
    <?php echo script_tag('public/js/popper.min.js', true); ?>
    <?php echo script_tag('public/js/bootstrap.js', true); ?>

</body>

</html>
