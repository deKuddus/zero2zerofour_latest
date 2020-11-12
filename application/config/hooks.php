<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|    https://codeigniter.com/user_guide/general/hooks.html
|
 */

$hook['post_controller_constructor'] = function () {

    $CI = &get_instance();

    $appConfigOptions = $CI->AppConfigModel->get_configurations();
    $header_image     = $CI->AppConfigModel->header_image();

    if ($appConfigOptions) {
        foreach ($appConfigOptions as $appConfigOption) {
            $CI->config->set_item($appConfigOption->config_key, $appConfigOption->value);
        }
    }

    if ($header_image) {
        foreach ($header_image as $image) {
            $CI->config->set_item($image->page_key, $image->image);
        }
    }
};