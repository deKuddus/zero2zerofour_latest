<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['/']                    = 'dashboard';
$route['default_controller']   = 'dashboard';
$route['administration']       = 'Administration';
$route['404_override']         = 'errors/index';
$route['translate_uri_dashes'] = FALSE;

//event edit
$route['events/edit/:id'] = 'events/edit';
