var event_categories_list = $('#event_categories_list').DataTable({
    "processing" : false,
    "serverSide" : true,
    "ajax" : {
      url:base_url+"event_categories/ajax_show",
      type:"POST"
    },
    dom: 'lBfrtip',
    buttons: [
    {extend: 'copy'},
    {extend: 'csv', title: 'categorieslist'},
    {extend: 'excel', title: 'categorieslist'},
    {extend: 'pdf', title: 'categorieslist'},
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




  var categories_create_form = $("#categories_create");
  if(is_valid(categories_create_form)!=false){
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      timeOut: 4000
    };
    categories_create_form.ajaxForm({
      url: base_url+'event_categories/store',
      success: function(data) {
        if(data['status'] == 200){
          categories_create_form[0].reset();
          event_categories_list.ajax.reload(null,false);
          $("#add_categoires_modal").modal('hide');
         toastr.success('Success');
        }else{
         toastr.error(data);
        }
      }
    });
  }

  function edit_categories(id){
   $.ajax({
    url:base_url+'event_categories/edit_categories',
    method:"post",
    data:{id:id},
    error:function(jqXHR,exception){
      error_check(jqXHR,exception);
    },
    success:function(data){
      if(data){
        var value = JSON.parse(data);
         $("#category_id").val(value.id);
         $("#category_name_edit").val(value.name);
      }
    }
  });
 }

 edit_form = $("#categories_edit");
 if(is_valid(edit_form)!=false){
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
  };
  edit_form.ajaxForm({
    url: base_url+'/event_categories/update',
    success: function(data) {
      if(data['status'] == 200){
        edit_form[0].reset();
        event_categories_list.ajax.reload(null,false);
        $("#event_categories_edit_modal").modal('hide');
        toastr.success(data.message);
      }else{
        toastr.error(data);
      }
    }
  });
}


$(document).on('change', '#categories_image', function () {
  var append_id = $('#categories_image_view');
  var imgpreview = DisplayImagePreview(this,append_id);
});

$(document).on('change', '#categories_image_edit', function () {
  var append_id = $('#categories_image_view_edit');
  var imgpreview = DisplayImagePreview(this,append_id);
});

$(document).ready(function(){
  $('.categories_select_all').on('change',function(e){
    if(this.checked){
      $('.event_categories_checkbox').each(function(){
        this.checked = true;
      });
    }else{
     $('.event_categories_checkbox').each(function(){
      this.checked = false;
    });
   }
 });

  $(document).on('click','.event_categories_checkbox',function(){
    var single_select = $('.event_categories_checkbox:checked').lengths;
    var multiple_select =$('.categories_select_all').length;
    if(single_select == multiple_select){
      $('.categories_select_all').prop('checked',true);
    }else{
      $('.categories_select_all').prop('checked',false);
    }
  });
});


function delete_multiple_categories(selector) {
  if($('.event_categories_checkbox:checked').length == 0){
    toastr.error('woops! no data selected');
  }else{
    var categories_id = [];
    $('.event_categories_checkbox').each(function(index){
      if(this.checked){
       var id = $(".event_categories_checkbox")[index].value;
       categories_id.push(id);
     }
   });
    delete_categories(categories_id);
  }
}

function delete_categories(categories_id){
  swal({
    title: "Are you sure?",
    text: "categories will be deleted",
    icon: "warning",
    buttons: [
      'No, cancel it!',
      'Yes, I am sure!'
    ],
    dangerMode: true,
  }).then(function (e) {
    if (e) {
      $.ajax({
       url:base_url+'event_categories/delete',
        type: 'POST',
        data: {
          categories_id: categories_id
        },
        success: function (data) {
          if (data.status == 200) {
             event_categories_list.ajax.reload(null, false);
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
      swal("Cancelled", "categories is not deleted :)", "error");
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
      }
    },
    messages:{
      'name': {
        required:"name is Required!"
      }
    }
  });
}

