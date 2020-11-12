<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- page content -->
<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Blog</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         <a href="<?php echo base_url('/') ?>">Home</a>
        </li>
        <li class="breadcrumb-item active">
          <strong>create</strong>
        </li>
      </ol>
    </div>
    <div class="col-sm-8">
      <div class="title-action">
        <?php echo go_back(); ?>
        <a href="<?php echo base_url('blogs'); ?>" class="btn btn-primary">Manage Blog</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <form id="edit_blogs" method="post" class="form-horizontal form-label-left">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Blog Title</label>
              <input type="hidden" name="blog_id" value="<?php echo $blog->id; ?>"/>
              <?php echo form_input(['name' => 'title', 'id' => 'title', 'class' => 'form-control ', 'placeholder' => 'Enter Blog title', 'type' => 'text', 'value' => $blog->title]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Blog Slug</label>
               <?php echo form_input(['name' => 'slug', 'id' => 'slug', 'class' => 'form-control ', 'placeholder' => 'Enter Blog slug', 'type' => 'text', 'value' => $blog->slug]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Blog Category</label>
              <?php
$selected = array($blog->category);
echo form_dropdown(['name' => 'category'], [$category], [$selected], ['id' => 'blog_category_id', 'class' => 'form-control']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Blog Sub Category</label>
              <select name="sub_category" id="blog_sub_category_id" class="form-control " data-placeholder="select sub category"></select>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Blog Tags</label>
              <?php
$selected = json_decode($blog->tags);
echo form_dropdown(['name' => 'tags[]'], [$tags], $selected, ['id' => 'tags', 'class' => 'form-control chosen-select', 'multiple' => 'multiple', 'style' => 'width:350px', 'tabindex' => '4']);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Author</label>
              <?php
$author = get_user_fullname_by_username($this->session->userdata('username'));
echo form_input(['name' => 'author', 'id' => 'author', 'class' => 'form-control', 'placeholder' => 'Enter Purchase price', 'type' => 'text', 'readonly' => 'readonly', 'value' => $blog->author]);?>
              <div class="form-error text-danger"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Blog Content</label>
              <?php echo form_textarea(['name' => 'content', 'id' => 'content', 'class' => 'form-control', 'placeholder' => 'Enter Product Description', 'rows' => 10, 'value' => $blog->content]); ?>
              <div class="form-error text-danger"></div>
            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Blog Main Image</label>
              <div class="blog_container">
                <span>
                  <label for="blog_images"><img class="blog_image" id="blog_image_preview"  src="<?php echo FILE_UPLOAD_PATH . $blog->images; ?>" alt="default image" height="400px" width="100%"></label>
                </span>
                <input type="file" id="blog_images" name="blog_images" accept="image/gif,image/jpeg,image/jpg,image/png," style="opacity: 0">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group pull-right">
                <a href="<?php echo site_url('blogs/manage'); ?>">
                  <button class="btn btn-primary" type="button" ><i class="fa fa-minus-square"></i>&nbsp; Cancel </button>
                </a>
                <button type="submit"  class="btn btn-primary" class="btn btn-success" id="submit">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
