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
     var volunteers_list = $('#volunteers_list').DataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
             url: base_url + "volunteers/ajax_show",
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

     function change_volunteers_status(volunteers_id) {
         if (!isNaN(volunteers_id)) {
             $.ajax({
                 url: base_url + 'volunteers/change_volunteers_status',
                 method: "post",
                 data: {
                     volunteers_id: volunteers_id
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         volunteers_list.ajax.reload(null, false);
                         toastr.success(response.message);
                     }
                 }
             });
         }
     }
     var volunteer_form = $("#volunteer_form");
     if (validate_volunteer_form(volunteer_form) != false) {
         volunteer_form.ajaxForm({
             url: base_url + 'volunteers/registger_new_vounteer',
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

     function validate_volunteer_form(form) {
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
                     required: true
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
                 'national_id': {
                     required: true
                 },
                 'volunteer_photo': {
                     required: true
                 }
             },
             messages: {
                 'name': {
                     required: "Full name is required"
                 },
                 'email': {
                     required: 'Email address is required'
                 },
                 'mobile': {
                     required: "mobile number is required"
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
                 'national_id': {
                     required: "National Id card photo is required"
                 },
                 'volunteer_photo': {
                     required: "Your photo is required"
                 }
             }
         });
     }
     var volunteer_edit_form = $("#volunteer_edit_form");
     if (validate_volunteer_edit_form(volunteer_edit_form) != false) {
         volunteer_edit_form.ajaxForm({
             url: base_url + 'volunteers/update_volunteer',
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

     function delete_volunteers(id) {
         if (confirm('are your sure ?')) {
             if (!isNaN(id)) {
                 $.ajax({
                     url: base_url + 'volunteers/delete',
                     method: "post",
                     data: {
                         id: id
                     },
                     success: function(response) {
                         if (response.status == 200) {
                             volunteers_list.ajax.reload(null, false);
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

     function validate_volunteer_edit_form(form) {
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
                     required: true
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
                     required: 'Email address is required'
                 },
                 'mobile': {
                     required: "mobile number is required"
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

     function DisplayImagePreview(input, append_id) {
         if (input.files[0]) {
             var reader = new FileReader();
             reader.onload = function(e) {
                 append_id.attr('src', e.target.result);
             }
             reader.readAsDataURL(input.files[0]);
         }
     }
     $(document).on('change', '#national_id', function() {
         var append_id = $('#nid_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });
     $(document).on('change', '#volunteer_photo', function() {
         var append_id = $('#volunter_photo_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });
     populateCountries("v_country", "v_state");