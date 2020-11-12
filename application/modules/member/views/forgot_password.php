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
                <form id="forgot_password" method="post" class="become_volunteer row m0">
                    <h4 class="hhh h2">The <code class="danger-text">*</code> Mark info is REQUIRED</h4>
                    <h5 id="messages" class="alert alert-danger" style="display: none;"></h5>
                    <div class="form-group">
                        <label for="email">Email <code class="danger-text">*</code> </label>
                        <input type="email" id="email" name="email" class="form-control">
                        <div class="form-error danger-text"></div>
                    </div>
                      <div class="row m0 text-right">
                        <input type="submit" value="Submit" id="forgot_password_submit" class="btn-primary">
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
