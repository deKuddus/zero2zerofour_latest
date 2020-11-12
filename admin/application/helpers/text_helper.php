<?php

function textShort($text, $limit = 300) {
    $text = $text . "";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strripos($text, ' '));
    $text = $text . "....";
    return $text;
}

function get_user_fullname_by_username($username) {
    $CI    = &get_instance();
    $query = $CI->db->select('name')->where('username', $username)->get('administration');
    $name  = $query->row();
    if ($name) {
        return $name->name;
    } else {
        return 1;
    }
}
function dateFormater($date) {
    return date('F j, Y, g:i a', strtotime($date));
}

function config($key) {
    $CI    = &get_instance();
    $query = $CI->db->where('config_key', $key)->get('config');
    foreach ($query->result() as $key => $value) {
        return $value->value;
        // var_dump($value->value);exit();
    }
}

function clean_special_character($string) {
    $string = str_replace(' ', '-', $string);
    return preg_replace('/[^A-Za-z0-9-]/', '', $string);
}

function go_back() {
    $referer = filter_var(isset($_SERVER['HTTP_REFERER']), FILTER_VALIDATE_URL);

    if (!empty($referer)) {

        return '<a href="' . $referer . '" title="Return to the previous page" class = "btn btn-primary"><i class="fa fa-arrow-left"></i> Go back</a>';

    } else {

        return '<a href="javascript:history.go(-1)" title="Return to the previous page" class = "btn btn-primary"><i class="fa fa-arrow-left"></i> Go back</a>';

    }
}

function eamil_config($html = false) {
    $CI                    = &get_instance();
    $config                = array();
    $config['protocol']    = $CI->config->item('protocol');
    $config['smtp_host']   = $CI->config->item('smtp_host');
    $config['smtp_user']   = $CI->config->item('smtp_user');
    $config['smtp_pass']   = $CI->config->item('smtp_pass');
    $config['smtp_port']   = $CI->config->item('smtp_port');
    $config['smtp_crypto'] = $CI->config->item('smtp_crypto');
    $config['newline']     = "\r\n";
    $config['crlf']        = "\r\n";
    $config['validation']  = TRUE;
    $config['charset']     = 'utf-8';
    if ($html) {
        $config['mailtype'] = 'html'; // or html
    }

    return $config;
}
?>