CKEDITOR.replace('desclaimer');

function view_desclaimer(id) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'desclaimer/view_desclaimer',
            method: "post",
            data: {
                id: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#append_desclaimer_heading').html(data.heading);
                $('#append_desclaimer').html(data.content);
                $('#desclaimer_view').modal('show');
            }
        });
    }
}

function change_desclaimer_status(id, selector) {
    if (!isNaN(id)) {
        $.ajax({
            url: base_url + 'desclaimer/change_desclaimer_status',
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