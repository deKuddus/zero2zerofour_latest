<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('components/page_head');  ?>
<!-- main content start -->
    <?php

    if (!isset($view_file)) {
        $view_file = '';
    }
    if (!isset($view_module)) {
        $view_module = $this->uri->segment(1);
    }

    if ( ($view_file != '') && ($view_module != '') ) {
        $path = $view_module.'/'.$view_file;
        $this->load->view($path);
    }
    ?>
<!-- main content end -->

<?php $this->load->view('components/page_footer');  ?>
