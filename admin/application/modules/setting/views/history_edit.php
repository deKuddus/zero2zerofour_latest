
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
      <h2>History</h2>
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
       <a href="<?php echo base_url('setting/history') ?>" class="btn btn-primary">Manage</a>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
        <form id="history_edit_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="year">History Year</label>
                <input type="hidden" name="history_id" id="history_id" value="<?php echo $history->id; ?>">
                <input type="text" class="form-control" name="year" id="history_year_edit" value="<?php echo $history->year; ?>">
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="history_description_edit">Description</label>
                <textarea  class="form-control" name="description" id="history_description_edit" rows="10"><?php echo $history->description; ?></textarea>
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
