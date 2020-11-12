  <?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>CATEGORIES</h2>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_categoires_modal">ADD CATEGORIES</button>
      </div>
    </div>
  </div>
  <style>
  .dt-buttons{
    float: right;
  }
</style>
  <div class="clearfix"></div>

  <div class="ibox ">
    <div class="ibox-title">
      <h5>CATEGORIES LIST</h5>
    </div>
    <div class="ibox-content">

      <div class="table-responsive">
        <table id="event_categories_list" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th></th>
              <th>ID</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th><input type="checkbox" class="categories_select_all" value="1">&nbsp;&nbsp;<button class="btn btn-danger " type="button" onclick="delete_multiple_categories(this)"><i class="fa fa-trash"></i></button></th>
              <th>ID</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>
  </div>
</div>





 <div class="modal inmodal fade " id="add_categoires_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">ADD CATEGORIES</h4>
      </div>

      <div class="modal-body">
       <form action="" id="categories_create" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-content">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Full Name</label>
                      <?php echo form_input(['name' => 'name', 'id' => 'category_name', 'class' => 'form-control', 'placeholder' => 'category name', 'type' => 'text', 'value' => '']); ?>
                      <div class="form-error text-danger"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
          <button type="submit" id="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<div class="modal inmodal fade " id="event_categories_edit_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">EDIT CATEGOIRES</h4>
      </div>
      <div class="modal-body">
       <form action="" id="categories_edit" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-content">
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="form-group">
                      <label>Full Name</label>
                      <?php echo form_input(['name' => 'name', 'id' => 'category_name_edit', 'class' => 'form-control', 'placeholder' => 'category name', 'type' => 'text', 'value' => '']); ?>
                      <div class="form-error text-danger"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
          <button type="submit" id="submitEdit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
