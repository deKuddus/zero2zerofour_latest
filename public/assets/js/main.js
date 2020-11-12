toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 3000
};
//contact form
function validate_contact_form(form) {
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
            'email': {
                required: true
            },
            'subject': {
                required: true
            },
            'message': {
                required: true
            }
        },
        messages: {
            'name': {
                required: " name is required"
            },
            'email': {
                required: 'Email is required'
            },
            'subject': {
                required: "Subject is required"
            },
            'message': {
                required: "Message is required"
            }
        }
    });
}
var contactForm = $("#contactForm");
if (validate_contact_form(contactForm) != false) {
    contactForm.ajaxForm({
        url: base_url + 'contacts/save_message',
        success: function(data) {
            if (data.status == 200) {
                contactForm[0].reset();
                toastr.success(data.message);
            }
        }
    });
}
///news js start
//comment submitting form start
var comment_form = $("#comment_form");
if (validate_comment_form(comment_form) != false) {
    comment_form.ajaxForm({
        url: base_url + 'news/save_comment',
        beforeSend: function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 5000
            };
            var name = $("#comment_name").val();
            var email = $("#email").val();
            var message = $("#message").val();
            if (!name) {
                toastr.error('please enter your name');
                return false;
            }
            if (!email) {
                toastr.error('please enter your email');
                return false;
            }
            if (!message) {
                toastr.error('please enter your message');
                return false;
            }
        },
        success: function(data) {
            if (data.status == 200) {
                comment_form[0].reset();
                get_comment();
            }
        }
    });
}

function validate_comment_form(form) {
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
            'email': {
                required: true
            },
            'message': {
                required: true
            }
        },
        messages: {
            'name': {
                required: " name is required"
            },
            'email': {
                required: 'Email is required'
            },
            'message': {
                required: "Message is required"
            }
        }
    });
}

function give_reply(selector) {
    var comment_id = $(selector).attr("id");
    $('#comment_id').val(comment_id);
    $('#comment_name').focus();
};
get_comment();

function get_comment() {
    if (news_id) {
        $.ajax({
            url: base_url + 'news/get_comment',
            method: "post",
            data: {
                news_id: news_id
            },
            success: function(data) {
                $("#display_comment").html(data);
            }
        });
    } else {
        return true;
    }
}
//get popular post
popular_post();

function popular_post() {
    $.ajax({
        url: base_url + 'news/get_popular_post',
        success: function(data) {
            var html = '';
            if (JSON.parse(data) == "null") {
                return false;
            } else {
                $.each(JSON.parse(data), function(key, value) {
                    html += ' <div class="post-thumbnail">';
                    html += ' <img src="' + image_url + value.images + '" alt="">';
                    html += ' </div>';
                    html += ' <div class="post-content">';
                    html += '<a href="' + base_url + 'news/view/' + value.slug + '">' + value.title + '</a>';
                    html += ' </div>';
                })
            }
            $('#popular_post').html(html);
        }
    });
}
//get popular post
//get news category start
get_news_category();

function get_news_category() {
    $.ajax({
        url: base_url + 'news/get_news_category',
        success: function(data) {
            var html = '';
            if (JSON.parse(data) == 'null') {
                return false;
            } else {
                $.each(JSON.parse(data), function(key, value) {
                    html += '<li><a href="' + base_url + 'news/news_in_cat/' + value.id + '">' + value.name + '</a></li>';
                })
            }
            $('#category').html(html);
        }
    });
}
//get news category end
///nes js end
function increment(selector, operation = '') {
    if (!operation) {
        var tr = $(selector).closest('tr');
        var qty = $('.bd', tr).val();
        qty = parseInt(qty) + 1;
        $('.bd', tr).val(qty);
    } else {
        var qty = $('.single_page_quantity').val();
        qty = parseInt(qty) + 1;
        $('.single_page_quantity').val(qty);
    }
}

