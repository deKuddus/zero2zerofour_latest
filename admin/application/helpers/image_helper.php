<?php

function image_config($path) {
    return $config = array(
        'upload_path'   => "../uploads/$path/",
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

function image_url($url) {
    $path = FILE_UPLOAD_PATH . '/' . $url;
    return $path;
}

function unlink_file($file) {
    $file_array = explode('/', $file);
    if (in_array('default.png', $file_array)) {
        return true;
    } else {
        $path = "../uploads/$file";
        if (@unlink($path)) {
            return true;
        }
    }
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
function user_data($column) {
    $CI   = &get_instance();
    $id   = $CI->session->userdata('user_id');
    $user = $CI->db->where('id', $id)->get('users')->row();
    if ($column == 'image') {
        if ($user->image) {
            return $user->image;
        } else {
            return '';
        }
    } else if ($column == 'username') {
        return $user->first_name . ' ' . $user->last_name;
    }
}

function user_role() {
    $CI     = &get_instance();
    $id     = $CI->session->userdata('user_id');
    $groups = $CI->ion_auth->get_users_groups($id)->result();
    return $groups;

}
?>
