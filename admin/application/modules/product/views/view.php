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
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-md-10">
    <h2>product detail</h2>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
       <a href="<?php echo base_url('/') ?>">Home</a>
     </li>
     <li class="breadcrumb-item">
      <a>product</a>
    </li>
    <li class="breadcrumb-item active">
      <strong>detail</strong>
    </li>
  </ol>
</div>
<div class="col-md-2"><br>
  <div class="btn-group">
    <?php echo go_back(); ?>
    <a href="<?php echo base_url('product/edit/' . $product->id); ?>"><button class="btn btn-info"><i class="fa fa-edit"></i>Edit</button></a>
  </div>
</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
 <div class="ibox product-detail">
  <div class="ibox-content">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="kuddus">
          <?php
$new_image_array = array();
foreach ($optional_images as $image) {
    $new_image_array[] = $image->picture;
}
array_push($new_image_array, $product->feature_picture);
foreach ($new_image_array as $key => $value) {?>
            <div>
             <img src="<?php echo image_url($value); ?>" onclick="view_image(this)" alt="product image" height="300px" width="300px">
           </div>
         <?php }?>
       </div>
     </div>
     <div class="col-md-3"></div>
   </div>
   <div class="row">
     <div class="table-responsive">
      <table  class="table table-striped table-bordered table-hover" >
        <thead>
          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Sale Price</th>
            <th>Purchase Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Discount</th>
            <th>Tax</th>

            <?php if (!empty($product->color)) {?>
              <th>Color</th>
            <?php }?>
            <?php if (!empty($product->size)) {?>
              <th>Size</th>
            <?php }?>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->sale_price; ?></td>
            <td><?php echo $product->purchase_price; ?></td>
            <td><?php echo $product->quantity; ?></td>
            <td>
              <?php foreach ($category as $key => $value) {
    if ($product->category_id == $value->id) {
        echo $value->category_name;
    }
}?>
            </td>
            <td>
              <?php
foreach ($category as $key => $value) {
    if ($product->category_id == $value->id) {
        echo $value->category_name;
    }
}
?>
            </td>
            <td><?php echo $product->discount; ?></td>
            <td>
              <?php
foreach ($types as $key => $type_value) {
    if ($product->discount_type == $type_value->id) {
        echo $type_value->symbol;
    }
}
?>
            </td>
            <td><?php echo $product->tax; ?></td>
            <?php if (!empty($product->color)) {
    ?>
              <td>
                <?php
$color = json_decode($product->color);
    foreach ($color as $key => $value) {
        foreach ($colors as $key => $color_value) {
            if ($color_value->id == $value) {
                echo "<span class='label label-info'>" . $color_value->value . "</span>&nbsp;";
            }
        }
    }
    ?>
              </td>
            <?php }?>

            <?php if (!empty($product->size)) {
    ?>
              <td>
                <?php
$size = json_decode($product->size);
    foreach ($size as $key => $value) {
        foreach ($sizes as $key => $sizes_value) {
            if ($sizes_value->id == $value) {
                echo "<span class='label label-info'>" . $sizes_value->value . "</span>&nbsp;";
            }
        }
    }
    ?>
              </td>
            <?php }?>
            <td><?php echo $product->description; ?></td>
            <td><a href="<?php echo base_url('product/edit/' . $product->id); ?>">EDIT</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>