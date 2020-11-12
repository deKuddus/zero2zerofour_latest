<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['/']                    = 'home';
$route['default_controller']   = 'home';
$route['404_override']         = 'errors/index';
$route['translate_uri_dashes'] = FALSE;

//message page custom route
$route['home/message/:order_id'] = 'home/message';
$route['events/view/:id']        = 'events/view/';
