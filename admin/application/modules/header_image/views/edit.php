<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Header Image</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>edit</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <a href="<?php echo base_url('header_image'); ?>" class="btn btn-primary">Manage Header Image</a>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">

      <form method="post" class="form-horizontal form-label-left" action="<?php echo base_url('header_image/update/' . $header_image->id); ?>" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="form-group">
              <label>Page Name </label>
              <?php echo form_input(['readonly' => 'readonly', 'class' => 'form-control', 'value' => $header_image->page_name]); ?>
            </div>

            <input type="hidden" name="header_image_id" value="<?php echo $header_image->id; ?>">

            <div class="form-group">
              <label>Image :</label><br>
              <label for="header_image"><img src="<?php echo image_url($header_image->image); ?>" id="header_image_preview" height="300px" width="100%" style="border-radius: 5px; "></label>
              <input type="file" name="header_image" id="header_image" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
              <?php echo form_error('header_image', '<div class="text-danger">', '</div>'); ?>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>

        <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <a href="<?php echo site_url('privacy'); ?>">
              <button class="btn btn-primary" type="button" ><i class="fa fa-minus-square"></i>&nbsp; Cancel </button>
            </a>
            <button type="submit"  class="btn btn-primary" class="btn btn-success" id="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
