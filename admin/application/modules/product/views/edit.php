<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
.dt-buttons{
  float: right;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}


/* Add Animation */
.modal-content {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
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
          <strong>edit</strong>
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
      <form id="edit_product" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
              <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control ', 'placeholder' => 'Enter Product Name', 'type' => 'text', 'value' => $product->name]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Slug</label>
              <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control ', 'type' => 'text', 'value' => $product->slug]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Category</label>
              <?php
$selected = array($product->category_id);
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
              <?php echo form_input(['name' => 'purchase_price', 'id' => 'purchase_price', 'class' => 'form-control', 'placeholder' => 'Enter Purchase price', 'type' => 'number', 'value' => $product->purchase_price, 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Sale Price</label>
              <?php echo form_input(['name' => 'sale_price', 'id' => 'sale_price', 'class' => 'form-control', 'placeholder' => 'Enter Sale  price', 'type' => 'number', 'value' => $product->sale_price, 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Discount</label>
              <?php echo form_input(['name' => 'discount', 'id' => 'discount', 'class' => 'form-control', 'placeholder' => 'Enter Discount', 'type' => 'number', 'value' => $product->discount, 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Discount Type</label>
              <?php
$selected = array($product->discount_type);
echo form_dropdown(['name' => 'discount_type'], [$types], [$selected], ['id' => 'discount_type', 'class' => 'form-control chosen-select', 'tabindex' => '4']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Tax</label>
              <?php echo form_input(['name' => 'tax', 'id' => 'tax', 'class' => 'form-control', 'placeholder' => 'Enter tax rate', 'type' => 'number', 'value' => $product->tax, 'min' => 1]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Color</label>
              <?php
$selected = json_decode($product->color);
echo form_dropdown(['name' => 'color[]'], [$colors], $selected, ['id' => 'color', 'class' => 'form-control chosen-select', 'multiple' => 'multiple', 'tabindex' => '4', 'data-placeholder' => 'Choose color']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Size</label>
              <?php
$selected = json_decode($product->size);
echo form_dropdown(['name' => 'size[]'], [$sizes], $selected, ['id' => 'size', 'class' => 'form-control select2_demo_2', 'multiple' => 'multiple', 'tabindex' => '4', 'data-placeholder' => 'Choose size']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Product Description</label>
              <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter Product Description', 'value' => $product->description, 'rows' => 5]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-center">
            <div class="form-group"><label>Product Feature Image : </label><br>
              <label for="product_feature_image"><img class="product_feature_image" id="product_feature_image_view"  src="<?php echo FILE_UPLOAD_PATH . $product->feature_picture; ?>" alt="default image" height="300px" width="100%" onclick="view_image(this)"></label>
              <input type="file" id="product_feature_image" name="product_feature_image" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none;">
            </div>
          </div>
          <div class="col-md-6"><br>
            <div class="input-images"></div>
          </div>
        </div>
        <?php if (sizeof($optional_images) > 0): ?>
        <div class="row" id="product_optional_image">

        </div>
      <?php endif?>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group pull-right">
              <a href="<?php echo site_url('product'); ?>">
                <button class="btn btn-primary" type="button" ><i class="fa fa-minus-square"></i>&nbsp; Cancel </button>
              </a>
              <button type="submit"  class="btn btn-primary" class="btn btn-success" id="edit_submit_button">Save</button>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  var product_id_from_edit = '<?php echo $product->id; ?>';
</script>




<!-- /page content -->
