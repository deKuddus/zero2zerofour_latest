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
    <h3><?php echo lang('login_heading'); ?></h3>
    <p><?php echo lang('login_subheading'); ?></p>

    <?php echo form_open("auth/login", ['class' => "m-t", 'role' => "form"]); ?>

 <div class="form-group">
      <?php echo form_input($identity); ?>
      <?php echo form_error('identity', '<div class="text-danger">', '</div>'); ?>
</div>

 <div class="form-group">
      <?php echo form_input($password); ?>
      <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
    </div>

 <div class="form-group">
      <label for="remember"><?php echo lang('login_remember_label', 'remember'); ?></label>
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
 </div>


    <p><?php echo form_submit('submit', lang('login_submit_btn'), ['class' => "btn btn-primary block full-width m-b"]); ?></p>

    <?php echo form_close(); ?>

    <p><a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a></p>


  </div>
  </div>
  <?php echo script_tag("public/js/jquery-3.1.1.min.js", true); ?>
  <?php echo script_tag("public/js/popper.min.js", true); ?>
  <?php echo script_tag("public/js/bootstrap.js", true); ?>
</body>
</html>