<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->module('template');
    }
    public function index() {
        $this->register_page();
    }

    public function register_page() {
        is_loggedin();
        $this->data['title']       = 'Member Registration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'member';
        $this->data['view_file']   = 'register';
        $this->template->site_ui($this->data);
    }

    public function edit($id) {
        is_loggedin();
        $this->data['member']      = $this->member_model->get_members($id);
        $this->data['title']       = 'Member Registration | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'member';
        $this->data['view_file']   = 'edit';
        $this->template->site_ui($this->data);
    }

    public function register_new_member() {
        // var_dump($this->member_model->get_last_sequence());die;
        if (isset($_POST)) {
            if ($this->member_model->duplicate_email(xss_clean($_POST['email'])) == true) {
                response('woops! Given email already taken', 202);
            }

            if (isset($_FILES) && !empty($_FILES['member_photo']['name']) && !empty($_FILES['registration_card']['name'])) {

                $this->load->library('upload', image_config('member'));
                if ($this->upload->do_upload('member_photo') == true) {
                    $data         = $this->upload->data();
                    $member_photo = 'member/' . $data['file_name'];
                    resizeImage('uploads/' . $member_photo, 'member');
                    if ($member_photo) {
                        $this->load->library('upload', image_config('member'));
                        if ($this->upload->do_upload('registration_card') == true) {
                            $data              = $this->upload->data();
                            $registration_card = 'member/' . $data['file_name'];
                        } else {
                            $image_err = $this->upload->display_errors();
                            response($image_err);
                        }
                    }
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
                $m_data = [
                    'name'              => xss_clean($_POST['name']),
                    'email'             => xss_clean($_POST['email']),
                    'mobile'            => xss_clean($_POST['mobile']),
                    'date_of_birth'     => xss_clean($_POST['date_of_birth']),
                    'street_address'    => xss_clean($_POST['street_address']),
                    'police_station'    => xss_clean($_POST['police_station']),
                    'post_code'         => xss_clean($_POST['post_code']),
                    'country'           => xss_clean($_POST['country']),
                    'state'             => xss_clean($_POST['state']),
                    'password'          => hashing_password(xss_clean($_POST['password'])),
                    'member_photo'      => $member_photo,
                    'registration_card' => $registration_card,
                    'member_id'         => 'MID-' . date('Y') . '-' . date('m') . '-' . $this->member_model->get_last_sequence(),
                ];
                if ($this->member_model->registger_new_member($m_data) == true) {
                    response('Registration success, Pleas Wait For Admin Verification', 200);
                }
            } else {
                response('National id card Photo and your photo is required');
            }

        }
    }

    public function update_member() {
        $id          = $this->input->post('member_id');
        $designation = $this->input->post('designation', TRUE);
        $m_data      = array();
        if (isset($_POST)) {
            if ($this->member_model->duplicate_email($_POST['email'], $id) == false) {
                if (isset($_FILES)) {
                    $this->load->library('upload', image_config('member'));
                    $data = $this->upload_member_documents($_FILES, $id);

                    if (isset($data['member_photo'])) {
                        $m_data['member_photo'] = $data['member_photo'];
                    }

                }
                $m_data['name']           = $this->input->post('name', TRUE);
                $m_data['email']          = $this->input->post('email', TRUE);
                $m_data['mobile']         = $this->input->post('mobile', TRUE);
                $m_data['date_of_birth']  = $this->input->post('date_of_birth', TRUE);
                $m_data['street_address'] = $this->input->post('street_address', TRUE);
                $m_data['police_station'] = $this->input->post('police_station', TRUE);
                $m_data['post_code']      = $this->input->post('post_code', TRUE);
                if (isset($_POST['country']) && $_POST['country'] != '' && $_POST['country'] != '-1') {
                    $m_data['country'] = $this->input->post('country', TRUE);
                    $m_data['state']   = $this->input->post('state', TRUE);
                }

                // var_dump($m_data);exit;
                if ($this->member_model->update_member($id, $m_data) == true) {
                    response('Member profile updated', 200);
                }
            } else {
                response('woops! Given is Email Exist', 202);
            }
        }
    }
    public function upload_member_documents($files, $id) {
        $d_data = array();
        $_FILES = $files;
        if (!empty($_FILES['member_photo']['name'])) {
            if ($this->unlink_file($id, 'photo') == true) {
                if ($this->upload->do_upload('member_photo') == true) {
                    $data                   = $this->upload->data();
                    $d_data['member_photo'] = 'member/' . $data['file_name'];
                    resizeImage('uploads/' . $d_data['member_photo'], 'member');
                } else {
                    $image_err = $this->upload->display_errors();
                    response($image_err);
                }
            }
        }
        return $d_data;
    }

    public function unlink_file($id, $type) {
        if ($type == 'photo') {
            $file = $this->member_model->get_members($id)->member_photo;
            if ($file) {
                @unlink('uploads/' . $file);
            }
            return true;
        }
    }

    public function login() {
        if (not_is_loggedin() == TRUE) {
            redirect('member/accounts');
        }
        $this->data['home_page']   = TRUE;
        $this->data['title']       = 'Member Login | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'member';
        $this->data['view_file']   = 'login';
        $this->template->site_ui($this->data);
    }

    public function login_member() {
        $email    = xss_clean($_POST['email']);
        $password = xss_clean($_POST['password']);
        if (isset($email) && !empty($email)) {
            if (isset($password) && !empty($password)) {
                $is_exist = $this->member_model->check_account_exist(xss_clean($_POST['email']), xss_clean($_POST['password']));
                if (!empty($is_exist) && $is_exist != false) {
                    $session_data = ['login' => true, 'member_id' => $is_exist->id, 'member_name' => $is_exist->name, 'member_email' => $is_exist->email];
                    $this->session->set_userdata($session_data);
                    response('Success', 200);
                } else if ($is_exist == false) {
                    response('No accounts found with this cridentials');
                } else {
                    response('woops ! Incorrect Password');
                }
            } else {
                response('Email and Password is required to login');
            }
        } else {
            response('Email and Password is required to login');
        }
    }

    public function accounts() {
        if (is_loggedin() == FALSE) {
            redirect('member/login');
        }
        $this->data['title']       = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $member_id                 = $this->session->userdata('member_id');
        $this->data['member']      = $this->member_model->get_member($member_id);
        $this->data['orders']      = $this->member_model->get_member_order($member_id);
        $this->data['premium']     = $this->member_model->get_membership(1);
        $this->data['lifetime']    = $this->member_model->get_membership(2);
        $this->data['previlize']   = $this->member_model->get_membership(3);
        $this->data['view_module'] = 'member';
        $this->data['view_file']   = 'profile';
        $this->template->site_ui($this->data);
    }

    public function invoice() {
        $order_id            = $this->input->get('order_id', TRUE);
        $this->data['order'] = $this->member_model->get_order_by_code($order_id);
        if ($this->data['order'] == false) {
            $this->data['view_module'] = 'template';
            $this->data['view_file']   = '_404';
            $this->template->site_ui($this->data);
        } else {
            $this->data['order_id'] = $order_id;
            $this->data['title']    = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
            $this->template->site_ui_invoice($this->data);
        }
    }

    public function logout() {
        $session_data = ['login', 'member_id', 'member_name', 'member_email'];
        $this->session->unset_userdata($session_data);
        redirect('home');
    }

    public function forgot_password() {
        if (is_loggedin() == TRUE) {
            redirect('member/accounts');
        }
        $this->data['title']       = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
        $this->data['view_module'] = 'member';
        $this->data['view_file']   = 'forgot_password';
        $this->template->site_ui($this->data);
    }

    public function verify_user_to_reset_password() {
        $email = xss_clean($_POST['email']);
        if (isset($email) && !empty($email)) {
            $user = $this->member_model->get_member($id = 0, $email);
            $code = uniqid();
            if ($user != false) {
                if ($this->member_model->update_user_reset_code($email, $code) == true) {
                    $data['link'] = base_url() . 'member/reset_password?email=' . $user->email . '&&code=' . $code;
                    $html         = $this->load->view('reset_mail', $data, true);
                    $this->email->from($this->config->item('smtp_user'), 'Zero2Zero4');
                    $this->email->to($_POST['email']);
                    $this->email->subject('Reset Your Password for Zero2Zero4');
                    $this->email->message($html);
                    $this->email->send();
                    response('Please check Your email to reset your password', 200);
                }
            } else {
                response('account not found, please try again');
            }
        }
    }

    public function reset_password() {
        $email = xss_clean($_GET['email']);
        $code  = xss_clean($_GET['code']);
        if (isset($email) && !empty($email)) {
            if (isset($code) && !empty($code)) {
                $member = $this->member_model->get_member_by_email_code($code, $email);
                if ($member != false) {
                    $this->data['title']       = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
                    $this->data['member']      = $member;
                    $this->data['view_module'] = 'member';
                    $this->data['view_file']   = 'reset_password';
                    $this->template->site_ui($this->data);
                } else {
                    $this->data['title']       = 'My account | SSC 2002 & HSC 2004 Bangladesh Foundation';
                    $this->data['member']      = '';
                    $this->data['view_module'] = 'member';
                    $this->data['view_file']   = 'reset_password';
                    $this->template->site_ui($this->data);
                }
            }
        }
    }

    public function update_user_password() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            if ($this->member_model->update_user_password($_POST['email'], $_POST['password']) == true) {
                response('password successfull changed', 200);
            } else {
                response('password can not be empty');
            }
        }
    }

}
