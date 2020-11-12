<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>PRODUCTS</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        </li>
        <li class="breadcrumb-item active">
          <strong>create</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <a href="<?php echo base_url('events'); ?>" class="btn btn-primary">Manage Events</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <form action="" id="event_create" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="ibox ">
            <div class="ibox-content">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title</label>
                    <?php echo form_input(['name' => 'title', 'id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter The Title', 'type' => 'text', 'value' => '']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Slug</label>
                    <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control', 'type' => 'text', 'value' => '']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Category</label>
                    <?php $selected = array();?>
                    <?php echo form_dropdown(['name' => 'category'], [$categories], $selected, ['id' => 'category', 'class' => 'form-control']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group" id="started_at">
                    <label class="font-normal" for="start_date" >Start Date</label>
                    <div class="input-group date">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" class="form-control" name="start_date" id="start_date">
                    </div>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group" id="end_at">
                    <label class="font-normal" for="end_date" >End Date</label>
                    <div class="input-group date">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" class="form-control" name="end_date" id="end_date">
                    </div>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ticket Price</label>
                    <?php echo form_input(['name' => 'ticket_price', 'id' => 'ticket_price', 'class' => 'form-control', 'placeholder' => 'Enter ticket price', 'type' => 'number', 'value' => '']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Location</label>
                    <?php echo form_input(['name' => 'location', 'id' => 'location', 'class' => 'form-control', 'placeholder' => 'Enter location', 'type' => 'text', 'value' => '']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <?php echo form_textarea(['name' => 'description', 'id' => 'tinymce', 'class' => 'form-control tinymce']); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Event Objective</label>
                      <?php echo form_textarea(['name' => 'objective', 'id' => 'objective', 'class' => 'form-control', 'placeholder' => 'Enter an objective between 150 to 200 words', 'rows' => 9]); ?>
                      <div class="form-error text-danger"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Upload Event Image</label>
                    <div class="form-group">
                        <label for="event_image"><img class="event_image" id="event_image_view"
                        src="<?php echo FILE_UPLOAD_PATH; ?>events/default.png"
                        alt="default image" height="200px" width="100%"></label>
                        <input type="file" id="event_image"
                        name="event_image"
                        accept="image/gif,image/jpeg,image/jpg,image/png,"
                        style="display: none;">
                         <div class="form-error text-danger"></div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" id="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>
