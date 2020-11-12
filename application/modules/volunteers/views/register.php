<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>

<section class="row page-header" style="background: url('<?php echo image_url($this->config->item('volunteer_page')); ?>');">
    <div class="container">
        <h4>Join as a volunteer</h4>
    </div>
</section>

<section class="row volunteer-content page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <form id="volunteer_form" method="post" class="become_volunteer row m0">
                    <h3 class="hhh h1">NEW VOLUNTEERS Registration Form</h3>
                    <h4 class="hhh h2">The following <code class="danger-text">*</code> mark is REQUIRED</h4>
                    <div class="form-group">
                        <label for="name">Full Name <code class="danger-text">*</code></label>
                        <input type="text" id="name" name="name" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <code class="danger-text">*</code></label>
                        <input type="email" id="email" name="email" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Phone <code class="danger-text">*</code></label>
                        <input type="tel" id="tel" name="mobile" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                     <div class="form-group">
                        <label for="date_of_birth">Date Of Birth <code class="danger-text">*</code> </label>
                        <input type="text" id="date_of_birth" name="date_of_birth" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="street_address">street address <code class="danger-text">*</code></label>
                        <input type="text" id="street_address" name="street_address" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="police_station">police station <code class="danger-text">*</code></label>
                        <input type="text" class="form-control" name="police_station" id="police_station">
                        <div class="form-error danger-text"></div>
                    </div>

                    <div class="form-group">
                        <label for="post_code">zip / postal code <code class="danger-text">*</code></label>
                        <input type="text" id="post_code" class="form-control" name="post_code">
                        <div class="form-error danger-text"></div>
                    </div>
                     <div class="form-group">
                        <label for="occupation">Occupation <code class="danger-text">*</code></label>
                        <input type="text" id="occupation" class="form-control" name="occupation">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="v_country">country <code class="danger-text">*</code></label>
                        <select name="country" id="v_country" class="form-control">
                        </select>
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="v_state">City <code class="danger-text">*</code></label>
                        <select name="state" id="v_state" class="form-control">
                        </select>
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Upload Your Photo <code class="danger-text">*</code></label><br>
                                <label for="volunteer_photo"><img src="<?php echo image_url('volunteer/default.png'); ?>" id="volunter_photo_preview"  width="100%" style="border-radius: 5px; "></label>
                                <input type="file" name="volunteer_photo" id="volunteer_photo" accept="image/png, image/jpeg,image/gif, image/jpg" style="display: none;">
                                <div class="form-error danger-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row m0 text-right">
                        <input type="submit" value="be volunteer" id="volunteer_register_button" class="btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <strong style="color:red;font-size: 20px">Notice</strong>
                <p style="line-height: 2;text-align: justify;font-size: 18px">Hello There, Volunteer Registration is just an online registration form, you never login with these credientials. You can foud your list in  <a href="<?php echo base_url('volunteers.html') ?>">volunteer list </a> after authority approve your profile. Only Registered member can login to access all features and functionalities. You may register your self as a member in <a href="<?php echo base_url('member.html') ?>">member registration</a> link.</p>
            </div>
        </div>
    </div>
</section>
