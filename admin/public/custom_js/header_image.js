     toastr.options = {
         closeButton: true,
         progressBar: true,
         showMethod: 'slideDown',
         timeOut: 4000
     };

     function change_header_image_status(header_image_id) {
         if (!isNaN(header_image_id)) {
             $.ajax({
                 url: base_url + 'header_image/change_header_image_status',
                 method: "post",
                 data: {
                     header_image_id: header_image_id
                 },
                 success: function(response) {
                     if (response.status == 200) {
                         toastr.success(response.message);
                     }
                 }
             });
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
     $(document).on('change', '#header_image', function() {
         var append_id = $('#header_image_preview');
         var imgpreview = DisplayImagePreview(this, append_id);
     });