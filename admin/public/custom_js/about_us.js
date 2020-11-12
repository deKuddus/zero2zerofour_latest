var about_us_list = $('#about_us_list').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: base_url + "setting/about_us_show",
        type: "POST"
    },
    dom: 'lBfrtip',
    buttons: [{
        extend: 'copy'
    }, {
        extend: 'csv'
    }, {
        extend: 'excel',
        title: 'ExampleFile'
    }, {
        extend: 'pdf',
        title: 'ExampleFile'
    }, {
        extend: 'print',
        customize: function(win) {
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');
            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
        }
    }],
    "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ]
});
toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 2000
};

function delete_about_us(about_us_id) {
    if (!isNaN(about_us_id)) {
        $.ajax({
            url: base_url + 'setting/about_us_delete',
            data: {
                about_us_id: about_us_id
            },
            method: 'post',
            datatype: 'json',
            beforeSend: function() {
                return confirm('are you sure to delete?');
            },
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            },
            success: function(data) {
                if (data.status == 200) {
                    about_us_list.ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data)
                }
            }
        });
    }
}
var new_about_us_add_form = $("#new_about_us_add_form");
if (validate_about_us_add_form(new_about_us_add_form) != false) {
    new_about_us_add_form.ajaxForm({
        url: base_url + 'setting/about_us_add',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                new_about_us_add_form[0].reset();
                $("#add_new_about_us").modal('hide');
                about_us_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_about_us_add_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'title': {
                required: true
            },
            'objective': {
                required: true
            },
            'description': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter about_us title"
            },
            'objective': {
                required: 'enter orgnaization objective'
            },
            'description': {
                required: "enter about_us operation"
            },
        }
    });
}

function edit_about_us(about_us_id) {
    if (!isNaN(about_us_id)) {
        $.ajax({
            url: base_url + 'setting/about_us_edit',
            data: {
                about_us_id: about_us_id
            },
            method: 'post',
            datatype: 'json',
            success: function(data) {
                var data = JSON.parse(data);
                $("#about_us_id").val(data.id);
                $('#about_us_title_edit').val(data.title);
                $('#about_us_edit_form').find('#about_us_description_edit').val(data.description);
                $("#edit_about_us_modal").modal('show');
            },
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            }
        });
    }
}
var about_us_edit_form = $('#about_us_edit_form');
if (validate_about_us_add_form(about_us_edit_form) != false) {
    about_us_edit_form.ajaxForm({
        url: base_url + 'setting/about_us_update',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                about_us_edit_form[0].reset();
                $("#edit_about_us_modal").modal('hide');
                about_us_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}

function change_about_us_status(about_us_id, selector) {
    if (!isNaN(about_us_id)) {
        $.ajax({
            url: base_url + 'setting/change_about_us_status',
            method: "post",
            data: {
                about_us_id: about_us_id
            },
            success: function(data) {
                if (data.status == 200) {
                    about_us_list.ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}
// CKEDITOR.replace('description', {
//     enterMode: CKEDITOR.ENTER_BR
// });
tinymce.init({
    selector: '.tinymce',
    height: 300,
    plugins: ['advlist autolink lists link image charmap print preview anchor', 'searchreplace visualblocks code fullscreen', 'insertdatetime media table contextmenu paste code'],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
});