@extends('layouts.login.main')

@section('content')
    <div class="login-container bg-white"  ng-controller="LoginController">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{ asset('img/logo.png') }}" alt="logo" data-src="{{ asset('img/logo.pngdd') }}" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
            <p>Sign into your pages account</p>

                <form id="formLogin" class="p-t-15" role="form" action="http://pages.revox.io/dashboard/latest/html/index.html">
                <div class="form-group form-group-default">
                    <label>Login</label>
                    <div class="controls">
                        <input type="text" ng-model="email_address" placeholder="Email Address" class="form-control" ng-required="true">
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Password</label>
                    <div class="controls">
                        <input type="password" class="form-control" ng-model="password" placeholder="Credentials" ng-required="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 no-padding">
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="checkbox1">
                            <label for="checkbox1">Keep Me Signed in</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="#" class="text-info small">Help? Contact Support</a>
                    </div>
                </div>
                <a href="#" ng-click="doLogin()" class="btn btn-primary">Sign In</a>
            </form>

            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-3 col-md-2 no-padding">
                        <img alt="" class="m-t-5" data-src="{{ asset('img/logo.png') }}" data-src-retina="{{ asset('img/logo.png') }}" height="60" src="{{ asset('img/logo.png') }}" width="60">
                    </div>
                    <div class="col-sm-9 no-padding">
                        <p>
                            <small>
                                Create a pages account. If you have a facebook account, log into it for this
                                process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection