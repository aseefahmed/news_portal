@extends('layouts.admin.dashboard')

@section('content')
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12"> <a href="{{ url('dashboard/assets/add') }}" class="btn btn-wide btn-success" >Add Courier Assets</a> </div>
</div>
<div class="col-sm-12" ng-controller="LocationController" ng-init="loadLocationsList()">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-body clearfix">
        <div class="table-responsive">
          <table class="table table-hover demo-table-dynamic table-responsive-block responsive-table" id="responsive-table">
            <thead>
              <tr>
                <th>Courier </th>
                <th>Given Date</th>
                <th>Comment</th>
                <th class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach($assets as $asset)
            <tr>
              <td>{{ $asset->courier_first_name }} {{ $asset->courier_last_name }}</td>
              <td>{{ date_format(date_create($asset->given_date), 'j F, Y') }}</td>
              <td>{{ $asset->comment }}</td>
              <td class="text-right">
              	<a href="{{ url('dashboard/asset/'.$asset->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                <a href="{{ url('dashboard/asset/'.$asset->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                <a ng-click="delete_cycle(<?php echo $asset->id;?>)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
              </tbody>            
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection