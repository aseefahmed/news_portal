@extends('layouts.admin.dashboard')

@section('content')


<div class="wrap" ng-app="myApp" ng-controller="LoginController">
    <div class="col-sm-4">&nbsp;</div>
    <div class="col-md-4">
        <h4 class="section-subtitle"><b>Change</b> Password  </h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <form id="PasswordChangeForm" name="PasswordChangeForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" value="{{ $email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Current Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Current Password" ng-model="old_password" ng-requiredc="true">
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" ng-model="new_password" ng-requiredc="true">
                            </div>
                            <div class="form-group">
                                <label for="password">Retype Password</label>
                                <input type="password" class="form-control" name="retype_password"  id="retype_password" placeholder="Type Again" ng-model="retype_password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" password_action="update" user_id="{{ $id }}" id="change_password_id">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">&nbsp;</div>
</div>

@endsection
