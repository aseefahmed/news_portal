@extends('layouts.admin.dashboard')

@section('content')


    <div class="alert alert-success fade in text-center">
        <h1>Orders List</h1>
    </div>

    <div class="col-md-12" ng-controller="OrderController">
        


            <div class="container-fluid padding-25 sm-padding-10">
            <div class="clearfix"></div>
            <div class="panel  table-responsive">
                <div class="panel-heading">

                </div>
                <div class="panel-body clearfix">

                    <table  class="table table-hover table-responsive demo-table-dynamic table-responsive-block col-sm-8" id="responsive-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sender</th>
                            <th>Reciever</th>
                            <th>Shipping Method</th>
                            <th>Pickup Date</th>
                            <th>ETD</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th class="text-right">Acttion</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <?php
                                if(isset($from_date))
                                    {
                                        //201705271651
                                        $getyear = substr($from_date, 0, 4);
                                        $getmonth = substr($from_date, 4, 2);
                                        $getday = substr($from_date, 6, 2);
                                        $gethour = substr($from_date, 8, 2);
                                        $getmin = substr($from_date, 10, 2);
                                        $getsec = "00";
                                        $from_date_format = $getyear."-".$getmonth."-".$getday." ".$gethour.":".$getmin.":".$getsec;

                                        $getyear = substr($to_date, 0, 4);
                                        $getmonth = substr($to_date, 4, 2);
                                        $getday = substr($to_date, 6, 2);
                                        $gethour = substr($to_date, 8, 2);
                                        $getmin = substr($to_date, 10, 2);
                                        $to_date_format = $getyear."-".$getmonth."-".$getday." ".$gethour.":".$getmin.":".$getsec;;
                                    }
                                else
                                    {
                                        $from_date_format = "2015-04-04 00:00:00";
                                        $to_date_format = Date('Y-m-d H:i:s');

                                    }


                            ?>
                                @if(true)
                                <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->sender_name }}</td>
                                <td>{{ $order->reciever_name }}</td>
                                <td>
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
                                        echo date_format(date_create($order->pickup_date), 'dS M, Y g:s A');
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
                                <td class="text-right">

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
                            </tr>
                                @endif


                        @endforeach
                        </tbody>
                    </table>
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