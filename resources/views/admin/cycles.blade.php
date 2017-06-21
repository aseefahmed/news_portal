@extends('layouts.admin.dashboard')

@section('content')

    <div class="pull-left" style="padding-left:15px;">
        <div class="col-xs-12">
            <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD CYCLE</button>
        </div>
    </div>

    <div class="col-sm-12" ng-controller="LocationController" ng-init="loadLocationsList()">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body  table-responsive">

                    <table class="table table-hover demo-table-dynamic table-responsive-block" id="responsive-table">
                        <thead>
                        <tr>
                            <th>Model </th>
                            <th>Courier </th>
                            <th>Given Date</th>
                            <th>Comment</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cycles as $cycle)
                            <tr>
                                <td>{{ $cycle->bicycle_number }}</td>
                                <td>{{ $cycle->courier_first_name }} {{ $cycle->courier_last_name }}</td>
                                <td>{{ $cycle->given_date }}</td>
                                <td>{{ $cycle->comments }}</td>
                                <td class="text-right">
                                    <a ng-click="viewCycleEditModal({{ $cycle->id }})" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                    <a ng-click="delete_cycle(<?php echo $cycle->id;?>)" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Cycle</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="myForm" id="myForm" novalidate>
                            {{ csrf_field() }}
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>BiCycle Model Number <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="cycle_number" id="cycle_number" ng-model="cycle.cycle_number" ng-required="true" ng-blur="checkCycleNumber()">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Given Date <span style="color:red">*</span></label>
                                            <input type="text" class="form-control default_datetimepicker_without_time" name="date" ng-model="cycle.date" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Courier <span style="color:red">*</span></label>
                                            <select class="form-control"  name="courier_id" ng-model="cycle.courier_id" ng-required="true">
                                                <option value="">Select a courier</option>
                                                <?php
                                                $i = 0;
                                                foreach($couriers as $courier){
                                                    if(isCourierGotCycle($courier->id) == 0){
                                                        $i++;
                                                        echo "<option value=".$courier->id.">$courier->first_name $courier->last_name </option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            @if($i == 0)
                                                <div class="text-danger ">
                                                    No Courier Found.
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Comment <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="comment" ng-model="cycle.comment" ng-model-options="{updateOn: 'blur'}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    @if($i > 0)
                        <div class="modal-footer">
                            <a type="button" class="btn btn-success" ng-disabled="count_cycle_number == 1 || myForm.courier_id.$invalid " ng-click="addCycle(myForm)">Ok</a>
                            <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                        </div>
                        <div class="modal-footer" ng-if="count_cycle_number == 1">
                            <div class="text-danger">
                                Model Number Already Exists.
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Edit Cycle</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
                            {{ csrf_field() }}
                            <div class="form-group-attached">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>BiCycle Model Number <span style="color:red">*</span></label>
                                            <input type="hidden" id="cycle_id" value="[[ cycles[0].id ]]">
                                            <input type="text" class="form-control" id="this_cycle_number" value="[[ cycles[0].bicycle_number ]]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Given Date <span style="color:red">*</span></label>
                                            <input type="text" class="form-control default_datetimepicker_without_time" id="this_given_date" value="[[ cycles[0].given_date ]]">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Courier <span style="color:red">*</span></label>
                                            <select class="form-control"  id="this_courier_id" ng-model="cycle.courier_id">
                                                <option value="">Select a courier</option>
                                                <?php
                                                $i = 0;
                                                foreach($couriers as $courier){
                                                    if(isCourierGotCycle($courier->id) == 0){
                                                        $i++;
                                                        echo "<option value=".$courier->id.">$courier->first_name $courier->last_name </option>";
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Comment <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="this_comment" value="[[ cycles[0].comments ]]">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <a type="button" class="btn btn-success" ng-disabled="userRegistrationForm.$invalid" ng-click="updateCycle(locationForm)">Ok</a>
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
                        <a type="button" class="btn btn-success" cycle_id="0" id="delete_cycle_confirm_btn" ng-click="delete_cycle_confirm()">Yes</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
    </div>



@endsection