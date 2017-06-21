@extends('layouts.admin.dashboard')

@section('content')

    <div class="row">
      <div class="col-md-12 success_div" style="display: none;">
        <div class="alert alert-success fade in"> <strong>Success!</strong> You have add a user. </div>
      </div>
    </div>
   <div class="pull-left" style="padding-left:15px;">
      <div class="col-xs-12">
        <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD COMPLAIN</button>
      </div>
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
                            <th>Order Ref</th>
                            <th>Customer</th>
                            <th>Details</th>
                            <th class="text-right">Resolved?</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($complains as $key=>$complain)
                          <tr>
                              <td><a href="{{ url('dashboard/order/'.$complain->order_id) }}" target="_blank">{{ $complain->order_id }}</a></td>
                              <td>{{ findCustomerDetails($complain->user_id)[0]->name }}</td>
                              <td>{{ $complain->details }}</td>
                              <td class="text-right">
                                <div class="checkbox-custom checkbox-primary">
                                    <input ng-click="resolveComplain({{ $complain->id }})" type="checkbox" id="check-h2_{{ $complain->id }}" <?php if($complain->flag == '1'){echo "checked";} ?>>
                                    <label class="check" for="check-h2_{{ $complain->id }}"></label>
                                </div>

                              </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSlideUp" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header state modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Complain</h4>
        </div>
        <div class="modal-body">
          <form role="form" name="addComplainForm" id="addComplainForm" novalidate>
            {{ csrf_field() }}
            <div class="form-group-attached">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Customer <span style="color:red">*</span></label>
                    <select class="form-control select2js col-sm-12" name="complain_customer_id"  id="complain_customer_id" style="width: 400px" ng-required="true">
                    <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group form-group-default">
                    <label>Order Ref: &nbsp;</label>
                    <select class="form-control select2js col-sm-12" id="customer_order_ref"  name="customer_order_ref" disabled  style="width: 400px" ng-required="true">
                        
                    </select>
                  </div>
                  <div class="form-group form-group-default">
                    <label>Details: &nbsp;</label>
                    <textarea class="form-control" name="complain_details" ng-required="true"></textarea>
                  </div>
                </div>
                
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer"> <a type="button" class="btn btn-success" id="complain_submit_btn">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>
      </div>
    </div>
  </div>
@endsection