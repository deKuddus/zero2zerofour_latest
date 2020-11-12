    <nav class="navbar navbar-default navbar2">
        <div class="container">
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="nav social_navbar navbar-right">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="row header1">
        <div class="container">
            <div class="logo pull-left">
                <a href="#"><img src="<?php echo base_url() ?>public/assets/images/logo.png" alt="SSC 2002 & HSC 2004 Bangladesh Foundation"></a>
            </div>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('home.html') ?>">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About
                         <i class="fa fa-angle-down" style=""></i>
                         </a>
                         <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('about.html') ?>">About Us</a></li>
                            <li><a href="<?php echo base_url('about/team.html') ?>">Our Team</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url('causes.html') ?>">Our Cause</a></li>
                    <li><a href="<?php echo base_url('news.html') ?>">News</a></li>
                    <li><a href="<?php echo base_url('merchandise.html') ?>">Merchandise</a></li>
                    <li><a href="<?php echo base_url('events.html') ?>">Events</a></li>
                    <li><a href="<?php echo base_url('contacts.html') ?>">Contacts</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User
                         <i class="fa fa-angle-down" style=""></i>
                        </a>
                         <ul class="dropdown-menu">
                            <li><a href="cause-listing-list.html">Register</a></li>
                            <li><a href="cause-listing-grid.html">Login</a></li>
                            <li><a href="cause-listing-grid.html">Profile</a></li>
                            <li><a href="cause-listing-grid.html">Logout</a></li>
                        </ul>
                    </li>
                    <li class="sd-minicart-icon mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page" data-toggle="modal" data-target="#exampleModal">
                        <a class="sd-minicart-link" href="#" title="View cart content">
                            <i style="font-size: 18px;" class="fa fa-shopping-cart"></i>
                            <span class="sd-nr sidr-class-sd-nr" >
                                <span class="sd-items-count" id="cart_quantity">0</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>