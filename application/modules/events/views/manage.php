<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('events_page')); ?>');">
        <div class="container">
            <h4>Our Events</h4>
        </div>
    </section>
    <div class="page-wrapper ">
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
                                <span class="date_time"><?php echo date_format(date_create($latest->start_date), 'd-M-Y'); ?> </span>
                                <span class="loc"><?php echo $latest->location; ?></span>
                            </h6>
                        </div>
                        <h4 class="event_title"><a href="<?php echo base_url('events/view/' . $latest->slug . '.html'); ?>"><?php echo $latest->title; ?></a></h4>
                        <p class="event_summery"><?php echo $latest->objective; ?></p>
                    <?php endif?>
                    </div>

                    <?php foreach ($events as $key => $event) {?>
                        <div class="col-sm-6 col-md-3 upcoming_events">
                            <div class="row event_cover_photo">
                                <img src="<?php echo FILE_UPLOAD_PATH . $event->picture; ?>" alt="event image" class="img-responsive">
                                <h6 class="event_time_loc">
                                    <span class="date_time"><?php echo date_format(date_create($event->start_date), 'd-M-Y'); ?> AT <?php echo $event->location; ?></span>
                                </h6>
                            </div>
                            <h5 class="event_title"><a href="<?php echo base_url('events/view/' . $event->id); ?>"><?php echo $event->title; ?></a></h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </section>
