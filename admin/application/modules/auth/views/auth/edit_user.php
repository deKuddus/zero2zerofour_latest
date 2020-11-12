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

        <?php echo form_open(uri_string(), ['enctype' => 'multipart/form-data']); ?>

        <div class="form-group">
          <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br />
          <?php echo form_input($first_name); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br />
          <?php echo form_input($last_name); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_company_label', 'company'); ?> <br />
          <?php echo form_input($company); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_phone_label', 'phone'); ?> <br />
          <?php echo form_input($phone); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_password_label', 'password'); ?> <br />
          <?php echo form_input($password); ?>
        </div>

        <div class="form-group">
          <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br />
          <?php echo form_input($password_confirm); ?>
        </div>

        <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
          <?php foreach ($groups as $group): ?>
            <label class="checkbox">
              <?php
$gID     = $group['id'];
$checked = null;
$item    = null;
foreach ($currentGroups as $grp) {
    if ($gID == $grp->id) {
        $checked = ' checked="checked"';
        break;
    }
}
?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
              <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
            </label>
          <?php endforeach?>

        <?php endif?>
        <div class="form-group">
          <label>Administrator Photo</label><br>
          <label for="administrator_photo"><img src="<?php echo image_url($user->image); ?>" id="administrator_photopreview" height="auto" width="100%" style="border-radius: 5px; "></label>
          <input type="file" name="administrator_photo" id="administrator_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
          <?php echo form_error('administrator_photo', '<div class="text-danger">', '</div>'); ?>
        </div>
        <?php echo form_hidden('id', $user->id); ?>
        <?php echo form_hidden($csrf); ?>

        <div class="form-group"><?php echo form_submit('submit', lang('edit_user_submit_btn'), ['class' => 'btn btn-primary pull-right']); ?></div>

        <?php echo form_close(); ?>
      </div>
      <div class="col-md-2"></div>

    </div>
  </div>
</div>
</div>