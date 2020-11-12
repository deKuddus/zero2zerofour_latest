var volunteer_form = $("#volunteer_form");
if (validate_volunteer_form(volunteer_form) != false) {
    volunteer_form.ajaxForm({
        url: base_url + 'volunteers/registger_new_vounteer',
        beforeSend: function() {
            volunteer_form.find('#volunteer_register_button').attr('disabled', true);
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
                volunteer_form.find('#volunteer_register_button').attr('disabled', false);
                toastr.warning(response.message);
            } else {
                volunteer_form.find('#volunteer_register_button').attr('disabled', false);
                toastr.error(response);
            }
        }
    });
}

function validate_volunteer_form(form) {
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
            }
        },
        messages: {
            'name': {
                required: "Full name is required"
            },
            'email': {
                required: 'Email address is required'
            },
            'mobile': {
                required: "mobile number is required",
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
$(document).on('change', '#national_id', function() {
    var append_id = $('#nid_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#volunteer_photo', function() {
    var append_id = $('#volunter_photo_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
populateCountries("v_country", "v_state");