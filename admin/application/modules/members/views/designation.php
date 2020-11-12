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
      <h2>Member Designation</h2>
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
        <button data-toggle="modal" data-target="#add_designation_modal" class="btn btn-primary">Create Designation</button>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="designation_list" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th>No.</th>
              <th>Designation Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>No.</th>
              <th>Designation Name</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal inmodal fade" id="add_designation_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h3> Create Designation </h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <form method="post" id="designation_create_form">
      <div class="modal-body">
            <div class="wrapper wrapper-content animated fadeInRight">
              <div class="ibox-content p-xl">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="designation_name">Designation Name</label>
                      <input type="text" class="form-control" name="designation_name" id="designation_name" placeholder="enter designation name">
                      <div class="form-errror" style="color: red;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<div class="modal inmodal fade" id="edit_designation_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <form method="post" id="designation_edit_form">
      <div class="modal-body">
            <div class="wrapper wrapper-content animated fadeInRight">
              <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="designation_id" id="designation_id_edit">
                      <div class="form-group">
                        <input type="text" class="form-control" name="designation_name" id="designation_name_edit">
                        <div class="form-errror" style="color: red;"></div>
                      </div>
                    </div>
                      <input type="hidden" name="category_id" id="category_id" value="">
                </div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>