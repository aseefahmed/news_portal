@extends('layouts.admin.dashboard')
@section('content')
@if(Auth::user()->role == 1)
  <div class="pull-left" style="padding-left:15px;">
    <div class="col-xs-12"> <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-wide btn-success" >ADD COURIER</a> </div>
  </div>
@endif
<div class="col-sm-12" ng-controller="CourierController" ng-init="loadCouriersList()">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
     <div class="panel-body  table-responsive">
      <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Name </th>
            <th>Branch</th>
            <th class="text-center"># of Task Assigned</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($couriers as $courier)
            @if((isset(findCourierLocation($courier->id)[0]) && isset($my_location[0])) && (findCourierLocation($courier->id)[0]->location_name == $my_location[0]->location_name)  )
              <tr>
                <td><a href="{{ url('dashboard/courier/'.$courier->id) }}">{{ ucwords(strtolower($courier->first_name)) }} {{ ucwords(strtolower($courier->last_name)) }}</a></td>
                <td>
                  @if(isset(findCourierLocation($courier->id)[0]))
                    {{ findCourierLocation($courier->id)[0]->location_name }}
                  @else
                    Not Allocated
                  @endif
                </td>
                <td class="text-center">{{ $courier->total_assigned_task }}</td>
              </tr>
            @endif
        @endforeach
          </tbody>        
      </table>
    </div>
    </div>
  </div>
</div>
@endsection 