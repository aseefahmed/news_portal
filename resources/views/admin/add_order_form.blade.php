@extends('layouts.admin.dashboard')



@section('content')



    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="alert alert-warning m-none">
                    <h3>Add Order</h3>
                </div>
            </div>
        </div>
    </div>

    <form role="form" name="OrderRequestForm" id="OrderRequestForm" ng-controller="OrderController" ng-init="initialize()" novalidate>

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">

                    <div class="panel-content">

                        <h4 class="section-subtitle"><b>Pickup</b> Date</h4>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <span class="text-danger">*</span>

                                    Fields are mendatory.

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="email">Date & Time</label><span class="text-danger">*</span>

                                    {{--@if(isManager(Auth::user()->id) > 0)
                                        <input type="text" class="form-control default_datetimepicker" name="pickup_date" id="default_datetimepicker" ng-model="user.pickup_date"  ng-model-options="{updateOn: 'blur'}" ng-class="{submitted:isFormInvalid}" disabled>
                                    @else
                                        <input type="text" class="form-control default_datetimepicker" name="pickup_date" id="default_datetimepicker" ng-model="user.pickup_date"  ng-model-options="{updateOn: 'blur'}" ng-class="{submitted:isFormInvalid}">
                                    @endif--}}

                                    <input type="text" class="form-control default_datetimepicker" name="pickup_date" id="default_datetimepicker" ng-model="user.pickup_date"  ng-model-options="{updateOn: 'blur'}" ng-class="{submitted:isFormInvalid}" ng-required="true">
                                </div>

                            </div>

                        </div>

                    </div>

            </div>
        </div>
    </div>

        <div class="col-sm-12 col-md-6">


            <div class="panel">

                <div class="panel-content">

                    <h4 class="section-subtitle"><b>Sender</b> Information</h4>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="email">Sender Name</label><span class="text-danger">*</span>

                                <select class="form-control select2js" name="user_id"  id="user_id" ng-model="user.user_id" ng-required="true" ng-class="{submitted:isFormInvalid}">

                                    <option value="">Choose a customer</option>

                                    <option ng-repeat="user in users_list" value="[[ user.id ]]">[[ user.name | uppercase ]] ([[ user.phone ]])</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Email Address</label>

                                <input type="text" class="form-control" name="sender_email" ng-model="sender_email" ng-class="{submitted:isFormInvalid}" readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Phone</label><span class="text-danger">*</span>

                                <input type="text" class="form-control"  id="sender_phone"  name="sender_phone" ng-model="user.sender_phone" ng-required="true" ng-class="{submitted:isFormInvalid}">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="email">Address</label>

                                <input placeholder="Enter your address" class="form-control" type="text" ng-class="{submitted:isFormInvalid}"  ng-model="user.sender_address_list" list="sender_address_list" id="sender_street" ng-required="true">



                                <datalist id="sender_address_list">

                                    <option ng-repeat="address in addresses_list">[[ address.sender_street ]]</option>

                                </datalist>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">District</label><span class="text-danger">*</span>

                                <select class="form-control select2js" name="sender_district" ng-model="user.sender_district" ng-class="{submitted:isFormInvalid}" id="sender_district" ng-required="true">

                                    <option value="">Select District</option>

                                    @foreach($districts as $district)

                                        <option value="{{ $district->id }}">{{ $district->name }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Coverage Area</label><span class="text-danger">*</span>

                                <select class="form-control select2js" name="sender_upazilla"  id="sender_upazilla" ng-class="{submitted:isFormInvalid}" ng-model="user.sender_upazilla" disabled ng-required="true">

                                    <option value="">Select Coverage Area</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Post Code</label>

                                <input placeholder="Enter your post code" class="form-control autocomplete" ng-class="{submitted:isFormInvalid}" type="text" ng-model="user.sender_zipcode" name="sender_zipcode" id="sender_zipcode" ng-required="true">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Country</label>

                                <input placeholder="Enter your post code" value="Bangladesh" class="form-control autocomplete" type="text" name="sender_country" disabled name="sender_country">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-12 col-md-6">


            <div class="panel">

                <div class="panel-content">

                    <h4 class="section-subtitle"><b>Receiver</b> Information</h4>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="email">Receiver Name</label><span class="text-danger">*</span>

                                <input type="text" class="form-control" name="reciever_name" id="receiver_name" ng-model="user.reciever_name" ng-class="{submitted:isFormInvalid}"  ng-required="true">



                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Email Address</label>

                                <input type="text" class="form-control" name="receiver_email" ng-model="user.reciever_email" ng-class="{submitted:isFormInvalid}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Phone</label><span class="text-danger">*</span>

                                <input type="text" class="form-control" name="receiver_phone" ng-model="user.reciever_phone" ng-class="{submitted:isFormInvalid}" ng-required="true">

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label for="email">Address</label>

                                <input placeholder="Enter your address" class="form-control" list="receiver_address_list" ng-class="{submitted:isFormInvalid}" ng-model="user.receiver_address_list" type="text" id="receiver_street" ng-required="true">

                                <datalist id="receiver_address_list">

                                    <option ng-repeat="address in receiver_details">[[ address.reciever_street ]]</option>

                                </datalist>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">District</label><span class="text-danger">*</span>

                                <select class="form-control select2js" name="receiver_district" id="receiver_district"  ng-class="{submitted:isFormInvalid}" ng-model="user.receiver_district" ng-required="true">

                                    <option value="">Select District</option>

                                    @foreach($districts as $district)

                                        <option value="{{ $district->id }}">{{ $district->name }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Coverage Area</label><span class="text-danger">*</span>

                                <select class="form-control select2js" name="receiver_upazilla"  id="receiver_upazilla" ng-class="{submitted:isFormInvalid}" ng-model="user.receiver_upzilla" disabled ng-required="true">

                                    <option value="">Select Coverage Area</option>

                                </select>

                            </div>



                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Post Code</label>

                                <input placeholder="Enter your post code" class="form-control autocomplete" ng-class="{submitted:isFormInvalid}" type="text" ng-model="user.receiver_postcode" name="receiver_zipcode" id="receiver_zipcode" ng-required="true">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="email">Country</label>

                                <input placeholder="Enter your post code" value="Bangladesh" class="form-control autocomplete" type="text" name="receiver_country" disabled name="receiver_postcode">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-12 col-md-12">


            <div class="panel">

                <div class="panel-content">
                    <h4 class="section-subtitle"><b>Shipment</b> Information</h4>

                    <div class="row">

                        <div class="col-sm-3">

                            <div class="form-group form-group-default">

                                <label>Package Type<span style="color:red">*</span></label>

                                <select class="form-control select2js" name="doc_type" id="doc_type" ng-model="doc_type" ng-required="true" ng-class="{submitted:isFormInvalid}">

                                    <option value="">Choose Option</option>

                                    <option value="document">Document</option>

                                    <option value="parcel">Percel</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group form-group-default">

                                <label>Shipment Purpose</label>

                                <select class="form-control select2js" name="shipment_purpose" ng-model="user.type" id="shipment_purpose">

                                    <option value="">Chose option</option>

                                    @foreach($shipment_purposes as $shipment_purpose)

                                        <option value="{{ $shipment_purpose->purpose }}">{{ $shipment_purpose->purpose }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group form-group-default">

                                <label>Payment Type<span style="color:red">*</span></label>

                                <select class="form-control select2js" name="payment_method" id="payment_method" ng-model="payment_method" ng-required="true" ng-class="{submitted:isFormInvalid}">

                                    <option value="">Chose option</option>

                                    <option value="Cash on Delivery">Cash on Delivery</option>

                                    <option value="Cash on Pickup">Cash on Pickup</option>
                                    <option value="Credit">Credit</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group form-group-default">

                                <label>Delivery Type<span style="color:red">*</span></label>

                                <select class="form-control select2js" name="delivery_type" id="delivery_type" ng-model="delivery_type" ng-required="true" ng-class="{submitted:isFormInvalid}">

                                    <option value="">Chose option</option>

                                    <option value="Self Pickup">Self Pickup</option>

                                    <option value="Door-to-Door">Door-to-Door</option>

                                </select>

                            </div>

                        </div>

                        <div class="row" style="margin: 10px;">

                            &nbsp;

                        </div>



                        <style>

                            fieldset.scheduler-border {
                                border: 1px groove black !important;
                                padding: 0 1.4em 1.4em 1.4em !important;
                                margin: 0 0 1.5em 0 !important;
                                -webkit-box-shadow:  0px 0px 0px 0px #000;
                                box-shadow:  0px 0px 0px 0px green;
                            }

                            legend.scheduler-border {
                                font-size: 1.2em !important;
                                font-weight: bold !important;
                                text-align: left !important;

                            }
                        </style>
                        <fieldset class="scheduler-border" id="fieldset_div" style="display: none;">
                            <legend class="scheduler-border">Product Information</legend>
                            <div class="control-group">
                                <div class="col-sm-3">

                                    <div class="form-group form-group-default" style="margin-left:15px;">

                                        <label>Item Name</label>



                                        <input style="display:none" type="text" id="parcel_item_input" class="form-control" name="item" ng-model="user.item">

                                        <select class="form-control"  id="doc_item_input" name="item" ng-model="user.item">

                                            <option value="">Choose Option</option>

                                            @foreach($doc_types as $doc_type)

                                                <option value="{{ $doc_type->doc_type }}">{{ $doc_type->doc_type }}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-4" style="display:none;" id="other_div">

                                    <div class="form-group form-group-default">

                                        <label>Other</label>

                                        <input type="text" class="form-control"  name="item" ng-model="user.other_item">

                                    </div>

                                </div>

                                <input type="hidden" name="item_details" id="item_details">
                                <div class="col-sm-3" style="display: none;" id="sku_idv">

                                    <div class="form-group form-group-default">



                                        <div class="col-sm-12">

                                            <label>SKU</label>

                                            <input type="text" class="form-control" name="sku" id="sku">

                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-2">

                                    <div class="form-group form-group-default">

                                        <div class="col-sm-12">

                                            <label>Qty</label>

                                            <input type="number" value="1" min="1" class="form-control calculate_subtotal" name="qty" id="qty">

                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-2" style="display: none;" id="item_price_div">

                                    <div class="form-group form-group-default">

                                        <div class="col-sm-12">

                                            <label>Unit Price</label>

                                            <input type="number" value="1" min="1" class="form-control calculate_subtotal" name="item_price" id="item_price">

                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-2" style="display: none;" id="discount_div">

                                    <div class="form-group form-group-default">



                                        <div class="col-sm-12">

                                            <label>Discount</label>

                                            <input type="text" class="form-control calculate_subtotal" name="discount" id="discount">

                                        </div>

                                    </div>

                                </div>
                                <div class="col-sm-2" style="display: none;" id="subtotal_div" style="margin-top:15px;">

                                    <div class="form-group form-group-default" >



                                        <div class="col-sm-12">

                                            <label>Subtotal</label>

                                            <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>

                                        </div>

                                    </div>

                                </div>
                                {{--<div class="col-sm-2">

                                    <div class="form-group form-group-default">



                                        <div class="col-sm-12">

                                            <label>Shipping Cost</label>

                                            <input type="text" class="form-control" name="shipping_cost" id="shipping_cost">

                                        </div>

                                    </div>

                                </div>--}}
                                {{--<div class="col-sm-2">

                                    <div class="form-group form-group-default">



                                        <div class="col-sm-12">

                                            <label>Total Cost</label>

                                            <input type="text" class="form-control" name="total_cost" id="total_cost">

                                        </div>

                                    </div>

                                </div>--}}

                                <div class="col-sm-2">

                                    <div class="form-group form-group-default">

                                        <label>Weight [Up to 10kg]</label>

                                        <input type="number" max="10" min="0.5" step="0.5" class="form-control parcel_element" disabled name="weight" ng-model="user.weight" id="weight">

                                    </div>

                                </div>
                                <div class="col-sm-12">

                                    <div class="form-group form-group-default">

                                        &nbsp;
                                    </div>

                                </div>
                                <div class="col-sm-2">

                                    <div class="form-group form-group-default" style="margin-left:15px;">

                                        <label>Height</label>

                                        <input type="number"  step="0.5" class="form-control" name="weight"  id="prod_height">

                                    </div>

                                </div>
                                <div class="col-sm-2">

                                    <div class="form-group form-group-default">

                                        <label>Width</label>

                                        <input type="number"  step="0.5" class="form-control" name="weight" id="prod_width">

                                    </div>

                                </div>
                                <div class="col-sm-2">

                                    <div class="form-group form-group-default">

                                        <label>length</label>

                                        <input type="number"  class="form-control" name="weight"  id="prod_length">

                                    </div>

                                </div>
                            </div>
                        </fieldset>


                        {{--<div class="col-sm-2">

                            <div class="form-group form-group-default">

                                <label>Length</label>

                                <input type="text" class="form-control parcel_element" disabled name="length" ng-model="user.length">

                            </div>

                        </div>

                        <div class="col-sm-2">

                            <div class="form-group form-group-default">

                                <label>Width</label>

                                <input type="text" class="form-control parcel_element" disabled name="width" ng-model="user.width">

                            </div>

                        </div>

                        <div class="col-sm-2">

                            <div class="form-group form-group-default">

                                <label>Height</label>

                                <input type="text" class="form-control parcel_element" disabled name="height" ng-model="user.height">

                            </div>

                        </div>--}}
                        <style>
                            tr:nth-child(odd) {
                                background-color: darkgreen;
                                color: white;
                            }
                            tr:nth-child(even) {
                                background-color: royalblue;
                                color: white;
                            }
                        </style>
                        <div class="row col-sm-12 clearfix" style="margin-top: 10px; margin-left: 10px;">
                            <table class="table table-responsive col-sm-12" width="100%" id="items_table" style=" display: none">
                                <thead>
                                <tr class="info">
                                    <th>Item</th>
                                    <th>SKU</th>
                                    <th>Qty</th>
                                    <th>Weight</th>
                                    <th>Item Price (TK.)</th>
                                    <th>Discount</th>
                                    <th>Sub Total</th>
                                </tr>
                                </thead>
                                <tbody id="items_table_tr">

                                </tbody>
                                <tbody id="shipment_cost_div" style="display: none">
                                <tr>
                                    <td>
                                        Shipping Cost <input type="text" class="form-control" name="shipping_amount" id="shipping_amount">
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="row clear">



                            <div class="col-sm-12" style="margin-top: 10px;">

                                <div class="form-group form-group-default col-sm-2">

                                    {{--<a class="btn btn-danger btn-block m-t-5" ng-click="addItem(OrderRequestForm)">Add Item</a>--}}
                                    <a class="btn btn-danger btn-block m-t-5" id="add_item_btn" ng-click="addNewItem()">Add Item</a>

                                </div>

                                <div class="col-sm-12">

                                    <strong class="text-danger" ng-cloak>

                                        [[ msg ]]

                                    </strong>

                                    <div class="row" ng-if="items.length > 0" ng-cloak>

                                        <div class="col-sm-4">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Item </label>

                                            </div>

                                        </div>

                                        <div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Qty </label>

                                            </div>

                                        </div>

                                        {{--<div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Type </label>

                                            </div>

                                        </div>--}}

                                        <div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Weight </label>

                                            </div>

                                        </div>

                                        {{--<div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Length </label>

                                            </div>

                                        </div>

                                        <div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Width </label>

                                            </div>

                                        </div>

                                        <div class="col-sm-2">

                                            <div style="background-color: #0479cc; color: white" class="text-center form-group-default">

                                                <label>Height </label>

                                            </div>

                                        </div>--}}

                                    </div>

                                    {{--<div class="row" ng-if="items.length > 0"  ng-repeat="item in items"% item[0] ]]

                                        <div ng-if="item[0]">

                                            <div class="col-sm-4">

                                                <div class="form-group form-group-default" ng-cloak>

                                                    <label><a ng-click="deleteItem($index, item[2], item[3])"><i class="fa fa-trash"></i></a> [[ item[0] ]] </label>

                                                </div>

                                            </div>

                                            --}}{{--<div class="col-sm-2">

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[1] ]] </label>

                                                </div>

                                            </div>--}}{{--

                                            --}}{{--<div class="col-sm-2" ng-cloak>

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[3] ]] </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-2" ng-cloak>

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[2] ]] </label>

                                                </div>

                                            </div>--}}{{--

                                            --}}{{--<div class="col-sm-2">

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[3] ]] </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-2">

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[4] ]] </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-2">

                                                <div class="form-group form-group-default">

                                                    <label> [[ item[5] ]] </label>

                                                </div>

                                            </div>--}}{{--

                                        </div>

                                    </div>--}}



                                    <div id="doc_div" class="row col-sm-4" style="display: none;">

                                        <h3>Price<span style="color:red">*</span>: <input ng-required="true" type="radio" class="price" value="[[ total_price ]]" name="price" >[[ total_price ]]</h3>

                                    </div>

                                    <div id="parcel_div">

                                        <div ng-if="prices.length > 0">

                                            {{--<div class="row">

                                                <div class="col-sm-2">

                                                    <kbd>total_weight</kbd>

                                                </div>

                                                <div class="col-sm-2">

                                                    <kbd>[[ total_weight ]]</kbd>

                                                </div>

                                            </div>--}}

                                            <div class="col-sm-2" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> Delivery Type </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 1HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 2HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 3HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 4HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 5-8HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 8HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 12HR </label>

                                                </div>

                                            </div>


                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 24HR </label>

                                                </div>

                                            </div>

                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 24-48HR </label>

                                                </div>

                                            </div>
                                            <div class="col-sm-1" ng-cloak>

                                                <div style="background-color: #0a0a0a; color: white" class="form-group form-group-default">

                                                    <label> 72-120HR </label>

                                                </div>

                                            </div>

                                            <div ng-repeat="price in prices">

                                                <div ng-if="price.delivery_type == 'express'" class="col-sm-12">

                                                    <div class="col-sm-2" ng-cloak>

                                                        <label> [[ price.delivery_type | uppercase ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" ng-required="true"  name="price"value="8_[[ price.hr8 ]]"  type="radio">  [[ price.hr8 ]]</label>

                                                    </div>



                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" ng-required="true"  name="price" value="12_[[ price.hr12 ]]"  type="radio">  [[ price.hr12 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>  -</label>

                                                    </div>

                                                </div>



                                            </div>



                                            <div ng-repeat="price in prices">

                                                <div ng-if="price.delivery_type == 'regular'" class="col-sm-12">

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> [[ price.delivery_type | uppercase ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label> -</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>



                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="24_[[ price.hr24 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr24 ]]</label>
                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="48_[[ price.hr48 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr48 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="120_[[ price.hr120 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr120 ]]</label>

                                                    </div>

                                                </div>



                                            </div>

                                            <div ng-repeat="price in prices">

                                                <div ng-if="price.delivery_type == 'tdd'" class="col-sm-12">

                                                    <div class="col-sm-2" ng-cloak>

                                                        <label> [[ price.delivery_type | uppercase ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="1_[[ price.hr1 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr1 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="2_[[ price.hr2 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr2 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="3_[[ price.hr3 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr3 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="4_[[ price.hr4 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr4 ]]</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label><input class="price" value="5_[[ price.hr5 ]]" ng-required="true" name="price"  type="radio">  [[ price.hr5 ]]</label>

                                                    </div>



                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                    <div class="col-sm-1" ng-cloak>

                                                        <label>-</label>

                                                    </div>

                                                </div>



                                            </div>

                                        </div>

                                    </div>



                                    <div class="row" ng-show="isFormInvalid == true">

                                        <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right text-danger">

                                            * fields are required.

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-12 text-right" style="padding: 30px;">

                                            <button class="btn btn-primary" data-ng-disabled="OrderRequestForm.price" ng-click="addOrder(OrderRequestForm)">Create Order</button>

                                        </div>

                                    </div>

                                </div>



                            </div>



                        </div>



                    </div>

                </div>

            </div>



    </form>

@endsection