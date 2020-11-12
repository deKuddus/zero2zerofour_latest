     toastr.options = {
         closeButton: true,
         progressBar: true,
         showMethod: 'slideDown',
         timeOut: 4000
     };
     $('#dob .input-group.date').datepicker({
         startView: 1,
         todayBtn: "linked",
         keyboardNavigation: false,
         forceParse: false,
         autoclose: true,
         format: "yyyy-mm-dd"
     });
     var members_list = $('#members_list').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: base_url + "members/ajax_show",
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

     function change_members_status(members_id) {
         if (!isNaN(members_id)) {
             $.ajax({
                 url: base_url + 'members/change_members_status',
                 method: "post",
                 data: {
                     members_id: members_id
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         members_list.ajax.reload(null, false);
                         toastr.success(response.message);
                     }
                 }
             });
         }
     }
     var member_form = $("#member_form");
     if (validate_member_form(member_form) != false) {
         member_form.ajaxForm({
             url: base_url + 'members/registger_new_member',
             beforeSend: function() {
                 var member_photo = $('#member_photo');
                 var registration_card = $('#registration_card');
                 if (!member_photo.val()) {
                     toastr.warning('Please upload your Photo');
                     return false;
                 } else if (!registration_card.val()) {
                     toastr.warning('Please upload your SSC registration card or certificate');
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

     function validate_member_form(form) {
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
                 },
                 'street_address': {
                     required: true
                 },
                 'police_station': {
                     required: true
                 },
                 'post_code': {
                     required: true
                 },
                 'country': {
                     required: true
                 },
                 'state': {
                     required: true
                 },
                 'password': {
                     required: true,
                     minlength: 6
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
                     required: "please enter your mobile number",
                     minlength: "mobile number can not be less than 11 character"
                 },
                 'street_address': {
                     required: "street address is required"
                 },
                 'police_station': {
                     required: "address line is required"
                 },
                 'post_code': {
                     required: "Postal Code is required"
                 },
                 'password': {
                     required: "please provide a password",
                     minlength: "your password must be at least 6 characters long"
                 }
             }
         });
     }
     var member_form_edit = $("#member_form_edit");
     if (validate_member_edit_form(member_form_edit) != false) {
         member_form_edit.ajaxForm({
             url: base_url + 'members/update_member',
             beforeSend: function() {},
             error: function(jqXHR, exception) {
                 error_check(jqXHR, exception)
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

     function validate_member_edit_form(form) {
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
                 },
                 'street_address': {
                     required: true
                 },
                 'police_station': {
                     required: true
                 },
                 'post_code': {
                     required: true
                 },
                 'country': {
                     required: true
                 },
                 'state': {
                     required: true
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
                     required: "please enter your mobile number",
                     minlength: "mobile number can not be less than 11 character"
                 },
                 'street_address': {
                     required: "street address is required"
                 },
                 'police_station': {
                     required: "address line is required"
                 },
                 'post_code': {
                     required: "Postal Code is required"
                 }
             }
         });
     }

     function delete_members(id) {
         if (confirm('are your sure ?')) {
             if (!isNaN(id)) {
                 $.ajax({
                     url: base_url + 'members/delete',
                     method: "post",
                     data: {
                         id: id
                     },
                     success: function(response) {
                         if (response.status == 200) {
                             members_list.ajax.reload(null, false);
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
     $(document).on('change', '#registration_card', function() {
         var append_id = $('#registation_card_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });
     $(document).on('change', '#member_photo', function() {
         var append_id = $('#member_photo_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });
     ////designatin js start
     var designation_list = $('#designation_list').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: base_url + "members/designation_show",
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
     var designation_create_form = $("#designation_create_form");
     if (validate_designation_form(designation_create_form) != false) {
         designation_create_form.ajaxForm({
             url: base_url + 'members/store_designation',
             beforeSend: function() {},
             error: function(jqXHR, exception) {
                 failed_error(jqXHR, exception)
             },
             success: function(response) {
                 if (response.status == 200) {
                     $('#add_designation_modal').modal('hide');
                     designation_create_form[0].reset();
                     designation_list.ajax.reload(null, false);
                     toastr.success(response.message);
                 } else if (response.status == 202) {
                     toastr.warning(response.message);
                 } else {
                     toastr.error(response);
                 }
             }
         });
     }
     var designation_edit_form = $("#designation_edit_form");
     if (validate_designation_form(designation_edit_form) != false) {
         designation_edit_form.ajaxForm({
             url: base_url + 'members/update_designation',
             beforeSend: function() {},
             error: function(jqXHR, exception) {
                 failed_error(jqXHR, exception)
             },
             success: function(response) {
                 if (response.status == 200) {
                     $('#edit_designation_modal').modal('hide');
                     designation_list.ajax.reload(null, false);
                     toastr.success(response.message);
                 } else if (response.status == 202) {
                     toastr.warning(response.message);
                 } else {
                     toastr.error(response);
                 }
             }
         });
     }

     function validate_designation_form(form) {
         $(form).validate({
             errorElement: "div",
             errorPlacement: function(error, element) {
                 error.appendTo(element.next(".form-error").html(''));
                 return false;
             },
             rules: {
                 'designation_name': {
                     required: true
                 }
             },
             messages: {
                 'designation_name': {
                     required: "designation name is required"
                 }
             }
         });
     }

     function edit_designation(id, name) {
         if (id) {
             $('#designation_id_edit').val(id);
             $('#designation_name_edit').val(name);
             $('#edit_designation_modal').modal('show');
         }
     }

     function delete_designation(id) {
         if (confirm('are your sure ?')) {
             if (!isNaN(id)) {
                 $.ajax({
                     url: base_url + 'members/delete_designation',
                     method: "post",
                     data: {
                         id: id
                     },
                     success: function(response) {
                         if (response.status == 200) {
                             designation_list.ajax.reload(null, false);
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
     populateCountries("v_country", "v_state");