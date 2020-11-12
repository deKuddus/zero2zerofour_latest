toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 2000
};

function validate_history_edit_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'mission': {
                required: true
            },
            'vision': {
                required: true
            },
            'theme_title': true
        },
        messages: {
            'mission': {
                required: "mission field is required"
            },
            'vision': {
                required: "vision field required"
            },
            'theme_title': {
                required: "theme title is required"
            }
        }
    });
}
var mission_form = $('#mission_form');
if (validate_history_edit_form(mission_form) != false) {
    mission_form.ajaxForm({
        url: base_url + 'setting/mission_update',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}
// CKEDITOR.replace('mission', {
//     enterMode: CKEDITOR.ENTER_BR
// });
// CKEDITOR.replace('vision', {
//     enterMode: CKEDITOR.ENTER_BR
// });
// CKEDITOR.replace('theme_title', {
//     enterMode: CKEDITOR.ENTER_BR
// });