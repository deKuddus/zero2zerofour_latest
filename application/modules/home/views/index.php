<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <!--Featured Slider-->
    <section class="row featured_news banner_slider">
        <?php if (get_slider()) {
    foreach (get_slider() as $key => $value) {?>
            <div class="item">
                <img src="<?php echo image_url($value->image) ?>" alt="slider image" >
                <div class="row caption m0">
                    <div class="container">
                        <div class="volunteer_summery_box col-lg-5 col-md-10">
                            <h6 class="label label-default white"><?php echo $value->title; ?></h6>
                            <h3 class="news-title"><a href="#"><?php echo $value->description; ?></a></h3>
                            <!-- <p>Fourth Estate members are Invisible Children’s most faithful supporters. By giving what they.</p> -->
                            <!-- <a href="single.html" class="btn-primary">learn more</a> -->
                        </div>
                    </div>
                </div>
            </div>
        <?php }
}?>
        </section>

        <div class="page-wrapper ">
                <div class="container">
            <section class="how_help2 row">
                <div class="col-md-4 help-process2">
                    <div class="media">
                        <div class="media-left"><span><img src="<?php echo base_url() ?>public/assets/images/help01.png" alt=""></span></div>
                        <div class="media-body">
                            <h5>give donation</h5>
                            <p>Lorem ipsum dolor sit amet, cons purus efficitur eget.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 help-process2">
                    <div class="media">
                        <div class="media-left"><span><img src="<?php echo base_url() ?>public/assets/images/help02.png" alt=""></span></div>
                        <div class="media-body">
                            <h5>become volunteer</h5>
                            <p>Lorem ipsum dolor sit amet, cons purus efficitur eget.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 help-process2">
                    <div class="media">
                        <div class="media-left"><span><img src="<?php echo base_url() ?>public/assets/images/help03.png" alt=""></span></div>
                        <div class="media-body">
                            <h5>GIVE SCHOLARSHIP</h5>
                            <p>Lorem ipsum dolor sit amet, cons purus efficitur eget.</p>
                        </div>
                    </div>
                </div>
            </section>
                </div>

            <section class="row our_causes">
                <div class="container">
                    <div class="row sectionTitle text-center">
                        <h6 class="label label-default">our causes</h6>
                        <h3>WE HELP THOUSANDS OF CHILDRENS TO GET THEIR EDUCATION NOW WE NEED YOUR HELP TO CONTINUE THIS</h3>
                    </div>

                    <div class="row">
                        <?php if ($causes) {?>
                            <div class="col-md-12 featured_recent_cause">
                                <div class=" inner m0">
                                    <div class="row" >
                                        <div class="cause_imgs cause_slider" >
                                            <?php foreach ($causes as $key => $c_value) {?>
                                            <div class="item">
                                                <div class="col-md-8">
                                                    <img src="<?php echo image_url($c_value->images); ?>" alt="causes images" height="auto">
                                                </div>
                                                <div class="event_box featured_event_box col-md-4" style="height:464px !important;">
                                                    <div class="event_meta row m0">
                                                        <div class="label label-default pull-left">featured</div>
                                                        <!-- <div class="pull-right days_left">193 days left</div> -->
                                                    </div>
                                                    <h4 class="event_link"><a href="<?php echo base_url('causes/view/' . $c_value->slug) ?>"><?php echo $c_value->title; ?></a></h4>
                                                    <p><?php echo $c_value->short_description; ?></p>
                                                    <div class="row fund_raises m0">
                                                        <div class="pull-left raised amount_box">
                                                            <h6>raised</h6>
                                                            <h2 style="font-size: 20px;"><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($c_value->current_fund); ?></h2>
                                                        </div>
                                                        <div class="pull-left goal amount_box">
                                                            <h6>goal</h6>
                                                            <h2 style="font-size: 20px;"><span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo floor($c_value->goal_fund); ?></h2>
                                                        </div>
                                                    </div>
                                                    <div class="row m0 text-center">
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#donation_modal" onclick="donate_to_cause('<?php echo $c_value->id ?>','cause')" class="btn-primary">donate now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }if ($non_featured) {foreach ($non_featured as $key => $fc_value) {?>

                            <div class="col-sm-4 recent_cause">
                                <div class="row m0 inner">
                                   <img src="<?php echo FILE_UPLOAD_PATH . $fc_value->images; ?>" alt="causes images" height="auto">
                                    <div class="row m0 cause_desc">
                                        <h5><a href="<?php echo base_url('causes/view/' . $fc_value->slug) ?>"><?php echo $fc_value->title; ?></a></h5>
                                       <p style="text-align: justify;"><?php echo $fc_value->short_description; ?></p>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#donation_modal" onclick="donate_to_cause('<?php echo $fc_value->id ?>','cause')" class="btn-primary">donate now</a>
                                    </div>
                                </div>
                            </div>
                        <?php }}?>
                    </div>
                </div>
            </section>
            <section class="row sponsor_banner text-center style2">
                <div class="container">
                    <div class="row sectionTitle">
                        <h6 class="label label-default">sponsor this project</h6>
                        <h3>HELP NEPAL TO OVERCOME FROM HUGE EARTHQUAKE</h3>
                    </div>
                    <p>Praesent diam massa, interdum quis ex id, laoreet interd vel ligula tortor. Phasellus gravida posuere orci, sed faucibus eu. Mauris fringilla.</p>
                    <div class="row">
                        <a href="#" class="btn-primary">sponsor now</a>
                        <a href="#" class="btn-primary btn-outline white">other projects</a>
                    </div>
                </div>
            </section>

            <section class="row upcoming_recent_events style2">
                <div class="container">
                    <div class="row sectionTitle text-center">
                       <h6 class="label label-default">EvENTS OF HELPING HANDS</h6>
                       <h3>UPCOMING &amp; RECENT EVENTS AT HELPING HANDS</h3>
                   </div>
                   <div class="row">
                       <div class="col-sm-12 col-md-6 upcoming_events">
                        <?php if ($latest): ?>
                            <div class="row event_cover_photo">
                                <img src="<?php echo FILE_UPLOAD_PATH . $latest->picture; ?>" alt="event image" class="img-responsive">
                                <div class="upcoming_label label">upcoming event</div>
                                <h6 class="event_time_loc">
                                    <span class="date_time"><?php echo $latest->start_date; ?></span>
                                    <span class="loc"><?php echo $latest->location; ?></span>
                                </h6>
                            </div>
                            <h4 class="event_title"><a href="<?php echo base_url('events/view/' . $latest->slug); ?>"><?php echo $latest->title; ?></a></h4>
                            <p class="event_summery"><?php echo $latest->objective; ?></p>
                        <?php endif?>
                    </div>

                    <?php foreach ($events as $key => $event) {?>
                        <div class="col-sm-6 col-md-3 upcoming_events">
                            <div class="row event_cover_photo">
                                <img src="<?php echo FILE_UPLOAD_PATH . $event->picture; ?>" alt="event image" class="img-responsive">
                                <h6 class="event_time_loc">
                                    <span class="date_time"><?php echo $event->start_date; ?> AT <?php echo $event->location; ?></span>
                                </h6>
                            </div>
                            <h5 class="event_title"><a href="<?php echo base_url('events/view/' . $event->id); ?>"><?php echo $event->title; ?></a></h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </section>

        <section class="row quotes_row style2">
            <div class="container">
                <div class="row sectionTitle text-center">
                    <h6 class="label label-default">DONORS OVER THE WORLD</h6>
                    <h3>WHAT OUR DONORS OVER THE WORLD ARE SAYING</h3>
                </div>
                <div class="row donors_qoute">
                    <?php
if ($qoutes) {
    foreach ($qoutes as $key => $qoute) {?>
                    <div class="item col-sm-4 quotation_block text-center">
                        <div class="quote_block row">
                            <span class="quote_sign">“</span>
                            <p><?php echo $qoute->qoute; ?></p>
                        </div>
                        <h5><?php echo $qoute->donor_name; ?></h5>
                        <h6><?php echo $qoute->designation; ?></h6>
                        <h5><?php echo $qoute->company_name; ?></h5>
                    </div>
                <?php }}?>
                </div>
                </div>
            </div>
        </section>

        <section class="row beVolunteer text-center">
            <div class="container beVolunteerBox">
                <div class="row sectionTitle text-center">
                    <h6 class="label label-default">for good</h6>
                    <h3>become volunteer</h3>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisc elit. Nam malesuada dapibus diam, ut fringilla purus efficitur eget imspurings.</p>
                <?php //echo anchor('volunteers', 'join us now', ['class' => "btn-primary"]); ?>
                <a href="<?php echo base_url('volunteers/register') ?>" class="btn-primary">join us now</a>
            </div>
        </section>

        <section class="row latest_news">
            <div class="container">
                <div class="row sectionTitle text-center">
                    <h6 class="label label-default">NEWS OF HELPING HANDS</h6>
                    <h3>LATEST NEWS AT HELPING HANDS</h3>
                </div>
                <div class="row">
                    <?php if ($news) {foreach ($news as $key => $n_value) {?>
                    <div class="latest-post col-md-3 col-sm-6" style="text-align: left;">
                        <div class="row m0 featured_cont">
                            <img src="<?php echo image_url($n_value->images); ?>" alt="" class="img-responsive">
                        </div>
                        <h5 class="post-title"><a href="#"><?php echo $n_value->title; ?></a></h5>
                        <h6 class="post-meta"><a href="#"><?php echo date_format(date_create($n_value->created_at), 'd-M-Y'); ?></a>  By <a href="#"><?php echo $n_value->author; ?></a></h6>
                        <style type="text/css">.post-excerpts p { line-height: 2 }</style>
                        <div class="post-excerpts row m0"> <?php echo character_limiter($n_value->content, 100); ?></div>
                        <a href="<?php echo base_url('news/view/' . $n_value->slug); ?>" class="btn-primary btn-outline">read more</a>
                    </div>
                <?php }}?>
                </div>
            </div>
        </section>

        <!-- <section class="row newsletter_signup style2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <h4>NEWSLETTER SIGN-UP</h4>
                        <p>Praesent diam massa, interdum quis ex id, laoreet interdum odio.</p>
                    </div>
                    <form class="col-sm-7 form-inline newsletter_signup_form style2">
                        <input type="text" class="form-control" placeholder="Name">
                        <input type="email" class="form-control" placeholder="Email Address">
                        <input type="submit" value="submit" class="btn-primary white">
                    </form>
                </div>
            </div>
        </section> ------>

