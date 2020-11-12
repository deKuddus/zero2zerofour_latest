<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view('admin_theme/components/page_head');  ?>
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="<?php echo site_url('admin_theme/dashboard'); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo config_item('site_name'); ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
          <div class="profile_pic">
            <img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="..." class="img-circle profile_img">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2>John Doe</h2>
          </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="index.html">Dashboard</a></li>
                  <li><a href="index2.html">Dashboard2</a></li>
                  <li><a href="index3.html">Dashboard3</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/form'); ?>">General Form</a></li>
                  <li><a href="<?php echo site_url('admin_theme/form_advanced'); ?>">Advanced Components</a></li>
                  <li><a href="<?php echo site_url('admin_theme/form_validation'); ?>">Form Validation</a></li>
                  <li><a href="<?php echo site_url('admin_theme/form_wizards'); ?>">Form Wizard</a></li>
                  <li><a href="<?php echo site_url('admin_theme/form_upload'); ?>">Form Upload</a></li>
                  <li><a href="<?php echo site_url('admin_theme/form_buttons'); ?>">Form Buttons</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/general_elements'); ?>">General Elements</a></li>
                  <li><a href="<?php echo site_url('admin_theme/media_gallery'); ?>">Media Gallery</a></li>
                  <li><a href="<?php echo site_url('admin_theme/typography'); ?>">Typography</a></li>
                  <li><a href="<?php echo site_url('admin_theme/icons'); ?>">Icons</a></li>
                  <li><a href="<?php echo site_url('admin_theme/glyphicons'); ?>">Glyphicons</a></li>
                  <li><a href="<?php echo site_url('admin_theme/widgets'); ?>">Widgets</a></li>
                  <li><a href="<?php echo site_url('admin_theme/invoice'); ?>">Invoice</a></li>
                  <li><a href="<?php echo site_url('admin_theme/inbox'); ?>">Inbox</a></li>
                  <li><a href="<?php echo site_url('admin_theme/calendar'); ?>">Calendar</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/tables'); ?>">Tables</a></li>
                  <li><a href="<?php echo site_url('admin_theme/tables_dynamic'); ?>">Table Dynamic</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/chartjs'); ?>">Chart JS</a></li>
                  <li><a href="<?php echo site_url('admin_theme/chartjs2'); ?>">Chart JS2</a></li>
                  <li><a href="<?php echo site_url('admin_theme/morisjs'); ?>">Moris JS</a></li>
                  <li><a href="<?php echo site_url('admin_theme/echarts'); ?>">ECharts</a></li>
                  <li><a href="<?php echo site_url('admin_theme/other_charts'); ?>">Other Charts</a></li>
                </ul>
              </li>
              <!-- <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php //echo site_url('admin_theme/fixed_sidebar'); ?>">Fixed Sidebar</a></li>
                  <li><a href="<?php //echo site_url('admin_theme/fixed_footer'); ?>">Fixed Footer</a></li>
                </ul>
              </li> -->
            </ul>
          </div>
          <div class="menu_section">
            <h3>Live On</h3>
            <ul class="nav side-menu">
              <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/e_commerce'); ?>">E-commerce</a></li>
                  <li><a href="<?php echo site_url('admin_theme/projects'); ?>">Projects</a></li>
                  <li><a href="<?php echo site_url('admin_theme/project_detail'); ?>">Project Detail</a></li>
                  <li><a href="<?php echo site_url('admin_theme/contacts'); ?>">Contacts</a></li>
                  <li><a href="<?php echo site_url('admin_theme/profile'); ?>">Profile</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin_theme/page_403'); ?>">403 Error</a></li>
                  <li><a href="<?php echo site_url('admin_theme/page_404'); ?>">404 Error</a></li>
                  <li><a href="<?php echo site_url('admin_theme/page_500'); ?>">500 Error</a></li>
                  <li><a href="<?php echo site_url('admin_theme/plain_page'); ?>">Plain Page</a></li>
                  <li><a href="<?php echo site_url('admin_theme/login'); ?>">Login Page</a></li>
                  <li><a href="<?php echo site_url('admin_theme/pricing_tables'); ?>">Pricing Tables</a></li>
                </ul>
              </li>
              <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="#level1_1">Level One</a>
                    <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li class="sub_menu"><a href="level2.html">Level Two</a>
                        </li>
                        <li><a href="#level2_1">Level Two</a>
                        </li>
                        <li><a href="#level2_2">Level Two</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#level1_2">Level One</a>
                    </li>
                </ul>
              </li>                  
              <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
            </ul>
          </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav class="" role="navigation">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="">John Doe
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li>
                  <a href="javascript:;">
                    <span class="badge bg-red pull-right">50%</span>
                    <span>Settings</span>
                  </a>
                </li>
                <li><a href="javascript:;">Help</a></li>
                <li><a href="<?php echo site_url('admin_theme/dashboard'); ?>login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>

            <li role="presentation" class="dropdown">
              <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-green">6</span>
              </a>
              <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                <li>
                  <a>
                    <span class="image"><img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <a>
                    <span class="image"><img src="<?php echo site_url('public/admin_theme/images/img.jpg') ?>" alt="Profile Image" /></span>
                    <span>
                      <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                    </span>
                    <span class="message">
                      Film festivals used to be do-or-die moments for movie makers. They were where...
                    </span>
                  </a>
                </li>
                <li>
                  <div class="text-center">
                    <a>
                      <strong>See All Alerts</strong>
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
      <!-- Subview -->
      <?php $this->load->view($subview); // Sub view is set in controller ?>
      <!-- /Subview -->
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
      <div class="pull-right">
        <?php echo config_item('site_footer_content'); ?>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>
<?php $this->load->view('admin_theme/components/page_footer');  ?>
    