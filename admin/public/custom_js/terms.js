CKEDITOR.replace('terms');

function view_terms(id) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'terms/view_terms',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#append_terms_heading').html(data.heading);
                $('#append_terms').html(data.content);
                $('#term_view').modal('show');
            }
        });
    }
}

function change_terms_status(id, selector) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'terms/change_terms_status',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                toastr.success('status changed');
            }
        });
    }
}