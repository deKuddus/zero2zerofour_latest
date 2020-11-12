<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "Login"; ?></title>
  <?php echo link_tag('public/css/bootstrap.min.css'); ?>
  <?php echo link_tag('public/font-awesome/css/font-awesome.css'); ?>
  <?php echo link_tag('public/css/animate.css'); ?>
  <?php echo link_tag('public/css/style.css'); ?>


</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
    <h3><?php echo lang('reset_password_heading'); ?></h3>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open('auth/reset_password/' . $code, ['class' => "m-t", 'role' => "form"]); ?>


 <div class="form-group">
    <label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?></label> <br />
    <?php echo form_input($new_password); ?>
</div>


 <div class="form-group">
    <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?> <br />
    <?php echo form_input($new_password_confirm); ?>
 </div>

  <?php echo form_input($user_id); ?>
  <?php echo form_hidden($csrf); ?>

  <p><?php echo form_submit('submit', lang('reset_password_submit_btn'), ['class' => "btn btn-primary"]); ?></p>

<?php echo form_close(); ?>

  </div>
  </div>
  <?php echo script_tag("public/js/jquery-3.1.1.min.js", true); ?>
  <?php echo script_tag("public/js/popper.min.js", true); ?>
  <?php echo script_tag("public/js/bootstrap.js", true); ?>
</body>
</html>