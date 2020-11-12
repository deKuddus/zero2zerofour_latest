     toastr.options = {
         closeButton: true,
         progressBar: true,
         showMethod: 'slideDown',
         timeOut: 4000
     };
     var donors_list = $('#donors_list').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: base_url + "donors/ajax_show",
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

     function change_donor_status(donors_id) {
         if (!isNaN(donors_id)) {
             $.ajax({
                 url: base_url + 'donors/change_donors_status',
                 method: "post",
                 data: {
                     donors_id: donors_id
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         donors_list.ajax.reload(null, false);
                         toastr.success(response.message);
                     }
                 }
             });
         }
     }
     var donor_form = $("#donor_form");
     if (validate_donor_form(donor_form) != false) {
         donor_form.ajaxForm({
             url: base_url + 'donors/registger_new_donor',
             beforeSend: function() {
                 var donor_photo = $('#donor_photo');
                 if (!donor_photo.val()) {
                     toastr.warning('Please upload donor Photo');
                     return false;
                 }
             },
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

     function validate_donor_form(form) {
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
                     required: true,
                     email: true
                 },
                 'mobile': {
                     required: true,
                     minlength: 11,
                     number: true
                 }
             },
             messages: {
                 'name': {
                     required: "Full name is required"
                 },
                 'email': {
                     required: 'Email address is required',
                     email: "provide a valid email"
                 },
                 'mobile': {
                     required: "please enter donor mobile number",
                     minlength: "mobile number can not be less than 11 character"
                 }
             }
         });
     }
     var donor_form_edit = $("#donor_form_edit");
     if (validate_donor_edit_form(donor_form_edit) != false) {
         donor_form_edit.ajaxForm({
             url: base_url + 'donors/update_donor',
             beforeSend: function() {},
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

     function validate_donor_edit_form(form) {
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
                     required: true,
                     email: true
                 },
                 'mobile': {
                     required: true,
                     minlength: 11,
                     number: true
                 }
             },
             messages: {
                 'name': {
                     required: "Full name is required"
                 },
                 'email': {
                     required: 'Email address is required',
                     email: "provide a valid email"
                 },
                 'mobile': {
                     required: "please enter donor mobile number",
                     minlength: "mobile number can not be less than 11 character"
                 }
             }
         });
     }

     function delete_donor(id) {
         if (confirm('are your sure ?')) {
             if (!isNaN(id)) {
                 $.ajax({
                     url: base_url + 'donors/delete',
                     method: "post",
                     data: {
                         id: id
                     },
                     success: function(response) {
                         if (response.status == 200) {
                             donors_list.ajax.reload(null, false);
                             toastr.success(response.message);
                         } else {
                             toastr.error(response);
                         }
                     }
                 });
             }
         } else {
             return false;
         }
     }

     function DisplayImagePreview(input, append_id) {
         if (input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 append_id.attr('src', e.target.result);
             }
             reader.readAsDataURL(input.files[0]);
         }
     }
     $(document).on('change', '#donor_photo', function() {
         var append_id = $('#donor_photo_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });