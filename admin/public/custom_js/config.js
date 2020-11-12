toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 2000
};

function edit_config(key, title, value) {
    $("#config_title").html(title);
    $("#config_value").val(value);
    $("#config_key").val(key);
    $("#edit_config_modal").modal('show');
}
var config_edit_form = $('#config_edit_form');
if (validate_config_form(config_edit_form) != false) {
    config_edit_form.ajaxForm({
        url: base_url + 'setting/update_config',
        success: function(response) {
            if (response.status == 200) {
                config_edit_form[0].reset();
                $("#edit_config_modal").modal('hide');
                toastr.success(response.message);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            } else {
                toastr.error(response);
            }
        }
    });
}

function validate_config_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'config_value': {
                required: true
            }
        },
        messages: {
            'config_value': {
                required: "config value should not be empty"
            }
        }
    });
}