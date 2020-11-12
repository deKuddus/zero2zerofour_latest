<?php

/**
 * Frontend_Controller
 */
class Admin_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // if ($this->ion_auth->logged_in() == FALSE) {
        //     redirect('auth/login_form');
        // }
    }
}

?>