<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Project</h2>
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
        <a href="<?php echo base_url('projects'); ?>" class="btn btn-primary">Manage Projects</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <form action="" id="project_edit" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="ibox ">
            <div class="ibox-content">
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="hidden" name="project_id" value="<?php echo $project->id; ?>">
                    <?php echo form_input(['name' => 'title', 'id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter The Title', 'autocomplete' => 'off', 'type' => 'text', 'value' => $project->title]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Slug</label>
                    <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control', 'type' => 'text', 'value' => $project->slug]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Goal Fund</label>
                    <?php echo form_input(['name' => 'goal_fund', 'id' => 'goal_fund', 'class' => 'form-control', 'placeholder' => 'Enter ticket price', 'autocomplete' => 'off', 'type' => 'number', 'value' => $project->goal_fund]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Location</label>
                    <?php echo form_input(['name' => 'location', 'id' => 'location', 'class' => 'form-control', 'placeholder' => 'Enter location', 'autocomplete' => 'off', 'type' => 'text', 'value' => $project->location]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <?php echo form_textarea(['name' => 'description', 'id' => 'tinymce', 'class' => 'form-control tinymce', 'value' => $project->description]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Event Objective</label>
                    <?php echo form_textarea(['name' => 'objective', 'id' => 'objective', 'class' => 'form-control', 'placeholder' => 'Enter an objective between 150 to 200 words', 'rows' => 9, 'value' => $project->objective]); ?>
                    <div class="form-error text-danger"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Upload Event Image</label>
                  <div class="form-group">
                    <label for="project_image"><img class="project_image" id="project_image_view"
                      src="<?php echo image_url($project->picture); ?>"
                      alt="default image" height="200px" width="100%"></label>
                      <input type="file" id="project_image" name="project_image_edit" accept="image/gif,image/jpeg,image/jpg,image/png," style="display: none;">
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
