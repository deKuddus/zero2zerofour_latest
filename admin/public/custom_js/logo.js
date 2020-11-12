
//logo js start

var logo_table = $('#logo_list').DataTable({
 "processing" : true,
 "serverSide" : true,
 "ajax" : {
  url:base_url+"setting/logo_show",
  type:"POST"
},
dom: 'lBfrtip',
buttons: [
{extend: 'copy'},
{extend: 'csv'},
{extend: 'excel', title: 'ExampleFile'},
{extend: 'pdf', title: 'ExampleFile'},

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

function delete_logo(logo_id) {
  if(!isNaN(logo_id)){
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      timeOut: 2000
    };
    $.ajax({
      url:base_url+'setting/logo_delete',
      data:{logo_id:logo_id},
      method:'post',
      datatype:'json',
      beforeSend:function(){
        return confirm('are you sure to delete?');
      },
      error:function (jqXHR, exception) {
        error_check(jqXHR,exception);
      },
      success:function (data) {
        if(data.status == 200){
          logo_table.ajax.reload(null, false);
          toastr.success(data.message);
        }else{
          toastr.error(data.message)
        }
      }
    });
  }
}


var new_logo_add_form = $("#new_logo_add_form");
if(validate_logo_add_form(new_logo_add_form) != false){
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 2000
  };
  new_logo_add_form.ajaxForm({
    url:base_url+'setting/logo_add',
    error:function(jqXHR,exception){
      error_check(jqXHR,exception);
    },
    success:function(data){
      if(data.status == 200){
        new_logo_add_form[0].reset();
        $("#add_new_logo").modal('hide');
        logo_table.ajax.reload(null, false);
        toastr.success(data.message);
      }else{
        toastr.error(data.message);
      }
    }
  });
}

function validate_logo_add_form(form){

  $(form).validate({
    errorElement: "div",
    errorPlacement: function(error, element) {
      error.appendTo( element.next(".form-error").html(''));
      return false;
    },
    rules: {
      'title': {
        required:true
      },
      'logo_image': {
        required:true
      }
    },
    messages:{
      'title': {
        required:"enter logo title"
      },
      'logo_image': {
        required:"select logo image"
      }
    }
  });
}

$(document).ready(function(){
  $(document).on('change','.check_all_logo',function(e){
    if(this.checked){
      $('.logo_checkbox').each(function(){
        this.checked = true;
      });
    }else{
     $('.logo_checkbox').each(function(){
      this.checked = false;
    });
   }
 });

  $(document).on('change','.logo_checkbox',function(){
    if($('.logo_checkbox:checked').length == $('.check_all_logo').length){
      $('.check_all_logo').prop('checked',true);
    }else{
      $('.check_all_logo').prop('checked',false);
    }
  });
});


function delete_multiple_logo(selector) {
  if($('.logo_checkbox:checked').length == 0){
    toastr.error('woops! no data selected');
  }else{
    var logo_id = [];
    $('.logo_checkbox').each(function(index){
      if(this.checked){
       var id = $(".logo_checkbox")[index].value;
       logo_id.push(id);
     }
   });
    $.ajax({
      url:base_url+'setting/logo_delete',
      data:{logo_id:logo_id},
      method:"post",
      beforeSend:function(){
        return confirm('are you sure to delete the selected item?');
      },
      error:function(jqXHR,exception) {
       error_check(jqXHR,exception);
     },
     success:function(data){
      if(data.status ==200){
        logo_table.ajax.reload(null, false);
        toastr.success(data.message);
      }
    }
  });
  }
}

function edit_logo(logo_id) {
  if(!isNaN(logo_id)){
    $.ajax({
      url:base_url+'setting/logo_edit',
      data:{logo_id:logo_id},
      method:'post',
      datatype:'json',
      success:function(data){
        var data = JSON.parse(data);
        type_dropdown(data.type);
        $("#logo_id").val(data.id);
        $('#logo_title_edit').val(data.title);
        $('#logo_url_edit').val(data.url);
        $('#logo_description_edit').val(data.description);
        $("#logo_image_preview_edit").attr('src', base_url+data.image);
      },
      error:function(jqXHR,exception){
        error_check(jqXHR,exception);
      }
    });
  }
}



var logo_edit_form = $('#logo_edit_form');
if(validate_logo_add_form(logo_edit_form) != false){
  logo_edit_form.ajaxForm({
    url:base_url+'setting/logo_update',
    error:function(jqXHR,exception) {
      error_check(jqXHR,exception);
    },
    success:function(data) {
      if(data.status == 200){
        logo_edit_form[0].reset();
        $("#edit_logo_modal").modal('hide');
        logo_table.ajax.reload(null, false);
        toastr.success(data.message);
      }else{
        toastr.error(data.message);
      }
    }
  });
}


function change_logo_status(logo_id,selector){
  var tr = $(selector).closest('tr');
  var status = $('.logo_status',tr).val();
  if(!isNaN(logo_id) && !isNaN(status)){
    $.ajax({
      url:base_url+'setting/change_logo_status',
      method:"post",
      data:{logo_id:logo_id,status:status},
      datatype:'json',
      success:function(data){
        toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: 'slideDown',
          timeOut: 4000
        };
        if(data.status == 200){
          logo_table.ajax.reload(null, false);
          toastr.success(data.message);
        }else{
          toastr.error(data.message);
        }
      }
    });
  }
}


$(document).on('change', '#logo_image', function () {
  var append_id = $('#logo_image_preview');
  var imgpreview = DisplayImagePreview(this,append_id);
});

$(document).on('change', '#logo_image_edit', function () {
  var append_id = $('#logo_image_preview_edit');
  var imgpreview = DisplayImagePreview(this,append_id);
});