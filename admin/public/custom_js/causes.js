var causes_table = $('#causes_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "causes/show",
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
$(document).ready(function() {
    $('.causes_select_all').on('change', function(e) {
        if (this.checked) {
            $('.causes_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.causes_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.causes_checkbox', function() {
        var single_select = $('.causes_checkbox:checked').lengths;
        var multiple_select = $('.causes_select_all').length;
        if (single_select == multiple_select) {
            $('.causes_select_all').prop('checked', true);
        } else {
            $('.causes_select_all').prop('checked', false);
        }
    });
});

function delete_multiple_causes(selector) {
    if ($('.causes_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var causes_id = [];
        $('.causes_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".causes_checkbox")[index].value;
                causes_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'causes/delete',
            data: {
                causes_id: causes_id
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
                    causes_table.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}

function delete_causes(causes_id) {
    $.ajax({
        url: base_url + '/causes/delete',
        method: "post",
        data: {
            causes_id: causes_id
        },
        beforeSend: function() {
            return confirm('are you sure?');
        },
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 2000
            };
            if (data.status == 200) {
                causes_table.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}
$(document).ready(function() {
    causes_form = $("#create_causes");
    $(document).on("click", "#submit", function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2000
        };
        if (validate_causes(causes_form) != false) {
            causes_form.ajaxForm({
                url: base_url + '/causes/store',
                beforeSend: function(argument) {
                    var content = causes_form.find('#content').val();
                    if (!content) {
                        toastr.error('content can not be empty');
                    }
                },
                error: function(jqXHR, exception) {
                    error_check(jqXHR, exception);
                },
                success: function(data) {
                    if (data.status == 200) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000)
                    } else if (data.status == 700) {
                        toastr.error(data.message);
                    } else {
                        toastr.error(data);
                    }
                }
            });
        }
    });
});
$(document).ready(function() {
    causes_form_edit = $("#edit_causes");
    $(document).on("click", "#submit", function() {
        if (validate_causes_edit(causes_form_edit) != false) {
            causes_form_edit.ajaxForm({
                url: base_url + '/causes/update',
                success: function(data) {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 3000
                    };
                    if (data.status == 200) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 3000)
                    } else if (data.status == 700) {
                        toastr.error(data.message);
                    } else {
                        toastr.error('woops! something went wrong');
                    }
                }
            });
        }
    });
});

function validate_causes(form) {
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
            'goal_fund': {
                required: true
            },
            'content': {
                required: true
            },
            'causes_images': {
                required: true
            },
            'short_description': {
                maxlength: 150
            }
        },
        messages: {
            'title': {
                required: "enter causes title"
            },
            'slug': {
                required: 'enter causes slug'
            },
            'category': {
                required: "select causes category"
            },
            'goal_fund': {
                required: "goal fund is required"
            },
            'content': {
                required: "write causes content"
            },
            'causes_images': {
                required: "select an image for causes"
            },
            'short_description': {
                maxlength: "short description must be between 1 to 150 character"
            }
        }
    });
}

function validate_causes_edit(form) {
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
            'goal_fund': {
                required: true
            },
            'content': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter causes title"
            },
            'slug': {
                required: 'enter causes slug'
            },
            'category': {
                required: "select causes category"
            },
            'goal_fund': {
                required: "goal fund is required"
            },
            'content': {
                required: "write causes content"
            }
        }
    });
}
$(document).on('change', '#causes_images', function() {
    var append_id = $('#causes_image_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});

function change_causes_status(causes_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".causes_status", tr).val();
    if (!isNaN(causes_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'causes/change_status',
            method: "post",
            data: {
                causes_id: causes_id,
                status: status
            },
            datatype: 'json',
            success: function(data) {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                if (data.status == 200) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}

function change_causes_featured_status(causes_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".causes_featured_status", tr).val();
    if (!isNaN(causes_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'causes/change_causes_featured_status',
            method: "post",
            data: {
                causes_id: causes_id,
                status: status
            },
            datatype: 'json',
            success: function(data) {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                if (data.status == 200) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}

function view_causes(causes_id) {
    if (!isNaN(causes_id)) {
        $.ajax({
            url: base_url + 'causes/view_causes',
            data: {
                causes_id: causes_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                $("#causes_view").html(data);
                $("#full_causes").modal('show');
            }
        });
    }
}
CKEDITOR.replace('content', {
    enterMode: CKEDITOR.ENTER_BR
});
/////////////category crud js //////////////
var causes_category_list = $('#causes_category_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "causes/show_category",
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
$(document).ready(function() {
    $('.blog_category_select_all').on('change', function(e) {
        if (this.checked) {
            $('.blog_category_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.blog_category_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.blog_category_checkbox', function() {
        var single_select = $('.blog_category_checkbox:checked').lengths;
        var multiple_select = $('.blog_category_select_all').length;
        if (single_select == multiple_select) {
            $('.blog_category_select_all').prop('checked', true);
        } else {
            $('.blog_category_select_all').prop('checked', false);
        }
    });
});

function delete_causes_category(causes_category_id) {
    $.ajax({
        url: base_url + '/causes/delete_causes_category/' + causes_category_id,
        method: "post",
        data: {
            causes_category_id: causes_category_id
        },
        beforeSend: function() {
            return confirm('are you sure?');
        },
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 2000
            };
            if (data.status == 200) {
                causes_category_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}

function delete_multiple_blog_category(selector) {
    if ($('.category_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var causes_category_id = [];
        $('.category_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".category_checkbox")[index].value;
                causes_category_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'causes/delete_causes_category',
            data: {
                causes_category_id: causes_category_id
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
                    causes_category_list.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}
var causes_category_create_form = $('#causes_category_create_form');
if (validate_causes_category_form(causes_category_create_form) != false) {
    causes_category_create_form.ajaxForm({
        url: base_url + '/causes/store_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                causes_category_create_form[0].reset();
                causes_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#add_causes_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}
var causes_category_edit_form = $('#causes_category_edit_form');
if (validate_causes_category_form(causes_category_edit_form) != false) {
    causes_category_edit_form.ajaxForm({
        url: base_url + '/causes/update_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                causes_category_edit_form[0].reset();
                causes_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#edit_causes_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_causes_category_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'category_name': {
                required: true
            }
        },
        messages: {
            'category_name': {
                required: "category name is required"
            }
        }
    });
}

function edit_causes_category(causes_category_id, name) {
    if (!isNaN(causes_category_id)) {
        $("#category_id").val(causes_category_id);
        $("#category_name_edit").val(name);
        $('#edit_causes_category_modal').modal('show');
    }
}