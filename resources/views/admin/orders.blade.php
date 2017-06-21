@extends('layouts.admin.dashboard')

@section('content')


    <div class="alert alert-success fade in text-center">
        <h1>Orders List</h1>
    </div>

    <div class="col-md-12" ng-controller="OrderController" ng-init="loadOrdersList('{{$order_status}}')">
        @if(true)
            <div class="">
                <div class="col-xs-3">
                    <a href="{{ url('dashboard/orders/add') }}" class="btn btn-wide btn-success" >ADD ORDER</a>
                </div>
                <div class="row col-xs-9 text-right">
                    <form name="searchOrder" method="post" action="{{ url('dashboard/orders/all/'.$order_status) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_status" id="order_status" value="{{ $order_status }}">
						
                            <?php
                                if($from_date!="")
                                {
                                    $from_date_value= substr($from_date, 0, 4)."/".substr($from_date, 5, 2)."/".substr($from_date, 8, 2);
                                    $to_date_value= substr($to_date, 0, 4)."/".substr($to_date, 5, 2)."/".substr($to_date, 8, 2);

                                }
                                else
                                {
                                    $from_date_value= "";
                                    $to_date_value= "";

                                }
                               
                            ?>
                        <div class="col-md-4 text-right">
                            <input placeholder="Order ID" name="order_id" id="order_id" value="{{$order_id}}"  class="form-control col-md-4" type="text">
                        </div>
                        <div class="col-md-3 text-right">
                            <input placeholder="From" name="from_date" id="from_date" value="{{ $from_date_value }}"  class="form-control  default_datetimepicker_without_time col-md-4" type="text">
                        </div>
                        <div class="col-md-3 text-right">
                            <input placeholder="To" name="to_date" value="{{ $to_date_value }}"  id="to_date"  class="form-control  default_datetimepicker_without_time col-md-4" type="text">
                        </div>
                        <div class="col-md-2 text-right">
                            <a type="button" id="search_order_btn" class="btn btn-primary">Search</a>
                        </div>
                    </form>
                </div>
            </div>
        @endif


            <div class="container-fluid padding-25 sm-padding-10">
            <div class="clearfix"></div>
            <div class="panel  table-responsive">
                <div class="panel-heading">

                </div>
					<div class="col-md-12 text-center">
					<code>{{$orders->total()}} Orders</code>
					</div>
                <div class="panel-body clearfix">
					<div class="col-md-3">
						@if($orders->currentPage() > 1)
							<a href="{{ url( $orders->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
						@else 
							<a class="btn btn-warning" disabled><< Prev</a>
						@endif
							
					</div>
					<div class="col-md-6">
					{{ $orders->links() }}
					</div>
					<div class="col-md-3 text-right">
						@if($orders->currentPage() < $orders->lastPage())
							<a href="{{ url( $orders->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
						@else 
							<a class="btn btn-warning" disabled>Next >></a>
						@endif
					</div>
                    <table class="table table-hover table-responsive demo-table-dynamic table-responsive-block col-sm-12 responsive-table">
                        <thead>
                        <tr>
                            <th>Acttion</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>SenderFullName</th>
                            <th>RecieverFullName</th>
                            <th>ShippingMethod</th>
                            <th>Date&TimeOfPickup</th>
                            <th>EstimatedTimeDelivery</th>
                            <th>TrackingNumber</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
							$i = 0;
						?>
                        @foreach($orders as $order)
                            <?php
                                if($from_date!="")
                                    {
                                        //201705271651
                                        $getyear = substr($from_date, 0, 4);
                                        $getmonth = substr($from_date, 5, 2);
                                        $getday = substr($from_date, 8, 2);/* 
                                        $gethour = substr($from_date, 8, 2);
                                        $getmin = substr($from_date, 10, 2); */
                                        $getsec = "00";
                                        $from_date_format = $getyear."-".$getmonth."-".$getday." 00:00:00";

                                        $getyear = substr($to_date, 0, 4);
                                        $getmonth = substr($to_date, 5, 2);
                                        $getday = substr($to_date, 8, 2);
                                        $gethour = substr($to_date, 8, 2);
                                        $getmin = substr($to_date, 10, 2);
                                        $to_date_format = $getyear."-".$getmonth."-".$getday." 23:59:59";
                                    }
                                else
                                    {
                                        $from_date_format = "2014-04-04 00:00:00";
                                        $to_date_format = Date('Y-m-d H:i:s');

                                    }

								$i++;
                            ?>
                                @if(strtotime($order->created_at) >= strtotime($from_date_format) && strtotime($order->created_at) <= strtotime($to_date_format))
                                <tr>
                                <td>

                                    <a  href="{{ url('dashboard/order/'.$order->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> View</a>
                                    @if(Auth::user()->role == 9)

                                        @if(is_assigned($order->id, Auth::user()->id) > 0)
                                            <a ng-click="deny_order(<?php echo $order->id;?>)" class="btn btn-danger"><i class="fa fa-bell-o"></i> Deny</a>
                                            <a ng-click="accept_order(<?php echo $order->id;?>)" class="btn btn-info"><i class="fa fa-anchor"></i> Accept</a>
                                        @endif
                                    @endif
                                    @if((Auth::user()->role != 18 && $order->flag != 0 && $order->assigned_courier == 0) ||  ($order->flag == 3 && findBranchManager($order->branch_id) == Auth::user()->id))
                                        <a order_id="[[ order.id ]]" ng-click="openModal({{ $order->id }})" class="btn btn-danger"><i class="fa fa-user"></i> Assign to Courier </a>
                                    @elseif($order->assigned_courier != 0)

                                        @if($order->assigned_courier != Auth::user()->id && Auth::user()->role != 18)
                                            <a order_id="[[ order.id ]]" ng-click="openModal({{ $order->id }})" class="btn btn-warning"><i class="fa fa-user"></i> Assigned to Rider</a>
                                        @endif
                                    @endif
                                    @if(Auth::user()->role == 1)
                                        <a ng-click="delete_order(<?php echo $order->id;?>)" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                    @endif
                               </td>
                                <td>
                                    <strong class="badge x-primary">{{ $order->payment_method }}</strong>
                                </td>
                                <td>
                                    @if($order->flag == 0)
                                        <strong class="badge x-danger">Pending</strong>
                                    @elseif($order->flag == 1)
                                        <strong class="badge x-success">Approved</strong>
                                    @elseif($order->flag == 2)
                                        <strong class="badge x-warning">Picked Up</strong>
                                    @elseif($order->flag == 3)
                                        <strong class="badge x-warning">Dropped Off to {{ findLocationDetails($order->branch_id)[0]->location_name }}</strong>
                                    @elseif($order->flag == 4)
                                        <strong class="badge x-warning">Transferred</strong>
                                    @elseif($order->flag == 5)
                                        <strong class="badge x-warning">Courier Assigned</strong>
                                    @elseif($order->flag == 11)
                                        <strong class="badge x-danger">On Hold</strong>
                                    @elseif($order->flag == 9)
                                        <strong class="badge x-warning">Delivered</strong>
                                    @elseif($order->flag == 10)
                                        <strong class="badge x-danger">Returned</strong>
                                    @elseif($order->flag == 14)
                                        <strong class="badge x-warning">Accepted</strong>
                                    @elseif($order->flag == 15)
                                        <strong class="badge x-danger">Denied</strong>
                                    @endif


                                </td>
                                <td>{{ $order->sender_name }}</td>
                                <td>{{ $order->reciever_name }}</td>
                                <td  style="min-width: 80%">
                                    @if($order->shipping_time < 8)
                                        Time Definite Delivery
                                    @elseif($order->shipping_time > 20)
                                        Regular
                                    @else
                                        Express
                                    @endif
                                </td>
                                <td>
                                    <?php

                                    if($order->pickup_date == '0000-00-00 00:00:00')
                                        echo "---";
                                    else
                                        //echo date_format(date_create($order->pickup_date), 'dS M, Y g:s A');
										echo date_format(date_create($order->pickup_date), 'd/M/Y g:s A');
                                    ?>
                               </td>
                                <td>
                                    <?php
                                    if($order->pickup_date == '0000-00-00 00:00:00')
                                        $date = date_create($order->created_at);
                                    else
                                        $date = date_create($order->pickup_date);

                                    date_add($date, date_interval_create_from_date_string($order->shipping_time.' hours'));
                                    echo date_format($date, 'dS M, Y g:s A');
                                    ?>
                                </td>
                                <td>{{ $order->id }}</td>
                            </tr>
                                @endif


                        @endforeach
						@if($i==0)
							<tr>
								<td><span class="code">No orders found</span></td>
							<tr>
						@endif
                        </tbody>
                    </table>
					<div class="col-md-3">
						@if($orders->currentPage() > 1)
							<a href="{{ url( $orders->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
						@else 
							<a class="btn btn-warning" disabled><< Prev</a>
						@endif
							
					</div>
					<div class="col-md-6">
					{{ $orders->links() }}
					</div>
					<div class="col-md-3 text-right">
						@if($orders->currentPage() < $orders->lastPage())
							<a href="{{ url( $orders->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
						@else 
							<a class="btn btn-warning" disabled>Next >></a>
						@endif
					</div>
                    <!-- Modal -->
                    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header state modal-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Assign To Courier</h4>
                                </div>
                                <div class="modal-body">

                                        <div class="form-group-attached">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        <label>Location<span style="color:red">*</span></label>
                                                        <select class="form-control" order_id="[[ $order_id ]]" id="select_location">
                                                            <option value="0">Select Location</option>
                                                            <option ng-repeat="location in locations" value="[[ location.id ]]">[[ location.location_name ]]</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        <label>Courier<span style="color:red">*</span></label>
                                                        <select class="form-control" id="select_courier" disabled>
                                                            <option value="-1">Select Courier</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <a type="button"  id="assign_courier_btn" class="btn btn-success">Ok</a>
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
                                    <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Delete Order</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group-attached">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-default">
                                                    Do you really want to delete the order?
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-success" order_id="0" user_type="" id="delete_order_confirm_btn" ng-click="delete_order_confirm()">Yes</a>
                                    <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="success-modal_3" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header state modal-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Deny Order</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" name="orderDenyForm" id="orderDenyForm" novalidate>
                                    {{ csrf_field() }}
                                        <div class="form-group-attached">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        Do you really want to deny this assignment?
                                                    </div>
                                                    <div>
                                                        <select id="deny_reason" style="border: 1px red solid;" ng-required="true" ng-model="deny_reason" name="deny_reason" class="form-control">
                                                            <option value="">Choose Denying Reason</option>
                                                            <option value="Out of City">Out of City</option>
                                                            <option value="On Holiday">On Holiday</option>
                                                            <option value="Absense">Absense</option>
                                                            <option value="Overloaded">Overloaded</option>
                                                            <option value="Rough Weather">Rough Weather</option>
                                                            <option value="Hours/Schedule Unacceptable">Hours/Schedule Unacceptable</option>
                                                            <option value="Not My Job">Not My Job</option>
                                                            <option value="Not in My Area">Not in My Area</option>
                                                            <option value="Political Violence">Political Violence</option>
                                                            <option value="Feeling Sick">Feeling Sick</option>
                                                            <option value="Cycle Trouble">Cycle Trouble</option>
                                                            <option value="Got Accident ">Got Accident </option>
                                                            <option value="Family Illness">Family Illness</option>
                                                            <option value="Injured and Unable to Work">Injured and Unable to Work</option>
                                                            <option value="Family Emergency"></option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="form-group form-group-default" style="display:none" id="deny_reason_2" >
                                                        <textarea ng-model="deny_reason_2_details" name="deny_reason_2_details"  id="deny_reason_2_details" class="form-control" placeholder="Please mention the reason for deny."></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-success" data-ng-disabled="orderDenyForm.$invalid" order_id="0" courier_id="{{ Auth::user()->id }}" user_type="" id="deny_order_confirm_btn" ng-click="deny_order_confirm()">Yes</a>
                                    <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="success-modal_4" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header state modal-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Accept Order</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" name="orderAcceptForm" id="orderAcceptForm" novalidate>
                                        {{ csrf_field() }}
                                        <div class="form-group-attached">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group form-group-default">
                                                        Do you really want to accept this assignment?
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-success"  order_id="0" courier_id="{{ Auth::user()->id }}" user_type="" id="accept_order_confirm_btn" ng-click="accept_order_confirm()">Yes</a>
                                    <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection