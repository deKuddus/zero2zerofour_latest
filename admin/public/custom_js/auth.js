$(document).on('click', '#create_user', function() {
    var user_create_form = $("#user_create_form");
    if (is_valid(user_create_form) != false) {
        return true;
    }
});
// function delete_administration(administration_id){
//   $.ajax({
//     url:base_url+'administration/delete',
//     method:"post",
//     data:{administration_id:administration_id},
//     beforeSend:function(){
//       return confirm('are you sure?');
//     },
//     success:function(data){
//       if(data.status == 200){
//         toastr.options = {
//           closeButton: true,
//           progressBar: true,
//           showMethod: 'slideDown',
//           timeOut: 4000
//         };
//         administration_list.ajax.reload(null,false);
//         toastr.success(data.message);
//       }
//     }
//   });
// }
$(document).on('change', '#administrator_photo', function() {
    var append_id = $('#administrator_photopreview');
    var imgpreview = DisplayImagePreview(this, append_id);
});
$(document).on('change', '#administration_image_edit', function() {
    var append_id = $('#administration_image_view_edit');
    var imgpreview = DisplayImagePreview(this, append_id);
});

function delete_administration(administration_id) {
    swal({
        title: "Are you sure?",
        text: "administrator will be deleted",
        icon: "warning",
        buttons: ['No, cancel it!', 'Yes, I am sure!'],
        dangerMode: true,
    }).then(function(e) {
        if (e) {
            $.ajax({
                url: base_url + 'auth/delete',
                type: 'POST',
                data: {
                    administration_id: administration_id
                },
                success: function(data) {
                    if (data.status == 200) {
                        administration_list.ajax.reload(null, false);
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
            swal("Cancelled", "Administration is not deleted :)", "error");
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
            'first_name': {
                required: true
            },
            'last_name': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'password': {
                required: true,
                minlength: 8
            },
            'password_confirm': {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            'first_name': {
                required: "First Name is Required!"
            },
            'last_name': {
                required: "Last Name is Required!"
            },
            'email': {
                required: "email is Required!",
                email: "please enter a valid email"
            },
            'password': {
                required: "Password is Required!"
            },
            'password_confirm': {
                required: "Confirm password must be same with password",
            }
        }
    });
}

function f() {
    console.log('ami asiii');
    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
}