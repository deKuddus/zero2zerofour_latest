var member_form = $("#member_form");
if (validate_member_form(member_form) != false) {
    member_form.ajaxForm({
        url: base_url + 'member/register_new_member',
        beforeSend: function() {
            member_form.find('#member_register_button').attr('disabled', true);
            var member_photo = $('#member_photo');
            var registration_card = $('#registration_card');
            if (!member_photo.val()) {
                member_form.find('#member_register_button').attr('disabled', false);
                toastr.warning('Please upload your Photo');
                return false;
            } else if (!registration_card.val()) {
                member_form.find('#member_register_button').attr('disabled', false);
                toastr.warning('Please upload your SSC registration card or certificate');
                return false;
            }
        },
        error: function(jqXHR, exception) {
            failed_error(jqXHR, exception)
        },
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.message);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            } else if (response.status == 202) {
                member_form.find('#member_register_button').attr('disabled', false);
                toastr.warning(response.message);
            } else {
                member_form.find('#member_register_button').attr('disabled', false);
                toastr.error(response);
            }
        }
    });
}

function validate_member_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'mobile': {
                required: true,
                minlength: 11,
                number: true
            },
            'street_address': {
                required: true
            },
            'address_line': {
                required: true
            },
            'city': {
                required: true
            },
            'post_code': {
                required: true
            },
            'country': {
                required: true
            },
            'state': {
                required: true
            },
            'password': {
                required: true,
                minlength: 6
            },
            'national_id': {
                required: true
            },
            'member_photo': {
                required: true
            }
        },
        messages: {
            'name': {
                required: "Full name is required"
            },
            'email': {
                required: 'Email address is required',
                email: "provide a valid email"
            },
            'mobile': {
                required: "please enter your mobile number",
                minlength: "mobile number can not be less than 11 character"
            },
            'street_address': {
                required: "street address is required"
            },
            'address_line': {
                required: "address line is required"
            },
            'city': {
                required: "city name is required"
            },
            'post_code': {
                required: "Postal Code is required"
            },
            'password': {
                required: "please provide a password",
                minlength: "your password must be at least 6 characters long"
            },
            'national_id': {
                required: "National Id card photo is required"
            },
            'member_photo': {
                required: "Your photo is required"
            }
        }
    });
}
var member_edit_form = $("#member_edit_form");
if (validate_member_edit_form(member_edit_form) != false) {
    member_edit_form.ajaxForm({
        url: base_url + 'member/update_member',
        beforeSend: function() {},
        error: function(jqXHR, exception) {
            failed_error(jqXHR, exception)
        },
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.message);
                setTimeout(function() {
                    window.location = base_url + 'member/accounts.html';
                }, 2000);
            } else if (response.status == 202) {
                toastr.warning(response.message);
            } else {
                toastr.error(response);
            }
        }
    });
}

function validate_member_edit_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'mobile': {
                required: true,
                minlength: 11,
                number: true
            },
            'street_address': {
                required: true
            },
            'police_station': {
                required: true
            },
            'post_code': {
                required: true
            },
            'country': {
                required: true
            },
            'state': {
                required: true
            }
        },
        messages: {
            'name': {
                required: "Full name is required"
            },
            'email': {
                required: 'Email address is required',
                email: "provide a valid email"
            },
            'mobile': {
                required: "please enter your mobile number",
                minlength: "mobile number can not be less than 11 character"
            },
            'street_address': {
                required: "street address is required"
            },
            'police_station': {
                required: "address line is required"
            },
            'post_code': {
                required: "Postal Code is required"
            }
        }
    });
}
var member_login_form = $("#member_login_form");
if (validate_member_login_form(member_login_form) != false) {
    member_login_form.ajaxForm({
        url: base_url + 'member/login_member',
        beforeSend: function() {
            member_login_form.find('#login_member_button').attr('disabled', true);
        },
        error: function(jqXHR, exception) {
            failed_error(jqXHR, exception)
        },
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.message);
                setTimeout(function() {
                    window.location = 'accounts';
                }, 2000);
            } else {
                member_login_form.find('#login_member_button').attr('disabled', false);
                $('#messages').html(response);
                $('#messages').show();
            }
        }
    });
}
$(document).on('focus', '#email,#password', function() {
    $('#messages').hide();
});

function validate_member_login_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'email': {
                required: true,
                email: true
            },
            'password': {
                required: true
            }
        },
        messages: {
            'email': {
                required: 'Please enter your email',
                email: "provide a valid email"
            },
            'password': {
                required: "Please enter your password",
            }
        }
    });
}
var forgot_password = $("#forgot_password");
if (validate_forgot_password(forgot_password) != false) {
    forgot_password.ajaxForm({
        url: base_url + 'member/verify_user_to_reset_password',
        beforeSend: function() {
            forgot_password.find('#forgot_password_submit').val('Please wait ...');
        },
        error: function(jqXHR, exception) {
            failed_error(jqXHR, exception)
        },
        success: function(response) {
            if (response.status == 200) {
                forgot_password.find('#forgot_password_submit').val('Submit');
                $('#messages').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                forgot_password[0].reset();
            } else {
                $('#messages').html(response);
                $('#messages').show();
            }
        }
    });
}

function validate_forgot_password(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'email': {
                required: true,
                email: true
            }
        },
        messages: {
            'email': {
                required: 'Please enter your email',
                email: "provide a valid email"
            }
        }
    });
}
var reset_password = $("#reset_password");
if (validate_reset_password(reset_password) != false) {
    reset_password.ajaxForm({
        url: base_url + 'member/update_user_password',
        beforeSend: function() {
            forgot_password.find('#forgot_password_submit').val('Please wait ...');
        },
        error: function(jqXHR, exception) {
            failed_error(jqXHR, exception)
        },
        success: function(response) {
            if (response.status == 200) {
                forgot_password.find('#forgot_password_submit').val('Submit');
                $('#messages').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                setTimeout(function() {
                    window.location = 'login.html';
                }, 2000);
            } else {
                $('#messages').html(response);
                $('#messages').show();
            }
        }
    });
}

function validate_reset_password(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'password': {
                required: true,
                minlength: 8
            },
            'confirm_password': {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            'password': {
                required: 'Please enter your new password',
                minlength: "Minimum Password length is 8 character"
            },
            'confirm_password': {
                required: 'Please enter your password again',
                equalTo: "password not match"
            }
        }
    });
}

function DisplayImagePreview(input, append_id) {
    if (input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            append_id.attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).on('change', '#registration_card', function() {
    var append_id = $('#registation_card_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#member_photo', function() {
    var append_id = $('#member_photo_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
populateCountries("v_country", "v_state");