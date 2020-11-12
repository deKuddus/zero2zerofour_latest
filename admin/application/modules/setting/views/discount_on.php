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
      <h2>Slider</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">slider</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>manage</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <button data-toggle="modal" data-target="#add_discount_on_modal" class="btn btn-primary">Add Slider</button>
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
        <table id="discount_on_list" style="width: 990px !important;" class="table table-striped table-bordered table-hover" >
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
              <th><input type="checkbox" class="check_all_discount_on" value="1">&nbsp;&nbsp;<button class="btn btn-danger btn-circle " type="button" onclick="delete_multiple_discount_on(this)"><i class="fa fa-trash"></i></button></th>
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

<div class="modal inmodal fade" id="add_discount_on_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Discount on</h4>
      </div>
      <form id="new_discount_on_add_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="eg. all_product, product">
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
        </form>
      </div>
    </div>
  </div>


  <div class="modal inmodal fade" id="edit_discount_on_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">edit discount on</h4>
        </div>
        <form id="new_discount_on_edit_form" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="">
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