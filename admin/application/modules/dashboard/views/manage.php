<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">
        <div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('members') ?>"><h5>Members</h5></a>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total_members ?></h1>

                        </div>
                    </div>
                </div>
               <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                             <a href="<?php echo base_url('volunteers') ?>"><h5>Volunteers</h5></a>
                        </div>
                        <div class="ibox-content">
                           <h1 class="no-margins"><?php echo $total_volunteer ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                             <a href="<?php echo base_url('causes') ?>"><h5>Causes</h5></a>
                        </div>
                        <div class="ibox-content">
                           <h1 class="no-margins"><?php echo $total_causes ?></h1>

                        </div>
                    </div>
                </div>
               <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('events') ?>"> <h5>Events</h5></a>
                        </div>
                        <div class="ibox-content">
                          <h1 class="no-margins"><?php echo $total_event ?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('donors') ?>"><h5>Donors</h5></a>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total_donor ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('blogs') ?>"><h5>Posts</h5></a>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total_post ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('orders') ?>"><h5>Pending Orders</h5></a>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total_pendig_orders ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-success float-right">total</span>
                            <a href="<?php echo base_url('orders/confirmed') ?>"><h5>Confirmed Orders</h5></a>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo $total_confirm_orders ?></h1>
                        </div>
                    </div>
                </div>


            </div>
                               <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Contact message List</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                        <tr>

                                            <th>#</th>
                                            <th>Name </th>
                                            <th>Email </th>
                                            <th>Subject</th>
                                            <th>Message </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($contact_message as $key => $value) {?>
                                                <tr >
                                                    <td><?php echo $value->id; ?></td>
                                                    <td><?php echo $value->name; ?></td>
                                                    <td><?php echo $value->email; ?></td>
                                                    <td><?php echo $value->subject; ?></td>
                                                    <td><?php echo $value->message; ?></td>
                                                    <td>
                                                        <?php if ($value->is_read == 0) {?>
                                                        <span class="badge badge-primary">New</span>
                                                    <?php } else {?>
                                                        <span class="badge badge-success">Old</span>
                                                    <?php }?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">Action</button>
                                                            <ul class="dropdown-menu" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                                                                <li><a onclick="view_contact_message(<?php echo $value->id; ?>)" class="dropdown-item">View</a></li>
                                                                <li><a onclick="give_contact_message_reply('<?php echo $value->email; ?>')" class="dropdown-item">Reply</a></li>
                                                                <li><a class="dropdown-item" onclick="delete_contact_message(<?php echo $value->id; ?>,this)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        </div>



 <div class="modal inmodal fade " id="contact_message_reply" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Reply To Contact Message</h4>
      </div>

      <div class="modal-body" id="kuddus123">
       <form id="submit_contact_message_reply" method="post">
        <div class="row sk-loading" id="kuddus">
            <div class="ibox ">
              <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>To</label>
                      <?php echo form_input(['name' => 'reply_to', 'id' => 'reply_to', 'class' => 'form-control', 'type' => 'email', 'value' => '']); ?>
                      <div class="form-error text-danger"></div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Subject</label>
                      <?php echo form_input(['name' => 'repey_subject', 'id' => 'repey_subject', 'class' => 'form-control', 'placeholder' => 'Enter Subject', 'type' => 'text', 'value' => '']); ?>
                      <div class="form-error text-danger"></div>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Message</label>
                      <?php echo form_textarea(['name' => 'reply_message', 'id' => 'reply_message', 'class' => 'form-control', 'placeholder' => 'write your message', 'value' => '']); ?>
                      <div class="form-error text-danger"></div>
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