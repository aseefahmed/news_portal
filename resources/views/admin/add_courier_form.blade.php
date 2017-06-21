@extends('layouts.admin.dashboard')

@section('content')
    <style>
        .error_class {
            border:  1px red solid;
        }
    </style>
<div class="alert alert-success fade in text-center">
    <h1>Add Courier</h1>
</div>
<div class="col-sm-12" ng-controller="CourierController">
        <div class="container-fluid padding-25 sm-padding-10">
            <div class="panel panel-transparent clearfix">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                    </button>
                    <h5> Courier <span class="semi-bold">INFORMATION</span></h5>
                    <p class="p-b-10">We need courier information for security purpose.</p>
                </div>
                 <form role="form" name="CourierRequestForm" id="CourierRequestForm" novalidate>
                     {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="row">
                            <h3 class="text text-success">Personal Information</h3>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>First Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" ng-model="user.first_name" ng-required="true" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Last Name <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="last_name"  id="last_name" ng-model="user.last_name" ng-required="true" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Father's Name</label>
                                    <input type="text" class="form-control" name="father_name" ng-model="user.father_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Mother's Name</label>
                                    <input type="text" class="form-control" name="mother_name" ng-model="user.mother_name">
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" ng-model="user.email">
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" ng-model="user.password">
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Date of Birth</label>
                                    <input type="text" class="form-control default_datetimepicker_without_time" name="dob" ng-model="user.dob" ng-required="true">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Religion</label>
                                    <select class="form-control"  name="religion" ng-model="user.religion">
                                        <option value="">Choose option</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Cristian">Cristian</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Bhuddist">Bhuddist</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>Nationality</label>
                                    <input type="text" class="form-control" name="nationality" ng-model="user.nationality">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label>National ID Number</label>
                                    <input type="text" class="form-control" name="national_id_number" ng-model="user.national_id_number">
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Blood Group</label>
                                    <select class="form-control"  name="blood_group" ng-model="user.blood_group">
                                        <option value="">Choose option</option>
                                        <option value="A+">A+</option>
                                        <option value="B+">B+</option>
                                        <option value="O+">O+</option>
                                        <option value="AB+">AB+</option>
                                        <option value="B-">B-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Gender</label>
                                    <select class="form-control"  name="gender" ng-model="user.gender">
                                        <option value="">Choose option</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" id="locationField">
                                <div class="form-group form-group-default">
                                    <label>Maritial Status</label>
                                    <select class="form-control"  name="maritial_status" ng-model="user.maritial_status">
                                        <option value="">Choose option</option>
                                        <option value="Single">Single</option>
                                        <option value="Maried">Maried</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <h3 class="text text-success">Contact Number</h3>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label>Home <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="contact_no_home" ng-model="user.contact_no_home" ng-required="true" >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label>Work <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="contact_no_work" ng-model="user.contact_no_work" ng-required="true" >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group form-group-default">
                                    <label>Other</label>
                                    <input type="text" class="form-control" name="contact_no_other" ng-model="user.contact_no_other">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text text-success">Attach Documents</h3>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Photo</label>
                                    <input class="fileinput" type="file" name="photo"  class="file" data-preview-file-type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Birth Certificate</label>
                                    <input class="fileinput" type="file" name="dob_doc"  class="file" data-preview-file-type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Police Verification</label><code>(For security reason you should obtain this)</code>
                                    <input class="fileinput" type="file" name="address_verification_doc" class="file" data-preview-file-type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>National ID Card</label>
                                    <input class="fileinput" type="file" name="national_id_number_doc"  class="file" data-preview-file-type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>CV</label>
                                    <input class="fileinput" type="file" name="cv" class="file" data-preview-file-type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Experience Certificate</label>
                                    <input class="fileinput" type="file" name="exp_certificate" class="file" data-preview-file-type="text">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div id="ajax_loading" style="display: none">
                                    <img src="{{ asset('public/img/squares.gif') }}" height="40px">
                                </div>
                                <a class="btn btn-success" id="add_courier_btn">Add Courier</a> <label id="err_msg" style="color:red;display:none;">Form is not complete</label><label id="err1" style="display: none; color:red;">Email address already taken.</label>
                            </div>

                        </div>
                    </div>
                     <div class="col-sm-6">
                         <div class="row" id="test2">
                             <h3 class="text text-success">Present Address</h3>
                             <div class="col-sm-12">
                                 <div class="form-group form-group-default">
                                     {{--<label>Street</label>--}}
                                     <textarea class="form-control" id="present_address" name="present_address" ng-model="user.street" ng-required="true"></textarea>
                                 </div>
                             </div>
                             {{--<div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>Town</label>
                                     <input type="text" class="form-control" name="present_address[town]" ng-model="user.town">
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>District</label>
                                     <input type="text" class="form-control" name="present_address[district]" ng-model="user.district">
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>Post Code</label>
                                     <input type="text" class="form-control" name="present_address[post_code]" ng-model="user.post_code">
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>Country</label>
                                     <input type="text" class="form-control" name="present_address[country]" ng-model="user.reciever_email">
                                 </div>
                             </div>--}}
                         </div>

                     </div>
                     <div class="col-sm-6">
                         <div class="row" id="test2">
                             <h3 class="text text-success">Permanent Address</h3>
                             <div class="col-sm-12">
                                 <div class="form-group form-group-default">
                                     <input type="checkbox" id="same_add_chk"> Same as present addreess
                                     {{--<label>Thana</label>--}}
                                     <textarea class="form-control" id="permanent_address" name="permanent_address"  ng-model="user.permanent_address_thana" ng-required="true"></textarea>
                                 </div>
                             </div>
                             {{--<div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>Post Office</label>
                                     <input type="text" class="form-control" name="permanent_address[post_office]" ng-model="user.permanent_address_post_office">
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>Village</label>
                                     <input type="text" class="form-control" name="permanent_address[village]" ng-model="user.permanent_address_village">
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group form-group-default">
                                     <label>District</label>
                                     <input type="text" class="form-control" name="permanent_address[district]" ng-model="user.permanent_address_district">
                                 </div>
                             </div>--}}
                         </div>

                     </div>
                     <input type="hidden" id="references" name="references" ng-model="references">
                     <div class="col-sm-6">
                         <div class="row" id="test2">
                             <h3 class="text text-success">References</h3>
                             <div class="col-sm-12">
                                 <div>
                                 <ol ng-repeat="reference in references">
                                    <li>
                                            <strong>Name:</strong> [[ reference[0] ]]<br>
                                            <strong>Company:</strong> [[ reference[1] ]]<br>
                                            <strong>Designation:</strong> [[ reference[2] ]]<br>
                                            <strong>Email:</strong> [[ reference[3] ]]<br>
                                            <strong>Phone:</strong> [[ reference[4] ]]<br>
                                    </li>
                                 </ol>
                                    <!-- <table class="table table-striped  table-responsive">
                                        <thead ng-if="references.length">
                                            <tr>
                                                <th>Namex</th>
                                                <th>Company</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tr ng-repeat="reference in references">
                                            <td>[[ reference[0] ]]</td>
                                            <td>[[ reference[1] ]]</td>
                                            <td>[[ reference[2] ]]</td>
                                            <td>[[ reference[3] ]]</td>
                                            <td>[[ reference[4] ]]</td>
                                        </tr>
                                    </table> -->
                                 </div>
                                 <button class="btn btn-danger" data-target="#modalSlideUp" data-toggle="modal">ADD Reference</button>
                             </div>
                         </div>
                     </div>
                     <input type="hidden" id="experiences" name="experiences">
                     <div class="col-sm-6">
                         <div class="row" id="test2">
                             <h3 class="text text-success">Experiences</h3>
                             <div class="col-sm-12">
                             <ol ng-repeat="experience in experiences">
                                <li>
                                        <strong>Company:</strong> [[ experience[0] ]]<br>
                                        <strong>Designation:</strong> [[ experience[1] ]]<br>
                                        <strong>Start Date:</strong> [[ experience[2] ]]<br>
                                        <strong>End Date:</strong> 
                                            <span ng-if="!experience[3]"><code>Still Working</code></span>
                                             <span ng-if="experience[3]">[[ experience[3] ]]</span>
                                             <br>
                                </li>
                             </ol>
                                 <!-- <div>
                                     <table class="table table-striped">
                                         <thead ng-if="experiences.length">
                                         <tr>
                                             <th>Company</th>
                                             <th>Designation</th>
                                             <th>Start Date</th>
                                             <th>Start Date</th>
                                         </tr>
                                         </thead>
                                         <tr ng-repeat="experience in experiences">
                                             <td>[[ experience[0] ]]</td>
                                             <td>[[ experience[1] ]]</td>
                                             <td>[[ experience[2] ]]</td>
                                             <td ng-if="!experience[3]"><code>Still Working</code></td>
                                             <td ng-if="experience[3]">[[ experience[3] ]]</td>
                                         </tr>
                                     </table>
                                 </div> -->
                                 <button class="btn btn-danger" data-target="#modalSlideUpExperience" data-toggle="modal">ADD Experience</button>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="row" id="test2">
                             <h3 class="text text-success">Remarks</h3>
                             <div class="col-sm-12">
                                 <div class="form-group form-group-default">
                                     <textarea class="form-control"  name="comments" ng-model="user.comments">></textarea>
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
                        <p class="p-b-10">We need courier information.</p>
                    </div>
                    <form name="reference_form" novalidate>
                        <div class="modal-body">
                                <div class="form-group-attached">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="referee_name" ng-model="referee.referee_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Company</label>
                                                <input type="text" class="form-control" name="referee_company" ng-model="referee.referee_company">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="referee_designation" ng-model="referee.referee_designation">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Email Address</label>
                                                <input type="text" class="form-control" ng-model="referee.referee_email" name="referee_email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" ng-model="referee.referee_contact" >
                                            </div>
                                        </div>
                                        <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                                            <div class="col-sm-4 m-t-10 sm-m-t-10">
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
                                                <label>Company <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="company" ng-model="exp.company" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="designation" ng-model="exp.designation">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Start Date</label>
                                                <input type="text" class="form-control default_datetimepicker_without_time" name="start_date" ng-model="exp.start_date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>End Date </label>
                                                <input type="text" class="form-control default_datetimepicker_without_time" ng-model="exp.end_date" name="end_date" id="end_date"><br>
                                                <input type="checkbox" id="till_date" name="till_date"> Till Date
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                                            <div class="col-sm-4 m-t-10 sm-m-t-10">
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
