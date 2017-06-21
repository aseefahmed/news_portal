@extends('layouts.admin.dashboard')

@section('content')

    <div class="row  animated fadeInRight">
        @if(Auth::user()->role == 1)
                <div class="col-xs-12">
                    <a href="{{ url('dashboard/couriers/add') }}" class="btn btn-wide btn-success" >Add Courier</a>
                    <a href="{{ url('dashboard/courier/edit/'.$courier[0]->id) }}" class="btn btn-wide btn-primary" >Edit Courier</a>
                    @if($count == 1)
                        <a href="{{ url('password/change/'.$courier[0]->id) }}" class="btn btn-wide btn-danger" >Change Password</a>
                    @else
                        <a href="{{ url('password/generate/'.$courier[0]->id) }}" class="btn btn-wide btn-danger" >Generate Password</a>
                    @endif
                </div>
        @endif
        @if(Auth::user()->role == 9)
                <div class="col-xs-12">
                    <a href="{{ url('dashboard/courier/edit/'.$courier[0]->id) }}" class="btn btn-wide btn-primary" >Edit Courier</a>
                    
                </div>
        @endif
        <div class="col-md-12 col-lg-8">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel  b-primary bt-sm">
                        <div class="panel-header row">
                            <div class="col-sm-4">
                                <h5 class="panel-title">Profile Info</h5>
                            </div>
                            <div class="col-sm-4 text-danger">
                                @if(isset(findCourierLocation($courier[0]->id)[0]))
                                    <strong>Branch: {{ findCourierLocation($courier[0]->id)[0]->location_name }}</strong>
                                @else
                                    <strong>Branch: Not Allocated</strong>
                                @endif
                            </div>
                            <div class="col-sm-4 text-right">
                                @if($courier[0]->status == "Confirmed")
                                    <img style="cursor:pointer;" <?php if(Auth::user()->role == 1){ echo "id='change_courier_status'"; } ?> status="{{ $courier[0]->status }}"  courier_id="{{ $courier[0]->id }}" src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-128.png" height="30px">
                                @else
                                    <img style="cursor:pointer;" <?php if(Auth::user()->role == 1){ echo "id='change_courier_status'"; } ?> status="{{ $courier[0]->status }}"  courier_id="{{ $courier[0]->id }}" src="https://cdn3.iconfinder.com/data/icons/ose/Error.png" height="30px">
                                @endif


                            </div>

                        </div>
                        <div class="panel-content">
                            <div class="p-info">
                                <ul>
                                    <li><span>First Name</span> {{ $courier[0]->first_name }}</li>
                                    <li><span>Father's Name</span>
                                        @if($courier[0]->father_name )
                                            {{ $courier[0]->father_name }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Date of Birth</span>
                                        @if($courier[0]->dob )
                                            {{ $courier[0]->dob }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Email</span>
                                        @if($courier[0]->email )
                                            {{ $courier[0]->email }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Blood Group</span>
                                        @if($courier[0]->blood_group )
                                            {{ $courier[0]->blood_group }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Maritial Status</span>
                                        @if($courier[0]->maritial_status )
                                            {{ $courier[0]->maritial_status }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                </ul>
                                <ul>
                                    <li><span>Last Name</span>{{ $courier[0]->last_name }}</li>
                                    <li><span>Mother's Name</span>
                                        @if($courier[0]->mother_name )
                                            {{ $courier[0]->mother_name }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Religion</span>
                                        @if($courier[0]->religion )
                                            {{ $courier[0]->religion }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Nationality</span>
                                        @if($courier[0]->nationality )
                                            {{ $courier[0]->nationality }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>Gender</span>
                                        @if($courier[0]->gender )
                                            {{ $courier[0]->gender }}
                                        @else
                                            Not Mentioned
                                        @endif
                                    </li>
                                    <li><span>National ID Number</span>
                                        @if(!  $courier[0]->national_id_number)
                                            Not Available
                                        @else
                                            {{ $courier[0]->national_id_number }}
                                        @endif
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel b-primary bt-sm ">
                        <div class="panel-header">
                            <h5 class="panel-title">Permanent Address</h5>
                        </div>
                        <div class="panel-content" style="height:auto">
                            <div class="nanod">
                                <div class="nadno-content" style="overflow: auto;">
                                    @if(!  $courier[0]->permanent_address)
                                        Not Available
                                    @else
                                        {{ $courier[0]->permanent_address }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel b-primary bt-sm ">
                        <div class="panel-header">
                            <h5 class="panel-title">Present Address</h5>
                        </div>
                        <div class="panel-content" style="height:auto">
                            <div class="nanod">
                                <div class="nadno-content" style="overflow: auto;">
                                    @if(!  $courier[0]->present_address)
                                        Not Available
                                    @else
                                        {{ $courier[0]->present_address }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel b-primary bt-sm ">
                        <div class="panel-header">
                            <h5 class="panel-title">Comments</h5>
                        </div>
                        <div class="panel-content" style="height:auto">
                            <div class="nanod">
                                <div class="nadno-content" style="overflow: auto;">
                                    @if(!  $courier[0]->comments)
                                        Not Available
                                    @else
                                        {{ $courier[0]->comments }}
                                    @endif
                                </div>
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

                                                    <div class="col-sm-4"><?php echo wordwrap($ref, 15, "<br>\n",TRUE); ?></div>
                                                @else
                                                    <div class="col-sm-2"><?php echo wordwrap($ref, 15, "<br>\n",TRUE); ?></div>

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
                                            <div class="col-sm-3 text-danger">Designation</div>
                                            <div class="col-sm-3 text-danger">Start Date</div>
                                            <div class="col-sm-3 text-danger">End Date</div>
                                            @foreach($experiences as $key=>$ref)
                                                @if($ref)
                                                    <div class="col-sm-3"><?php echo wordwrap($ref, 15, "<br>\n",TRUE); ?></div>
                                                @else
                                                    <div class="col-sm-3">N/A</div>
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
                                                <img style="padding:1px;border:1px solid #021a40;background-color:#ff0;" class="img1" src="http://www.nrbxpress.com/uploads/images/pictures/{{ $courier[0]->picture }}" height="250px;">
                                            @else
                                                <img style="padding:1px;border:1px solid #021a40;background-color:#ff0;" class="img1" src="https://cdn3.iconfinder.com/data/icons/user-avatars-1/512/users-11-2-128.png" height="250px">
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
                <div class="panel-content" style="height:200px">
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
                                                        Police Verification
                                                    </a>
                                                @else
                                                    Police Verification
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
                                                        National ID Number
                                                    </a>
                                                @else
                                                    National ID Number
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
                                    <li>
                                        <div class="checkbox-custom checkbox-primary">
                                            @if($courier[0]->exp_certificate != '')
                                                <input type="checkbox" id="check-simple2" value="option1" checked>
                                            @else
                                                <input type="checkbox" id="check-simple2" value="option1">
                                            @endif
                                            <label class="check"  style="text-decoration: none;">
                                                @if($courier[0]->exp_certificate != '')
                                                    <a href="http://www.nrbxpress.com/uploads/images/courier/exp_certificate/{{ $courier[0]->dob_doc }}" target="_blank">
                                                        Experience Certificate
                                                    </a>
                                                @else
                                                    Experience Certificate
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

@endsection
