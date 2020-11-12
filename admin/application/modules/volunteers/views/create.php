<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Volunteer</h2>
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
        <a href="<?php echo base_url('volunteers'); ?>" class="btn btn-primary">Manage Volunteer</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form id="volunteer_form" method="post" class="form-horizontal form-label-left">
            <div class="form-group">
              <label for="name">Full Name*</label>
              <input type="text" id="name" name="name" class="form-control">
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="email">Email*</label>
              <input type="email" id="email" name="email" class="form-control">
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="tel">Phone*</label>
              <input type="tel" id="tel" name="mobile" class="form-control">
              <div class="form-error danger-text"></div>
            </div>
            <div class="col-md-6">
            <div class="form-group" id="dob">
              <label class="font-normal" for="date_of_birth" >Date of Birth</label>
              <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth">
              </div>
              <div class="form-error text-danger"></div>
            </div>
          </div>
            <div class="form-group">
              <label for="street_address">street address*</label>
              <input type="text" id="street_address" name="street_address" class="form-control">
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="police_station">police station*</label>
              <input type="text" class="form-control" name="police_station">
              <div class="form-error danger-text"></div>
            </div>

            <div class="form-group">
              <label for="post_code">zip / postal code</label>
              <input type="text" id="post_code" class="form-control" name="post_code">
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="v_country">country*</label>
              <select name="country" id="v_country" class="form-control">
              </select>
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="v_state">City*</label>
              <select name="state" id="v_state" class="form-control">
              </select>
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="v_state">Occupation*</label>
              <input type="text" class="form-control" name="occupation">
              <div class="form-error danger-text"></div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Upload Volunteer Photo :</label><br>
                  <label for="volunteer_photo"><img src="<?php echo image_url('volunteer/default.png'); ?>" id="volunter_photo_preview" height="200px" width="200px" style="border-radius: 5px; "></label>
                  <input type="file" name="volunteer_photo" id="volunteer_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                  <div class="form-error danger-text"></div>
                </div>
              </div>
            </div>
            <div class="row pull-right">
              <input type="submit" value="Create" class="btn btn-primary">
            </div>
          </form>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</div>
