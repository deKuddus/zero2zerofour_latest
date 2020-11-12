<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <section class="row page-header" style="background: url('<?php echo image_url($this->config->item('contact_page')); ?>');">
        <div class="container">
            <h4>contact us</h4>
        </div>
    </section>
    <div class="page-wrapper ">
    <section class="row contact-content page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="contact_page_title">have an idea to help us ? - contact us</h3>
                    <p class="contact_page_para">Pellentesque mollis eros quis massa interdum porta et vel nisi. Duis vel viverra quamam molesvulputate femy contenteu.</p>
                    <form method="post" class="row m0 contact-form" id="contactForm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            <div class="form-error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            <div class="form-error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                            <div class="form-error" style="color: red;"></div>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" placeholder="Message" class="form-control"></textarea>
                            <div class="form-error" style="color: red;"></div>
                        </div>
                        <input type="submit" value="submit" class="btn-primary">
                    </form>
                    <h3 class="contact_page_title map-title">find us on map</h3>
                    <div id="mapBox" class="row m0" data-lat="37.3818288" data-lon="-122.0636325" data-zoom="15" data-marker="images/map-marker.png"></div>
                </div>
                <div class="col-md-4 contact-sidebar">
                     <div class="row m0 address_box">
                        <div class="inner row">
                            <h3><?php echo $this->config->item('company_city_dhaka'); ?></h3>
                            <address>
                                <?php echo $this->config->item('company_address_dhaka'); ?> <br>
                                <?php echo $this->config->item('company_city_dhaka'); ?> <br>
                                <?php echo $this->config->item('company_country'); ?>. <br>
                                <br>
                                tel. <?php echo $this->config->item('company_phone_dhaka'); ?> <br>
                            </address>
                        </div>
                    </div>
                    <div class="row m0 address_box">
                        <div class="inner row">
                            <h3><?php echo $this->config->item('company_city'); ?></h3>
                            <address>
                                <?php echo $this->config->item('company_address'); ?> <br>
                                <?php echo $this->config->item('company_city'); ?> <br>
                                <?php echo $this->config->item('company_country'); ?>. <br>
                                <br>
                                tel. <?php echo $this->config->item('company_phone'); ?> <br>
                            </address>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
