<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>

<!-- <section class="row page-header">
    <div class="container">
        <h4>Password Reset</h4>
    </div>
</section> -->

<section class="row volunteer-content page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row my-container">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <?php if (!empty($member)) {?>
                <form id="reset_password" method="post" class="become_volunteer row m0">
                    <h3 class="hhh h1">Password Reset </h3>
                    <h4 class="hhh h2">The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
                    <h5 id="messages" class="alert alert-danger" style="display: none;"></h5>
                    <div class="form-group">
                        <label for="password">Password <code class="danger-text">*</code> </label>
                        <input type="password" id="password" name="password" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password <code class="danger-text">*</code> </label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                      <div class="row m0 text-right">
                        <input type="hidden" id="email" name="email" value="<?php echo $member->email; ?>">
                        <input type="submit" value="Submit" class="btn-primary">
                    </div>
                </form>
            <?php } else {?>
                <h3>Sorry no account found with this email or your password link is expired, try again.</h3>
            <?php }?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
