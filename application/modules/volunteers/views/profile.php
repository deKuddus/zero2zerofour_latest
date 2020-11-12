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
            <form id="volunteer_form" method="post" class="become_volunteer row m0">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                    <h3 class="hhh h1">VOLUNTEER Profile</h3><br>
                     <div class="text-center">
                        <img src="<?php echo image_url($volunteer->volunteer_photo); ?>" id="volunter_photo_preview"   width="100%"  style="border-radius: 5px; height: 190px; width: 192px;">
                    </div>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" readonly="readonly" value="<?php echo $volunteer->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control"  readonly="readonly" value="<?php echo $volunteer->email; ?>">
                    </div>
                     <div class="form-group">
                        <label for="date_of_birth">Date Of Birth </label>
                        <input type="text" id="date_of_birth"  class="form-control"  readonly="readonly" value="<?php echo $volunteer->date_of_birth; ?>">
                    </div>
                    <div class="form-group">
                        <label for="street_address">street address</label>
                        <input type="text" id="street_address"  class="form-control"  readonly="readonly" value="<?php echo $volunteer->street_address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="police_station">Police Station</label>
                        <input type="text" class="form-control" id="police_station"  readonly="readonly" value="<?php echo $volunteer->police_station; ?>">
                    </div>

                    <div class="form-group">
                        <label for="post_code">zip / postal code</label>
                        <input type="text" id="post_code" class="form-control"  readonly="readonly" value="<?php echo $volunteer->post_code; ?>">
                    </div>
                     <div class="form-group">
                        <label for="occupation">Occupation </label>
                        <input type="text" id="occupation" class="form-control"  readonly="readonly" value="<?php echo $volunteer->occupation; ?>">
                    </div>
                    <div class="form-group">
                         <label for="occupation">Country </label>
                        <input type="text" id="occupation" class="form-control"  readonly="readonly" value="<?php echo $volunteer->country; ?>">
                    </div>
                    <div class="form-group">
                        <label for="v_state">City</label>
                       <input type="text" class="form-control" readonly="readonly" value="<?php echo $volunteer->state; ?>">
                    </div>
                    
                    <div class="row m0 text-right">
                       <a href="<?php echo base_url('volunteers/index.html') ?>"> <button class="btn-primary">Back</button></a>
                    </div>
            </div>
            <div class="col-md-2"></div>
            </form>
        </div>
    </div>
</section>
