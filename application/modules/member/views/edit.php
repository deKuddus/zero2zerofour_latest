<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>



<section class="row volunteer-content page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row my-container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form id="member_edit_form" method="post" class="become_volunteer row m0">
                    <h3 class="hhh h1">UPDATE MY PROFILE</h3>
                    <h4 class="hhh h2">The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
                    <div class="form-group">
                        <label for="name">Full Name <code class="danger-text">*</code> </label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $member->name; ?>" >
                        <div class="form-error danger-text"></div>
                        <input type="hidden" name="member_id" value="<?php echo $member->id; ?>">
                    </div>
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
                    <div class="form-group">
                        <label for="date_of_birth">Date Of Birth <code class="danger-text">*</code> </label>
                        <input type="text" id="date_of_birth" name="date_of_birth" class="form-control" value="<?php echo $member->date_of_birth; ?>">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="street_address">street address <code class="danger-text">*</code> </label>
                        <input type="text" id="street_address" name="street_address" class="form-control" value="<?php echo $member->street_address; ?>">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="police_station">Police Station<code class="danger-text">*</code> </label>
                        <input type="text" class="form-control" name="police_station" id="police_station" value="<?php echo $member->police_station; ?>">
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
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Upload Your Photo <code class="danger-text">*</code> </label><br>
                          <label for="member_photo"><img src="<?php echo image_url($member->member_photo); ?>" id="member_photo_preview" height="150px" width="100%" style="border-radius: 5px; "></label>
                          <input type="file" name="member_photo" id="member_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                          <div class="form-error danger-text"></div>
                      </div>
                  </div>

          </div>
          <div class="row m0 text-right">
            <input type="submit" value="be member" id="member_register_button" class="btn-primary">
        </div>
    </form>
</div>
<div class="col-md-2"></div>
</div>
</div>
</section>
