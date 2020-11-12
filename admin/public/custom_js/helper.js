function error_check(jqXHR, exception) {
    if (jqXHR.status === 0) {
        toastr.error('Not connect.\n Verify Network.');
    } else if (jqXHR.status == 404) {
        toastr.error('Requested page not found. [404]');
    } else if (jqXHR.status == 500) {
        toastr.error('Internal Server Error [500].');
    } else if (exception === 'parsererror') {
        toastr.error('Requested JSON parse failed.');
    } else if (exception === 'timeout') {
        toastr.error('Time out error.');
    } else if (exception === 'abort') {
        toastr.error('Ajax request aborted.');
    } else {
        toastr.error('Uncaught Error.\n' + jqXHR.responseText);
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
$('.close').click(function() {
    $("#myModal").modal('hide');
});

function view_image(selector) {
    $("#img01").attr('src', selector.src);
    $("#myModal").modal('show');
}
var slider_table = $('#config_list').DataTable({
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