function decrement(selector, operation = '') {
    if (!operation) {
        var tr = $(selector).closest('tr');
        var qty = $('.bd', tr).val();
        qty = parseInt(qty) - 1;
        if (qty <= 0) {
            return false;
        }
        $('.bd', tr).val(qty);
    } else {
        var qty = $('.single_page_quantity').val();
        qty = parseInt(qty) - 1;
        if (qty <= 0) {
            return false;
        }
        $('.single_page_quantity').val(qty);
    }
}
//single item remove from cart
function single_remove(cart_id) {
    if (!isNaN(cart_id)) {
        swal({
            title: "Are you sure?",
            text: "Product Will be removed From Your Cart",
            icon: "warning",
            buttons: ['No, cancel it!', 'Yes, I am sure!'],
            dangerMode: true,
        }).then(function(e) {
            if (e) {
                $.ajax({
                    url: base_url + 'cart/single_remove',
                    method: "post",
                    data: {
                        cart_id: cart_id
                    },
                    error: function(jqXHR, exception) {
                        failed_error(jqXHR, exception);
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            swal({
                                title: 'Deleted!',
                                text: data.message,
                                type: 'success',
                                confirmButtonClass: "btn btn-success",
                                buttonsStyling: false
                            }).then(function() {
                                count_cart();
                                show_cart();
                            }).catch(swal.noop);
                        }
                    }
                });
            } else {
                swal("Cancelled", "Product is keeped in your cart :)", "error");
            }
        });
    }
}
//count cart start
count_cart();

function count_cart() {
    $.ajax({
        url: base_url + 'cart/count_cart',
        success: function(cart) {
            total_cart = cart;
            if (total_cart > 0) {
                $("#modal_checkout_button").attr('href', base_url + 'checkout');
            } else {
                $("#modal_checkout_button").attr('href', 'javascript:void(0)');
            }
            $('#cart_quantity').html(cart);
            $('#cart_quantity_sidebar').html(cart);
        }
    });
}
//////////////////////////product review
var review_form = $("#review_form");
if (validate_review_form(review_form) != false) {
    review_form.ajaxForm({
        url: base_url + 'merchandise/save_review',
        beforeSend: function() {},
        success: function(data) {
            if (data.status == 200) {
                review_form[0].reset();
                $('#review_success').html(data.message).show();
                get_review();
                setTimeout(function() {
                    $('#review_success').html('').hide();
                }, 4000);
            }
        }
    });
}

function validate_review_form(form) {
    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.appendTo(element.next(".form-error").html(''));
            return false;
        },
        rules: {
            'review': {
                required: true,
                maxlength: 200
            }
        },
        messages: {
            'review': {
                required: "please write your review before submit",
                maxlength: "your review must be between 200 character"
            }
        }
    });
}
get_review();

function get_review() {
    if (product_id) {
        $.ajax({
            url: base_url + 'merchandise/get_review',
            method: "post",
            data: {
                product_id: product_id
            },
            success: function(data) {
                $("#display_reviews").html(data);
            }
        });
    }
}
///product review
function add_to_cart(product_id, type = '', quantity = 1) {
    if (!isNaN(product_id)) {
        $.ajax({
            url: base_url + 'cart/add_to_cart',
            method: 'post',
            data: {
                product_id: product_id,
                quantity: quantity,
                type: type
            },
            error: function(jqXHR, exception) {
                failed_error(jqXHR, exception);
            },
            success: function(response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    count_cart();
                    show_cart();
                }
            }
        });
    }
}
//load full cart start
show_cart();

function show_cart() {
    $.ajax({
        url: base_url + 'cart/contents',
        success: function(cartData) {
            miniCart(cartData.cart);
            if (cartData.cart != 'null') {
                var input = '<input type="submit" name="" class="button-style submit" value="Update My Cart">';
                var checkout = '<a href="' + base_url + 'checkout"  class="checkout button-style">Procedd to checkout</a>';
                var cart = '';
                var cart_total = '';
                var vat = 0;
                var in_total = 0;
                cart += '<div class="col-md-8">';
                cart += '<div class="table-responsive checkout-table">';
                cart += '<table class="table">';
                cart += ' <thead>';
                cart += ' <tr>';
                cart += ' <th class="amount">IMAGES</th>';
                cart += ' <th class="description">PRODUCT</th>';
                cart += '<th class="amount">PRICE</th>';
                cart += '<th class="amount">QUANTITY</th>';
                cart += '<th class="amount">TOTAL</th>';
                cart += ' <th></th>';
                cart += '</tr>';
                cart += ' </thead>';
                cart += ' <tbody>';
                $.each(JSON.parse(JSON.stringify(cartData.cart)), function(key, value) {
                    var total = 0;
                    total = total + (value.product_quantity * value.product_price);
                    vat = (!isNaN(value.tax) ? (parseFloat(vat) + parseFloat(value.tax)) : 0);
                    in_total = (in_total + total);
                    cart += '<tr class="alert" role="alert">';
                    cart += '<td> <div class="media"><div class="media-left"><a href="#"><img src="' + image_url + value.picture + '" height="80px" width="90px"></a></div>';
                    cart += '</td>';
                    cart += '<td style="text-transform: uppercase;margin-top: 10px;">' + value.product_name + '</td>';
                    cart += '<td style="color:#29af8a;">$ ' + value.product_price + '</td>';
                    cart += '<td>';
                    cart += '<button type="button" class="sd-quantity-input cart-minus" onclick="decrement(this)">-</button>';
                    cart += '<input type="number" class="sd-quantity-input bd" min="1" name="cart_quantity[]" value="' + value.product_quantity + '">';
                    cart += '<input type="hidden" min="1" name="cart_id[]" value="' + value.id + '">';
                    cart += '<button type="button" class="sd-quantity-input cart-plus" onclick="increment(this)">+</button>';
                    cart += '</td>';
                    cart += '<td style="color:#29af8a;">$' + total + '</td>';
                    cart += '<td> <a href="javascript:void(0)" onclick="single_remove(' + value.id + ')" class="close"><i class="fa fa-times-circle"></i></a></td>';
                    cart += '</tr>';
                });
                cart += '</tbody>';
                cart += '<tfoot>';
                cart += '<tr>';
                cart += '<td colspan="6">';
                cart += '</td>';
                cart += '</tr>';
                cart += '</tfoot>';
                cart += '</table>';
                cart += '</div>';
                cart += '</div>';
                cart += '<div class="col-md-4">';
                cart += '<table class="table subtotal" style="border-color: #dee2e6;">';
                cart += '<h3 class="cart_hading">Cart Totals</h3>';
                cart += ' <tbody>';
                cart += '<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">';
                cart += '<th>Subtoal </th>';
                cart += '<td>$ ' + in_total + '</td>';
                cart += '</tr>';
                cart += '<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">';
                cart += '<th>Tax</th>';
                cart += '<td>$ ' + vat + '</td>';
                cart += '</tr>';
                cart += ' <tr>';
                cart += '<th style="color: #000 !important;">TOTAL </th>';
                cart += '<td style="color: #29af8a;font-weight: 700;">$ ' + (in_total + vat) + '</td>';
                cart += '</tr>';
                cart += '</tbody>';
                cart += '</table>';
                cart += input;
                cart += checkout;
                cart += '</div>';
                $("#carts").html(cart);
            } else {
                var cart = '';
                cart += '<div class="col-md-8">';
                cart += '<table class="table mak">';
                cart += ' <thead class="thead-dark" style="background-color: #435061;">';
                cart += ' <tr>';
                cart += ' <th scope="col">IMAGES</th>';
                cart += ' <th scope="col">PRODUCT</th>';
                cart += '<th scope="col">PRICE</th>';
                cart += '<th scope="col">QUANTITY</th>';
                cart += '<th scope="col">TOTAL</th>';
                cart += '<th></th>';
                cart += '</tr>';
                cart += ' </thead>';
                cart += ' <tbody>';
                cart += '<tr><td colspan="6" class="text-center text-warning">No Product Available into Cart</td></tr>';
                cart += '</tbody>';
                cart += '</table>';
                cart += '</div>';
                cart += '<div class="col-md-4">';
                cart += '<table class="table subtotal" style="border-color: #dee2e6;">';
                cart += '<h3 class="cart_hading">Cart Totals</h3>';
                cart += ' <tbody>';
                cart += '<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">';
                cart += '<th>Subtoal </th>';
                cart += '<td>$ ' + 0 + '</td>';
                cart += '</tr>';
                cart += '<tr style="border-bottom: 5px solid #cbd0db;margin-bottom: 10px;">';
                cart += '<th>Tax</th>';
                cart += '<td>$ ' + 0 + '</td>';
                cart += '</tr>';
                cart += ' <tr>';
                cart += '<th style="color: #000 !important;">TOTAL </th>';
                cart += '<td style="color: #29af8a;font-weight: 700;">$ ' + (0) + '</td>';
                cart += '</tr>';
                cart += '</tbody>';
                cart += '</table>';
                cart += '<input type="submit" disabled name="" class="button-style submit" value="Update My Cart">';
                cart += '<a href="javascript:void(0)"  class="checkout button-style">Procedd to checkout</a>';
                cart += '</div>';
                $("#carts").html(cart);
            }
        }
    });
}
//load full cart end
function miniCart(cartData) {
    if (cartData != 'null') {
        var input = '<input type="submit" name="" class="button-style submit" value="Update My Cart">';
        var checkout = '<a href="' + base_url + 'checkout"  class="checkout button-style">Procedd to checkout</a>';
        var cart = '';
        var cart_total = '';
        var vat = 0;
        var in_total = 0;
        cart += '<div class="col-md-12">';
        cart += '<div class="table-responsive checkout-table">';
        cart += '<table class="table">';
        cart += '<thead>';
        cart += '<tr>';
        cart += '<th class="amount" scope="col">IMAGES</th>';
        cart += '<th class="description" scope="col">PRODUCT</th>';
        cart += '<th class="amount" scope="col">PRICE</th>';
        cart += '<th class="amount" scope="col">QUANTITY</th>';
        cart += '<th class="amount" scope="col">TOTAL</th>';
        cart += ' <th></th>';
        cart += '</tr>';
        cart += ' </thead>';
        cart += ' <tfoot>';
        cart += ' <tr>';
        cart += ' <td colspan="6">';
        cart += ' </td>';
        cart += ' </tr>';
        cart += ' </tfoot>';
        cart += ' <tbody>';
        $.each(JSON.parse(JSON.stringify(cartData)), function(key, value) {
            var total = 0;
            total = total + (value.product_quantity * value.product_price);
            vat = (!isNaN(value.tax) ? (parseFloat(vat) + parseFloat(value.tax)) : 0);
            in_total = (in_total + total);
            cart += '<tr>';
            cart += '<td><img src="' + image_url + value.picture + '" height="80px" width="90px">';
            cart += '</td>';
            cart += '<td style="text-transform: uppercase;margin-top: 10px;">' + value.product_name + '</td>';
            cart += '<td style="color:#29af8a;">$ ' + value.product_price + '</td>';
            cart += '<td style="color:#29af8a;">' + value.product_quantity + '</td>';
            cart += '<td style="color:#29af8a;">$' + total + '</td>';
            cart += '<td><button onclick="single_remove(' + value.id + ')" class="close"><i class="fa fa-times-circle"></i></button></td>';
            cart += '</tr>';
        });
        cart += '</tbody>';
        cart += '</table>';
        cart += '</div>';
        $("#modal_carts").html(cart);
    } else {
        var cart = '';
        cart += '<div class="col-md-8">';
        cart += '<table class="table mak">';
        cart += ' <thead class="thead-dark" style="background-color: #435061;">';
        cart += ' <tr>';
        cart += ' <th scope="col">IMAGES</th>';
        cart += ' <th scope="col">PRODUCT</th>';
        cart += '<th scope="col">PRICE</th>';
        cart += '<th scope="col">QUANTITY</th>';
        cart += '<th scope="col">TOTAL</th>';
        cart += '<th></th>';
        cart += '</tr>';
        cart += ' </thead>';
        cart += ' <tbody>';
        cart += '<tr><td colspan="6" class="text-center">No Product Available into Cart</td></tr>';
        cart += '</tbody>';
        cart += '</table>';
        cart += '</div>';
        $("#modal_carts").html(cart);
    }
}
$("#checkout_submit_button").click(function() {
    if (validate_billing_form($('#checkout_form')) != false) {
        return true;
    }
});
// $('#checkout_form').ajaxForm({
//     url: base_url + 'checkout/proced_to_checkout',
//     beforeSend: function() {
//         var country = $('#c_country').val();
//         var state = $('#c_state').val();
//         if (!country) {
//             toastr.error('Select Your Country Name');
//             return false;
//         } else if (!state) {
//             toastr.error('Select Your State Name');
//             return false;
//         }
//     },
//     error: function(jqXHR, exception) {
//         failed_error(jqXHR, exception);
//     },
//     success: function(response) {
//         if (response.status == 200) {
//             toastr.success(response.message);
//             setTimeout(function() {
//                 window.location = response.url;
//             }, 2000);
//         } else if (response.status == 201) {
//             toastr.success(response.message);
//             setTimeout(function() {
//                 window.location = response.url;
//             }, 2000);
//         } else {
//             toastr.error(response.message);
//         }
//     }
// });
function validate_billing_form(form) {
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
            'email': {
                required: true
            },
            'phone': {
                required: true
            },
            'town_city': {
                required: true
            },
            'country': {
                required: true
            },
            'state': {
                required: true
            },
            'street_address1': {
                required: true
            },
            'zip_code': {
                required: true
            }
        },
        messages: {
            'name': {
                required: "Billing name is required"
            },
            'email': {
                required: 'Billing Email is required'
            },
            'phone': {
                required: "Billing phone is required"
            },
            'town_city': {
                required: "Enter your city / town name"
            },
            'country': {
                required: "Select your country name"
            },
            'state': {
                required: "Select your state name"
            },
            'street_address1': {
                required: "Enter your address"
            },
            'zip_code': {
                required: 'Enter your zip code'
            }
        }
    });
}
$(document).on('change', '#register', function() {
    $("#password").toggle('slow');
})

