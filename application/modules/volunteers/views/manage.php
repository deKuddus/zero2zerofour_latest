<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">.danger-text{color: red;}</style>

<section class="row page-header" style="background: url('<?php echo image_url($this->config->item('volunteer_page')); ?>');">
    <div class="container">
        <h4>Our Volunteers</h4> 
    </div>
</section>
<section class="row volunteer-content page-content" style="background-color: #ffffff;">
    <div class="container">
        <div class="row">
           <div class="col-sm-9">
            <h3 class="team_page_title">Our Volunteers</h3>
            <div class="row">
                <?php if ($volunteers){ foreach ($volunteers as $key => $value) {?>
                    <div class="col-xs-3 col-sm-4 col-md-3 team_member">
                        <img src="<?php echo image_url($value->volunteer_photo) ?>" alt="volunteer photo" class="img-responsive">
                        <h4><a href="<?php echo base_url('volunteers/profile/'.$value->v_id); ?>"><?php echo $value->name; ?></a></h4>
                        <h6>volunteer</h6>
                    </div>
                <?php }
            }else{?>
                <h3 class="text-center">No Vollunters Found !</h3>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-3">
        <form action="<?php echo base_url('volunteers/index.html') ?>" class="input-group shop-search" method="post" role="search">
            <input type="search" class="form-control" name="name" placeholder="search volunteer">
            <span class="input-group-addon"><button type="submit"><i class="fa fa-search"></i></button></span>
        </form>
    </div>
</div>
</div>
</section>
