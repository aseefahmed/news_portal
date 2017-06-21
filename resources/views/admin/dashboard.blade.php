@extends('layouts.admin.dashboard')

@section('content')
    <div ng-controller="OrderController" ng-init="viewDashboard()">
        
        <div class="row col-sm-12">
            
            <div class="row">
                @if(Auth::user()->role == 1)
                    <div class="col-sm-4 col-lg-3">
                        <div class="panel widgetbox wbox-3 bg-primary ">
                            <div class="panel-content">
                                <span class="icon fa fa-users"></span>
                                <h1 class="title color-darker-2">Total Customer </h1>
                                <h4 class="numbers"><b>{{ $no_of_customer }}</b></h4>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-sm-4 col-lg-3">
                    <div class="panel widgetbox wbox-3 bg-warning ">
                            <div class="panel-content">
                                <span class="icon fa fa-gift"></span>
                                <h1 class="title color-darker-2">Total Orders</h1>
                                <h4 class="numbers"><b>{{ $no_of_order }}</b></h4>
                            </div>
                    </div>
                </div>
                @if(Auth::user()->role != 9)
                    <div class="col-sm-4 col-lg-3">
                            <div class="panel widgetbox wbox-3 bg-danger ">
                                <div class="panel-content">
                                    <span class="icon fa fa-user"></span>
                                    <h1 class="title color-darker-2">Total Courier</h1>
                                    <h4 class="numbers"><b>{{ $no_of_courier }}</b></h4>
                                </div>
                            </div>
                        </div>
                @endif
                <div class="col-sm-4 col-lg-3">
                    <div class="panel widgetbox wbox-3 bg-success ">
                            <div class="panel-content">
                                <span class="icon fa fa-bicycle"></span>
                                <h1 class="title color-darker-2">Total Delivered</h1>
                                <h4 class="numbers"><b>{{ $no_of_order_delivered }}</b></h4>
                            </div>
                    </div>
                </div>
            </div>
        </div>
		@if(Auth::user()->role == 1)
			<div class="col-sm-6">
				<h4 class="section-subtitle"><b>Monthly</b> Summery</h4>
				<div class="panel">
					<div class="panel-content">
						 <canvas id="myChart1" width="500" height="200"></canvas>
					</div>
				</div>

				   
				</div>
				<div class="col-sm-6">
				<h4 class="section-subtitle"><b>Order</b> Status</h4>
				<div class="panel">
					<div class="panel-content">
						 <canvas id="myChart2" width="500" height="200"></canvas>
					</div>
				</div>
			</div>
			<!--div class="col-sm-6">
				<h4 class="section-subtitle"><b>Hub</b> Overview</h4>
				<div class="panel">
					<div class="panel-content">
						 <canvas id="myChart3" width="500" height="200"></canvas>
					</div>
				</div>

				   
				</div>
				<div class="col-sm-6">
				<h4 class="section-subtitle"><b>Hub</b> Statistics</h4>
				<div class="panel">
					<div class="panel-content">
						 <canvas id="myChart4" width="500" height="200"></canvas>
					</div>
				</div>
			</div-->
		@endif
    </div>    
@endsection