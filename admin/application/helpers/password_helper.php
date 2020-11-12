<?php

function hashing_password($password) {
    $options = ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3];
    return password_hash($password, PASSWORD_ARGON2I, $options);
}

function check_login() {
    $CI = &get_instance();
    if ($CI->ion_auth->logged_in() == FALSE) {
        redirect('auth/login');
    }
}

?>
