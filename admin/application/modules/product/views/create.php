<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <style>
  .dt-buttons{
    float: right;
  }
</style>
<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>PRODUCTS</h2>
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
        <a href="<?php echo base_url('product'); ?>" class="btn btn-primary">Manage Product</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <form id="add_product" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control ', 'placeholder' => 'Enter Product Name', 'type' => 'text', 'value' => '']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Slug</label>
              <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control ', 'type' => 'text', 'value' => '']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Category</label>
              <?php
$selected = array();
echo form_dropdown(['name' => 'category_id'], [$categories], [$selected], ['id' => 'category_id', 'class' => 'form-control chosen-select']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Sub Category</label>
              <select name="sub_category_id" id="sub_category_id" class="form-control " data-placeholder="select sub category" style="display: inline !important; "></select>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Purchase Price</label>
              <?php echo form_input(['name' => 'purchase_price', 'id' => 'purchase_price', 'class' => 'form-control', 'placeholder' => 'Enter Purchase price', 'type' => 'number', 'value' => '', 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Sale Price</label>
              <?php echo form_input(['name' => 'sale_price', 'id' => 'sale_price', 'class' => 'form-control', 'placeholder' => 'Enter Sale  price', 'type' => 'number', 'value' => '', 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Discount</label>
              <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control', 'placeholder' => 'Enter Discount', 'type' => 'number', 'value' => '', 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Discount Type</label>
              <?php
$selected = array();
echo form_dropdown(['name' => 'discount_type'], [$types], [$selected], ['id' => 'discount_type', 'class' => 'form-control chosen-select', 'tabindex' => '4']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Tax</label>
              <?php echo form_input(['name' => 'tax', 'id' => 'tax', 'class' => 'form-control', 'placeholder' => 'Enter tax rate', 'type' => 'number', 'value' => '', 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Color</label>
              <?php
echo form_dropdown(['name' => 'size[]'], [$sizes], [$selected], ['id' => 'size', 'class' => 'form-control chosen-select', 'multiple' => 'multiple', 'tabindex' => '4', 'data-placeholder' => 'Choose size']); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Size</label>
              <?php
$selected = array();
echo form_dropdown(['name' => 'size[]'], [$sizes], [$selected], ['id' => 'size', 'class' => 'form-control select2_demo_2', 'multiple' => 'multiple', 'tabindex' => '4', 'data-placeholder' => 'Choose size']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Product Description</label>
              <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter Product Description', 'value' => '', 'rows' => 5]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"> <label>Product Feature Image :</label><br>
              <label for="product_feature_image"><img class="product_feature_image" id="product_feature_image_view"  src="<?php echo image_url('administration/default.png'); ?>" alt="default image" height="auto" width="100%"></label>
              <input type="file" id="product_feature_image" name="product_feature_image" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none;">
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6"><br>
            <div class="input-images"></div>
          </div>
        </div>
          <br>
          <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="<?php echo site_url('product'); ?>">
                  <button class="btn btn-primary" type="button" ><i class="fa fa-minus-square"></i>&nbsp; Cancel </button>
                </a>
                <button type="submit"  class="btn btn-primary" class="btn btn-success" id="submit">Save</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>





<!-- /page content -->
