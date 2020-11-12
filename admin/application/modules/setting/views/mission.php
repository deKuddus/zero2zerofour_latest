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
      <h2>Mission & Vission</h2>
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
        <!-- <a href="<?php //echo base_url('setting/mission') ?>" class="btn btn-primary">Manage</a> -->
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
     <form id="mission_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="mission">Mission</label>
                <input type="hidden" name="mission_id" id="mission_id" value="<?php echo $mission->id; ?>">
                <textarea  class="form-control" name="mission" id="mission" rows="10"><?php echo $mission->mission; ?></textarea>
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="vision">Description</label>
                <textarea  class="form-control" name="vision" id="vision" rows="10"><?php echo $mission->vision; ?></textarea>
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="theme_title">Company's Slogan</label>
                <textarea  class="form-control" name="theme_title" id="theme_title" rows="10"><?php echo $mission->theme_title; ?></textarea>
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

