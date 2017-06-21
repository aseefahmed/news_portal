@extends('layouts.admin.dashboard')

@section('content')
    <style>
        .img1 {
            border: 1px solid darkgreen;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
            border-radius: 50%;
        }

        .img1:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>
    <div class="pull-left">
        <div class="col-xs-12">
            <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-wide btn-success" >ADD COURIER</a>
            <a href="{{ url('dashboard/courier/edit/'.$courier[0]->id) }}" class="btn btn-wide btn-info" >Edit</a>
            <a href="{{ url('password/change/'.$courier[0]->id) }}" class="btn btn-wide btn-danger" >Change Password</a>
        </div>
    </div>
    <div class="col-sm-12" ng-controller="CourierController">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <form role="form" name="CourierRequestForm" id="CourierRequestForm" novalidate>

                    <div class="col-sm-12">
                        <div class="row">


                            <h3 class="text text-success">Personal Information</h3>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label class="code">First Name </label><br>
                                    {{ $courier[0]->first_name }}
                                    <br><label class="code">Father's Name</label><br>
                                    @if($courier[0]->father_name )
                                        {{ $courier[0]->father_name }}
                                    @else
                                        Not Mentioned
                                    @endif
                                    <br><label class="code">Date of Birth</label><br>
                                    @if($courier[0]->dob )
                                        {{ $courier[0]->dob }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label class="code">Last Name </label><br>
                                    {{ $courier[0]->last_name }}
                                    <br><label class="code">Mother's Name</label><br>
                                    @if($courier[0]->mother_name )
                                        {{ $courier[0]->mother_name }}
                                    @else
                                        Not Mentioned
                                    @endif
                                    <br><label class="code">Religion</label><br>
                                    @if($courier[0]->religion )
                                        {{ $courier[0]->religion }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group form-group-default">

                                    @if($courier[0]->picture != '')
                                        <img class="img1" src="http://www.nrbxpress.com/uploads/images/courier/picture/{{ $courier[0]->picture }}" height="150px;">
                                    @else
                                        <img class="img1" src="https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-11-2-128.png" height="150px;">
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label class="code">Email</label><br>
                                    @if($courier[0]->email )
                                        {{ $courier[0]->email }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label class="code">Nationality</label><br>
                                    @if($courier[0]->nationality )
                                        {{ $courier[0]->nationality }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label class="code">National ID Number</label><br>
                                    @if($courier[0]->national_id_number )
                                        {{ $courier[0]->national_id_number }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4" id="locationField">
                                <div class="form-group form-group-default">
                                    <label class="code">Blood Group</label><br>
                                    @if($courier[0]->blood_group )
                                        {{ $courier[0]->blood_group }}
                                    @else
                                        Not Mentioned
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-4" id="locationField">
                                <div class="form-group form-group-default">
                                    <label class="code">Gender</label><br>
                                    @if($courier[0]->gender )
                                        {{ $courier[0]->gender }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4" id="locationField">
                                <div class="form-group form-group-default">
                                    <label class="code">Maritial Status</label><br>
                                    @if($courier[0]->maritial_status )
                                        {{ $courier[0]->maritial_status }}
                                    @else
                                        Not Mentioned
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="row" id="test2">
                                <h3 class="text text-success">Present Address</h3>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        @if($courier[0]->present_address )
                                            {{ $courier[0]->present_address }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </div>
                                </div>
                                {{--<div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">Town</label><br>
                                        <input type="text" class="form-control" value="{{ $present_address['town']}}" name="present_address[town]" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">District</label><br>
                                        <input type="text" class="form-control" value="{{ $present_address['district']}}" name="present_address[district]" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">Post Code</label><br>
                                        <input type="text" class="form-control"  value="{{ $present_address['post_code']}}"name="present_address[post_code]" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">Country</label><br>
                                        <input type="text" class="form-control" value="{{ $present_address['country']}}" name="present_address[country]">
                                    </div>
                                </div>--}}
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <h3 class="text text-success">Permanent Address</h3>
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        @if($courier[0]->permanent_address )
                                            {{ $courier[0]->permanent_address }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </div>
                                </div>
                                {{--<div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">Post Office</label><br>
                                        <input type="text" class="form-control" value="{{ $permanent_address['post_office']}}" name="permanent_address[post_office]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">Village</label><br>
                                        <input type="text" class="form-control" value="{{ $permanent_address['village']}}" name="permanent_address[village]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-group-default">
                                        <label class="code">District</label><br>
                                        <input type="text" class="form-control" value="{{ $permanent_address['district']}}" name="permanent_address[district]">
                                    </div>
                                </div>--}}
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <h3 class="text text-success">Contact Number</h3>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label class="code">Home </label><br>
                                        @if($courier[0]->contact_no_home )
                                            {{ $courier[0]->contact_no_home }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label class="code">Work </label><br>
                                        @if($courier[0]->contact_no_work )
                                            {{ $courier[0]->contact_no_work }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-group-default">
                                        <label class="code">Other</label><br>
                                        @if($courier[0]->contact_no_other )
                                            {{ $courier[0]->contact_no_other }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">

                            <div class="row" id="test2">
                                <h3 class="text text-success">References</h3>
                                <div class="col-sm-12">
                                    <div>
                                        <?php
                                        $references = $courier[0]->references;
                                        $references = explode(",",$references);

                                        $arr = Array();


                                        $experiences = $courier[0]->experiences;
                                        $experiences = explode(",",$experiences);

                                        $arr1 = Array();

                                        ?>
                                        @if(count($references) > 1)
                                            <div class="col-sm-2 text-danger">Name</div>
                                            <div class="col-sm-2 text-danger">Company</div>
                                            <div class="col-sm-2 text-danger">Designation</div>
                                            <div class="col-sm-2 text-danger">Email</div>
                                            <div class="col-sm-2 text-danger">Phone</div>
                                            <div class="col-sm-2 text-danger">&nbsp;</div>
                                            @foreach($references as $key=>$ref)
                                                @if($key%5 == 4)

                                                    <div class="col-sm-4">{{ $ref }}</div>
                                                @else
                                                    <div class="col-sm-2">{{ $ref }}</div>

                                                @endif
                                            @endforeach


                                        @else
                                            <div class="col-sm-12 text-danger">No Data Found</div>
                                        @endif
                                    </div>
                                    <!--button class="btn btn-danger" data-target="#modalSlideUp" data-toggle="modal">ADD Reference</button-->
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="experiences" name="experiences">
                        <div class="col-sm-12">
                            <div class="row" id="test2">
                                <h3 class="text text-success">Experiences</h3>
                                <div class="col-sm-12">
                                    <div>
                                        @if(count($experiences) >1 )
                                            <div class="col-sm-3 text-danger">Company</div>
                                            <div class="col-sm-3 text-danger">Designatino</div>
                                            <div class="col-sm-3 text-danger">Start Date</div>
                                            <div class="col-sm-3 text-danger">End Date</div>
                                            @foreach($experiences as $key=>$ref)

                                                <div class="col-sm-3">{{ $ref }}</div>

                                            @endforeach



                                        @else
                                            <div class="col-sm-12 text-danger">No Data Found</div>
                                        @endif
                                    </div>
                                    <!--button class="btn btn-danger" data-target="#modalSlideUpExperience" data-toggle="modal">ADD Experience</button-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text text-success">Attach Documents</h3>

                            <div class="col-sm-3">
                                <div class="form-group form-group-default">
                                    <label class="code">Birth Certificate</label><br>
                                    @if($courier[0]->dob_doc != '')
                                        <a href="http://www.nrbxpress.com/uploads/images/courier/dob/{{ $courier[0]->dob_doc }}" target="_blank">View</a>
                                    @else
                                        Not attached
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-group-default">
                                    <label class="code">Utility Bills</label><br>
                                    @if($courier[0]->national_id_number_doc != '')
                                        <a href="http://www.nrbxpress.com/uploads/images/courier/ni/{{ $courier[0]->national_id_number_doc}}" target="_blank">View</a>
                                    @else
                                        Not attached
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-group-default">
                                    <label class="code">National ID Card</label><br>
                                    @if($courier[0]->address_verification_doc != '')
                                        <a href="http://www.nrbxpress.com/uploads/images/courier/address/{{ $courier[0]->address_verification_doc}}" target="_blank">View</a>
                                    @else
                                        Not attached
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group form-group-default">
                                    <label class="code">CV</label><br>
                                    @if($courier[0]->cv != '')
                                        <a href="http://www.nrbxpress.com/uploads/images/courier/resume/{{ $courier[0]->cv }}" target="_blank">View</a>
                                    @else
                                        Not attached
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="row" id="test2">
                            <h3 class="text text-success">Remarks</h3>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">

                                    @if(!  $courier[0]->comments)
                                        <div class="col-sm-12 text-danger">No Data Found</div>
                                    @else
                                        {{ $courier[0]->comments }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        <div class="modal fade stick-up" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                            </button>
                            <h5>Reference <span class="semi-bold">INFORMATION</span></h5>
                            <p class="p-b-10">We need client information inorder to process the order</p>
                        </div>
                        <form name="reference_form" novalidate>
                            <div class="modal-body">
                                <div class="form-group-attached">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label class="code">Name </label><br>
                                                <input type="text" class="form-control" name="referee_name" ng-model="referee.referee_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Company</label><br>
                                                <input type="text" class="form-control" name="referee_company" ng-model="referee.referee_company">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Designation</label><br>
                                                <input type="text" class="form-control" name="referee_designation" ng-model="referee.referee_designation">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Email Address</label><br>
                                                <input type="text" class="form-control" ng-model="referee.referee_email" name="referee_email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Contact Number</label><br>
                                                <input type="text" class="form-control" ng-model="referee.referee_contact" >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                                <a class="btn btn-primary btn-block m-t-5" ng-click="add_referee()" ng-disabled="reference_form.$invalid">Add</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade stick-up" id="modalSlideUpExperience" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                            </button>
                            <h5>Experience <span class="semi-bold">INFORMATION</span></h5>
                            <p class="p-b-10">We need client information inorder to process the order</p>
                        </div>
                        <form name="experience_form" novalidate>
                            <div class="modal-body">
                                <div class="form-group-attached">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Company </label><br>
                                                <input type="text" class="form-control" name="company" ng-model="exp.company" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Designation</label><br>
                                                <input type="text" class="form-control" name="designation" ng-model="exp.designation">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">Start Date</label><br>
                                                <input type="text" class="form-control default_datetimepicker" name="start_date" ng-model="exp.start_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label class="code">End Date</label><br>
                                                <input type="text" class="form-control default_datetimepicker" ng-model="exp.end_date" name="end_date">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                                <a class="btn btn-primary btn-block m-t-5" ng-click="add_experience()" ng-disabled="experience_form.$invalid">Add</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
