@extends('layouts.admin.dashboard')

@section('content')
<div class="col-sm-12" ng-controller="RoleController" ng-init="loadPermissions()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg pull-right" data-target="#modalSlideUp" data-toggle="modal">ADD</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body clearfix">
                    <div class="row col-sm-2 clearfix">
                        <input type="text" class="form-control" ng-model="search_filter" placeholder="Search">
                    </div>

                    <table class="table table-hover demo-table-dynamic table-responsive-block" id="tableWithDynamicRows">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="permission in filtered = (permissions | filter : search_filter)" ng-cloak>
                                <td>[[ $index+1 ]]</td>
                                <td>[[ permission.display_name | uppercase ]]</td>
                            </tr>
                            <tr ng-if="filtered.length == 0">
                                <td colspan="3">
                                    No data found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade stick-up" id="modalSlideUp" tabindex="-1" permission="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Permission <span class="semi-bold">INFORMATION</span></h5>
                    </div>
                    <div class="modal-body">
                        <form permission="form" name="userPermissionForm" novalidate>
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Permission <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="permission" ng-model="permission.name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" ng-if="userPermissionForm.permission.$dirty && userPermissionForm.permission.$invalid">
                                        <label><span style="color:red">Name is required</span></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Display Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="display_name" ng-model="permission.display_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" ng-if="userPermissionForm.permission.$dirty && userPermissionForm.permission.$invalid">
                                        <label><span style="color:red">Display name is required</span></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Description </label>
                                            <textarea rows="10" cols="10" class="form-control" name="description" ng-model="permission.description"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                <a class="btn btn-primary btn-block m-t-5" ng-disabled="userPermissionForm.$invalid" ng-click="addPermission(userPermissionForm)">Add Permission</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection