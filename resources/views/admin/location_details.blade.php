@extends('layouts.admin.dashboard')

@section('content')
    <style>
        /* Card Box */
        .card-box {
            padding: 20px;
            border: 1px solid #dddddd;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            background-clip: padding-box;
            margin-bottom: 20px;
            background-color: #ffffff;
        }
        .contact-search .btn-white {
            position: absolute;
            top: 1px;
            right: 16px;
            background-color: transparent !important;
            border: none !important;
            font-size: 16px;
            box-shadow: none !important;
            outline: none !important;
            color: #98a6ad;
        }
        .contact-card {
            position: relative;
        }
        .contact-card:hover .contact-action {
            display: block;
        }
        .contact-card img {
            width: 80px;
            height: 80px;
        }
        .contact-card .member-info {
            padding-left: 100px;
        }
        .contact-card .member-info h4,
        .contact-card .member-info p {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            white-space: nowrap;
        }
        .contact-card .contact-action {
            position: absolute;
            right: 0px;
            top: 0px;
            display: none;
        }
    </style>

    <div  ng-controller="LocationController">
        <div class="col-sm-12">
        <div class="pull-left" style="padding-left:15px;">
            <div class="col-xs-12">
                <button class="btn btn-wide btn-success" data-target="#modalSlideUp" data-toggle="modal">ADD COURIER TO {{strtoupper($location[0]->location_name)}} </button>
                <button class="btn btn-wide btn-primary" data-target="#modalSlideUp1" data-toggle="modal">ADD COVERAGE AREA </button>
            </div>
        </div>

        <div class="col-sm-12" ng-init="loadCouriersInLocationsList({{$location[0]->id}})">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="panel panel-transparent clearfix">
                    <div class="panel-body clearfix">

                        <div class="col-md-12">
                            <div class="panel  b-primary bt-sm">
                                <div class="panel-header">
                                    <h5 class="panel-title">NRBxpress Branch Information</h5>
                                </div>
                                <div class="col-md-6">
                                    <strong>Branch Name</strong> {{$location[0]->location_name}}
                                </div>
                                <div class="col-md-6">
                                    <strong>Branch Name</strong> {{$location[0]->address}}
                                </div>
                                <div class="col-md-6">
                                    <strong>Contact Person</strong> {{ $location[0]->first_name }} {{ $location[0]->last_name }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Contact Number</strong> {{ $location[0]->contact_number }}
                                </div>


                            </div>
                        </div>
                        </div>
                    </div>
                <div class="panel panel-transparent clearfix">
                    <div class="panel-body clearfix">

                    <div class="col-md-12 panel  b-primary bt-sm">
                        <div class="panel-header">
                            <h5 class="panel-title">Coverage Area</h5>
                        </div>


                            @foreach($coverate_areas as $area)
                                <div class="col-md-3"> {{ $area->name }} <span style="cursor: pointer;" class="fa fa-trash text-danger" href="#" ng-click="removeArea({{ $area->upazilla_id }}, {{ $area->location_id }} )"></span></div>
                            @endforeach

                        @if(count($coverate_areas) == 0)
                            No area coverred
                        @endif
                    </div>
                        </div>
                    </div>
                        <div class="panel-header">
                            <h5 class="panel-title">Couriers</h5>
                        </div>
                        <div style="top: 10px;" class="col-sm-4" ng-repeat="courier in location_based_couriers">
                            <div class="card-box">
                                <div class="contact-card">
                                    <a class="pull-left" href="#">
                                        <img class="img-circle" src='http://www.nrbxpress.com/uploads/images/courier/picture/[[ courier.picture ]]' alt="">
                                    </a>
                                    <div class="member-info">
                                        <h4 class="m-t-0 m-b-5 header-title"><b>[[ courier.first_name ]] [[ courier.last_name ]]</b></h4>
                                        <p class="text-muted">Date of Birth: [[ courier.dob ]]</p>
                                        <p class="text-muted">Blood Group: [[ courier.blood_group ]]</p>

                                        <p class="text-dark"><i class="fa fa-envelope"></i><small> [[ courier.email ]]</small></p>
                                        <p class="text-dark"><i class="fa fa-phone"></i><small> [[ courier.contact_no_work ]]</small></p>
                                        <div class="contact-action">
                                            <a href='{{ url("dashboard/courier/") }}/[[ courier.id ]]' class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <a ng-click="removeCourierFromBranch(courier.id, {{$location[0]->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            {{--<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>--}}
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
                            <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Courier</h4>
                        </div>
                        <div class="modal-body" style="">
                            <form role="form" name="addCourierToLocationForm" novalidate>
                                {{ csrf_field() }}
                                <div class="form-group-attached">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Courier <span style="color:red">*</span></label>
                                                <select class="form-control"  name="courier_id" ng-model="location.courier_id" ng-required="true">
                                                    <option value="">Select a courier</option>
                                                    <?php
                                                    $i = 0;
                                                    ?>
                                                    @foreach($couriers as $courier)
                                                        @if(isCourierAllocated($courier->id) == 0)

                                                            <?php
                                                            $i++;
                                                            $count = isCourierInThisLocation($location[0]->id, $courier->id);
                                                            ?>
                                                            <option value="{{ $courier->id }}" data-class="avatar" data-style="background-image: url(&apos;http://www.gravatar.com/avatar/b3e04a46e85ad3e165d66f5d927eb609?d=monsterid&amp;r=g&amp;s=16&apos;);">{{ $courier->first_name }} {{ $courier->last_name }} ({{ $courier->contact_no_work }}) </option>";
                                                        @endif


                                                    @endforeach
                                                </select>
                                                @if($i == 0)
                                                    No Courier Found.
                                                @endif

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                            <div class="row">
                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    @if($i > 0)
                                        <a class="btn btn-primary btn-block m-t-5" ng-disabled="addCourierToLocationForm.$invalid" ng-click="addCourierToLocation(addCourierToLocationForm, <?php echo $location[0]->id;?>, location.courier_id)">ALLOCATE</a>
                                    @endif

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalSlideUp1" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header state modal-success">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Coverrage Area</h4>
                            </div>
                            <div class="modal-body" style="">
                                <form role="form" name="addAreaToLocationForm" novalidate>
                                    {{ csrf_field() }}
                                    <div class="form-group-attached">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group form-group-default">
                                                    <label>Area <span style="color:red">*</span></label>
                                                    <select class="form-control select2js"  name="coverage_area"   ng-model="location.area_id" ng-required="true">

                                                        <option value="">Select coverage area</option>
                                                        @foreach($areas as $area)

                                                            <?php
                                                                //$count = isAreaInThisLocation($location[0]->id, $area->id);
                                                                $count = isAreaAlloted($area->id);
                                                            ?>

                                                            @if($count == 0)
                                                                <option value="{{ $area->id }}" data-class="avatar" >{{ $area->name }}  </option>";
                                                            @endif
                                                        @endforeach
                                                    </select>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                        <a class="btn btn-primary btn-block m-t-5" ng-disabled="addAreaToLocationForm.$invalid" ng-click="addAreaToLocation(addAreaToLocationForm, <?php echo $location[0]->id;?>, location.area_id)">Add</a>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            <div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header state modal-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Courier</h4>
                        </div>
                        <div class="modal-body" style="">
                            Are you sure you want release this courier.
                            <div class="row">
                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <div class="modal-footer"> <a ng-click="confirmRemoveCourierFromBranch(courier.id, {{$location[0]->id}})" type="button" class="btn btn-success">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalSlideUp3" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header state modal-success">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Add Courier</h4>
                        </div>
                        <div class="modal-body" style="">
                            Are you sure you want release this location.
                            <div class="row">
                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <div class="modal-footer"> <a ng-click="removeAreaConfirmed(courier.id, {{$location[0]->id}})" type="button" class="btn btn-success">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
    </div>

@endsection