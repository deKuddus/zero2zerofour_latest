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
      <h2>Slider</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>manage</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <button data-toggle="modal" data-target="#add_slider_modal" class="btn btn-primary">Add Slider</button>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">
      &nbsp;
    </label>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="slider_list" style="width: 990px !important;" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th></th>
              <th>Image</th>
              <th>Ttitle</th>
              <th>Descrition</th>
              <th>Url</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th><input type="checkbox" class="check_all_slider" value="1">&nbsp;&nbsp;<button class="btn btn-danger btn-circle " type="button" onclick="delete_multiple_slider(this)"><i class="fa fa-trash"></i></button></th>
              <th>Image</th>
              <th>Ttitle</th>
              <th>Descrition</th>
              <th>Url</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal inmodal fade" id="add_slider_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">new slider</h4>
      </div>
      <form id="new_slider_add_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="title">Slider Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="slider title">
                <div class="form-error text-danger"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="url">Product Url on Slider</label>
                <input type="text" class="form-control" name="url" id="url" placeholder="advertise url on slider">
                 <div class="form-error text-danger"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
                 <div class="form-error text-danger"></div>
              </div>
            </div>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Slider Image</label>
                    <label for="slider_image"><img  id="slider_image_preview"  src="<?php echo FILE_UPLOAD_PATH; ?>/slider_image/default.png" alt="default image" height="200px" width="100%"></i></label>
                    <input type="file" id="slider_image" name="slider_image" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none;">
                    <div class="form-error text-danger"></div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-9"></div>
            <div class="modal-footer col-md-3">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal inmodal fade" id="edit_slider_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">edit slider</h4>
      </div>
      <form id="slider_edit_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="slider_title_edit">Slider Title</label>
                <input type="hidden" name="slider_id" id="slider_id">
                <input type="text" class="form-control" name="title" id="slider_title_edit" placeholder="slider title">
                <div class="form-error text-danger"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="slider_url_edit">Product Url on Slider</label>
                <input type="text" class="form-control" name="url" id="slider_url_edit" placeholder="advertise url on slider">
                 <div class="form-error text-danger"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="slider_description_edit">Description</label>
                <textarea class="form-control" name="description" id="slider_description_edit"></textarea>
                 <div class="form-error text-danger"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="">Slider Image</label><br>
                    <label for="slider_image_edit"> <img  id="slider_image_preview_edit"  src="" alt="default image" height="200px" width="100%"></i></label>
                  <input type="file" id="slider_image_edit" name="slider_image" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none;">
                   <div class="form-error text-danger"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9"></div>
            <div class="modal-footer col-md-3">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>