function failed_error(jqXHR, exception) {
    if (jqXHR.status === 0) {
        toastr.error('Not connect.\n Verify Network.');
    } else if (jqXHR.status == 404) {
        toastr.error('Requested page not found. [404]');
    } else if (jqXHR.status == 500) {
        toastr.error('Internal Server Error [500].');
    } else if (exception === 'parsererror') {
        toastr.error('Requested JSON parse failed.');
    } else if (exception === 'timeout') {
        toastr.error('Time out error.');
    } else if (exception === 'abort') {
        toastr.error('Ajax request aborted.');
    } else {
        toastr.error('Uncaught Error.\n' + jqXHR.responseText);
    }
}
//sorting form 
///////////donate section js
var donate_form = $('#donate_form');
donate_form.ajaxForm({
    url: base_url + 'causes/donate',
    beforeSend: function() {},
    error: function(jqXHR, exception) {
        failed_error(jqXHR, exception);
    },
    success: function(response) {
        if (response.status == 200) {
            count_cart();
            show_cart();
            $("#donation_modal").modal('hide');
            toastr.success(response.message);
        } else {
            toastr.error(response.message);
        }
    }
});

function empty_message() {
    swal('Your Cart is empty, Choose some product firs');
}

function donate_to_cause(cause_id, type) {
    $("#cause_id_from_footer").val(cause_id);
    $('#cause_type_from_footer').val(type);
}
///volunteer create form
var site = url.split("/");
if (site.includes("checkout")) {
    loadjsfile("checkout", "js");
}
if (site.includes("volunteers")) {
    loadjsfile("volunteers", "js");
}
if (site.includes("member")) {
    loadjsfile("member", "js");
}

function loadjsfile(filename, filetype) {    
    if (filetype == "js") {        
        var fileref = document.createElement('script')        
        fileref.setAttribute("type", "text/javascript")        
        fileref.setAttribute("src", base_url + 'public/assets/js/custom/' + filename + '.js')    
    }    
    if (typeof fileref != "undefined") {        
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
}