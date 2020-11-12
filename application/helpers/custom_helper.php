<?php

function config($key) {
    $CI    = &get_instance();
    $value = $CI->db->where('config_key', $key)->get('config')->row();
    if (isset($value)) {
        return $value->value;
    } else {
        return " ";
    }
}
function header_image_config($key) {
    $CI    = &get_instance();
    $image = $CI->db->where('page_key', $key)->get('header_image')->row();
    if (isset($image)) {
        return $image->image;
    } else {
        return "empty";
    }
}

function textShort($text, $limit = 300) {
    $text = $text . "";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strripos($text, ' '));
    $text = $text . "....";
    return $text;
}
function dump($value) {
    echo "<pre>";
    var_dump($value);exit;
}
function image_url($url) {
    $path = FILE_UPLOAD_PATH . '/' . $url;
    return $path;
}

function hashing_password($password) {
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    return password_hash($password, PASSWORD_ARGON2I, $options);
}

function get_optional_images($id) {
    $CI    = &get_instance();
    $query = $CI->db->where('product_id', $id)->get('product_pictures');
    return $query->result();
}

function footer_news() {
    $CI    = &get_instance();
    $query = $CI->db->where('is_active', 1)->order_by('id', 'DESC')->limit(3)->get('blogs');
    return $query->result();
}
function footer_about_us() {
    $CI     = &get_instance();
    $query  = $CI->db->select('objective')->where('is_active', 1)->order_by('id', 'DESC')->get('about_us');
    $result = $query->row();
    return $result->objective;
}

function cause_by_category($category) {
    $CI    = &get_instance();
    $query = $CI->db->where(['is_active' => 1, 'category' => $category])->get('causes');
    return $query->result();
}

function image_config($path) {
    return $config = array(
        'upload_path'   => "uploads/$path/",
        'allowed_types' => "gif|jpg|png|jpeg",
        'overwrite'     => false,
        'max_size'      => "2048000",
        'height'        => 128,
        'width'         => 128,
        'encrypt_name'  => true,
    );
}
function resizeImage($filename, $path) {
    $CI           = &get_instance();
    $target_path  = $_SERVER['DOCUMENT_ROOT'] . "/uploads/$path/";
    $config_manip = array(
        'image_library'  => 'gd2',
        'source_image'   => $filename,
        'maintain_ratio' => TRUE,
        'width'          => 192,
        'height'         => 192,
    );

    $CI->load->library('image_lib', $config_manip);
    if (!$CI->image_lib->resize()) {
        $image_err = $CI->image_lib->display_errors();
        response($image_err);
    }
    $CI->image_lib->clear();
    return true;
}

function response($message = '', $status = '') {
    if (!empty($status)) {
        $data = array('status' => $status, 'message' => $message);
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    } else {
        $data = array($message);
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
function is_loggedin() {
    $CI = &get_instance();

    $meber_login  = $CI->session->userdata('login');
    $member_login = $CI->session->userdata('member_id');
    if ($member_login == true && !is_null($member_login)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
function not_is_loggedin() {
    $CI           = &get_instance();
    $meber_login  = $CI->session->userdata('login');
    $member_login = $CI->session->userdata('member_id');
    if ($member_login == true && !is_null($member_login)) {
        return TRUE;
    }
}

function get_slider() {
    $CI    = &get_instance();
    $query = $CI->db->where('is_active', 1)->get('slider')->result();
    if (!empty($query)) {
        return $query;
    } else {
        return '';
    }
}
?>