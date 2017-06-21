@extends('layouts.admin.dashboard')


@section('content')

    <div class="col-sm-12" ng-controller="CourierController" ng-init="loadCouriersList()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
                    {{ csrf_field() }}
                    <div class="form-group-attached">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Location <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="location_name" ng-model="location.location_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Address <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="location_address" ng-model="location.address" ng-model-options="{updateOn: 'blur'}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Contact Person <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="location_contact_number" ng-model="location.contact_name" ng-model-options="{updateOn: 'blur'}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Contact Number <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="location_contact_number" ng-model="location.contact_number" ng-model-options="{updateOn: 'blur'}">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


@endsection
