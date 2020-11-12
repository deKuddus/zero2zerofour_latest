<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Donors</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>create</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <a href="<?php echo base_url('donors'); ?>" class="btn btn-primary">Manage Donors</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <form id="donor_form" method="post" class="form-horizontal form-label-left">
          <h3>NEW DONOR REGISTRAION FORM </h3>
          <h4 >The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
          <div class="form-group">
            <label for="name">Full Name <code class="danger-text">*</code> </label>
            <input type="text" id="name" name="name" class="form-control">
            <div class="form-error danger-text"></div>
          </div>
          <div class="form-group">
            <label for="email">Email <code class="danger-text">*</code> </label>
            <input type="email" id="email" name="email" class="form-control">
            <div class="form-error danger-text"></div>
          </div>
          <div class="form-group">
            <label for="tel">Phone <code class="danger-text">*</code> </label>
            <input type="tel" id="tel" name="mobile" class="form-control">
            <div class="form-error danger-text"></div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Upload Donor Photo <code class="danger-text">*</code> </label><br>
                <label for="donor_photo"><img src="<?php echo image_url('member/default.png'); ?>" id="donor_photo_preview" height="150px" width="100%" style="border-radius: 5px; "></label>
                <input type="file" name="donor_photo" id="donor_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                <div class="form-error danger-text"></div>
              </div>
            </div>
          </div>
          <div class="row  pull-right">
            <input type="submit" value="Create Member" class="btn btn-primary">
          </div>
        </form>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
</div>
</div>
