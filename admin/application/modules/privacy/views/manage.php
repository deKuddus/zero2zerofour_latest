<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Privacy & Policys</h2>
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
        <a href="<?php echo base_url('privacy/create'); ?>" class="btn btn-primary">Add Privacy & Policy</a>
      </div>
    </div>
  </div>

  <div class="ibox ">
    <div class="ibox-content">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
          <thead>
            <tr>
              <th>ID</th>
              <th>Privacy Heading</th>
              <th>Privacy & Policy</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($privacy as $key => $value) {?>
                <tr>
                  <td><?php echo $value->id; ?></td>
                  <td><?php echo $value->privacy_heading; ?></td>
                  <td><?php echo htmlspecialchars_decode(textShort($value->privacy, 200)); ?></td>
                  <td>
                    <?php if ($value->status == 1) {?>
                      <div class="switch">
                        <div class="onoffswitch">
                          <input type="checkbox" onchange="change_privacy_status(<?php echo $value->id ?>,this)" checked="checked" class="onoffswitch-checkbox status" id="example<?php echo $key; ?>" value="0">
                          <label class="onoffswitch-label" for="example<?php echo $key; ?>">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    <?php } else {?>
                      <div class="switch">
                        <div class="onoffswitch">
                          <input type="checkbox" onchange="change_privacy_status(<?php echo $value->id ?>,this)" class="onoffswitch-checkbox status" id="example<?php echo $key; ?>" >
                          <label class="onoffswitch-label" for="example<?php echo $key; ?>">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </div>
                    <?php }?>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                      <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                        <li>
                          <a href="<?php echo base_url('privacy/edit/' . $value->id); ?>" class="dropdown-item">Edit</a>
                        </li>
                        <li>
                          <a class="dropdown-item" onclick="view_privacy(<?php echo $value->id; ?>)">view</a>
                        </li>
                        <li>
                          <a href="<?php echo base_url('privacy/delete/' . $value->id); ?>" class="dropdown-item">Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php }?>
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Privacy Heading</th>
              <th>Privacy & Policy</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </tfoot>
        </table>
      </div>

    </div>
  </div>


</div>
<div class="modal inmodal fade " id="privacy_view" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Privay & Policy</h4>
      </div>
      <div class="modal-body">
        <h4 class="text-center" id="append_privacy_heading"></h4>
        <div class="row" id="append_privacy"></div>
      </div>
    </div>
  </div>
</div>


