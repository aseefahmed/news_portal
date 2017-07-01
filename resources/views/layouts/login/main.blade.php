<!doctype html>
<html lang="en" class="fixed accounts sign-in">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Bangladesh Times</title>
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
                                <input type="text" name="username" id="username" ng-model="email_address" placeholder="Email Address" class="form-control" ng-required="true">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <div class="text-danger" ng-if="formLogin.username.$dirty && formLogin.username.$invalid" ng-cloak>
                                Email address is mandatory
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" id="password" name="password" class="form-control" ng-model="password" placeholder="Credentials" ng-required="true">
                                <i class="fa fa-key"></i>
                            </span>
                            <div id="error" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <input type="checkbox" name="remember" value="1">
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input data-ng-disabled="formLogin.$dirty && formLogin.$invalid" type="button" id="signin" class="btn btn-primary" value="Sign In">
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ url('forget-password') }}">Forgot password?</a>
                            {{--<hr/>
                            <span>Don't have an account?</span>
                            <a href="pages_register.html" class="btn btn-block mt-sm">Register</a>--}}
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
