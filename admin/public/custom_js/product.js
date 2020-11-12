var table = $('#product_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "product/ajax_show",
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
$(document).on('keyup', '#name', function() {
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
    $('.product_select_all').on('change', function(e) {
        if (this.checked) {
            $('.product_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.product_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.product_checkbox', function() {
        var single_select = $('.product_checkbox:checked').lengths;
        var multiple_select = $('.product_select_all').length;
        if (single_select == multiple_select) {
            $('.product_select_all').prop('checked', true);
        } else {
            $('.product_select_all').prop('checked', false);
        }
    });
});

function delete_multiple_product(selector) {
    if ($('.product_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var product_id = [];
        $('.product_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".product_checkbox")[index].value;
                product_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'product/delete?multiple_delete=' + 1,
            data: {
                product_id: product_id
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
                    table.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}

function delete_product(product_id) {
    $.ajax({
        url: base_url + '/product/delete',
        method: "post",
        data: {
            product_id: product_id
        },
        beforeSend: function() {
            return confirm('are you sure?');
        },
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                table.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}
var add_product = $("#add_product");
$(document).on("click", "#submit", function() {
    if (validate_product(add_product) != false) {
        var product_feature_image = $('#product_feature_image').val();
        if (!product_feature_image) {
            toastr.warning('Please upload product Photo');
        } else {
            add_product.ajaxForm({
                url: base_url + 'product/store',
                beforeSend: function(jqXHR, settings) {},
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
                        toastr.warning(response.message);
                    } else {
                        toastr.error(response);
                    }
                }
            });
        }
    }
})
var product_form_edit = $("#edit_product");
if (validate_product(product_form_edit) != false) {
    product_form_edit.ajaxForm({
        url: base_url + '/product/update',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data['status'] == 200) {
                toastr.success(data.message);
                setTimeout(function() {
                    location.reload();
                }, 3000)
            } else {
                toastr.error('woops! something went wrong');
            }
        }
    });
}

function validate_product(form) {
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
            'slug': {
                required: true
            },
            'category_id': {
                required: true
            },
            'sub_category_id': {
                required: true
            },
            'purchase_price': {
                required: true
            },
            'sale_price': {
                required: true
            },
            'tax': {
                required: true
            }
        },
        messages: {
            'name': {
                required: "enter product title"
            },
            'slug': {
                required: "product slug is required"
            },
            'category_id': {
                required: "select product category"
            },
            'sub_category_id': {
                required: "select product sub category"
            },
            'purchase_price': {
                required: "enter product purchase price"
            },
            'sale_price': {
                required: "enter product sale price"
            },
            'tax': {
                required: "enter product tax rate"
            }
        }
    });
}
$(document).on('change', '#product_feature_image', function() {
    var append_id = $('#product_feature_image_view');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#feature_image2', function() {
    var append_id = $('#product_image2');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#category_id', function() {
    var category_id = $(this).val();
    if (category_id) {
        $.ajax({
            url: base_url + 'product/get_sub_category',
            data: {
                category_id: category_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                var html = '';
                if (data) {
                    $.each(JSON.parse(data), function(key, value) {
                        html += '<option value="' + value.id + '">' + value.category_name + '</option>';
                    })
                    $("#sub_category_id").html(html);
                }
            }
        });
    }
})
$(document).ready(function() {
    var category_id = $('#category_id').val();
    if (category_id) {
        $.ajax({
            url: base_url + 'product/get_sub_category',
            data: {
                category_id: category_id
            },
            method: "post",
            datatype: "json",
            success: function(data) {
                var html = '';
                if (data) {
                    $.each(JSON.parse(data), function(key, value) {
                        html += '<option value="' + value.id + '">' + value.category_name + '</option>';
                    })
                    $("#sub_category_id").html(html);
                }
            }
        });
    }
});

function change_product_status(product_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".status", tr).val();
    if (!isNaN(product_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'product/change_status',
            method: "post",
            data: {
                product_id: product_id,
                status: status
            },
            datatype: 'json',
            success: function(data) {
                if (data.status == 200) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}
///product stock
function add_product_tostock(product_id, category_id) {
    if (!isNaN(product_id)) {
        $("#product_id_to_stock").val(product_id);
        $("#product_category_id_to_stock").val(category_id);
    }
}
var quantity_add_form = $("#quantity_add_form");
quantity_add_form.ajaxForm({
    url: base_url + 'product/update_quantity_in_product_table',
    beforeSend: function() {
        return confirm('are you sure to add this new quantity');
    },
    success: function(data) {
        if (data.status == 200) {
            $("#add_product_tostock").modal('hide');
            $(quantity_add_form).trigger("reset");
            table.ajax.reload(null, false);
            toastr.success(data.message);
        } else if (data.status == 300) {
            toastr.error(data.message);
        } else {
            toastr.error('failed to update');
        }
    }
});

function add_discount(product_id) {
    $("#product_id_to_discount").val(product_id);
    if (!isNaN(product_id)) {
        $.ajax({
            url: base_url + 'product/get_product_discount_by_id',
            data: {
                product_id: product_id
            },
            method: "post",
            datatype: "json",
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            },
            success: function(data) {
                if (data) {
                    var data = JSON.parse(data);
                    discount_type(data.discount_type);
                    $("#discount_rate").val(data.discount);
                }
            }
        });
    }
}

function discount_type(discount_type) {
    if (!isNaN(discount_type)) {
        $.ajax({
            url: base_url + 'product/get_selected_discount_type',
            error: function(jqXHR, exception) {
                error_check(jqXHR, exception);
            },
            success: function(data) {
                if (data) {
                    var html = '';
                    $.each(JSON.parse(data), function(key, value) {
                        if (value.id == discount_type) {
                            html += '<option selected value="' + value.id + '">' + value.symbol + '</option>';
                        } else {
                            html += '<option value="' + value.id + '">' + value.symbol + '</option>';
                        }
                    })
                    $("#discount_type_to_product").html(html);
                }
            }
        });
    }
}
$(document).ready(function() {
    $('.product-images').slick({
        dots: true
    });
});
$('.input-images').imageUploader({});
CKEDITOR.replace('description', {
    enterMode: CKEDITOR.ENTER_BR
});
//get product optional image
get_image_optional_image();

function get_image_optional_image() {
    if (product_id_from_edit) {
        $.ajax({
            url: base_url + 'product/get_image_optional_image',
            method: 'post',
            data: {
                product_id: product_id_from_edit
            },
            success: function(data) {
                if (data) {
                    $('#product_optional_image').html(data);
                } else {
                    $('#product_optional_image').html(' ');
                }
            }
        });
    }
}

function delete_single_image_optional(id) {
    if (!isNaN(id)) {
        if (confirm('are you sure to remove this image ?')) {
            $.ajax({
                url: base_url + 'product/delete_single_image_optional',
                method: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data['status'] == 200) {
                        get_image_optional_image();
                    }
                }
            });
        }
    }
}
/////////////category crud js //////////////
var product_category_list = $('#product_category_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "product/show_category",
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
    $('.product_category_select_all').on('change', function(e) {
        if (this.checked) {
            $('.product_category_checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.product_category_checkbox').each(function() {
                this.checked = false;
            });
        }
    });
    $(document).on('click', '.product_category_checkbox', function() {
        var single_select = $('.product_category_checkbox:checked').lengths;
        var multiple_select = $('.product_category_select_all').length;
        if (single_select == multiple_select) {
            $('.product_category_select_all').prop('checked', true);
        } else {
            $('.product_category_select_all').prop('checked', false);
        }
    });
});

function delete_products_category(products_category_id) {
    $.ajax({
        url: base_url + '/product/delete_products_category/' + products_category_id,
        method: "post",
        data: {
            products_category_id: products_category_id
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
                product_category_list.ajax.reload(null, false);
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }
        }
    });
}

