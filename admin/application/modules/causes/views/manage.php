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
      <h2>CAUSES</h2>
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
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> back</a>
        <a href="<?php echo base_url('causes/create'); ?>" class="btn btn-primary">Create Causes</a>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="causes_list" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th></th>
              <th>Image</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Category</th>
              <th>Goal Fund</th>
              <th>Raised Fund</th>
              <th>Status</th>
              <th>Is Featured</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th><input type="checkbox" class="causes_select_all" value="1">&nbsp;&nbsp;<button class="btn btn-danger btn-circle " type="button" onclick="delete_multiple_causes(this)"><i class="fa fa-trash"></i></button></th>
              <th>Image</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Category</th>
              <th>Goal Fund</th>
              <th>Raised Fund</th>
              <th>Status</th>
              <th>Is Featured</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal inmodal fade" id="full_causes" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content " style="width: 1228px;left: -26%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
              <div class="ibox-content p-xl">
                <div class="row" id="causes_view">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
