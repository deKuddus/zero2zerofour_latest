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
      <h2>About Us</h2>
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
        <a href="<?php echo base_url('setting/about_us') ?>" class="btn btn-primary">Manage</a>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
     <form id="about_us_edit_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="title">About Us Title</label>
                <input type="hidden" name="about_us_id" id="about_us_id" value="<?php echo $about_us->id; ?>">
                <input type="text" class="form-control" name="title" id="about_us_title_edit" value="<?php echo $about_us->title; ?>">
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="objective">Objective of our Organization</label>
                <input type="text" class="form-control" name="objective" id="objective" value="<?php echo $about_us->objective; ?>">
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea  class="form-control " name="description" id="" rows="10"><?php echo $about_us->description; ?></textarea>
                <div class="form-error text-danger"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9"></div>
            <div class="modal-footer col-md-3">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
              <button type="submit" id="save_status" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

