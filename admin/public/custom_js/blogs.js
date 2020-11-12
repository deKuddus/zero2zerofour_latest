var blogs_table = $('#blogs_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "blogs/show",
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
    var slug = title.replace(/[^a-zA-Z ]/g, "");
    var i = 0,
        strLength = slug.length;
    for (i; i < strLength; i++) {
        slug = slug.replace(" ", "-");
    }
    $('#slug').val(slug.toLowerCase());
});
$(document).ready(function() {
    $('.blog_select_all').on('change', function(e) {
        if (this.checked) {
            $('.blogs_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.blogs_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.blogs_checkbox', function() {
        var single_select = $('.blogs_checkbox:checked').lengths;
        var multiple_select = $('.blog_select_all').length;
        if (single_select == multiple_select) {
            $('.blog_select_all').prop('checked', true);
        } else {
            $('.blog_select_all').prop('checked', false);
        }
    });
});

function delete_multiple_blog(selector) {
    if ($('.blogs_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var blogs_id = [];
        $('.blogs_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".blogs_checkbox")[index].value;
                blogs_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'blogs/delete',
            data: {
                blogs_id: blogs_id
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
                    blogs_table.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}

function delete_blogs(blogs_id) {
    $.ajax({
        url: base_url + '/blogs/delete',
        method: "post",
        data: {
            blogs_id: blogs_id
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
                blogs_table.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}
$(document).ready(function() {
    blogs_form = $("#create_blogs");
    $(document).on("click", "#submit", function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2000
        };
        if (validate_blogs(blogs_form) != false) {
            blogs_form.ajaxForm({
                url: base_url + '/blogs/store',
                beforeSend: function(argument) {
                    var content = blogs_form.find('#content').val();
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
    blogs_form_edit = $("#edit_blogs");
    $(document).on("click", "#submit", function() {
        if (validate_blogs_edit(blogs_form_edit) != false) {
            blogs_form_edit.ajaxForm({
                url: base_url + '/blogs/update',
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

function validate_blogs(form) {
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
            'sub_category': {
                required: true
            },
            'tag': {
                required: true
            },
            'content': {
                required: true
            },
            'blog_images': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter blogs title"
            },
            'slug': {
                required: 'enter blog slug'
            },
            'category': {
                required: "select blogs category"
            },
            'sub_category': {
                required: "select blogs sub category"
            },
            'tag': {
                required: "select blogs tag"
            },
            'content': {
                required: "write blogs content"
            },
            'blog_images': {
                required: "select blogs main images"
            }
        }
    });
}

function validate_blogs_edit(form) {
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
            'sub_category': {
                required: true
            },
            'tag': {
                required: true
            },
            'content': {
                required: true
            }
        },
        messages: {
            'title': {
                required: "enter blogs title"
            },
            'slug': {
                required: 'enter blog slug'
            },
            'category': {
                required: "select blogs category"
            },
            'sub_category': {
                required: "select blogs sub category"
            },
            'tag': {
                required: "select blogs tag"
            },
            'content': {
                required: "write blogs content"
            }
        }
    });
}
$(document).on('change', '#blog_images', function() {
    var append_id = $('#blog_image_preview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#blog_category_id', function() {
    var category_id = $(this).val();
    if (category_id) {
        $.ajax({
            url: base_url + 'blogs/get_sub_category',
            data: {
                category_id: category_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                var html = '';
                if (data) {
                    $.each(JSON.parse(data), function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    })
                    $("#blog_sub_category_id").html(html);
                }
            }
        });
    }
})
$(document).ready(function() {
    var category_id = $('#blog_category_id').val();
    if (category_id) {
        $.ajax({
            url: base_url + 'blogs/get_sub_category',
            data: {
                category_id: category_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                var html = '';
                if (data) {
                    $.each(JSON.parse(data), function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    })
                    $("#blog_sub_category_id").html(html);
                }
            }
        });
    }
});

function change_status(blogs_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".status", tr).val();
    if (!isNaN(blogs_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'blogs/change_status',
            method: "post",
            data: {
                blogs_id: blogs_id,
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

function view_blog(blog_id) {
    if (!isNaN(blog_id)) {
        $.ajax({
            url: base_url + 'blogs/view_blog',
            data: {
                blog_id: blog_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                $("#blog_view").html(data);
                $("#full_blog").modal('show');
            }
        });
    }
}
CKEDITOR.replace('content', {
    enterMode: CKEDITOR.ENTER_BR
});
/////////////category crud js //////////////
var blog_category_list = $('#blog_category_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "blogs/show_category",
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

function delete_blogs_category(blogs_category_id) {
    $.ajax({
        url: base_url + '/blogs/delete_blogs_category/' + blogs_category_id,
        method: "post",
        data: {
            blogs_category_id: blogs_category_id
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
                blog_category_list.ajax.reload(null, false);
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
        var blogs_category_id = [];
        $('.category_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".category_checkbox")[index].value;
                blogs_category_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'blogs/delete_blogs_category',
            data: {
                blogs_category_id: blogs_category_id
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
                    blog_category_list.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}
var blog_category_create_form = $('#blog_category_create_form');
if (validate_blogs_category_form(blog_category_create_form) != false) {
    blog_category_create_form.ajaxForm({
        url: base_url + '/blogs/store_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                blog_category_create_form[0].reset();
                get_parent_category();
                blog_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#add_blog_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}
var blog_category_edit_form = $('#blog_category_edit_form');
if (validate_blogs_category_form(blog_category_edit_form) != false) {
    blog_category_edit_form.ajaxForm({
        url: base_url + '/blogs/update_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                blog_category_edit_form[0].reset();
                blog_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#edit_blog_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_blogs_category_form(form) {
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

function change_status(blogs_category_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".category_status", tr).val();
    if (!isNaN(blogs_category_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'blogs/change_category_status',
            method: "post",
            data: {
                blogs_category_id: blogs_category_id,
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

function edit_blog_category(parent_id, blogs_category_id, name) {
    if (!isNaN(blogs_category_id)) {
        $.ajax({
            url: base_url + 'blogs/get_selected_category',
            method: 'post',
            data: {
                parent_id: parent_id
            },
            success: function(data) {
                if (data) {
                    $("#category_id").val(blogs_category_id);
                    $("#category_name_edit").val(name);
                    $('#parent_category_edit').html(data);
                    $('#edit_blog_category_modal').modal('show');
                }
            }
        });
    }
}
get_parent_category();

function get_parent_category() {
    $.ajax({
        url: base_url + 'blogs/get_parent_category',
        success: function(data) {
            if (data) {
                $("#parent_category").html(data);
            }
        }
    });
}