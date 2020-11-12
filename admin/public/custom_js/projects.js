console.log(4);
var project_list = $('#project_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "projects/ajax_show",
        type: "POST"
    },
    dom: 'lBfrtip',
    buttons: [{
        extend: 'copy'
    }, {
        extend: 'csv',
        title: 'projectlist'
    }, {
        extend: 'excel',
        title: 'projectlist'
    }, {
        extend: 'pdf',
        title: 'projectlist'
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
var project_form_create = $("#project_create");
if (validate_project_create_form(project_form_create) != false) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    project_form_create.ajaxForm({
        url: base_url + 'projects/store',
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

function validate_project_create_form(form) {
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
            'goal_fund': {
                required: true
            },
            'location': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "title is Required!"
            },
            'slug': {
                required: "slug is Required!"
            },
            'goal_fund': {
                required: "goal fund is Required!",
            },
            'location': {
                required: "location is Required!",
            }
        }
    });
}
var edit_form = $("#project_edit");
if (validate_project_edit_form(edit_form) != false) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 2000
    };
    edit_form.ajaxForm({
        url: base_url + 'projects/update',
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

function validate_project_edit_form(form) {
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
$(document).on('change', '#project_image', function() {
    var append_id = $('#project_image_view');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#project_image_edits', function() {
    var append_id = $('#project_image_view_edits');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).ready(function() {
    $('.projects_select_all').on('change', function(e) {
        if (this.checked) {
            $('.project_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.project_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.project_checkbox', function() {
        var single_select = $('.project_checkbox:checked').lengths;
        var multiple_select = $('.projects_select_all').length;
        if (single_select == multiple_select) {
            $('.projects_select_all').prop('checked', true);
        } else {
            $('.projects_select_all').prop('checked', false);
        }
    });
});

function delete_multiple_projects(selector) {
    if ($('.project_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var project_id = [];
        $('.project_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".project_checkbox")[index].value;
                project_id.push(id);
            }
        });
        delete_project(project_id);
    }
}

function delete_project(project_id) {
    swal({
        title: "Are you sure?",
        text: "Event will be delete",
        icon: "warning",
        buttons: ['No, cancel it!', 'Yes, I am sure!'],
        dangerMode: true,
    }).then(function(e) {
        if (e) {
            $.ajax({
                url: base_url + 'projects/delete',
                type: 'POST',
                data: {
                    project_id: project_id
                },
                success: function(data) {
                    if (data.status == 200) {
                        project_list.ajax.reload(null, false);
                        swal({
                            title: 'Deleted!',
                            text: data.message,
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            timer: 2000,
                            buttonsStyling: false
                        }).then(function(project) {}).catch(swal.noop);
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
            'goal_fund': {
                required: true
            },
            'location': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "title is Required!"
            },
            'slug': {
                required: "slug is Required!"
            },
            'goal_fund': {
                required: "goal fund is Required!",
            },
            'location': {
                required: "location is Required!",
            }
        }
    });
}
$('#created_at .input-group.date').datepicker({
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