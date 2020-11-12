var customer_list = $('#customer_list').DataTable({
    "processing" : false,
    "serverSide" : true,
    "ajax" : {
      url:base_url+"customers/ajax_show",
      type:"POST"
    },
    dom: 'lBfrtip',
    buttons: [
    {extend: 'copy'},
    {extend: 'csv', title: 'customerlist'},
    {extend: 'excel', title: 'customerlist'},
    {extend: 'pdf', title: 'customerlist'},
    {extend: 'print',
    customize: function (win){
      $(win.document.body).addClass('white-bg');
      $(win.document.body).css('font-size', '10px');

      $(win.document.body).find('table')
      .addClass('compact')
      .css('font-size', 'inherit');
    }
  }
  ],
  "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ]
});




  var customer_form_create = $("#customer_create");
  if(is_valid(customer_form_create)!=false){
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      timeOut: 4000
    };
    customer_form_create.ajaxForm({
      url: base_url+'customers/store',
      success: function(data) {
        if(data['status'] == 200){
          customer_form_create[0].reset();
          customer_list.ajax.reload(null,false);
          $("#add_customer_modal").modal('hide');
         toastr.success('Success');
        }else{
         toastr.error(data);
        }
      }
    });
  }

  function edit_customer(id){
   $.ajax({
    url:base_url+'customers/edit_customer',
    method:"post",
    data:{id:id},
    error:function(jqXHR,exception){
      error_check(jqXHR,exception);
    },
    success:function(data){
      if(data){
        var value = JSON.parse(data);
         $("#customer_id").val(value.id);
         $("#edit_customer_name").val(value.name);
         $("#edit_customer_user_name").val(value.username);
         $("#edit_customer_phone").val(value.phone);
         $("#edit_customer_email").val(value.email);
         $("#edit_customer_address").val(value.address);
         $("#customer_image_view_edit").attr('src', image_url+value.picture);
      }
    }
  });
 }

 edit_form = $("#customer_edit");
 if(is_valid(edit_form)!=false){
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
  };
  edit_form.ajaxForm({
    url: base_url+'/customers/update',
    success: function(data) {
      if(data['status'] == 200){
        edit_form[0].reset();
        customer_list.ajax.reload(null,false);
        $("#customer_edit_modal").modal('hide');
        toastr.success(data.message);
      }else{
        toastr.error(data);
      }
    }
  });
}


// function delete_customer(customer_id){
//   $.ajax({
//     url:base_url+'customer/delete',
//     method:"post",
//     data:{customer_id:customer_id},
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
//         customer_list.ajax.reload(null,false);
//         toastr.success(data.message);
//       }
//     }
//   });
// }

$(document).on('change', '#customer_image', function () {
  var append_id = $('#customer_image_view');
  var imgpreview = DisplayImagePreview(this,append_id);
});

$(document).on('change', '#customer_image_edit', function () {
  var append_id = $('#customer_image_view_edit');
  var imgpreview = DisplayImagePreview(this,append_id);
});

$(document).ready(function(){
  $('.customer_select_all').on('change',function(e){
    if(this.checked){
      $('.customer_checkbox').each(function(){
        this.checked = true;
      });
    }else{
     $('.customer_checkbox').each(function(){
      this.checked = false;
    });
   }
 });

  $(document).on('click','.customer_checkbox',function(){
    var single_select = $('.customer_checkbox:checked').lengths;
    var multiple_select =$('.customer_select_all').length;
    if(single_select == multiple_select){
      $('.customer_select_all').prop('checked',true);
    }else{
      $('.customer_select_all').prop('checked',false);
    }
  });
});


function delete_multiple_customer(selector) {
  if($('.customer_checkbox:checked').length == 0){
    toastr.error('woops! no data selected');
  }else{
    var customer_id = [];
    $('.customer_checkbox').each(function(index){
      if(this.checked){
       var id = $(".customer_checkbox")[index].value;
       customer_id.push(id);
     }
   });
    delete_customer(customer_id);
  }
}

function delete_customer(customer_id){
  swal({
    title: "Are you sure?",
    text: "All Product Will be removed From Your Cart",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function (e) {
    if (e) {
      $.ajax({
       url:base_url+'customers/delete',
        type: 'POST',
        data: {
          customer_id: customer_id
        },
        success: function (data) {
          if (data.status == 200) {
             customer_list.ajax.reload(null, false);
            swal({
              title: 'Deleted!',
              text: data.message,
              type: 'success',
              confirmButtonClass: "btn btn-success",
              timer: 2000,
              buttonsStyling: false
            }).then(function (event) {

            }).catch(swal.noop);
          }
        }
      });
    } else {
      swal("Cancelled", "customer is not deleted :)", "error");
    }
  });
}

function is_valid(form){

  $(form).validate({
    errorElement: "div",
    errorPlacement: function(error, element) {

      error.appendTo( element.next(".form-error").html(''));
      return false;
    },
    rules: {
      'name': {
        required:true
      },
      'username': {
        required:true
      },
      'password': {
        required:true,
        minlength: 8
      },
      'email': {
        required:true,
        email: true
      },
      'phone': {
        required:true,
        minlength: 11
      },
      'address': {
        required:true
      }
    },
    messages:{
      'name': {
        required:"name is Required!"
      },
      'username': {
        required:"userame is Required!"
      },
      'password': {
        required:"password Required!"
      },
      'email': {
        required:"email is Required!",
        email:"please enter a valid email"
      },
      'phone': {
        required:"phone number is Required!",
        minlength: "phone number length must be of minimum 11 characters!"
      },
      'address': {
        required:"address is Required!"
      }
    }
  });
}
