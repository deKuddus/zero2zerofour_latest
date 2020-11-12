<?php

/**
 * Frontend_Controller
 */
class Frontend_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->module('auth');
        $this->load->module('template');
        if (!$this->ion_auth->logged_in()) {

        }
    }
}

?>