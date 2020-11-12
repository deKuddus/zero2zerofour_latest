<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section class="row page-header" style="background: url('<?php echo image_url(header_image_config('causes_page')); ?>');">
        <div class="container">
            <h4>our causes</h4>
        </div>
    </section>

    <section class="row gallery-content" style="background-color: #ffffff;">
        <div class="container">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">how you could help</h6>
                <h3>WE NEED YOUR HELP TO HELP OTHERS, SEE OUR CAUSES gallery</h3>
            </div>



            <div class="row">
                <div class="causes_container popup-gallery">
                    <div class="col-sm-6 col-md-4 grid-sizer"></div>
                    <div class="cause-item">
                        <?php if ($causes) {
    foreach ($causes as $key => $cause) {
        ?>
                    <div class="col-md-4">
                        <div class="images_row row m0">
                            <img src="<?php echo image_url($cause->images); ?>" alt="cause image" widget="90%">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#donation_modal" class="btn-primary" onclick="donate_to_cause(<?php echo $cause->id; ?>,'cause')">donate now</a>
                        </div>
                        <div class="cause_excepts row m0">
                            <h4 class="cuase_title"><a href="<?php echo base_url('causes/view/' . $cause->slug . '.html') ?>"><?php echo $cause->title; ?></a></h4>
                            <p><?php echo $cause->short_description; ?></p>
                            <div class="row fund_progress m0">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo floor($cause->current_fund); ?>" aria-valuemin="0" aria-valuemax="<?php echo floor($cause->goal_fund); ?>">
                                        <div class="percentage"><span class="counter">                                                                <?php
$percentage      = $cause->goal_fund / 100;
        $current_percent = $cause->current_fund / $percentage;
        echo $current_percent;
        ?></span>%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row fund_raises m0">
                                <div class="pull-left raised amount_box">
                                    <h6>raised</h6>
                                    <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($cause->current_fund); ?></h3>
                                </div>
                                <div class="pull-left goal amount_box">
                                    <h6>goal</h6>
                                    <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($cause->goal_fund); ?></h3>
                                </div>
                            </div>
                        </div>
                        </div>

                    <?php }}?>
                </div>
                </div>
            </div>
        </div>
    </section>