CKEDITOR.replace('faq');

function view_faq(id) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'faq/view_faq',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#append_faq_heading').html(data.heading);
                $('#append_faq').html(data.content);
                $('#term_view').modal('show');
            }
        });
    }
}

function change_faq_status(id, selector) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'faq/change_faq_status',
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