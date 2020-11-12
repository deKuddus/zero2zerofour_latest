<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section class="row page-header">
        <div class="container">
            <h4> Privacy and Policy </h4>
        </div>
    </section>
    <style type="text/css">
        .mak p{
            line-height: 2;
            text-align: justify;
        }
    </style>
    <section class="row content_faqs page-content" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">

                <div class="col-md-1 col-sm-1"></div>
                <div class="col-md-10 col-sm-10">
                    <!-- <h3 class="team_page_title">Terms and Conditions</h3>
                    <p class="team_page_para about_var">Everything you need to know about helping hand. Many desktop publishing packages and rem Ipsum as their default modefancy.</p> -->

                    <div class="row m0 questions">
                        <h3 class="question_type">Our Privacy and Policy</h3>
                        <div class="panel-group question_accordion" id="question_accordion1" role="tablist" aria-multiselectable="true">

                             <?php foreach ($privacy as $key => $value) {?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo $key; ?>">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#question_accordion1" href="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse<?php echo $key; ?>">
                                            <?php echo $value->privacy_heading; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $key; ?>">
                                    <div class="panel-body mak">
                                       <?php echo htmlspecialchars_decode($value->privacy); ?>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1"></div>
            </div>
        </div>
    </section>


