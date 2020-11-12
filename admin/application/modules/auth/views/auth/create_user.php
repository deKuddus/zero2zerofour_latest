<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>ADMINISTRATION</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>Create</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">

      </div>
    </div>
  </div>
  <style>
  .dt-buttons{
    float: right;
  }
</style>
<div class="clearfix"></div>

<div class="ibox ">
  <div class="ibox-title">
    <h5>Administration List</h5>
  </div>
  <div class="ibox-content">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <?php echo form_open("auth/create_user", ['id' => "user_create_form", 'enctype' => 'multipart/form-data']); ?>

        <div class="form-group">
          <?php echo lang('create_user_fname_label', 'first_name'); ?> <br />
          <?php echo form_input($first_name); ?>
          <div class="form_error text-danger"></div>
          <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
          <?php echo lang('create_user_lname_label', 'last_name'); ?> <br />
          <?php echo form_input($last_name); ?>
          <div class="form_error text-danger"></div>
          <?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
        </div>

        <?php
if ($identity_column !== 'email') {
    echo '<p>';
    echo lang('create_user_identity_label', 'identity');
    echo '<br />';
    echo form_error('identity');
    echo form_input($identity);
    echo '</div>';
    echo form_error('identity', '<div class="text-danger">', '</div>');
}
?>

        <div class="form-group">
          <?php echo lang('create_user_company_label', 'company'); ?> <br />
          <?php echo form_input($company); ?>
          <?php echo form_error('company', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
          <?php echo lang('create_user_email_label', 'email'); ?> <br />
          <?php echo form_input($email); ?>
          <div class="form_error text-danger"></div>
          <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
          <?php echo lang('create_user_phone_label', 'phone'); ?> <br />
          <?php echo form_input($phone); ?>
          <?php echo form_error('phone', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
          <?php echo lang('create_user_password_label', 'password'); ?> <br />
          <?php echo form_input($password); ?>
          <div class="form_error text-danger"></div>
          <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group">
          <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
          <?php echo form_input($password_confirm); ?>
          <div class="form_error text-danger"></div>
          <?php echo form_error('password_confirm', '<div class="text-danger">', '</div>'); ?>
        </div>


          <div class="form-group">
            <label>Administrator Photo</label><br>
            <label for="administrator_photo"><img src="<?php echo image_url('member/default.png'); ?>" id="administrator_photopreview" height="auto" width="100%" style="border-radius: 5px; "></label>
            <input type="file" name="administrator_photo" id="administrator_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
           <?php echo form_error('administrator_photo', '<div class="text-danger">', '</div>'); ?>
          </div>

        <div class="form-group">
          <?php echo form_submit('submit', lang('create_user_submit_btn'), ['class' => "btn btn-primary pull-right", 'id' => "create_user"]); ?>
        </div>
        <?php echo form_close(); ?>
      </div>
      <div class="col-md-2"></div>

    </div>
  </div>
</div>
</div>