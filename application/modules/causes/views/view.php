<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="row page-header" style="background: url('<?php echo image_url($this->config->item('causes_page')); ?>');">
    <div class="container">
        <h4>cause details</h4>
    </div>
</section>

<section class="row gallery-content">
    <div class="container">

        <div class="row">
            <div class="col-md-8 single-project single-cause">
                <img src="<?php echo FILE_UPLOAD_PATH . $causes->images; ?>" alt="causes images" width="100%">

                <div class="row m0 project_title">
                    <h2 class="hhh h1 pull-left"><?php echo $causes->title; ?></h2>
                    <a href="javscript:void(0)" data-toggle="modal" data-target="#donation_modal" onclick="donate_to_cause(<?php echo $causes->id; ?>,'cause')" class="btn-primary pull-right">donate now</a>
                </div>

                <div class="row progressBarRow">
                    <div class="row m0">
                        <div class="progress_barBox row m0">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo floor($causes->current_fund); ?>" aria-valuemin="0" aria-valuemax="<?php echo floor($causes->goal_fund); ?>">
                                    <div class="percentage"><span class="counter"><?php
$percentage      = $causes->goal_fund / 100;
$current_percent = $causes->current_fund / $percentage;
echo $current_percent;
?></span>%</div>
                                </div>
                            </div>
                        </div>

                        <div class="fund_raises style2 row m0">
                            <div class="col-xs-4 amount_box">
                                <h6>RAISED</h6>
                                <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($causes->current_fund); ?></h3>
                            </div>
                            <div class="col-xs-4 amount_box text-center">
                                    <!-- <h6>days left</h6>
                                        <h3>293</h3> -->
                                    </div>
                                    <div class="col-xs-4 amount_box text-right">
                                        <h6>goal</h6>
                                        <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($causes->goal_fund); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4><?php echo $causes->short_description; ?></h4>
                        <?php echo $causes->content; ?>


                       <!--  <h2 class="hhh h2">few latest donors</h2>

                        <div class="row latest-donors">
                            <div class="col-xs-3 donor style2">
                                <img src="images/donors/1.jpg" alt="">
                                <div class="row inner">
                                    <h5 class="name">Johnathan Doe</h5>
                                    <h5 class="amount">donated - $5000</h5>
                                </div>
                            </div>
                            <div class="col-xs-3 donor style2">
                                <img src="images/donors/2.jpg" alt="">
                                <div class="row inner">
                                    <h5 class="name">michell flintoff</h5>
                                    <h5 class="amount">donated - $5000</h5>
                                </div>
                            </div>
                            <div class="col-xs-3 donor style2">
                                <img src="images/donors/3.jpg" alt="">
                                <div class="row inner">
                                    <h5 class="name">donny chang</h5>
                                    <h5 class="amount">donated - $5000</h5>
                                </div>
                            </div>
                            <div class="col-xs-3 donor style2">
                                <img src="images/donors/4.jpg" alt="">
                                <div class="row inner">
                                    <h5 class="name">Angelina Yeager</h5>
                                    <h5 class="amount">donated - $5000</h5>
                                </div>
                            </div>
                        </div> -->

                        <div class="row shareOnRow m0">
                            <ul class="list-unstyled pull-left">
                                <li>SHARE IT ON</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
                            </ul>
                            <a href="#donate_box" class="btn-primary pull-right">donate now</a>
                        </div>
                    </div>

                    <div class="col-md-4 sidebar cause-sidebar">
                        <div class="row m0 widget widget-category">
                            <h4 class="widget-title">categories</h4>
                            <ul class="nav">
                                <?php foreach ($category as $key => $category) {?>
                                <li><a href="<?php echo base_url('causes/category/' . $category->id) ?>"><?php echo $category->name; ?></a></li>
                            <?php }?>
                            </ul>
                        </div>
                        <div class="row m0 widget widget-similar-project widget-similar">
                            <h4 class="hhh h2">SIMILAR causes</h4>
                            <div class="similar-project">

                                <?php
if ($related_causes) {
    foreach ($related_causes as $key => $value) {
        ?>
                                        <div class="row cause-item environment">
                                            <div class="images_row row m0">
                                                <img src="<?php echo image_url($value->images); ?>" alt="causes image" >
                                                <a href="javscript:void(0)" data-toggle="modal" data-target="#donation_modal" onclick="donate_to_cause(<?php echo $value->id; ?>,'cause')" class="btn-primary pull-right">donate now</a>
                                            </div>
                                            <div class="cause_excepts row m0">
                                                <h4 class="cuase_title"><a href="<?php echo base_url('causes/view/' . $value->slug); ?>"><?php echo $value->title; ?></a></h4>
                                                <p><?php echo $value->short_description; ?></p>
                                                <div class="row fund_progress m0">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $value->current_fund; ?>" aria-valuemin="0" aria-valuemax="<?php echo $value->goal_fund; ?>">
                                                            <div class="percentage"><span class="counter">
                                                                <?php
$percentage      = $value->goal_fund / 100;
        $current_percent = $value->current_fund / $percentage;
        echo $current_percent;
        ?></span>%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row fund_raises m0">
                                                        <div class="pull-left raised amount_box">
                                                            <h6>raised</h6>
                                                            <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo $value->current_fund; ?></h3>
                                                        </div>
                                                        <div class="pull-left goal amount_box">
                                                            <h6>goal</h6>
                                                            <h3><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo $value->goal_fund; ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>