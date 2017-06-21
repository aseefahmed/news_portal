<!doctype html>
<html lang="en" class="fixed">


<!-- Mirrored from myiideveloper.com/helsinki/helsinki-green/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Feb 2017 08:56:36 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NRB Express</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link href="{{ asset('public/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/css/datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/plugins/bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet" type="text/css">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('public/css/toaster.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">



    <style>
        input.submitted.ng-invalid
        {
            border:1px solid #f00;
        }
        select.submitted.ng-invalid
        {
            border:1px solid #f00;
        }
    </style>
</head>

<body ng-app="myApp">
<div class="wrap">
    <div class="page-body">
        <div class="row animated bounce">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel mt-xlg">
                    <div class="panel-content">
                        <h1 class="error-number"><img src="{{ asset('public/img/logo.png') }}"></h1>
                        <h2 class="error-name">Password Recovered</h2>
                        <p class="error-text">An email has been sent to your email address with new credentials details.
                            <br/>Please check your inbox for more details.</p>
                        <div class="row mt-xlg">
                            <div class="col-sm-6  col-sm-offset-3">
                                <a href="{{ url('login') }}" class="btn btn-sm btn-primary btn-block">Login Now</a>
                                <a href="{{ url('forget-password') }}" class="btn btn-sm btn-lighter-2 btn-block mb-xlg">Recover Password Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/js/all.js') }}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" type="text/javascript"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('public/js/toaster.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/plugins/angular/angular.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/controller.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/datetimepicker.js') }}" type="text/javascript"></script>

{{--<script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('public/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
{{--<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>--}}

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
</script>
{{--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js">
</script>--}}
<script>
$(document).ready(function()  {
/*
    $('.default_datetimepicker').datetimepicker();*/

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#user_reg_btn').click(function(){
        user_type = $('#user_reg_btn').attr('user_type');
        formData = new FormData($("#userRegistrationForm")[0]);
        $.ajax({
            url: "{{ url('registerUser') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('.success_div').css('display', 'block');
                $('#success-modal').modal('toggle');
                toastr.warning('User has been created successfully!', 'Notification')
                toastr.options.closeButton = true;
                window.location.href = app.host + 'dashboard/'+user_type+'/list';
            }
        }).fail(function(result){
            console.log(result)
        });
    });
    $('#same_add_chk').click(function(){
        var present_address = $('#present_address').val();
        if($('#same_add_chk').prop('checked'))
        {
            $('#permanent_address').val(present_address);
        }
        else
        {
            $('#permanent_address').val('');
        }
    })
    $('#sender_input').change(function(){console.log('dd')
        formData = new FormData($("#userRegistrationForm")[0]);
        $.ajax({
            url: "{{ url('filterSearchOrder') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('#modalSlideUp').modal('toggle');
                console.log(result)
            }
        }).fail(function(result){
            console.log(result)
        });
    });
    $('#user_id').change(function(){
        user_id = $('#user_id').val();
        formData = new FormData($("#OrderRequestForm")[0]);
        $.ajax({
            url: "{{ url('fetchUserDetails') }}/"+user_id,
            method: "GET",
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                console.log(result)
                //window.location.href = app.host + 'dashboard/order/'+order_id;
            }
        }).fail(function(result){
            console.log(result)
        });
    });

    $('#delivery_type').change(function(){
        val = $('#delivery_type').val();
        if(val == 'regular')
        {
            $('#regular').css('display', 'block')
            $('#express').css('display', 'none')
            $('#tdd').css('display', 'none')
        }
        else if(val == 'express')
        {
            $('#express').css('display', 'block')
            $('#regular').css('display', 'none')
            $('#tdd').css('display', 'none')
        }
        else if(val == 'tdd')
        {
            $('#express').css('display', 'none')
            $('#regular').css('display', 'none')
            $('#tdd').css('display', 'block')
        }
    })

    $('#sender_id').change(function(){
        val = $('#sender_id').val();
        index = val.indexOf('-');
        account_type = val.substr(index+1);
    })
    $('#assign_courier_btn').click(function(){
        var order_id = $('#select_location').attr('order_id');
        var location_id = $('#select_location').val();
        var courier_id = $('#select_courier').val();
        $.ajax({
            url: "{{ url('assignCourier') }}/"+order_id+'/'+courier_id+'/'+location_id,
            method: "GET",
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                console.log(result)
                window.location.href = app.host + 'dashboard/order/'+order_id;
            }
        }).fail(function(result){
            console.log(result)
        });
    });
    $('#select_location').change(function(){
        var location = $('#select_location').val();

        if(location != 0)
        {
            $.ajax({
                url: "{{ url('getLocationbasedCourier') }}/"+location,
                method: "GET",
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){
                    console.log(result)
                    $('#select_courier').html(result);
                    $('#select_courier').prop('disabled', false);
                }
            }).fail(function(result){
                console.log(result)
            });
        }
        else
        {
            $('#select_courier').prop('disabled', 'disabled');
        }
    });
    $('#btn-add-price-chart').click(function(){
        var route_id = $('#route_id').attr('route');
        formData = new FormData($("#addPriceChart")[0]);
        $.ajax({
            url: "{{ url('dashboard/route/addPrice') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('#modalSlideUp').modal('toggle');
                window.location.href = app.host + 'dashboard/routes/view/'+route_id;
            }
        }).fail(function(result){
            console.log(result)
        });
    });
    $('#generate_location_btn').click(function(){
        formData = new FormData($("#locationForm")[0]);
        $.ajax({
            url: "{{ url('dashboard/routes/add') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                $('#modalSlideUp').modal('toggle');
                window.location.href = app.host + 'dashboard/routes/all';
            }
        }).fail(function(result){
            console.log(result)
        });
    });


    ///////////////////////////////////////

    compositions = new Array()
    var n=0;
    $('#composition_plus').click(function(){
        composition_name = $('#composition_name').val();
        composition_percentage = $('#composition_percentage').val();
        composition_yarn_rate = $('#composition_yarn_rate').val();
        composition_wastage = $('#composition_wastage').val();
        compositions[n] = [composition_name, composition_percentage, composition_yarn_rate, composition_wastage];

        composition_str = JSON.stringify(compositions);
        $('#compositions').val(composition_str)
        n++;

        $('#composition-div-group').css('display','block');
        $('#composition-div-group').append("<label class='col-sm-3 control-label'> </label><div class='composition-div'><div class='col-sm-2 composition_name_arr'><input class='form-control' readonly='readonly' name='composition_name_arr' value='"+composition_name+"'type='text' placeholder='Name'></div><div class='col-sm-2'><input class='form-control' readonly='readonly' name='composition_percentage_arr' value='"+composition_percentage+"'type='number' placeholder='Percentage'></div><div class='col-sm-2'><input class='form-control' readonly='readonly' name='composition_yarn_rate_arr' value='"+composition_yarn_rate+"'type='number' placeholder='Percentage'></div><div class='col-sm-2'><input class='form-control' readonly='readonly' name='composition_wastage_arr' value='"+composition_wastage+"'type='number' placeholder='Percentage'></div></div>");

        total_yarn_weight =  Number(total_yarn_weight) + Number($("#qty_per_dzn").val()*$("#weight_dzn").val()*composition_percentage/100*(1+Number(composition_wastage/100)));
        total_yarn_cost = Number(total_yarn_cost) + Number(Number($("#qty_per_dzn").val()*$("#weight_dzn").val()*composition_percentage/100*(1+Number(composition_wastage/100)))*composition_yarn_rate);

        $('#total_yarn_weight').val(Math.round(total_yarn_weight));
        $('#total_yarn_cost').val(Math.round(total_yarn_cost));

    });

    ////////////////////////////////////////////////////////

    items = new Array()
    var n=0;


    $('#add_courier_btn').click(function(){
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        if(first_name == "" || last_name == "")
        {
            /*$('#first_name').addClass('error_class');
             $('#last_name').addClass('error_class');
             $('#err_msg').css('display', 'block');*/
            toastr.warning('Form is incomplete!', 'Notification')
            $('#ajax_loading').css('display', 'none');
            toastr.options.closeButton = true;
            return false;
        }

        $('#ajax_loading').css('display', 'block');
        formData = new FormData($("#CourierRequestForm")[0]);
        $.ajax({
            url: "{{ url('dashboard/couriers/add') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                console.log(result)
                if(result == -1)
                {
                    toastr.warning('Email address already exists!', 'Notification');
                    $('#ajax_loading').css('display', 'none');
                    toastr.options.closeButton = true;
                    return false;
                }
                else {
                    toastr.success('Courer has been successfully added!', 'Notification')
                    toastr.options.closeButton = true;
                    window.location.href = app.host + 'dashboard/courier/'+result;
                }
            }
        }).fail(function(result){
            console.log(result)
        });
    });

    $('#change_courier_status').click(function(){
        var status = $('#change_courier_status').attr('status');
        var courier_id = $('#change_courier_status').attr('courier_id');

        $.ajax({
            url: "{{ url('change_courier_status') }}/"+courier_id+"/"+status,
            method: "GET",
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){

                if(result == 'Confirmed')
                {
                    toastr.success('Courer account has been activated.', 'Notification')
                    toastr.options.closeButton = true;
                    $('#change_courier_status').attr('src', 'https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-128.png')
                    $('#change_courier_status').attr('status', 'Confirmed');
                }
                else
                {
                    toastr.warning('Courer account has been deactivated.', 'Notification')
                    toastr.options.closeButton = true;
                    $('#change_courier_status').attr('src', 'https://cdn3.iconfinder.com/data/icons/ose/Error.png');
                    $('#change_courier_status').attr('status', 'Inactive');
                }
            }
        }).fail(function(result){
            console.log(result)
        });
    });

    $('.remove_area_btn').click(function(){
        alert('ddddd')
    });
    $('#update_courier_btn').click(function(){
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        if(first_name == "" || last_name == "")
        {
            /*$('#first_name').addClass('error_class');
             $('#last_name').addClass('error_class');
             $('#err_msg').css('display', 'block');*/
            toastr.warning('Form is incomplete!', 'Notification')
            toastr.options.closeButton = true;
            return false;
        }
        formData = new FormData($("#CourierRequestForm")[0]);
        $.ajax({
            url: "{{ url('dashboard/couriers/update') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                console.log(result)
                if(result == -1)
                {
                    toastr.warning('Email address already exists!', 'Notification')
                    toastr.options.closeButton = true;
                    return false;
                }
                else {
                    toastr.success('Courer has been successfully added!', 'Notification')
                    toastr.options.closeButton = true;
                   // window.location.href = app.host + 'dashboard/couriers/all';
                }
            }
        }).fail(function(result){
            console.log(result)
        });
    });
    $('#search_order_btn').click(function(){
        var order_status = $('#order_status').val();
        var from_date = $('#from_date').val();
        if($('#from_date').val() == "" || $('#to_date').val() == "")
        {
            $('#from_date').css('border', '1px red solid');
            $('#to_date').css('border', '1px red solid');
            return false;
        }
        //2017/05/03 11:00
        from_date = from_date.split('/');
        from_date = from_date[0]+from_date[1]+from_date[2].substr(0, 2)+from_date[2].substr(3, 2)+from_date[2].substr(6, 2);
        var to_date = $('#to_date').val();
        to_date = to_date.split('/');
        to_date = to_date[0]+to_date[1]+to_date[2].substr(0, 2)+to_date[2].substr(3, 2)+to_date[2].substr(6, 2);
        console.log(from_date);
        window.location.href  = app.host + 'dashboard/orders/all/'+ order_status+'/'+from_date+'/'+to_date;
    });
    $('#change_password_id').click(function() {
        password_action = $('#change_password_id').attr('password_action');
        user_id = $('#change_password_id').attr('user_id');
        if($('#new_password').val() != $('#retype_password').val())
        {
            toastr.warning('New password and retype password did not match.', 'Notification')
            toastr.options.closeButton = true;
            return false;
        }
        if($('#new_password').val().length < 6)
        {
            toastr.warning('Password should be atleast 6 characters long.', 'Notification')
            toastr.options.closeButton = true;
            return false;
        }
        if(password_action == "generate")
        {
            var url = "{{ url('doGeneratePassword') }}";
        }
        else
        {
            var url = "{{ url('updatePassword') }}";
        }
        formData = new FormData($("#PasswordChangeForm")[0]);
        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result)
                if(result == -1)
                {
                    toastr.warning('Please provide correct password.', 'Notification')
                    toastr.options.closeButton = true;
                }
                else if(result == 2)
                {
                    toastr.success('Password has been successfully generated.', 'Notification')
                    toastr.options.closeButton = true;
                    window.location.href = app.host + 'password/change/'+user_id;
                }
                else
                {
                    toastr.success('Password has been successfully updated.!', 'Notification')
                    toastr.options.closeButton = true;
                    window.location.href = app.host + 'password/change/'+user_id;
                }
            }
        }).fail(function (result) {
            console.log(result)
        });
    });
    $('#complain_customer_id').change(function() {
        
        formData = new FormData($("#addComplainForm")[0]);
        $.ajax({
            url: "{{ url('findCustomerOrders') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result)
                $('#customer_order_ref').html(result);
                $('#customer_order_ref').prop('disabled', false);  
            }
        }).fail(function (result) {
            console.log(result)
        });
    });
    $('#complain_submit_btn').click(function() {
        if($('#complain_customer_id').val() == "" || $('#customer_order_ref').val() == "")
        {
            toastr.warning('Form not completed!', 'Notification')
            toastr.options.closeButton = true;
            return;
        }
        formData = new FormData($("#addComplainForm")[0]);
        $.ajax({
            url: "{{ url('submitCustomerComplain') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result)
                $('#modalSlideUp').modal('toggle')
                toastr.success('Customer complain has been added successfully!', 'Notification')
                toastr.options.closeButton = true;
                window.location.href = app.host + 'complains/list';
            }
        }).fail(function (result) {
            console.log(result)
        });
    });
    $('#edit_user').click(function(){
        formData = new FormData($("#userDetails")[0]);
        $.ajax({
            url: "{{ url('dashboard/users/update') }}",
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(result){
                console.log(result)
                $('#success_div').css('display', 'block');
                $("#success_div").delay(3000).fadeOut('slow');
                $('#failure_div').css('display', 'none');
                //window.location.href = app.host + 'dashboard/couriers/all';
            }
        }).fail(function(result){
            $('#success_div').css('display', 'none');
            $('#failure_div').css('display', 'block');
            $("#failure_div").delay(3000).fadeOut('slow');
        });
    });
    $('#doc_item_input').change(function(){
        item_id = $('#doc_item_input').val();
        if(item_id == 'Your document description')
        {
            $('#other_div').css('display', 'block')
        }
        else
        {
            $('#other_div').css('display', 'none');
        }
    })
    /*$.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.params = function (params) {
        params._token = $("meta[name=token]").attr("content");
        return params;
    };
    $('.editable_element').editable({

        type: 'text',
        url: '{{url("order/update")}}',
        title: 'Edit Status',
        placement: 'top',
        send: 'always',

    });*/
    /*var user_result;
    $.get("{{url("getUsersList/clients")}}", function(data, status){
        user_result = data;
        console.log(user_result)
        user_result[0].foreEach(function(item){
            console.log(item)
        })
            /!*)    [
                {value: 1, text: 'Active'},
                {value: 2, text: 'Blocked'},
                {value: 3, text: 'Deleted'}
                ]*!/
    });
    $('#user_id').editable({
        value: 2,
        source: user_result,
    });*/
    $('#sender_district').change(function(){
        var sender_district = $('#sender_district').val();

        if(sender_district != 0)
        {
            $.ajax({
                url: "{{ url('getUpazilla') }}/"+sender_district,
                method: "GET",
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){;
                    $('#sender_upazilla').html(result)
                    $('#sender_upazilla').prop('disabled', false);
                }
            }).fail(function(result){
                console.log(result)
            });
        }
        else
        {
            $('#sender_upazilla').prop('disabled', 'disabled');
        }
    });
    $('#receiver_district').change(function(){
        var receiver_district = $('#receiver_district').val();

        if(receiver_district != 0)
        {
            $.ajax({
                url: "{{ url('getUpazilla') }}/"+receiver_district,
                method: "GET",
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){;
                    $('#receiver_upazilla').html(result)
                    $('#receiver_upazilla').prop('disabled', false);
                }
            }).fail(function(result){
                console.log(result)
            });
        }
        else
        {
            $('#receiver_upazilla').prop('disabled', 'disabled');
        }
    });
    $('#deny_reason').change(function(){
        if($('#deny_reason').val() == 'Other')
        {
            $('#deny_reason_2').css('display', 'block');
        }
        else
        {
            $('#deny_reason_2').css('display', 'none');
        }
    })
    $('#order_order_status').change(function(){
        if($('#order_order_status').val() == 3)
        {
            $('#location_id').css('display', 'block');
        }
    });
    $('#order_status').click(function(){
        var order_id = $('#order_order_status').attr('order_id');
        var status = $('#order_order_status').val();
        var location_id = $('#location_id').val();
        if(status == -1)
        {
            return;
        }
        else
        {
            $.ajax({
                url: "{{ url('changeOrderStatus') }}/"+order_id+"/"+status+"/"+location_id,
                method: "GET",
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){;
                   window.location.href = app.host + 'dashboard/order/'+order_id;
                }
            }).fail(function(result){
                console.log(result)
            });
        }
    });
    $('#responsive-table').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('#till_date').click(function(){
        if($('#till_date').prop('checked'))
        {

            $('#end_date').prop('disabled', 'disabled');
        }
        else{
            $('#end_date').prop('disabled', false);
        }
    })
    $('.select2js').select2();

    $('.default_datetimepicker').datetimepicker({
        allowTimes: ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'],
    });
    $('.default_datetimepicker_without_time').datetimepicker({
        timepicker:false,
        format: 'Y/m/d'
    });
            $(this).change(function(){
        date = new Date($(this).val());
        day = date.getDate();
        month = date.getMonth()+1;
        year = date.getFullYear();
        if(month < 10)
        {
            month = "0"+month;
        }
        if(day < 10)
        {
            day = "0"+day;
        }
        $(this).val(year + "-" + month + "-" + day);
    });
    $(".fileinput").fileinput({'showUpload':false, 'previewFileType':'any'});

})
/* tooltip*/
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $(".nano").nanoScroller({ scroll: 'top' });
    $(".nano").nanoScroller({ scroll: 'bottom' });
});
</script>
</body>

<!-- Mirrored from pages.revox.io/dashboard/latest/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Jan 2017 04:46:22 GMT -->
</html>