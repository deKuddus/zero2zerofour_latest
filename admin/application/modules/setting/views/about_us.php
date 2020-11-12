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
          <strong>manage</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <button data-toggle="modal" data-target="#add_new_about_us" class="btn btn-primary">Add About</button>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="about_us_list"  class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th>Title</th>
              <th>Objective</th>
              <th>About</th>
              <th>Action</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Objective</th>
              <th>About</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal inmodal fade" id="add_new_about_us" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">ADD ABOUT US FORM</h4>
      </div>
      <form id="new_about_us_add_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="title">About Us Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="about us title">
                <div class="form-error text-danger"></div>
              </div>
               <div class="form-group">
                <label for="objective">Objective of our Organization</label>
                <input type="text" class="form-control" name="objective" id="objective" placeholder="about us objective">
                <div class="form-error text-danger"></div>
              </div>
              <div class="form-group">
                <label for="title">Description</label>
                <textarea  class="form-control" name="description" id="description" rows="10"></textarea>
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