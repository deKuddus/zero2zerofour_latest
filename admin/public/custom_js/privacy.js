CKEDITOR.replace('privacy');

function view_privacy(id) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'privacy/view_privacy',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#append_privacy_heading').html(data.heading);
                $('#append_privacy').html(data.content);
                $('#privacy_view').modal('show');
            }
        });
    }
}

function change_privacy_status(id, selector) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'privacy/change_privacy_status',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                toastr.success(response);
            }
        });
    }
}