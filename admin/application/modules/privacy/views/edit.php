<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Privacy & Policy</h2>
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
        <a href="<?php echo base_url('privacy'); ?>" class="btn btn-primary">Manage Privacy & Policy</a>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">

          <form method="post" class="form-horizontal form-label-left" action="<?php echo base_url('privacy/update'); ?>">
            <div class="col-md-12">
              <div class="form-group">
              <label>Privacy & Policy Heading</label>
              <?php echo form_input(['name' => 'privacy_heading', 'id' => 'privacy_heading', 'class' => 'form-control', 'value' => $privacy->privacy_heading]); ?>
              <div class="form-error text-danger"></div>
            </div>
            <div class="form-group">
              <label>Privacy & Policy</label>
              <input type="hidden" name="privacy_id" value="<?php echo $privacy->id; ?>">
              <?php echo form_textarea(['name' => 'privacy', 'id' => 'privacy', 'class' => 'form-control summernote', 'placeholder' => 'write here your privacy and conditions', 'value' => $privacy->privacy]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
</div>


