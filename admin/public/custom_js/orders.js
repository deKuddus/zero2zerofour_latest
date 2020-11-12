toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 3000
};
var table = $('#orders_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "orders/ajax_show",
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
var confirmed_table = $('#pending_orders_list').DataTable({
    "processing": false,
    "serverSide": true,
    "ajax": {
        url: base_url + "orders/all_confirmed_orders",
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

function view_full_invoice(order_id) {
    if (order_id) {
        $.ajax({
            url: base_url + 'orders/get_order_by_code',
            data: {
                order_id: order_id
            },
            method: 'post',
            datatype: 'json',
            success: function(data) {
                var order = JSON.parse(data);
                var data = JSON.parse(JSON.stringify(order.order));
                $("#from_name").html(data.customer_name);
                $("#from_address").html(data.customer_address1 + '<br>' + data.customer_zipp_code + ',' + data.customer_city + '<br>' + data.customer_state + ',' + data.customer_country);
                $("#from_phone").html(data.customer_phone);
                $("#invoice_no").html('#INV' + data.order_id);
                $("#to_name").html(data.customer_name);
                $("#to_address").html(data.customer_address1 + '<br>' + data.customer_zipp_code + ',' + data.customer_city + '<br>' + data.customer_state + ',' + data.customer_country);
                $("#to_phone").html(data.customer_phone);
                $("#sales_at").html(new Date(data.order_at));
                var html = "";
                var tax = 0;
                var sub_total = 0;
                $.each(JSON.parse(JSON.stringify(order.order_list)), function(key, value) {
                    html += '<tr>';
                    html += '<td>' + value.product_name + '</td>';
                    html += '<td>' + value.product_total_quantity + '</td>';
                    html += '<td>' + '$ ' + value.product_price + '</td>';
                    html += '<td>' + '$ ' + value.product_tax + '</td>';
                    html += '<td>' + '$ ' + ((value.product_price) * (value.product_total_quantity)) + '</td>';
                    tax = parseFloat(tax) + parseFloat(value.product_tax);
                    sub_total = parseFloat(sub_total) + parseFloat(((value.product_price) * (value.product_total_quantity)));
                })
                $("#sub_total").html('$' + sub_total);
                $("#total_tax").html('$' + tax);
                $("#total").html('$' + (tax + sub_total));
                $("#item_list").html(html);
                $("#modal_pring_button").attr('href', base_url + 'orders/prints/' + data.order_id);
                $("#full_invoice").modal('show');
            }
        });
    }
}

function confrm_order(order_id) {
    if (order_id) {
        $.ajax({
            url: base_url + 'orders/confirmed_order',
            method: "post",
            data: {
                order_id: order_id
            },
            beforeSend: function() {
                if (confirm('Are Your sure to Cofirm this order ?')) {
                    return true;
                }
            },
            success: function(response) {
                if (response.status == 200) {
                    table.ajax.reload(null, false);
                    toastr.success(response.message);
                }
            }
        });
    }
}