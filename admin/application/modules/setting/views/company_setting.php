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
      <h2>Site Config</h2>
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
  <div class="clearfix"></div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="config_list" style="width: 990px !important;" class="table table-striped table-bordered table-hover" >
          <thead>
            <tr>
              <th>ID</th>
              <th>Ttitle</th>
              <th>Value</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($configs as $key => $config) {
    ?>
              <tr>
                <td><?php echo $config->id ?></td>
                <td><?php echo $config->title ?></td>
                <td><?php if (strlen($config->value) > 100) {
        echo textShort($config->value, 50);
    } else {
        echo $config->value;
    }?></td>
                <td>
                  <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                    <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                      <li><a href="javascript:void(0)" onclick="edit_config('<?php echo $config->config_key ?>','<?php echo $config->title; ?>','<?php echo $config->value ?>')" class="dropdown-item">Edit</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
          <?php }?>
          </tbody>
          <tfoot>
            <th>ID</th>
            <th>Ttitle</th>
              <th>Value</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>



<div class="modal inmodal fade" id="edit_config_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">edit config</h4>
      </div>
      <form id="config_edit_form" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="slider_url_edit">Config Value for <span id="config_title"></span></label>
                <input type="text" class="form-control" name="config_value" id="config_value" value="">
                 <div class="form-error text-danger"></div>
              </div>
            </div>
            <input type="hidden" name="config_key" value="" id="config_key">
          </div>

          <div class="row">
            <div class="modal-footer col-md-12 pull-right">
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>