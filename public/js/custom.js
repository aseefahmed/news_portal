$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#add_courier_btn').click(function(){
        formData = new FormData($("#CourierRequestForm")[0]);

        $.ajax({
            url: "add",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){console.log(result)
                window.location = "all";
            }
        }).fail(function(result){
            console.log(result);
            $('#ajax_preloader').css('display', 'none');
            $('#show_status').html(
                "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> There was some technical issue. Contact to the administrator.</div>"
            );
        });
    });
});