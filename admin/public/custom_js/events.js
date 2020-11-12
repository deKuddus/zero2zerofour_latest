var event_list = $('#event_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "events/ajax_show",
        type: "POST"
    },
    dom: 'lBfrtip',
    buttons: [{
        extend: 'copy'
    }, {
        extend: 'csv',
        title: 'eventlist'
    }, {
        extend: 'excel',
        title: 'eventlist'
    }, {
        extend: 'pdf',
        title: 'eventlist'
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
$(document).on('keyup', '#title', function() {
    var title = $(this).val();
    var slug = title.replace(/[^a-zA-Z0-9 ]/g, "");
    var i = 0,
        strLength = slug.length;
    for (i; i < strLength; i++) {
        slug = slug.replace(" ", "-");
    }
    $('#slug').val(slug.toLowerCase());
});
var event_form_create = $("#event_create");
if (validate_event_create_form(event_form_create) != false) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    event_form_create.ajaxForm({
        url: base_url + 'events/store',
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.message);
                setTimeout(function(argument) {
                    window.location.reload();
                }, 2000);
            } else {
                toastr.error(response);
            }
        }
    });
}

function validate_event_create_form(form) {
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
            'slug': {
                required: true
            },
            'category': {
                required: true
            },
            'start_date': {
                required: true
            },
            'end_date': {
                required: true
            },
            'ticket_price': {
                required: true
            },
            'location': {
                required: true
            },
            'event_image': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "Title is Required!"
            },
            'slug': {
                required: "Slug is Required!"
            },
            'category': {
                required: "Category is  Required!"
            },
            'start_date': {
                required: "Start Date is Required!",
            },
            'end_date': {
                required: "End Date is Required!",
            },
            'ticket_price': {
                required: "Ticket Price is Required!",
            },
            'location': {
                required: "Location is Required!",
            },
            'event_image': {
                required: "Event image is Required!",
            }
        }
    });
}
var edit_form = $("#event_edit");
if (validate_event_edit_form(edit_form) != false) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    edit_form.ajaxForm({
        url: base_url + 'events/update',
        success: function(response) {
            if (response.status == 200) {
                toastr.success(response.message);
                setTimeout(function(argument) {
                    window.location.reload();
                }, 2000);
            } else {
                toastr.error(response);
            }
        }
    });
}

function validate_event_edit_form(form) {
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
            'slug': {
                required: true
            },
            'category': {
                required: true,
            },
            'start_date': {
                required: true,
            },
            'end_date': {
                required: true,
            },
            'ticket_price': {
                required: true
            },
            'location': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "Title is Required!"
            },
            'slug': {
                required: "Slug is Required!"
            },
            'category': {
                required: "Category is  Required!"
            },
            'start_date': {
                required: "Start Date is Required!",
            },
            'end_date': {
                required: "End Date is Required!",
            },
            'ticket_price': {
                required: "Ticket Price is Required!",
            },
            'location': {
                required: "Location is Required!",
            }
        }
    });
}
$(document).on('change', '#event_image', function() {
    var append_id = $('#event_image_view');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#event_image_edits', function() {
    var append_id = $('#event_image_view_edits');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).ready(function() {
    $('.events_select_all').on('change', function(e) {
        if (this.checked) {
            $('.event_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.event_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.event_checkbox', function() {
        var single_select = $('.event_checkbox:checked').lengths;
        var multiple_select = $('.events_select_all').length;
        if (single_select == multiple_select) {
            $('.events_select_all').prop('checked', true);
        } else {
            $('.events_select_all').prop('checked', false);
        }
    });
});

function delete_multiple_events(selector) {
    if ($('.event_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var event_id = [];
        $('.event_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".event_checkbox")[index].value;
                event_id.push(id);
            }
        });
        delete_event(event_id);
    }
}

function delete_event(event_id) {
    swal({
        title: "Are you sure?",
        text: "Event will be delete",
        icon: "warning",
        buttons: ['No, cancel it!', 'Yes, I am sure!'],
        dangerMode: true,
    }).then(function(e) {
        if (e) {
            $.ajax({
                url: base_url + 'events/delete',
                type: 'POST',
                data: {
                    event_id: event_id
                },
                success: function(data) {
                    if (data.status == 200) {
                        event_list.ajax.reload(null, false);
                        swal({
                            title: 'Deleted!',
                            text: data.message,
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            timer: 2000,
                            buttonsStyling: false
                        }).then(function(event) {}).catch(swal.noop);
                    }
                }
            });
        } else {
            swal("Cancelled", "Event is not deleted :)", "error");
        }
    });
}

function is_valid(form) {
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
            'slug': {
                required: true
            },
            'category': {
                required: true,
                minlength: 8
            },
            'start_date': {
                required: true,
                email: true
            },
            'end_date': {
                required: true,
                minlength: 11
            },
            'ticket_price': {
                required: true
            },
            'location': {
                required: true
            },
            'event_image': {
                required: true
            }
        },
        messages: {
            'name': {
                required: "name is Required!"
            },
            'username': {
                required: "userame is Required!"
            },
            'password': {
                required: "password Required!"
            },
            'email': {
                required: "email is Required!",
                email: "please enter a valid email"
            },
            'phone': {
                required: "phone number is Required!",
                minlength: "phone number length must be of minimum 11 characters!"
            }
        }
    });
}
$('#started_at .input-group.date').datepicker({
    startView: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "yyyy-mm-dd"
});
$('#end_at .input-group.date').datepicker({
    startView: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "yyyy-mm-dd"
});
CKEDITOR.replace('tinymce', {
    enterMode: CKEDITOR.ENTER_BR
});
// tinymce.init({
//     selector: '#tinymce',
//     height: 300,
//     plugins: ['advlist autolink lists link image charmap print preview anchor', 'searchreplace visualblocks code fullscreen', 'insertdatetime media table contextmenu paste code'],
//     toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
// });