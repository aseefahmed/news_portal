<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NRB Express</title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link href="{{ asset('public/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .ng-cloak { display:none; }
    </style>
</head>

<body>
<div class="wrap" ng-app="myApp" ng-controller="LoginController">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <img alt="logo" src="{{ asset('public/img/logo.png') }}" />
        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">

                    <form name="formLogin" id="formLogin" action="{{ url('processLogin') }}" method="post" class="p-t-15" role="form">
                        {{ csrf_field() }}
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" name="recovered_email" id="recovered_email" ng-model="recovered_email" placeholder="Email Address" class="form-control" ng-required="true">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <div class="text-danger" ng-if="formLogin.recovered_email.$dirty && formLogin.recovered_email.$invalid" ng-cloak>
                                Email address is mandatory
                            </div>

                            <div id="error" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <input data-ng-disabled="formLogin.$invalid" type="button" name="recover_password" id="recover_password" class="btn btn-primary" value="Recover Password">
                            <img src="{{ asset('public/img/squares.gif') }}" id="ajax_loading_img_2" height="40px" style="display:none;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="{{ asset('public/js/all.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/plugins/angular/angular.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/controller.js') }}" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        $('#recover_password').click(function(){
            $('#ajax_loading_img_2').css('display', 'inline');
            formData = new FormData($("#formLogin")[0]);
            $.ajax({
                url: "{{ url('processRecoverPassword') }}",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){

                     $('#ajax_loading_img_2').css('display', 'none');
                    console.log(result);

                    if(result == -1)
                    {
                        $("#error").html('Email address not found in the system.');
                    }
                    else if(result == -2)
                    {
                        $("#error").html('A verification code has been sent your email address. Please have a look.');
                    }

                }
            }).fail(function(result){
                console.log(result)
            });
        })
        function loginFunc(){
            formData = new FormData($("#formLogin")[0]);
            $.ajax({
                url: "{{ url('processLogin') }}",
                method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function(result){
                    console.log(result);

                    if(result == -1)
                    {
                        $("#error").html('Username/Password did not matched');
                    }
                    else if(result == 2)
                    {
                        $("#error").html('Account has not been activated yet. please contact administrator.');
                    }
                    else if(result == 1)
                    {
                        window.location.href = app.host + 'dashboard';
                    }

                }
            }).fail(function(result){
                console.log(result)
            });
        }
        $('#signin').click(loginFunc)
        $('#username').on('keypress', function (e) {
            if(e.which === 13){
                loginFunc();
            }
        });
        $('#password').on('keypress', function (e) {
            if(e.which === 13){
                loginFunc();
            }
        });
    })
</script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>

</html>
