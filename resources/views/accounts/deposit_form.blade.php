@extends('layouts.admin.dashboard')

@section('content')
	@if(Auth::user()->role != 12)
		<div class="pull-left" style="padding-left:15px;">
			<div class="col-xs-12">
				<button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">Make Deposit</button>
			</div>
		</div>
	@endif
    <div class="col-sm-12" ng-controller="OrderController">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body clearfix table-responsive">
					<div class="col-md-3">
						@if($accounts->currentPage() > 1)
							<a href="{{ url( $accounts->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
						@else 
							<a class="btn btn-warning" disabled><< Prev</a>
						@endif
							
					</div>
					<div class="col-md-6">
					{{ $accounts->links() }}
					</div>
					<div class="col-md-3 text-right">
						@if($accounts->currentPage() < $accounts->lastPage())
							<a href="{{ url( $accounts->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
						@else 
							<a class="btn btn-warning" disabled>Next >></a>
						@endif
					</div>
                    <table class="table table-hover demo-table-dynamic table-responsive-block responsive-table">
                        <thead>
                        <tr>
                            <th>Received By</th>
                            <th>Bank </th>
                            <th>Acc No </th>
                            <th>Ref </th>
                            <th>Amount </th>
                            <th>Accepted </th>
                            <th  class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
							@foreach($accounts as $key=>$account)
								<tr>
									<th>
										@if($account->cash_receiver == 0)
											---
										@else 
											{{findEmployeeDetails($account->cash_receiver)[0]->first_name}} 
											{{findEmployeeDetails($account->cash_receiver)[0]->last_name}} 
										@endif
									</th>
									<th>
										@if($account->cash_receiver == 0)
											{{$account->bank}}
										@else  
											--- 
										@endif
									</th>
									<th>
										@if($account->cash_receiver == 0)
											{{$account->acc_no}}
										@else  
											--- 
										@endif
									</th>
									<th>{{$account->ref}} </th>
									<th>{{$account->amount}} </th>
									<th>
										@if($account->is_accepted == 1)
											<img src="https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678134-sign-check-128.png" height="40px">
										@elseif($account->is_accepted == 0)
											<img src="https://cdn3.iconfinder.com/data/icons/tango-icon-library/48/help-browser-128.png" height="40px">
										@elseif($account->is_accepted == 2)
											<img src="https://cdn3.iconfinder.com/data/icons/fugue/bonus/icons-32/cross-circle.png" height="40px">
										@endif
									</th>
									<th class=" text-right">
										<a href="http://www.nrbxpress.com/uploads/bank_receipts/{{ $account->receipt }}" target="_blank" class="btn btn-primary">Download</a>
										@if(Auth::user()->role == 12)
											<a  class="btn btn-success" ng-click="acceptAmount({{$account->id}})">Accept</a>
											<a  class="btn btn-danger" ng-click="denyAmount({{$account->id}})">Deny</a>
										@endif
									</th>
								</tr>
							@endforeach
                        </tbody>
                    </table>
					<div class="col-md-3">
						@if($accounts->currentPage() > 1)
							<a href="{{ url( $accounts->previousPageUrl()) }}" class="btn btn-primary"><< Prev</a>
						@else 
							<a class="btn btn-warning" disabled><< Prev</a>
						@endif
							
					</div>
					<div class="col-md-6">
					{{ $accounts->links() }}
					</div>
					<div class="col-md-3 text-right">
						@if($accounts->currentPage() < $accounts->lastPage())
							<a href="{{ url( $accounts->nextPageUrl()) }}" class="btn btn-primary">Next >></a>
						@else 
							<a class="btn btn-warning" disabled>Next >></a>
						@endif
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
													<strong>Payment Method</strong> <span style="color:red">*</span></label> 
													<input type="radio" id="radioCustom3" name="payment_method" value="bank" ng-click="getPaymentMethod('bank')" checked>
													<label for="radioCustom3">Bank</label>
													<input type="radio" id="radioCustom31" name="payment_method" value="cash" ng-click="getPaymentMethod('cash')">
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
                        <a type="button" class="btn btn-success"  ng-click="confirmAcceptAmount(1)">Ok</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>
		
		<div class="modal fade" id="modalSlideUp3" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header state modal-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-success-label"><i class="fa fa-anchor"></i>Deny Amount</h4>
                    </div>
                    <div class="modal-body">
                        Do you really want to perform this action?
                    </div>

                    <div class="modal-footer">
						<div id="ajax_loading" style="display: none">
							<img src="{{ asset('public/img/squares.gif') }}" height="40px">
						</div>
                        <a type="button" class="btn btn-success"  ng-click="confirmAcceptAmount(2)">Ok</a>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>
        </div>


    </div>
    </div>



@endsection