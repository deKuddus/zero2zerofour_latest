<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('projects_page')); ?>');">
        <div class="container">
            <h4>Our Projects</h4>
        </div>
    </section>
    <div class="page-wrapper ">
     <section class="row upcoming_recent_events style2">
            <div class="container">
                <div class="row sectionTitle text-center">
                   <h6 class="label label-default">PROJECTS OF 0204BANGLADESH</h6>
               </div>
               <div class="row">
                   <div class="col-sm-12 col-md-6 upcoming_events">
                   <h3>UPCOMING &amp; RECENT PROJECTS AT 0204BANGLADESH</h3>
                    <?php if ($latest): ?>
                        <div class="row event_cover_photo">
                            <img src="<?php echo image_url($latest->picture); ?>" alt="project image" class="img-responsive">
                            <div class="upcoming_label label">upcoming/recent project</div>
                            <h6 class="event_time_loc">
                                <span class="date_time"><?php echo date_format(date_create($latest->created_at), 'd-M-Y'); ?> </span>
                                <span class="loc"><?php echo $latest->location; ?></span>
                            </h6>
                        </div>
                        <h4 class="event_title"><a href="<?php echo base_url('projects/view/' . $latest->slug . '.html'); ?>"><?php echo $latest->title; ?></a></h4>
                        <p class="event_summery"><?php echo $latest->objective; ?></p>
                    <?php endif?>
                    </div>

                    <?php foreach ($projects as $key => $project) {?>
                        <div class="col-sm-6 col-md-3 upcoming_projects">
                            <div class="row project_cover_photo">
                                <img src="<?php echo FILE_UPLOAD_PATH . $project->picture; ?>" alt="project image" class="img-responsive">
                                <h6 class="project_time_loc">
                                    <span class="date_time"><?php echo date_format(date_create($project->created_at), 'd-M-Y'); ?> AT <?php echo $project->location; ?></span>
                                </h6>
                            </div>
                            <h5 class="project_title"><a href="<?php echo base_url('projects/view/' . $project->id); ?>"><?php echo $project->title; ?></a></h5>
                        </div>
                    <?php }?>
                </div>
            </div>
        </section>
