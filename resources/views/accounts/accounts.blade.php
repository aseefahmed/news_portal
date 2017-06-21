@extends('layouts.admin.dashboard')

@section('content')
		    <style>
		        .error_class {
		            border:  1px red solid;
		        }
		    </style>
			<div class="alert alert-success fade in text-center">
			    <h1>Accounts</h1>
			</div>
            
<div class="col-sm-12">
	<form name="searchOrder" method="post" action="{{ url('dashboard/reports/accounts') }}">
		{{ csrf_field() }}
		@if(Auth::user()->role == 8 || Auth::user()->role == 1)
		  <div class="col-md-3">
			
			<div class="input-group col-md-12">
				<select class="select2js col-md-12" name="courier_id">
					<option value="all">All</option>
				   @foreach($couriers as $courier)
						<option value="{{ $courier->id }}">{{ $courier->first_name }} {{ $courier->last_name }}</option>     
				   @endforeach
				</select>
			</div>

		</div>
		@endif
		<div class="col-md-3 text-right">
			
			<div class="input-group">
				<input placeholder="From" ng-required="true" ng-model="from_date" name="from_date" id="from_date" value=""  class="form-control  default_datetimepicker_without_time col-md-4" type="text">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>

		</div>
		<div class="col-md-3 text-right">
			

			<div class="input-group">
				<input placeholder="To"  ng-required="true" ng-model="to_date" name="to_date" value=""  id="to_date"  class="form-control  default_datetimepicker_without_time col-md-4" type="text">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
		<div class="col-md-2 text-right">
			<input type="submit"  class="btn btn-primary" value="SEARCH" ng-disabled='searchOrder.from_date.$invalid || searchOrder.to_date.$invalid'>
		</div>
	</form>
