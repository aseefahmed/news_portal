@extends('layouts.admin.dashboard')

@section('content')
    <style>
        .error_class {
            border:  1px red solid;
        }
    </style>
<div class="alert alert-success fade in text-center">
    <h1>{{ucwords($duration)}} Statements</h1>
</div>
<div class="col-sm-12" ng-controller="CourierController">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <table  class="table table-hover table-responsive demo-table-dynamic table-responsive-block col-sm-8" id="responsive-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Total Orders</th>
                            <th>Orders Delivered</th>
                            <th>New Customers</th>
                            <th class="text-right">Acttion</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($orders as $order)
                            	<tr>
	                            	<th>#</th>
		                            <th>{{ $order->monthyear }}</th>
		                            <th>{{ $order->total_orders }}</th>
		                            <th>{{ totalDeliveredOrders($order->this_month, $order->this_year) }}</th>
		                            <th>{{ totalNewCustomers($order->this_month, $order->this_year) }}</th>
		                            <th class="text-right">
		                            	<a class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
		                            </th>
                            	</tr>
                            @endforeach
                        </tbody>
                </table>
            </div>

        </div><pre>
        	{{ print_r($orders) }}

</div>


@endsection
