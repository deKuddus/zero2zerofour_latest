<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2>Members</h2>
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
        <a href="<?php echo base_url('members'); ?>" class="btn btn-primary">Manage Members</a>
      </div>
    </div>
  </div>
  <div class="ibox ">
    <div class="ibox-content">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form id="member_form_edit" method="post" class="form-horizontal form-label-left">
            <h3>MEMBER EDIT FORM </h3>
            <h4 >The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
            <div class="form-group">
              <label for="name">Full Name <code class="danger-text">*</code> </label>
              <input type="text" id="name" name="name" class="form-control" value="<?php echo $member->name; ?>">
              <div class="form-error danger-text"></div>
            </div>
            <div class="form-group">
              <label for="designation">Designation (its mandatory for board member, not necessary for others) </label>
              <select name="designation" class="form-control">
                <option>Select Designation for Board member</option>
                <?php foreach ($designations as $key => $designation) {
    ?>
                  <option value="<?php echo $designation->id ?>"
                    <?php
if ($member->designation == $designation->id) {
        echo "selected";
    }
    ?>
                    ><?php echo $designation->designation_name; ?></option>
                  <?php }?>
                </select>
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="board_member_order">Board Member Serial (its mandatory for board member, not necessary for others) </label>
                <select name="board_member_order" class="form-control">
                  <option>Select Serial for Board member</option>
                  <?php foreach ($get_member_order as $key => $order) {
    ?>
                    <option value="<?php echo $order ?>" <?php if ($order == $member->board_member_order) {
        echo "selected";
    }
    ?>><?php echo $order; ?></option>
                  <?php }?>
                </select>
                <div class="form-error danger-text"></div>
              </div>
              <input type="hidden" name="member_id" value="<?php echo $member->id; ?>">
              <div class="form-group">
                <label for="email">Email <code class="danger-text">*</code> </label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $member->email; ?>">
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="tel">Phone <code class="danger-text">*</code> </label>
                <input type="tel" id="tel" name="mobile" class="form-control" value="<?php echo $member->mobile; ?>">
                <div class="form-error danger-text"></div>
              </div>

              <div class="col-md-6">
                <div class="form-group" id="dob">
                  <label class="font-normal" for="date_of_birth" >Date of Birth</label>
                  <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php echo $member->date_of_birth ?>">
                  </div>
                  <div class="form-error text-danger"></div>
                </div>
              </div>

              <div class="form-group">
                <label for="street_address">street address <code class="danger-text">*</code> </label>
                <input type="text" id="street_address" name="street_address" class="form-control" value="<?php echo $member->street_address; ?>">
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="police_station">police station <code class="danger-text">*</code> </label>
                <input type="text" class="form-control" name="police_station" value="<?php echo $member->police_station; ?>">
                <div class="form-error danger-text"></div>
              </div>

              <div class="form-group">
                <label for="post_code">zip / postal code <code class="danger-text">*</code> </label>
                <input type="text" id="post_code" class="form-control" name="post_code" value="<?php echo $member->post_code; ?>">
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="v_country">country <code class="danger-text">*</code> </label>
                <select name="country" id="v_country" class="form-control">
                </select>
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="v_state">City <code class="danger-text">*</code></label>
                <select name="state" id="v_state" class="form-control">
                  <option value="<?php echo $member->state; ?>"><?php echo $member->state; ?></option>
                </select>
                <div class="form-error danger-text"></div>
              </div>
              <div class="form-group">
                <label for="password">Password <code class="danger-text">*</code> </label>
                <input type="password" id="password" class="form-control" name="password">
                <div class="form-error danger-text"></div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Upload member Photo <code class="danger-text">*</code> </label><br>
                    <label for="member_photo"><img src="<?php echo image_url($member->member_photo); ?>" id="member_photo_preview" height="200px" width="200px" style="border-radius: 5px; "></label>
                    <input type="file" name="member_photo" id="member_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                    <div class="form-error danger-text"></div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Upload member SSC Certificate <code class="danger-text">*</code></label><br>
                    <label for="registration_card"><img src="<?php echo image_url($member->registration_card); ?>" id="registation_card_preview" height="150px" width="100%" style="border-radius: 5px; "></label>
                    <input type="file" name="registration_card" id="registration_card" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                    <div class="form-error danger-text"></div>
                  </div>
                </div>
              </div>
              <div class="row  pull-right">
                <input type="submit" value="Update Member" class="btn btn-primary">
              </div>
            </form>
            <div class="col-md-2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