</div>
	<div class="col-sm-12" ng-controller="OrderController">
		<div class="container-fluid padding-25 sm-padding-10">      
			<div class="table-responsive">
				<div class="tabs">
					<ul class="nav nav-tabs">
						@if(Auth::user()->role == 8)
							<li class="active"><a href="#home" data-toggle="tab">Not Yet Received</a></li>
						@elseif(Auth::user()->role == 9)
							<li class="active"><a href="#home" data-toggle="tab">Not Handed Over</a></li>
						@endif
						@if(Auth::user()->role == 8)
							<li><a href="#profile" data-toggle="tab">Approval Pending</a></li>
						@elseif(Auth::user()->role == 9)
							<li><a href="#profile" data-toggle="tab">Handed Over</a></li>
						@endif
						@if(Auth::user()->role == 8)
							<li><a href="#received_money" data-toggle="tab">Received Money</a></li>
						@endif
						
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="home">
						
							<table class="table table-striped table-hover table-bordered responsive-table">
							  <thead>
							  <tr style="background-color: rgb(236,236,236)">
								<th>
								  <input type="checkbox" id="check_main" ng-click="checkAllCheckbox()">
								</th>
								<th>Amount</th>
								<th>Customer</th>
								<th>Date</th>
								<th>Ref/SKU No</th>
								<th>Order Number</th>
								<th>Courier</th>
								<th>Payment Method</th>
								<!-- <th>Action</th> -->
							  </tr>
							  </thead>
							  <tbody>
							  <?php
								  $total_price = 0;
								  $i=-1;
							  ?>
								@foreach($orders as $key=>$order)
								  <?php
									  $total_price += $order->price;
								  ?>
								  @if($order->handedover == "" || $order->handedover == "2")
									<?php 
									  $i++;
									?>
									@if($order->payment_method == 'Cash on Delivery')
										<?php
											$total_amount = findTotalAmount($order->id);
											$price = $order->price + $order->shipping_cost+ $total_amount;
										?>
									@else 
										
										<?php
											$price = $order->price;
										?>									
									@endif
									<tr>
									  <td>
										<div class="checkbox-custom checkbox-primary">
										   @if($order->handedover == 1)
												  <button class="btn btn-danger" disabled>Handed Over</button>
											@else 
												  <input type="checkbox" order_id="{{ $order->id }}" money="{{ $price }}" id="mycheck_{{ $i}}" class="checkboxclass" ng-click="checkHandover({{ $i}})">
												  <label class="check" for="mycheck_{{ $i }}"></label>
											@endif
										</div>
									  </td>
									  <td class="text-right">
										{{ $price }} Tk. 
									  </td>
									  <td>{{ $order->name }}</td>
									  <td>{{ date_format(date_create($order->pickup_date), 'g:s A, dS M, Y') }}</td>
									  <td></td>
									  <td><a href="{{ url('dashboard/order/'.$order->id) }}" target="_blank">{{ $order->id }}</a></td>
									  
									  <td>
										  @if($order->assigned_courier > 0)
											  {{ findCourierDetails($order->assigned_courier)[0]->first_name }} {{ findCourierDetails($order->assigned_courier)[0]->last_name }}
										  @else 
											  ---
										  @endif        
									  </td>
									  <td>{{ $order->payment_method }}</td>
									  <!-- <td>
										<div class="checkbox">
										  @if($order->handedover == '1')
											<button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-danger" disabled>Handed Over</button>
										  @else
											  @if(Auth::user()->role == 9)
												  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-success">Hand Over</button>
											  @elseif(Auth::user()->role == 8)
												  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-warning" disabled="">Not Received </button>
											  @endif
										  @endif
									  </td> -->
									</tr>
									
								  @endif
								@endforeach
									<!-- <tr>
									  <th>
										&nbsp;
									  </th>
									  <th>Total</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>{{ $total_price }} Tk.</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									</tr> -->

							  </tbody>
							  
							</table>
						</div>
						<div class="tab-pane fade" id="profile">
							<table class="table table-striped table-hover table-bordered responsive-table">
							  <thead>
							  <tr style="background-color: rgb(236,236,236)">
								<th>
								  Action
								</th>
								<th>Amount</th>
								<th>Customer</th>
								<th>Date</th>
								<th>Ref/SKU No</th>
								<th>Order Number</th>
								<th>Courier</th>
								<th>Payment Method</th>
								<!-- <th>Action</th> -->
							  </tr>
							  </thead>
							  <tbody>
							  <?php
								  $total_price = 0;
							  ?>
								@foreach($orders as $key=>$order)
								  <?php
									  $total_price += $order->price;
								  ?>
								  @if((Auth::user()->role == 9 && ($order->handedover == "3" || $order->handedover == "1")) 
									||   (Auth::user()->role == 8 && ($order->handedover == "3"))
								  )
									@if($order->payment_method == 'Cash on Delivery')
										<?php
											$total_amount = findTotalAmount($order->id);
											$price = $order->price + $order->shipping_cost+ $total_amount;
										?>
									@else 
										{{ $order->price }} Tk.
										<?php
											$price = $order->price;
										?>									
									@endif
									<tr>
									  <td>
										<div class="checkbox-custom checkbox-primary">
										   @if($order->handedover == "3" || $order->handedover == "1")
												  @if(Auth::user()->role == 9)
													  <button class="btn btn-danger" disabled>Handed Over</button>
												  @elseif(Auth::user()->role == 8)
													  <button class="btn btn-primary" ng-click="approveHandover({{ $order->id }})"><i class="fa fa-check"></i> </button>
													  <button class="btn btn-danger" ng-click="rejectHandover({{ $order->id }})"><i class="fa fa-times"></i> </button>
												  @endif
											@else 
												  <input type="checkbox" order_id="{{ $order->id }}" id="mycheck_{{ $key}}" class="checkboxclass">
												<label class="check" for="mycheck_{{ $key }}"></label>
											@endif
										</div>
									  </td>
									  <td class="text-right">{{ $price }} Tk. </td>
									  <td>{{ $order->name }}</td>
									  <td>{{ date_format(date_create($order->pickup_date), 'g:s A, dS M, Y') }}</td>
									  <td></td>
									  <td><a href="{{ url('dashboard/order/'.$order->id) }}" target="_blank">{{ $order->id }}</a></td>
									  
									  <td>
										  @if($order->assigned_courier > 0)
											  {{ findCourierDetails($order->assigned_courier)[0]->first_name }} {{ findCourierDetails($order->assigned_courier)[0]->last_name }}
										  @else 
											  ---
										  @endif        
									  </td>
									  <td>{{ $order->payment_method }}</td>
									  <!-- <td>
										<div class="checkbox">
										  @if($order->handedover == '1')
											<button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-danger" disabled>Handed Over</button>
										  @else
											  @if(Auth::user()->role == 9)
												  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-success">Hand Over</button>
											  @elseif(Auth::user()->role == 8)
												  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-warning" disabled="">Not Received </button>
											  @endif
										  @endif
									  </td> -->
									</tr>
								  @endif
								@endforeach
									<!-- <tr>
									  <th>
										&nbsp;
									  </th>
									  <th>Total</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									  <th>{{ $total_price }} Tk.</th>
									  <th>&nbsp;</th>
									  <th>&nbsp;</th>
									</tr> -->

							  </tbody>
							  
							</table>
						</div>
						@if(Auth::user()->role == 8)
							<div class="tab-pane fade" id="received_money">
								<table class="table table-striped table-hover table-bordered responsive-table">
								  <thead>
								  <tr style="background-color: rgb(236,236,236)">
									<th>
									  Action
									</th>
									<th>Amount</th>
									<th>Customer</th>
									<th>Date</th>
									<th>Ref/SKU No</th>
									<th>Order Number</th>
									<th>Courier</th>
									<th>Payment Method</th>
									<!-- <th>Action</th> -->
								  </tr>
								  </thead>
								  <tbody>
								  <?php
									  $total_price = 0;
								  ?>
									@foreach($orders as $key=>$order)
									  <?php
										  $total_price += $order->price;
									  ?>
									  @if($order->handedover == "1")
										    @if($order->payment_method == 'Cash on Delivery')
												<?php
													$total_amount = findTotalAmount($order->id);
													$price = $order->price + $order->shipping_cost+ $total_amount;
												?>
											@else 
												{{ $order->price }} Tk.
												<?php
													$price = $order->price;
												?>									
											@endif
										<tr>
										  <td>
											<div class="checkbox-custom checkbox-primary">
											   @if($order->handedover == "3" || $order->handedover == "1")
													  @if(Auth::user()->role == 9)
														  <button class="btn btn-danger" disabled>Handed Over</button>
													  @elseif(Auth::user()->role == 8)
													      <button class="btn btn-warning">Received </button>
														  
													  @endif
												@else 
													  <input type="checkbox" order_id="{{ $order->id }}" id="mycheck_{{ $key}}" class="checkboxclass">
														<label class="check" for="mycheck_{{ $key }}"></label>
												@endif
											</div>
										  </td>
										  <td class="text-right">{{ $price }} Tk. </td>
										  <td>{{ $order->name }}</td>
										  <td>{{ date_format(date_create($order->pickup_date), 'g:s A, dS M, Y') }}</td>
										  <td></td>
										  <td><a href="{{ url('dashboard/order/'.$order->id) }}" target="_blank">{{ $order->id }}</a></td>
										  
										  <td>
											  @if($order->assigned_courier > 0)
												  {{ findCourierDetails($order->assigned_courier)[0]->first_name }} {{ findCourierDetails($order->assigned_courier)[0]->last_name }}
											  @else 
												  ---
											  @endif        
										  </td>
										  <td>{{ $order->payment_method }}</td>
										  <!-- <td>
											<div class="checkbox">
											  @if($order->handedover == '1')
												<button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-danger" disabled>Handed Over</button>
											  @else
												  @if(Auth::user()->role == 9)
													  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-success">Hand Over</button>
												  @elseif(Auth::user()->role == 8)
													  <button id="{{ $order->id }}" ng-click="handoverMoney({{ $order->id }})" class="btn btn-warning" disabled="">Not Received </button>
												  @endif
											  @endif
										  </td> -->
										</tr>
									  @endif
									@endforeach
										<!-- <tr>
										  <th>
											&nbsp;
										  </th>
										  <th>Total</th>
										  <th>&nbsp;</th>
										  <th>&nbsp;</th>
										  <th>&nbsp;</th>
										  <th>&nbsp;</th>
										  <th>{{ $total_price }} Tk.</th>
										  <th>&nbsp;</th>
										  <th>&nbsp;</th>
										</tr> -->

								  </tbody>
								  
								</table>
							</div>
						@endif
					</div>
				</div>

			  @if(Auth::user()->role == 9)
				@if($i>0)
				  <button ng-disabled="money<1" class="btn btn-success" id="send_money_btn" ng-click="updateAllAccount()" disabled><i class="fa fa-usd"></i> SEND MONEY</button>
				  <button class="btn btn-danger" id="total_amount_btn" style="display:none"></button>
				  
				@endif
			  @endif
		   
			</div>
			
		
		</div>
		<div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header state modal-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Reject Handover</h4>
                        </div>
                        <div class="modal-body" style="">
                            Are you sure you want perform this action.
                            <div class="row">
                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <div class="modal-footer"> <a ng-click="confirmRejectHandover()" type="button" class="btn btn-success">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
	</div>
</div>

@endsection
