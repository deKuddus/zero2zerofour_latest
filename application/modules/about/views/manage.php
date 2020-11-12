<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo "<pre>";
// var_dump($board_director);exit();
?>

    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('about_page')); ?>');">
        <div class="container">
            <h4>About us</h4>
        </div>
    </section>
    <div class="page-wrapper ">
    <section class="row content_about page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 who_we_are">
                    <h6 class="label label-defatult about_var">who we are</h6>
                    <h3 class="team_page_title"><?php echo $about->title; ?></h3>
                    <p class="about_readmore" style="line-height: 2;text-align: justify;"><?php echo $about->description; ?></p>
                </div>
                <div class="col-sm-6 history">
                    <h6 class="label label-defatult">history</h6>
                    <div class="history_carousel">
                        <?php if ($history) {foreach ($history as $key => $value) {?>
                        <div class="item">
                            <h3 class="year"><?php echo $value->year; ?></h3>
                            <p style="line-height: 2;text-align: justify;"><?php echo $value->description ?></p>
                        </div>
                    <?php }}?>
                    </div>
                </div>
            </div>

            <div class="row mission_vision">
                <div class="col-sm-4 text-center">
                    <i class="fa fa-thumbs-up"></i>
                    <h5>Our Slogan</h5>
                    <p style="line-height: 2;text-align: justify;"><?php echo $mission->theme_title; ?></p>
                </div>
                <div class="col-sm-4 text-center">
                    <i class="fa fa-gratipay"></i>
                    <h5>vision</h5>
                    <p style="line-height: 2;text-align: justify;"><?php echo $mission->vision; ?></p>
                </div>
                <div class="col-sm-4 text-center">
                    <i class="fa fa-star"></i>
                    <h5>mission</h5>
                    <p style="line-height: 2;text-align: justify;"><?php echo $mission->mission; ?></p>
                </div>

            </div>

            <div class="row team_members_row">
                <div class="col-sm-12">
                    <h3 class="team_page_title">board of directors</h3>
                    <p class="team_page_para about_var"><?php echo ucfirst($this->config->item('company_name')) ?> Honourable Board Member Those Are Always Helping To Serve The People</p>

                    <div class="row">
                        <?php if (!empty($board_head)) {?>
                      <div class="col-xs-3 col-sm-4 col-md-3 team_member">
                        <img src="<?php echo image_url($board_head->member_photo) ?>" alt="" class="img-responsive">
                        <h4><?php echo $board_head->name; ?></h4>
                        <?php foreach ($designations as $key => $d_value) {?>
                            <?php if ($board_head->designation == $d_value->id) {?>
                                <h6><?php echo $d_value->designation_name; ?></h6>
                            <?php }}?>
                        </div>
                    <?php }?>
                        <?php if (sizeof($board_director) > 0) {?>
                            <?php foreach ($board_director as $key => $directors) {?>
                        <div class="col-xs-3 col-sm-4 col-md-3 team_member">
                            <img src="<?php echo image_url($directors->member_photo) ?>" alt="" class="img-responsive">
                            <h4><?php echo $directors->name; ?></h4>
                            <?php foreach ($designations as $key => $d_value) {?>
                                <?php if ($directors->designation == $d_value->id) {?>
                            <h6><?php echo $d_value->designation_name; ?></h6>
                        <?php }}?>
                        </div>
                    <?php }}?>
                    </div>
                </div>
            </div>

            <div class="row how-fund-help-children">
                <h3>how Children's Health Fund is making a difference.</h3>
                <a href="<?php echo base_url('volunteers/register'); ?>" class="pull-right btn-primary btn-outline dark">Be Volunteer</a>
            </div>
        </div>
    </section>
