@extends('layouts.admin.dashboard')

@section('content')
    <div class="pull-left">
        <div class="col-xs-12">
            <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD</button>
        </div>
    </div>
<div class="col-sm-12" ng-controller="RoleController" ng-init="loadRoles()">

        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body clearfix table-responsive">

                    <table class="table table-hover demo-table-dynamic table-responsive-block" id="responsive-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="role in filtered = (roles | filter : search_filter)" ng-cloak>
                                <td>[[ $index+1 ]]</td>
                                <td>[[ role.name ]]</td>
                                <td><a class="btn btn-primary" href="{{url('dashboard/role/[[ role.id ]]/permission')}}">Assign Permissions</a></td>
                            </tr>
                            <tr ng-if="roles.length == 0">
                                <td colspan="3">
                                    No data found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade stick-up" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog ">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Role <span class="semi-bold">INFORMATION</span></h5>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="userRoleForm" novalidate>
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Role <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="role" ng-model="role.name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" ng-if="userRoleForm.role.$dirty && userRoleForm.role.$invalid">
                                        <label><span style="color:red">Name is required</span></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Description </label>
                                            <textarea rows="10" cols="10" class="form-control" name="description" ng-model="role.description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                <a class="btn btn-primary btn-block m-t-5" ng-disabled="userRoleForm.$invalid" ng-click="addRole(userRoleForm)">Add Role</a>
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