@extends('layouts.admin.dashboard')

@section('content')
<div class="col-sm-12" ng-controller="RoleController" ng-init="loadPermissions()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body clearfix">
                    <div class="row clearfix">
                       <h3> Role : <span class="text-primary"><strong>{{ strtoupper($role[0]->name) }}</strong></span></h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center bg bg-success">
                            <h2>Assign Privileges</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div ng-repeat="permission in permissions" class="col-sm-4">
                            <input type="checkbox" id="[[ permission.id ]]" ng-model="permissions_id" ng-change="selectPermission(this, {{$role[0]->id}}, [[ permission.id ]])">[[ permission.display_name | uppercase ]]
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</div>

@endsection