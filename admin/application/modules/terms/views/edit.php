<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Terms and Conditions</h2>
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
        <a href="<?php echo base_url('terms'); ?>" class="btn btn-primary">Manage Terms and Conditions</a>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">

          <form method="post" class="form-horizontal form-label-left" action="<?php echo base_url('terms/update'); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label>Terms and Condition Heading</label>
                <?php echo form_input(['name' => 'terms_heading', 'id' => 'terms_heading', 'class' => 'form-control', 'value' => $term->terms_heading]); ?>
                <div class="form-error text-danger"></div>
              </div>
            <div class="form-group">
              <label>Terms and Condition</label>
              <input type="hidden" name="terms_id" value="<?php echo $term->id; ?>">
              <?php echo form_textarea(['name' => 'terms', 'id' => 'terms', 'class' => 'form-control summernote', 'placeholder' => 'write here your terms and conditions', 'value' => $term->terms]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="<?php echo site_url('terms'); ?>">
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
