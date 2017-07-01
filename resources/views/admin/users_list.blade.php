@extends('layouts.admin.dashboard')
@section('css_block')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js_block')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12 success_div" style="display: none;">
    <div class="alert alert-success fade in"> <strong>Success!</strong> You have add a user. </div>
  </div>
</div>
<div class="col-sm-12" ng-controller="ClientController" ng-init="initialize('{{ $user_type }}')">
  <button type="button" class="btn btn-wide btn-success" data-toggle="modal" data-target="#success-modal"> @if($user_type == 'clients')
  
  Add Customer
  
  @elseif($user_type == 'employees')
  
  ADD EMPLOYEE
  
  @endif </button>
  <div class="panel">
    <div class="panel-content table-responsive">
    <div class="col-md-12 text-center">
        {{ $users->links() }}
    </div>
      <table class="data-table table table-striped table-hover responsive nowrap responsive-table" cellspacing="0" width="100%">
        <thead>
        
          <th>Name</th>
          <th>Email Address </th>
          <th>Categories </th>
          <th>Role</th>
          <th class="text-right">Acttion</th>
            </thead>
        <tbody>
        
        @foreach($users as $user)
        <tr> 
          <td>{{ $user->first_name }} {{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->email }}</td>
          <td>
			<?php 
				$user_categories = findUserCategories($user->id);
				
				$str = "";
				foreach($user_categories as $cat)
				{
					$str = $str."<code>$cat->category_name</code><br>";
				}
				echo substr($str, 0, -1);
				if(strlen($str) == 0)
					echo "<code>Not Categorized</code>";
			?>
		  </td>
          <td class="text-right">
          	<a href="{{ url('view/'.$user_type .'/'.$user->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
            @if(Auth::user()->role == 1) <a href="{{ url('edit/'.$user_type .'/'.$user->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> @endif 
            <a class="btn btn-danger" ng-click="delete_user(<?php echo $user->id;?>, '<?php echo $user_type;?>')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
        @endforeach
          </tbody>
        
      </table>
      <div class="col-md-12 text-center">
        {{ $users->links() }}
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  
  <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header state modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i> 
          @if($user_type == 'clients')            
            Add Customer            
            
            @elseif($user_type == 'employees')            
            Add Employee            
            @endif </h4>
        </div>
        <div class="modal-body">
          <form role="form" name="userRegistrationForm" id="userRegistrationForm" novalidate>
            {{ csrf_field() }}
            <div class="form-group-attached">
              <div class="row">
                <div class="col-sm-12" ng-if="msg != ''">
                  <label><span style="color:red">[[ msg ]]</span></label>
                </div>
                @if($user_type == 'clients')
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Account Type</label>
                    <select class="form-control"  name="account_type">
                      <option value="1">Individual</option>
                      <option value="2">Corporate</option>
                      <option value="3">Government</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Region</label>
                    <select class="form-control"  name="region">
                      <option value="Domestic">Domestic</option>
                      <option value="International">International</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Customer Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="first_name" ng-model="user.first_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                  </div>
                </div>
                @endif
                
                @if($user_type == 'employees')
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>First Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="first_name" ng-model="user.first_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Last Name <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="last_name" ng-model="user.last_name" ng-required="true" ng-model-options="{updateOn: 'blur'}">
                  </div>
                </div>
                @endif
                                                
                @if($user_type == 'employees')
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Role <span style="color:red">*</span></label>
                    <select class="form-control select2js" style="width: 100%" name="role" ng-model="user.role" ng-required="true">
                      <option value="">Chose Options</option>
                      <option ng-repeat="role in roles" value="[[ role.id ]]">[[ role.name ]]</option>
                    </select>
                  </div>
                </div>
                @endif
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Email Address <span style="color:red">*</span></label>
                    <input type="email" class="form-control" ng-model="user.email_address" id="email_address" ng-required="true" name="email_address" ng-model-options="{updateOn: 'blur'}" ng-blur="checkEmail()">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Permissions <span style="color:red">*</span></label>
                    <select class="form-control select2js" style="width: 100%" name="permissions[]" multiple>
                      @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->category_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                @if($user_type == 'clients')
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Phone Number <span style="color:red">*</span></label>
                    <input type="text" class="form-control" ng-model="user.phone" id="phone" ng-required="true" name="phone" ng-model-options="{updateOn: 'blur'}" ng-blur="checkEmail()">
                  </div>
                </div>
                @endif
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Password <span style="color:red">*</span></label>
                    <input type="password" class="form-control" ng-model="user.password" ng-minlength="6"  ng-maxlength="20"  name="password" ng-model-options="{updateOn: 'blur'}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group form-group-default">
                    <label>Retype Password <span style="color:red">*</span></label>
                    <input type="password" class="form-control" name="retype_password" ng-model="user.retype_password" ng-required="true" ng-model-options="{updateOn: 'blur'}" ng-pattern="user.password">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-6" ng-if="userRegistrationForm.email_address.$dirty && userRegistrationForm.email_address.$error.email">
              <label><span style="color:red">* Email address must be valid.</span></label>
            </div>
          </div>
          <div class="col-sm-12" ng-show="error_msg == 1">
            <div class="col-sm-6">
              <label><span style="color:red">* Email address already exists</span></label>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="col-sm-12" ng-if="userRegistrationForm.password.$dirty && userRegistrationForm.password.$invalid">
              <label><span style="color:red">* Password must be at least 6 characters long.</span></label>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="col-sm-12" ng-if="userRegistrationForm.retype_password.$dirty && user.retype_password!=user.password">
              <label><span style="color:red">* Password and re-type password must be same.</span></label>
            </div>
          </div>
        </div>
        <div class="modal-footer"> <a type="button" class="btn btn-success" ng-disabled="userRegistrationForm.$invalid || error_msg == 1" user_type="{{ $user_type }}" id="user_reg_btn">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="success-modal_2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header state modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modal-success-label"><i class="fa fa-user"></i>Delete User</h4>
        </div>
        <div class="modal-body">
          <div class="form-group-attached">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group-default"> Do you really want to delete the user? </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"> <a type="button" class="btn btn-success" user_id="0" user_type="" id="delete_user_confirm_btn" ng-click="delete_user_confirm()">Yes</a> <a type="button" class="btn btn-default" data-dismiss="modal">No</a> </div>
      </div>
    </div>
  </div>
</div>
@endsection