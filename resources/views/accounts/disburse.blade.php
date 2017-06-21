@extends('layouts.admin.dashboard')

@section('content')
<div ng-controller="OrderController">
	
    <div class="col-sm-12" ng-controller="OrderController">
        <div class="container-fluid padding-25 sm-padding-10">
			<div class="table-responsive">
				<div class="tabs">
					<ul class="nav nav-tabs">
							<li class="active"><a href="#home" data-toggle="tab">Need to Disburse</a></li>
							<li><a href="#profile" data-toggle="tab">Already Disbursed</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="home">
						
							<div class="pull-left">
								<div class="col-xs-12">
									<button class="btn btn-wide btn-success" ng-click="disburseAmount()">Disburse</button>
								</div>
							</div>
							<table class="table table-hover demo-table-dynamic table-responsive-block responsive-table">
								<thead>
								<tr>
									<th>Customer</th>
									<th>Order ID</th>
									<th>Customer Receivable Amount </th>
									<th>Amount Received (NRBXpress) </th>
									<th>Action</th>
								</tr>
								</thead>
								<?php 
									$i = 0;
									$j = 0;
								?>
								<tbody>
									@foreach($customers as $key=>$customer)
										@if($customer->customer_receivable_status == '1')
											<?php 
												$i++;
											?>
											<tr>
												<td>
													<?php
														if(isset(findCustomerDetails($customer->user_id)[0]))
															echo findCustomerDetails($customer->user_id)[0]->name ;
														else 
															echo "N/A";
													?>
												</td>
												<td>{{ $customer->id }}</td>
												<td>{{ $customer->customer_receivable}} Taka</td>
												<td>{{ $customer->price }} Taka</td>
												<td>
													<div class="checkbox-custom checkbox-primary">
														
															<input type="checkbox" order_id="{{ $customer->id }}" id="mycheck_{{ $key}}" class="checkboxclass">
															<label class="check" for="mycheck_{{ $key }}"></label>
														
													</div>
												</td>
											</tr>
										@endif
									@endforeach
									@if($i==0)
										<tr><td>No data available</td></tr>
									@endif
								</tbody>
							</table>
							
						</div>
						<div class="tab-pane fade" id="profile">
							<table class="table table-hover demo-table-dynamic table-responsive-block responsive-table">
								<thead>
								<tr>
									<th>Customer</th>
									<th>Order ID</th>
									<th>Customer Receivable Amount </th>
									<th>Amount Received (NRBXpress) </th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
									@foreach($customers as $key=>$customer)
										@if($customer->customer_receivable_status == '2')
											<?php 
												$j++;
											?>
											<tr>
												<td>
													<?php
														if(isset(findCustomerDetails($customer->user_id)[0]))
															echo findCustomerDetails($customer->user_id)[0]->name ;
														else 
															echo "N/A";
													?>
												</td>
												<td>{{ $customer->id }}</td>
												<td>{{ $customer->customer_receivable}} Taka</td>
												<td>{{ $customer->price }} Taka</td>
												<td>
													<div class="checkbox-custom checkbox-primary">
														
															<input type="checkbox" order_id="{{ $customer->id }}" id="mycheck_{{ $key}}" class="checkboxclass">
															<label class="check" for="mycheck_{{ $key }}"></label>
														
													</div>
												</td>
											</tr>
										@endif
									@endforeach
									@if($j==0)
										<tr><td>No data available</td></tr>
									@endif
								</tbody>
							</table>
						</div>
						
					</div>
				</div>

		   
			</div>
		
			@if(Auth::user()->role != 12)
			<div class="modal fade" id="modalSlideUp" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header state modal-success">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modal-success-label"><i class="fa fa-anchor"></i>Deposit Details</h4>
						</div>
						<div class="modal-body">
							<form role="form" name="myform" id="myform" novalidate>
								{{ csrf_field() }}
								<div class="form-group-attached">

									<div class="row">
										<div class="col-sm-12">

											<div class="form-group form-group-default">
												
												<div class="radio radio-custom radio-success">
													<strong>Payment Method</strong> <span style="color:red">*</span></label> <input type="radio" id="radioCustom3" name="payment_method" value="option3" ng-click="getPaymentMethod('bank')" checked>
													<label for="radioCustom3">Bank</label>
													<input type="radio" id="radioCustom31" name="payment_method" value="option3" ng-click="getPaymentMethod('cash')" checked>
													<label for="radioCustom31">Cash</label>
												</div>
											</div>
										</div>
										<div class="col-sm-10 cash_div" style="display:none">
											<div class="form-group form-group-default">
												<label>Receiver <span style="color:red">*</span></label>
												<select name="cash_receiver" class="select2js" style="width:100%">
													@foreach($employees as $emp)
														<option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
													@endforeach
												
												</select>
											</div>
										</div>
										<div class="col-sm-5 bank_div">
											<div class="form-group form-group-default">
												<label>Bank <span style="color:red">*</span></label>
												<input type="text" class="form-control" name="bank">
											</div>
										</div>
										<div class="col-sm-5 bank_div">
											<div class="form-group form-group-default">
												<label>Acc No: <span style="color:red">*</span></label>
												<input type="text" class="form-control" name="account">
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group form-group-default">
												<label>Amount: <span style="color:red">*</span></label>
												<input type="number" class="form-control" name="amount">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group form-group-default">
												<label>Ref: <span style="color:red">*</span></label>
												<input type="text" class="form-control" name="ref">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group form-group-default">
												<label>Orders: <span style="color:red">*</span></label>
												<select class="form-control select2js" style="width: 100%" name="orders[]" multiple id="orders">
													@foreach($orders as $order)
														<option>{{ $order->id }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group form-group-default">
												<label>Receipt: <span style="color:red">*</span></label>
												<input type="file" class="form-control fileinput" name="receipt">
											</div>
										</div>

									</div>
								</div>
							</form>
						</div>

						<div class="modal-footer">
							<div id="ajax_loading" style="display: none">
								<img src="{{ asset('public/img/squares.gif') }}" height="40px">
							</div>
							<a type="button" class="btn btn-success"  id="generate_deposit_btn">Ok</a>
							<a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
						</div>

					</div>
				</div>
			</div>
			</div>
			@endif
        </div>
		
		
		<div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-anchor"></i>Accept Amount</h4>
                    </div>
                    <div class="modal-body">
                        Do you really want to perform this action?
                    </div>

                    <div class="modal-footer">
						<div id="ajax_loading" style="display: none">
							<img src="{{ asset('public/img/squares.gif') }}" height="40px">
						</div>
                        <a type="button" class="btn btn-success"  ng-click="confirmAcceptAmount()">Ok</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>
        </div>


    </div>
    </div>

</div>

@endsection