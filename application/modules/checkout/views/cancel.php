<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--     <section class="row page-header">
        <div class="container">
            <h4> 404 error </h4>
        </div>
    </section> -->

   <section class="row content_404" style="background-color: #dddddd;">
        <div class="container">
            <div class="row error_message" style="background-color: #dfdfdf;">
                <h2>Canceled Your payment procedure</h2>
                <div class="row m0 buttons">
                    <a href="<?php echo base_url('/') ?>" class="btn-primary btn-outline dark" style="font-size: 25px;"> <i class="fa fa-home"></i> &nbsp;Go Home</a>
                </div>
            </div>
            <div class="row sidebar_404">
                <div class="col-md-6 address_box">
                    <div class="inner row">
                        <h3><?php echo $this->config->item('company_city'); ?></h3>
                        <address>
                           <?php echo $this->config->item('company_address'); ?> <br>
                            <?php echo $this->config->item('company_city'); ?> <br>
                            <?php echo $this->config->item('company_country'); ?>. <br>
                            <br>
                            tel. <?php echo $this->config->item('company_phone'); ?> <br>
                            email. <?php echo $this->config->item('company_email'); ?> <br>
                            <br>
<!--                             <a href="">Need help? Have questions? Check out our Help Center.</a> -->
                        </address>
                    </div>
                </div>
                <div class="col-md-6 address_box text-center">
                    <div class="inner row">
                        <i class="fa fa-question"></i>
                        <h3>have questions?</h3>
                        <p>Everything you need to know about helping hand</p>
                         <a href="<?php echo base_url('faqs.html') ?>" class="btn-primary btn-outline dark">go to faq</a> OR <a class="btn-primary btn-outline dark" href="<?php echo base_url('contact.html') ?>">Contact with us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
