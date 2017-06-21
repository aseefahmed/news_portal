@extends('layouts.admin.dashboard')

@section('content')
    <div class="pull-left" style="padding-left:15px;">
        <div class="col-xs-12">
            <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD ROUTE</button>
        </div>
    </div>
    <div class="col-sm-12" ng-controller="LocationController">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body clearfix table-responsive">

                    <table class="table table-hover demo-table-dynamic table-responsive-block responsive-table" id="responsive-table">
                        <thead>
                        <tr>
                            <th>Route </th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($routes as $route)
                                <tr>
                                    <td><strong>{{ $route->sender_dist }}</strong> to <strong>{{ $route->receiver_dist }}</strong> </td>
                                    <td class="text-right">
                                        <a href="{{ url('dashboard/routes/view/'.$route->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                                        <a ng-click="viewRouteEditModal({{ $route->id }}, {{ $route->sender_dist_id }}, {{ $route->receiver_dist_id }})" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <a ng-click="delete_route(<?php echo $route->id;?>)" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalSlideUp" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-anchor"></i>Add Route</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="locationForm" id="locationForm" novalidate>
                            {{ csrf_field() }}
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>From <span style="color:red">*</span></label>
                                            <select class="form-control" name="from" id="from">
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>To <span style="color:red">*</span></label>
                                            <select class="form-control" name="to" id="to">
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <a type="button" class="btn btn-success"  id="generate_location_btn">Ok</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Edit Route</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" id="this_route_id">
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>From <span style="color:red">*</span></label>
                                            <select class="form-control" name="from" id="this_from">
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>To <span style="color:red">*</span></label>
                                            <select class="form-control" name="to" id="this_to">
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <a type="button" class="btn btn-success" ng-disabled="userRegistrationForm.$invalid" ng-click="updateRoute(locationForm)">Ok</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="success-modal_2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Delete Location</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group-attached">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        Do you really want to delete the location?
                                    </div>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-success" route_id="0" id="delete_route_confirm_btn" ng-click="delete_route_confirm()">Yes</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
    </div>



@endsection