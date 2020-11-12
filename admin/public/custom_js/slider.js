//slider js start
var slider_table = $('#slider_list').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: base_url + "setting/slider_show",
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

function delete_slider(slider_id) {
    if (!isNaN(slider_id)) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2000
        };
        $.ajax({
            url: base_url + 'setting/slider_delete',
            data: {
                slider_id: slider_id
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
                    slider_table.ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data)
                }
            }
        });
    }
}
var new_slider_add_form = $("#new_slider_add_form");
if (validate_slider_add_form(new_slider_add_form) != false) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    new_slider_add_form.ajaxForm({
        url: base_url + 'setting/slider_add',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                new_slider_add_form[0].reset();
                $("#add_slider_modal").modal('hide');
                slider_table.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_slider_add_form(form) {
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
            'url': {
                required: true
            },
            'description': {
                required: true
            },
            'slider_image': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter slider title"
            },
            'url': {
                required: "enter slider operation"
            },
            'description': {
                required: "enter slider quantity"
            },
            'slider_image': {
                required: "select slider image"
            }
        }
    });
}

function validate_slider_edit_form(form) {
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
            'url': {
                required: true
            },
            'description': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter slider title"
            },
            'url': {
                required: "enter slider operation"
            },
            'description': {
                required: "enter slider quantity"
            }
        }
    });
}
$(document).ready(function() {
    $('.check_all_slider').on('change', function(e) {
        if (this.checked) {
            $('.slider_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.slider_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $('.slider_checkbox').on('change', function() {
        if ($('.slider_checkbox:checked').length == $('.check_all_slider').length) {
            $('.check_all_slider').prop('checked', true);
        } else {
            $('.check_all_slider').prop('checked', false);
        }
    });
});

function delete_multiple_slider(selector) {
    if ($('.slider_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var slider_id = [];
        $('.slider_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".slider_checkbox")[index].value;
                slider_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'setting/slider_delete',
            data: {
                slider_id: slider_id
            },
            method: "post",
            beforeSend: function() {
                return confirm('are you sure to delete the selected item?');
            },
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            },
            success: function(data) {
                if (data.status == 200) {
                    slider_table.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}

function edit_slider(slider_id) {
    if (!isNaN(slider_id)) {
        $.ajax({
            url: base_url + 'setting/slider_edit',
            data: {
                slider_id: slider_id
            },
            method: 'post',
            datatype: 'json',
            success: function(data) {
                var data = JSON.parse(data);
                $("#slider_id").val(data.id);
                $('#slider_title_edit').val(data.title);
                $('#slider_url_edit').val(data.url);
                $('#slider_description_edit').val(data.description);
                $("#slider_image_preview_edit").attr('src', image_url + data.image);
            },
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            }
        });
    }
}
var slider_edit_form = $('#slider_edit_form');
if (validate_slider_edit_form(slider_edit_form) != false) {
    slider_edit_form.ajaxForm({
        url: base_url + 'setting/slider_update',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                slider_edit_form[0].reset();
                $("#edit_slider_modal").modal('hide');
                slider_table.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}
$(document).on('change', '#slider_image', function() {
    var append_id = $('#slider_image_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#slider_image_edit', function() {
    var append_id = $('#slider_image_preview_edit');
    var imgpreview = DisplayImagePreview(this, append_id);
});