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
    <h3><?php echo lang('forgot_password_heading'); ?></h3>

<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>



<?php echo form_open("auth/forgot_password", ['class' => "m-t", 'role' => "form"]); ?>

      <div class="form-group">
        <label for="identity"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label> <br />
        <?php echo form_input($identity); ?>
         <div id="infoMessage" class="text-danger"><?php echo $message; ?></div>
   </div>

      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), ['class' => "btn btn-primary"]); ?></p>

<?php echo form_close(); ?>

  </div>
  </div>
  <?php echo script_tag("public/js/jquery-3.1.1.min.js", true); ?>
  <?php echo script_tag("public/js/popper.min.js", true); ?>
  <?php echo script_tag("public/js/bootstrap.js", true); ?>
</body>
</html>