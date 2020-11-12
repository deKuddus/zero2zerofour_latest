<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('project_page')); ?>');">
        <div class="container">
            <h4>PROJECT Details</h4>
        </div>
    </section>

<section class="row gallery-content" style="background-color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 single-event">
                    <div class="media event-header">
                        <div class="media-left">
                            <span><img src="<?php echo image_url($project->picture); ?>" alt=""></span>
                        </div>
                        <div class="media-body">
                            <div class="row m0 event-place info-row">
                                <div class="row m0"><i class="fa fa-map-marker"></i><span><?php echo $project->location; ?></span></div>
                            </div>
                            <div class="row m0 event-place info-row">
                                <div class="row m0"><i class="fa fa-calendar"></i><span><?php echo date_format(date_create($event->created_at), 'd-M-Y'); ?> </span></div>
                            </div>
                            <div class="row m0 event-place info-row text-center">
                                <div class="row m0">
                                    <a class="btn-primary btn-outline white">PROJECT GOAL FUND <br> <span style="font-size: 16px;font-weight: bold">৳ &nbsp;</span><?php echo $project->goal_fund; ?></a>
                                </div>
                                <br>
                                <div class="row m0">
                                    <a href="javscript:void(0)" data-toggle="modal" data-target="#donation_modal" onclick="donate_to_cause(<?php echo $project->id; ?>,'project')" class="btn-primary btn-outline white">Help Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m0 event_title">
                        <h2 class="hhh h1 pull-left"><?php echo $project->title; ?></h2>
                    </div>

                    <p class="event-target"><?php echo $project->objective; ?></p>

                    <?php echo $project->description; ?>

                    <!-- <div class="row countdown_block m0" style="background: none !important;">
                        <div class="pull-left timer" id="example" data-date="<?php echo $project->created_at; ?>"></div>
                    </div> -->
                    <br>
                    <div class="row shareOnRow m0">
                        <a href="javscript:void(0)" onclick="donate_to_cause(<?php echo $project->id; ?>,'project')" class="btn-primary pull-left">SPONSORE NOW</a>
                        <ul class="list-unstyled">
                            <li>SHARE IT</li>


                            <li><div class="fb-share-button" data-href="http://team-executive-bd.com" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('projects/view/' . $project->id); ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div></li>
                            <li><a class="twitter-share-button btn btn-info btn-xs" href="https://twitter.com/intent/tweet?text=http://team-executive-bd.com"data-size="large"> Tweet</a></li>
                            <!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 sidebar event-sidebar">
                    <div class="row m0 widget widget-similar-project widget-similar">
                        <h4 class="hhh h2">SIMILAR upcoming PROJECTS</h4>
                        <div class="similar-project">
                            <!--PROJECT-->
                            <?php if ($related_project) {foreach ($related_project as $key => $value) {?>
                            <div class="row event-listing">
                                <div class="images_row row m0">
                                    <a href="<?php echo base_url('projects/view/' . $value->id) ?>"><img src="<?php echo image_url($value->picture); ?>" alt=""></a>
                                </div>
                                <div class="event_excepts row m0">
                                    <h4 class="event_title"><a href="<?php echo base_url('projects/view/' . $value->id) ?>"><?php echo $value->title; ?></a></h4>
                                    <h5 class="event-place"><?php echo $value->location; ?></h5>
                                    <p><?php echo $value->objective; ?></p>
                                    <a href="<?php echo base_url('projects/view/' . $value->id) ?>" class="btn-primary btn-outline">read more</a>
                                </div>
                                <div class="event-date row m0">
                                    <h5><i class="fa fa-calendar"></i><?php echo date_format(date_create($value->created_at), 'd-M-Y H:i:s') ?></h5>
                                </div>
                            </div>
<?php }} else {
    if ($all_project) {foreach ($all_project as $key => $value) {?>
                            <div class="row event-listing">
                                <div class="images_row row m0">
                                    <a href="<?php echo base_url('projects/view/' . $value->id) ?>"><img src="<?php echo image_url($value->picture); ?>" alt=""></a>
                                </div>
                                <div class="event_excepts row m0">
                                    <h4 class="event_title"><a href="<?php echo base_url('projects/view/' . $value->id) ?>"><?php echo $value->title; ?></a></h4>
                                    <h5 class="event-place"><?php echo $value->location; ?></h5>
                                    <p><?php echo $value->objective; ?></p>
                                    <a href="<?php echo base_url('projects/view/' . $value->id) ?>" class="btn-primary btn-outline">read more</a>
                                </div>
                                <div class="event-date row m0">
                                    <h5><i class="fa fa-calendar"></i><?php echo date_format(date_create($value->created_at), 'd-M-Y H:i:s') ?></h5>
                                </div>
                            </div>
<?php }}}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>