function delete_multiple_product_category(selector) {
    if ($('.category_checkbox:checked').length == 0) {
        toastr.error('woops! no data selected');
    } else {
        var products_category_id = [];
        $('.category_checkbox').each(function(index) {
            if (this.checked) {
                var id = $(".category_checkbox")[index].value;
                products_category_id.push(id);
            }
        });
        $.ajax({
            url: base_url + 'product/delete_products_category',
            data: {
                products_category_id: products_category_id
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
                    product_category_list.ajax.reload(null, false);
                    toastr.success(data.message);
                }
            }
        });
    }
}
var product_category_create_form = $('#product_category_create_form');
if (validate_products_category_form(product_category_create_form) != false) {
    product_category_create_form.ajaxForm({
        url: base_url + '/product/store_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                product_category_create_form[0].reset();
                get_parent_category();
                product_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#add_product_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}
var product_category_edit_form = $('#product_category_edit_form');
if (validate_products_category_form(product_category_edit_form) != false) {
    product_category_edit_form.ajaxForm({
        url: base_url + '/product/update_category',
        error: function(jqXHR, exception) {
            error_check(jqXHR, exception);
        },
        success: function(data) {
            if (data.status == 200) {
                product_category_edit_form[0].reset();
                product_category_list.ajax.reload(null, false);
                toastr.success(data.message);
                $("#edit_product_category_modal").modal('hide');
            } else {
                toastr.error(data);
            }
        }
    });
}

function validate_products_category_form(form) {
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

function change_category_status(products_category_id, selector) {
    var tr = $(selector).closest('tr');
    var status = $(".category_status", tr).val();
    if (!isNaN(products_category_id) && !isNaN(status)) {
        $.ajax({
            url: base_url + 'product/change_category_status',
            method: "post",
            data: {
                products_category_id: products_category_id,
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

function edit_product_category(parent_id, products_category_id, name) {
    if (!isNaN(products_category_id)) {
        $.ajax({
            url: base_url + 'product/get_selected_category',
            method: 'post',
            data: {
                parent_id: parent_id
            },
            success: function(data) {
                if (data) {
                    $("#category_id").val(products_category_id);
                    $("#category_name_edit").val(name);
                    $('#parent_category_edit').html(data);
                    $('#edit_product_category_modal').modal('show');
                }
            }
        });
    }
}
get_parent_category();

function get_parent_category() {
    $.ajax({
        url: base_url + 'product/get_parent_category',
        success: function(data) {
            if (data) {
                $("#parent_category").html(data);
            }
        }
    });
}