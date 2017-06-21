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
    @if(Auth::user()->role == 1)
        <div class="pull-left">
            <div class="col-xs-12">
                <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-wide btn-success" >ADD COURIER</a>
                <a href="{{ url('password/change/'.$courier[0]->id) }}" class="btn btn-wide btn-danger" >Change Password</a>
            </div>
        </div>
    @endif
    <div class="col-sm-12" ng-controller="CourierController">
        <form role="form" name="CourierRequestForm" id="CourierRequestForm" novalidate>
            {{ csrf_field() }}
            <input type="hidden" name="courier_id" value="{{ $courier[0]->id }}">
            <div class="row  animated fadeInRight">
                <div class="col-md-12 col-lg-8">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel  b-primary bt-sm">
                                <div class="panel-header">
                                    <h5 class="panel-title">Profile Info</h5>
                                </div>
                                <div class="panel-content">
                                    <div class="p-info">
                                        <ul>
                                            <li><span>First Name</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->first_name }}" id="first_name" name="first_name" ng-required="true" >
                                            </li>
                                            <li><span>Father's Name</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->father_name }}" name="father_name">
                                            </li>
                                            <li><span>Date of Birth</span>
                                                <input type="text" class="form-control default_datetimepicker" value="{{ $courier[0]->dob }}" name="dob" ng-required="true">
                                            </li>
                                            <li><span>Email</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->email }}"  disabled>
                                            </li>
                                            <li><span>Blood Group</span>
                                                <select class="form-control"  name="blood_group">
                                                    <option value="A+" <?php if($courier[0]->blood_group == 'A+'){echo "selected";} ?>>A+</option>
                                                    <option value="B+" <?php if($courier[0]->blood_group == 'B+'){echo "selected";} ?>>B+</option>
                                                    <option value="O+" <?php if($courier[0]->blood_group == 'O+'){echo "selected";} ?>>O+</option>
                                                    <option value="AB+" <?php if($courier[0]->blood_group == 'AB+'){echo "selected";} ?>>AB+</option>
                                                    <option value="B-" <?php if($courier[0]->blood_group == 'B-'){echo "selected";} ?>>B-</option>
                                                </select>
                                            </li>
                                            {{--<li><span>Present Address</span>
                                                <textarea class="form-control" id="present_address" name="present_address">{{ $courier[0]->present_address }}</textarea>
                                            </li>--}}
                                            <li><span>Maritial Status</span>
                                                <select class="form-control"  name="maritial_status">
                                                    <option value="">Choose option</option>
                                                    <option value="Single" <?php if($courier[0]->maritial_status == 'Single'){echo "selected";} ?>>Single</option>
                                                    <option value="Married" <?php if($courier[0]->maritial_status == 'Married'){echo "selected";} ?>>Married</option>
                                                </select>
                                            </li>
                                        </ul>
                                        <ul>
                                            <li><span>Last Name</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->last_name }}" id="last_name" name="last_name"  ng-required="true" >
                                            </li>
                                            <li><span>Mother's Name</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->mother_name }}" name="mother_name" >
                                            </li>
                                            <li><span>Religion</span>
                                                <select class="form-control"  name="religion">
                                                    <option value="Islam" <?php if($courier[0]->religion == 'Islam'){echo "selected";} ?>>Islam</option>
                                                    <option value="Cristian" <?php if($courier[0]->religion == 'Cristian'){echo "selected";} ?>>Cristian</option>
                                                    <option value="Hindu" <?php if($courier[0]->religion == 'Hindu'){echo "selected";} ?>>Hindu</option>
                                                    <option value="Bhuddist" <?php if($courier[0]->religion == 'Bhuddist'){echo "selected";} ?>>Bhuddist</option>
                                                </select>
                                            </li>
                                            <li><span>Nationality</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->nationality }}" name="nationality">
                                            </li>
                                            <li><span>Gender</span>
                                                <select class="form-control"  name="gender">
                                                    <option value="Male" <?php if($courier[0]->gender == 'Male'){echo "selected";} ?>>Male</option>
                                                    <option value="Female" <?php if($courier[0]->gender == 'Female'){echo "selected";} ?>>Female</option>
                                                </select>
                                            </li>
                                            {{--<li><span>Permanent Address</span>
                                                <textarea class="form-control" id="permanent_address" name="permanent_address">{{ $courier[0]->permanent_address }}</textarea>
                                            </li>--}}
                                            <li><span>National ID Number</span>
                                                <input type="text" class="form-control" value="{{ $courier[0]->national_id_number }}" name="national_id_number">
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel b-primary bt-sm ">
                                <div class="panel-header">
                                    <h5 class="panel-title">References</h5>
                                </div>
                                <div class="panel-content" style="height:auto">
                                    <div class="nanod">
                                        <div class="nadno-content" style="overflow: auto;">
                                            <div class="widgedt-list list-left-element">
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
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel b-primary bt-sm ">
                                <div class="panel-header">
                                    <h5 class="panel-title">Experiences</h5>
                                </div>
                                <div class="panel-content" style="height:auto">
                                    <div class="nanod">
                                        <div class="nadno-content" style="overflow: auto;">
                                            <div class="widgedt-list list-left-element">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-success" id="update_courier_btn">Update</a> <label id="err_msg" style="color:red;display:none;">Form is not complete</label><label id="err1" style="display: none; color:red;">Email address already taken.</label>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="panel b-primary bt-sm ">
                        <div class="panel-header">
                            <h5 class="panel-title">Profile Picture</h5>
                        </div>
                        <div class="panel-content" style="height:300px">
                            <div class="nano">
                                <div class="nano-content">
                                    <div class="list-left-element">
                                        <ul>
                                            <li style="list-style-type: none;">
                                                <a href="#">
                                                    @if($courier[0]->picture != '')
                                                        <img class="img1" src="http://www.nrbxpress.com/uploads/images/courier/picture/{{ $courier[0]->picture }}" height="250px;">
                                                    @else
                                                        <img class="img1" src="https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-11-2-128.png" height="250px">
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel b-primary bt-sm ">
                        <div class="panel-header">
                            <h5 class="panel-title">Attached Documents</h5>
                        </div>
                        <div class="panel-content" style="height:180px">
                            <div class="nano">
                                <div class="nano-content">
                                    <div class="widget-list list-to-do">
                                        <ul>
                                            <li>
                                                <div class="checkbox-custom checkbox-primary">
                                                    @if($courier[0]->cv != '')
                                                        <input type="checkbox" id="check-simple2" value="option1" checked>
                                                    @else
                                                        <input type="checkbox" id="check-simple2" value="option1">
                                                    @endif
                                                    <label class="check"  style="text-decoration: none;">

                                                        @if($courier[0]->cv != '')
                                                            <a href="http://www.nrbxpress.com/uploads/images/courier/resume/{{ $courier[0]->cv }}" target="_blank">
                                                                Resume
                                                            </a>
                                                        @else
                                                            Resume
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox-custom checkbox-primary">
                                                    @if($courier[0]->address_verification_doc != '')
                                                        <input type="checkbox" id="check-simple2" value="option1" checked>
                                                    @else
                                                        <input type="checkbox" id="check-simple2" value="option1">
                                                    @endif
                                                    <label class="check"  style="text-decoration: none;">

                                                        @if($courier[0]->address_verification_doc != '')
                                                            <a href="http://www.nrbxpress.com/uploads/images/courier/address/{{ $courier[0]->address_verification_doc }}" target="_blank">
                                                                Utility Bills
                                                            </a>
                                                        @else
                                                            Utility Bills
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox-custom checkbox-primary">
                                                    @if($courier[0]->national_id_number_doc != '')
                                                        <input type="checkbox" id="check-simple2" value="option1" checked>
                                                    @else
                                                        <input type="checkbox" id="check-simple2" value="option1">
                                                    @endif
                                                    <label class="check"  style="text-decoration: none;">

                                                        @if($courier[0]->national_id_number_doc != '')
                                                            <a href="http://www.nrbxpress.com/uploads/images/courier/ni/{{ $courier[0]->national_id_number_doc }}" target="_blank">
                                                                NI
                                                            </a>
                                                        @else
                                                            NI
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="checkbox-custom checkbox-primary">
                                                    @if($courier[0]->dob_doc != '')
                                                        <input type="checkbox" id="check-simple2" value="option1" checked>
                                                    @else
                                                        <input type="checkbox" id="check-simple2" value="option1">
                                                    @endif
                                                    <label class="check"  style="text-decoration: none;">
                                                        @if($courier[0]->dob_doc != '')
                                                            <a href="http://www.nrbxpress.com/uploads/images/courier/dob/{{ $courier[0]->dob_doc }}" target="_blank">
                                                                Birth Certificate
                                                            </a>
                                                        @else
                                                            Birth Certificate
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>








    </div>


@endsection
