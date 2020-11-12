<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Desclaimer</h2>
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
        <a href="<?php echo base_url('desclaimer'); ?>" class="btn btn-primary">Manage Desclaimers</a>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">

          <form method="post" class="form-horizontal form-label-left" action="<?php echo base_url('desclaimer/store'); ?>">
            <div class="col-md-12">
              <div class="form-group">
                <label>Desclaimer Heading</label>
                <?php echo form_input(['name' => 'desclaimer_heading', 'id' => 'desclaimer_heading', 'class' => 'form-control', 'placeholder' => 'Terms and Condition Heading']); ?>
                <div class="form-error text-danger"></div>
              </div>
            <div class="form-group">
              <label>Desclaimer Body</label>
              <?php echo form_textarea(['name' => 'desclaimer', 'id' => 'desclaimer', 'class' => 'form-control summernote', 'placeholder' => 'write here your desclaimer and conditions', 'style' => "width:100%"]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="<?php echo base_url('desclaimer'); ?>">
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
