<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->
<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Causes</h2>
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
        <a href="<?php echo base_url('causes'); ?>" class="btn btn-primary">Manage Causes</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <form id="create_causes" method="post" class="form-horizontal form-label-left">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Cause Title</label>
              <?php echo form_input(['name' => 'title', 'id' => 'title', 'class' => 'form-control ', 'placeholder' => 'Enter cause title', 'type' => 'text', 'value' => '']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Cause Slug</label>
               <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control ', 'placeholder' => 'Enter Cause slug', 'type' => 'text', 'value' => '']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Cause Category</label>
              <?php
$selected = array();
echo form_dropdown(['name' => 'category'], [$category], [$selected], ['id' => 'blog_category_id', 'class' => 'form-control']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Goal Fund</label>
              <?php
echo form_input(['name' => 'goal_fund', 'id' => 'goal_fund', 'class' => 'form-control', 'placeholder' => 'Enter Cause Goal Fund Amount', 'type' => 'number']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
           <div class="col-md-6">
             <div class="form-group">
               <label>Cause Short Description</label>
               <?php echo form_textarea(['name' => 'short_description', 'id' => 'short_description', 'class' => 'form-control ', 'placeholder' => 'Enter short description', 'rows' => 9]); ?>
               <div class="form-error text-danger"></div>
             </div>
           </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Cause Image</label>
              <div class="blog_container">
                <span>
                  <label for="causes_images"><img class="causes_image" id="causes_image_preview"  src="<?php echo FILE_UPLOAD_PATH; ?>/causes_images/default.png" alt="default image" height="200px" width="200px"></label>
                </span>
                <input type="file" id="causes_images" name="causes_images" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Cause Content</label>
              <?php echo form_textarea(['name' => 'content', 'id' => 'content', 'class' => 'form-control', 'placeholder' => 'Enter Product Description', 'rows' => 10]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group pull-right">
                <a href="<?php echo site_url('causes'); ?>">
                  <button class="btn btn-primary" type="button" ><i class="fa fa-minus-square"></i>&nbsp; Cancel </button>
                </a>
                <button type="submit"  class="btn btn-primary" class="btn btn-success" id="submit">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- /page content -->
