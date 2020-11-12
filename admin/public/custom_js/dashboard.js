
function view_contact_message(id) {
    
}




function delete_contact_message(message_id,selector){
    swal({
        title: "Are you sure?",
        text: "message will be deleted",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],
        dangerMode: true,
    }).then(function (e) {
        if (e) {
            $.ajax({
                url:base_url+'dashboard/delete_contact_message',
                type: 'POST',
                data: {
                    message_id: message_id
                },
                success: function (data) {
                    if (data.status == 200) {
                        swal({
                            title: 'Deleted!',
                            text: data.message,
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            timer: 2000,
                            buttonsStyling: false
                        }).then(function (event) {
                            var tr = $(selector).closest('tr');
                            tr.remove();
                        }).catch(swal.noop);
                    }
                }
            });
        } else {
            swal("Cancelled", "message is not deleted :)", "error");
        }
    });
}

function give_contact_message_reply(email) {
    $('#reply_to').val(email);
    $('#contact_message_reply').modal('show');
}

var submit_contact_message_reply = $('#submit_contact_message_reply');
if(valid_reply_form(submit_contact_message_reply) != false){
    
    submit_contact_message_reply.ajaxForm({
        url:base_url+'dashboard/reply_contact_message',
        beforeSend:function(){
            submit_contact_message_reply.find('#submit').text('Please Wait...');
        },
        success:function(response){
            if(response.status == 200){
                submit_contact_message_reply[0].reset();
                submit_contact_message_reply.find('#submit').text('Save');
                $('#contact_message_reply').modal('hide');
                toastr.success(response.message);
            }else{
                submit_contact_message_reply.find('#submit').text('Save');
                toastr.error(response.message);
            }
        }

    });
}

function valid_reply_form(form){

    $(form).validate({
        errorElement: "div",
        errorPlacement: function(error, element) {

            error.appendTo( element.next(".form-error").html(''));
            return false;

        },
        rules: {
            'email': {
                required:true
            },
            'subject': {
                required:true
            },
            'message': {
                required:true,
            }
        },
        messages:{
            'name': {
                required:"name is Required!"
            },
            'subject': {
                required:"subject is Required!"
            },
            'message': {
                required:"message Required!"
            }
        }
    });
}


CKEDITOR.replace('reply_message',{
});




