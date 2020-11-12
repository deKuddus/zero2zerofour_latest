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
      <h2>Header Image</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>manage</strong>
        </li>
      </ol>
    </div>
  </div>

  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <?php echo go_back(); ?>
        <table class="table table-striped table-bordered table-hover dataTables-example" >
          <thead>
            <tr>
              <th>ID</th>
              <th>Page Name</th>
              <th>Image</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($header_images as $key => $value) {?>
                <tr>
                  <td><?php echo $value->id; ?></td>
                  <td><?php echo $value->page_name; ?></td>
                  <td><img onclick="view_image(this)" src="<?php echo image_url($value->image); ?>" alt='image' height="80px" width="90px" ></td>
                  <td>
                    <?php if ($value->status == 1) {?>
                      <div class="switch">
                        <div class="onoffswitch">
                          <input type="checkbox" onchange="change_header_image_status(<?php echo $value->id ?>,this)" checked="checked" class="onoffswitch-checkbox status" id="example<?php echo $key; ?>" value="0">
                          <label class="onoffswitch-label" for="example<?php echo $key; ?>">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    <?php } else {?>
                      <div class="switch">
                        <div class="onoffswitch">
                          <input type="checkbox" onchange="change_header_image_status(<?php echo $value->id ?>,this)" class="onoffswitch-checkbox status" id="example<?php echo $key; ?>" >
                          <label class="onoffswitch-label" for="example<?php echo $key; ?>">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    <?php }?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                      <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                        <li>
                          <a href="<?php echo base_url('header_image/edit/' . $value->id); ?>" class="dropdown-item">Edit</a>
                        </li>
                        <li>
                         <!--  <a href="<?php //echo base_url('privacy/delete/' . $value->id); ?>" class="dropdown-item">Delete</a> -->
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php }?>
          </tbody>
          <tfoot>
            <tr>
               <th>ID</th>
              <th>Page Name</th>
              <th>Image</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>
  </div>


</div>
<div class="modal inmodal fade " id="privacy_view" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Privay & Policy</h4>
      </div>
      <div class="modal-body">
        <h4 class="text-center" id="append_privacy_heading"></h4>
        <div class="row" id="append_privacy"></div>
      </div>
    </div>
  </div>
</div>


