<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('components/page_head');?>


<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <div class="nav head_menu">
                <div class="btn-group" style="margin: 13px 0px 15px 30px;">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Settings</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/about_us'); ?>">Abut Us</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/config'); ?>">Site Config</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/slider'); ?>">Slider</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/logo'); ?>">Logo</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/history'); ?>">History</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('setting/mission'); ?>">Mission & Vision</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('terms'); ?>">Terms & Conditions</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('privacy'); ?>">Privay & Policy</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('desclaimer'); ?>">Desclaimer</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('faq'); ?>">FAQ</a></li>
                    </ul>
                </div>
                <div class="btn-group" style="margin: 13px 0px 15px 30px;">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Header Image</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo base_url('header_image'); ?>">manage</a></li>
                    </ul>
                </div>
                <div class="btn-group" style="margin: 13px 0px 15px 30px;">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Events</button>
                    <ul class="dropdown-menu">
                       <li><a class="dropdown-item" href="<?php echo base_url('event_categories'); ?>">Manage</a></li>
                    </ul>
                </div>

                </div>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Zero2Zero4 Admin Panel.</span>

                    <li>
                        <a href="<?php echo base_url('auth/logout'); ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>


        <!-- page content -->

        <!-- Subview -->
        <?php

if (!isset($view_file)) {
    $view_file = '';
}
if (!isset($view_module)) {
    $view_module = $this->uri->segment(1);
}

if (($view_file != '') && ($view_module != '')) {
    $path = $view_module . '/' . $view_file;
    $this->load->view($path);
}
?>
        <div class="footer">
          <div class="float-right">
            <?php echo config_item('site_footer_content'); ?>
        </div>
        <div>
          <strong>Copyright</strong> Example Company &copy; 2014-2018
      </div>
  </div>

</div>
</div>
<?php $this->load->view('components/page_footer');?>
