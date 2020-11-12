<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.my-container {
    position: relative;
    overflow: hidden;
}
/* You could use :after - it doesn't really matter */
.my-container:before {
    content: ' ';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0.6;
    background-image: url('<?php echo base_url('public/assets/images/logo.png') ?>');
    background-repeat: no-repeat;
    background-position: 50% 0;
    -ms-background-size: cover;
    -o-background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    background-size: cover;
}

.danger-text{color: red;}</style>

<section class="row page-header">
    <div class="container">
        <h4>Member Registration Area</h4>
    </div>
</section>

<section class="row volunteer-content page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row my-container" style="/*background-image: url('<?php //echo base_url('public/assets/images/logo.png') ?>');  background-repeat:no-repeat;background-attachment: fixed;background-position: center;  background-size: cover;  opacity: 0.5;*/
">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form id="member_form" method="post" class="become_volunteer row m0">
                    <h3 class="hhh h1">NEW MEMBER REGISTRAION FORM </h3>
                    <h4 class="hhh h2">The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
                    <div class="form-group">
                        <label for="name">Full Name <code class="danger-text">*</code> </label>
                        <input type="text" id="name" name="name" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <code class="danger-text">*</code> </label>
                        <input type="email" id="email" name="email" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Phone <code class="danger-text">*</code> </label>
                        <input type="tel" id="tel" name="mobile" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="street_address">street address <code class="danger-text">*</code> </label>
                        <input type="text" id="street_address" name="street_address" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="address_line">address line <code class="danger-text">*</code> </label>
                        <input type="text" class="form-control" name="address_line">
                        <div class="form-error danger-text"></div>
                    </div>

                    <div class="form-group">
                        <label for="city" >city <code class="danger-text">*</code> </label>
                        <input type="text" id="city" class="form-control" name="city">
                        <div class="form-error danger-text"></div>
                    </div>

                    <div class="form-group">
                        <label for="post_code">zip / postal code <code class="danger-text">*</code> </label>
                        <input type="text" id="post_code" class="form-control" name="post_code">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="v_country">country <code class="danger-text">*</code> </label>
                        <select name="country" id="v_country" class="form-control">
                        </select>
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="v_state">State <code class="danger-text">*</code></label>
                        <select name="state" id="v_state" class="form-control">
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
                          <label>Upload Your Photo <code class="danger-text">*</code> </label><br>
                          <label for="member_photo"><img src="<?php echo image_url('member/default.png'); ?>" id="member_photo_preview" height="150px" width="100%" style="border-radius: 5px; "></label>
                          <input type="file" name="member_photo" id="member_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                          <div class="form-error danger-text"></div>
                      </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>SSC Registation or Certificate <code class="danger-text">*</code></label><br>
                      <label for="registration_card"><img src="<?php echo image_url('member/default.png'); ?>" id="registation_card_preview" height="150px" width="100%" style="border-radius: 5px; "></label>
                      <input type="file" name="registration_card" id="registration_card" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                      <div class="form-error danger-text"></div>
                  </div>
              </div>
          </div>
          <div class="row m0 text-right">
            <input type="submit" value="be member" class="btn-primary">
        </div>
    </form>
</div>
<div class="col-md-2"></div>
</div>
</div>
</section>
