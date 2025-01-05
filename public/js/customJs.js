setTimeout(function () {
    $('.alert').fadeOut('fast');
}, 5000);

/*
|-------------------------------------|
| delete List Row                     |
|-------------------------------------|
*/
function deleteRow(deleteUrl) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.value && result.value == true) {

            $.ajax({
                url: deleteUrl,
                type: "DELETE",
                dataType: 'json',
                success: function (data) {

                    Swal.fire(
                        data.title,
                        data.message,
                        data.response
                    )

                    $('#faqstable').dataTable().fnDestroy();
                    getListData();
                        location.reload();
                },
                error: function (data) {

                    Swal.fire(
                        data.responseJSON.title,
                        data.responseJSON.message + "<br><small><b>" + data.responseJSON.hint + "</b></small>",
                        data.responseJSON.response
                    )
                },
            });
        }
    });
}


$('#master').on('click', function (e) {
    if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
    } else {
        $(".sub_chk").prop('checked', false);
    }
});
