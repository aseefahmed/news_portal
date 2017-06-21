@extends('layouts.admin.dashboard')
@section('content')
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12"> <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-wide btn-success" >ADD COURIER</a> </div>
</div>
<div class="col-sm-12" ng-controller="CourierController" ng-init="loadCouriersList()">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
     <div class="panel-body  table-responsive ">
	 <div class="col-md-3">
		@if($couriers->currentPage() > 1)
			<a href="{{ url( $couriers->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
		@else 
			<a class="btn btn-warning" disabled><< Prev</a>
		@endif
			
	</div>
	<div class="col-md-6">
	{{ $couriers->links() }}
	</div>
	<div class="col-md-3 text-right">
		@if($couriers->currentPage() < $couriers->lastPage())
			<a href="{{ url( $couriers->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
		@else 
			<a class="btn btn-warning" disabled>Next >></a>
		@endif
	</div>
      <table id="responsive-table" class="data-table table table-striped table-hover table-responsive nowrap responsive-table" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Name </th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($couriers as $courier)
        <tr>
          <td>{{ $courier->first_name }} {{ $courier->last_name }}</td>
          <td>{{ $courier->email }}</td>
          <td>{{ $courier->contact_no_work }}</td>
          <td> {{ $courier->gender }} </td>
          <td> 
          	@if($courier->status == 'Pending')
            	<span class="badge x-danger">{{ $courier->status }} </span>
            @elseif($courier->status == 'Processing')
            	<span class="badge x-warning">{{ $courier->status }} </span>
            @elseif($courier->status == 'Confirmed')
            	<span class="badge x-success">{{ $courier->status }} </span>
            @elseif($courier->status == 'Inactive')
            	<span class="badge">{{ $courier->status }} </span>
			@elseif($courier->status == 'Deleted')
            	<span class="badge x-danger">{{ $courier->status }} </span>                
            @endif
          </td>
          <td>
              <a href="{{ url('dashboard/courier/'.$courier->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
              <a href="{{ url('dashboard/courier/edit/'.$courier->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
              <a href="{{ url('dashboard/courier/delete/'.$courier->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
          </td>
        </tr>
        @endforeach
          </tbody>        
      </table>
	  <div class="col-md-3">
		@if($couriers->currentPage() > 1)
			<a href="{{ url( $couriers->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
		@else 
			<a class="btn btn-warning" disabled><< Prev</a>
		@endif
			
	</div>
	<div class="col-md-6">
	{{ $couriers->links() }}
	</div>
	<div class="col-md-3 text-right">
		@if($couriers->currentPage() < $couriers->lastPage())
			<a href="{{ url( $couriers->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
		@else 
			<a class="btn btn-warning" disabled>Next >></a>
		@endif
	</div>
    </div>
    </div>
  </div>
</div>
@endsection 