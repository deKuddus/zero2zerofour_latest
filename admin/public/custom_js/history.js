var history_list = $('#history_list').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: base_url + "setting/history_show",
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

function delete_history(history_id) {
    if (!isNaN(history_id)) {
        $.ajax({
            url: base_url + 'setting/history_delete',
            data: {
                history_id: history_id
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
                    history_list.ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data)
                }
            }
        });
    }
}
var new_history_add_form = $("#new_history_add_form");
if (validate_history_add_form(new_history_add_form) != false) {
    new_history_add_form.ajaxForm({
        url: base_url + 'setting/history_add',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                new_history_add_form[0].reset();
                $("#add_new_history").modal('hide');
                history_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_history_add_form(form) {
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
            'description': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter history title"
            },
            'description': {
                required: "enter history operation"
            },
        }
    });
}

function edit_history(history_id) {
    if (!isNaN(history_id)) {
        $.ajax({
            url: base_url + 'setting/history_edit',
            data: {
                history_id: history_id
            },
            method: 'post',
            datatype: 'json',
            success: function(data) {
                var data = JSON.parse(data);
                $("#history_id").val(data.id);
                $('#history_title_edit').val(data.title);
                $('#history_edit_form').find('#history_description_edit').val(data.description);
                $("#edit_history_modal").modal('show');
            },
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            }
        });
    }
}
var history_edit_form = $('#history_edit_form');
if (validate_history_add_form(history_edit_form) != false) {
    history_edit_form.ajaxForm({
        url: base_url + 'setting/history_update',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                history_edit_form[0].reset();
                $("#edit_history_modal").modal('hide');
                history_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data);
            }
        }
    });
}

function change_history_status(history_id, selector) {
    if (!isNaN(history_id)) {
        $.ajax({
            url: base_url + 'setting/change_history_status',
            method: "post",
            data: {
                history_id: history_id
            },
            success: function(data) {
                if (data.status == 200) {
                    history_list.ajax.reload(null, false);
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}
CKEDITOR.replace('description', {
    enterMode: CKEDITOR.ENTER_BR
});
CKEDITOR.replace('history_description_edit', {
    enterMode: CKEDITOR.ENTER_BR
});