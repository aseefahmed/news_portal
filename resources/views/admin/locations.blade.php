@extends('layouts.admin.dashboard')
@section('content')
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12">
    <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD LOCATION</button>
  </div>
</div>
<div class="col-sm-12" ng-controller="LocationController" ng-init="loadLocationsList()">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-body  table-responsive">
        <table class="table table-striped responsive-table" id="responsive-table">
          <thead>
            <tr>
              <th>Location Name </th>
              <th>Address </th>
              <th>Contact Person </th>
              <th>Contact Number</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>
          
          @foreach($locations as $location)
          <tr>
            <td>{{ $location->location_name }}</td>
            <td><?php echo wordwrap($location->address, 50,"<br>\n"); ?></td>
            <td>{{ $location->first_name }} {{ $location->last_name }}</td>
            <td>{{ $location->contact_number }}</td>
            <td class="text-right">
            	<a href="{{ url('dashboard/locations/view/'.$location->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
                <a ng-click="viewLocationEditModal({{ $location->id }})" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                <a ng-click="delete_location(<?php echo $location->id;?>)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
          <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Location</h4>
        </div>
        <div class="modal-body">
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
                    <select class="form-control" name="location_contact_number" ng-model="location.contact_name" ng-model-options="{updateOn: 'blur'}">
                      <option value="">Choose User</option>
                       @foreach($users as $user)                  
                      <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
			`		@endforeach                  
                    </select>
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
        <div class="modal-footer"> <a type="button" class="btn btn-success" ng-disabled="userRegistrationForm.$invalid" ng-click="addLocation(locationForm)">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header state modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Edit Location</h4>
        </div>
        <div class="modal-body">
          <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
            {{ csrf_field() }}
            <div class="form-group-attached">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Location <span style="color:red">*</span></label>
                    <input type="hidden" id="location_id" value="[[ locations[0].id ]]">
                    <input type="text" class="form-control" id="location_name" value="[[ locations[0].location_name ]]">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Address <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="location_address" value="[[ locations[0].address ]]">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Contact Person <span style="color:red">*</span></label>
                    <select class="form-control" id="location_contact_name" name="location_contact_name">
                      <option value="0">Choose User</option>
                       @foreach($users as $user)
                      <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                      @endforeach              
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Contact Number <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="location_contact_number" value="[[ locations[0].contact_number ]]">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer"> <a type="button" class="btn btn-success" ng-disabled="userRegistrationForm.$invalid" ng-click="updateLocation(locationForm)">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>
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
                <div class="form-group form-group-default"> Do you really want to delete the location? </div>
              </div>
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer"> <a type="button" class="btn btn-success" location_id="0" id="delete_location_confirm_btn" ng-click="delete_location_confirm()">Yes</a> <a type="button" class="btn btn-default" data-dismiss="modal">No</a> </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection