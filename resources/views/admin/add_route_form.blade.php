@extends('layouts.admin.dashboard')

@section('content')
    <div class="content sm-gutter" ng-controller="LocationController" ng-init="getDistrictList()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-heading">
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body clearfix">

                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>ROUTE <span class="semi-bold">INFORMATION</span></h5>
                        <p class="p-b-10">We need client information inorder to process the order</p>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="locationForm" novalidate>
                            <div class="form-group-attached">

                                <div class="row col-sm-12">
                                    <div class="col-sm-4">
                                        From
                                    </div>
                                    <div class="col-sm-4">
                                        To
                                    </div>
                                </div>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4">
                                        <select class="form-control select2js" style="width: 400px;" ng-change="getRelaventDistricts(3)">
                                            <option ng-repeat="district in districts">[[ district.bn_name ]]</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control select2js" style="width: 400px;">
                                            <option ng-repeat="district in districts2">[[ district.bn_name ]]</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row col-sm-12">
                                    <div class="col-sm-2 ">
                                        <a class="btn btn-primary btn-block m-t-5" ng-disabled="userRegistrationForm.$invalid" ng-click="addLocation(locationForm)">ADD</a>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>



@endsection