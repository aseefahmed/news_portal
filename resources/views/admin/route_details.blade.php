@extends('layouts.admin.dashboard')

@section('content')
    <div class="pull-left" style="padding-left:15px;">
        <div class="col-xs-12">
            <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD SHIPPING RATE</button>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="panel-body clearfix">
                    <table class="table table-hover demo-table-dynamic table-responsive-block" id="tableWithDynamicRows">
                        <thead>
                        <tr>
                            <th class="text-danger"><strong>From:</strong> {{$route[0]->sender_dist}} </th>
                            <th class="text-danger"><strong>To:</strong> {{$route[0]->receiver_dist}} </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="panel">
                        <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="collapse">
                            @foreach($packages as $key=>$package)
								@if($key == 0)
									<li class="active"><a href="#{{ $package->label }}_price" data-toggle="tab" role="tab">{{ $package->package_name }}</a></li>
								@else 
									<li><a href="#{{ $package->label }}_price" data-toggle="tab" role="tab">{{ $package->package_name }}</a></li>
								@endif
								
								<!--li><a href="#express_price" data-toggle="tab" role="tab">Express</a></li>
								<li><a href="#tdd_price" data-toggle="tab" role="tab">Time Definite Delivery(TDD)</a></li-->
							@endforeach
                        </ul>

                        <div class="table-responsive">
                            <div class="tab-content">
                                @foreach($packages as $package)
									<div class="tab-pane active" id="{{ $package->label }}_price">
										<table class="table table-striped table-hover">
											<thead>
											<tr>
												@foreach(findPackageHours($package->label) as $hour)
													<th>{{ $hour->hours }}Hrs</th>
												@endforeach
												
											</tr>
											</thead>
											<tbody>
											@foreach($packages as $package)
												<?php 
													echo $count = countTotalRates($package->label)
												?>
												@foreach(findPackageRates($package->label) as $rate)
													<td>{{ $rate->weight }} Kg</td>
												@endforeach
											@endforeach
											<?php
											$tdd_count = 0;
											?>
											
											</tbody>
										</table>
									</div>
								@endforeach
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade stick-up" id="modalSlid212eUp" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                            </button>
                            <h5>Route <span class="semi-bold">INFORMATION</span></h5>
                            <p class="p-b-10">We need client information inorder to process the order</p>
                        </div>
                        <div class="modal-body">
                                <div class="form-group-attached">
                                    <div class="row">

                                     </div>
                                </div>

                            <div class="row">
                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <a class="btn btn-primary btn-block m-t-5" >ADD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <div class="modal fade" id="modalSlideUp" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-success-label"><i class="fa fa-truck"></i>Add Shipping Rate</h4>
                </div>
                <div class="modal-body">
                    <form role="form"  name="addPriceChart" id="addPriceChart"  novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="route_id" id="route_id" route="{{$route[0]->id}}" value="{{$route[0]->id}}">
                        <div class="form-group-attached">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Delivery Type <span style="color:red">*</span></label>
                                        <select class="form-control"  name="delivery_type"   id="delivery_type" ng-model="location.courier_id" ng-required="true">
                                            <option value="">Select Delivery Type</option>
                                            @foreach($packages as $package)
												<option value="{{ $package->label }}">{{ $package->package_name }}</option>
											@endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display:none;" id="express">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>8Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr8">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>12Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display:none;" id="regular">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>24Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr24">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>24Hr to 48Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr48">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>72Hr to 120Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr120">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="display:none;" id="tdd">
                                    <!-- <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>1Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr1">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>2Hrs<span style="color:red">*</span></label>
                                            <input type="text" name="hr2">
                                        </div>
                                    </div> -->
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>3Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr3">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>4Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr4">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>5-7Hr<span style="color:red">*</span></label>
                                            <input type="text" name="hr7">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default">
                                            <label>Weight in Kg.<span style="color:red">*</span></label>
                                            <input type="text" name="weight">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-success" id="btn-add-price-chart">Ok</a>
                    <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>

            </div>
        </div>
    </div>

    </div>


@endsection