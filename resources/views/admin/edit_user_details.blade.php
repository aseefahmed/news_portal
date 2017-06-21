@extends('layouts.admin.dashboard')

@section('content')

{{--
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12"> <a href="{{ url('dashboard/clients/list') }}" class="btn btn-wide btn-success" >USERS LIST</a> </div>
</div>
--}}
<div class="col-sm-12 col-md-6" ng-controller="ClientController" >
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-header">
        <h5 class="panel-title">Update Information</h5>
      </div>
      <form id="userDetails">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $user[0]->id }}">
        <input type="hidden" name="user_type" value="{{ $user_type }}">
        <div class="panel-content">
          <div class="alert alert-success fade in" style="display: none;" id="success_div"> <strong>Success!</strong> You have successfully updated the information </div>
          <div class="alert alert-danger fade in" style="display: none;" id="failure_div"> <strong>Error!</strong> Operation Faild </div>
          
                    
        	<div class="row">
            <div class="col-md-12">                                   
                @if($user_type == 'clients')
                <div class="form-group">
                    <label for="email">Account Type</label>
                    <select class="form-control"  name="account_type">
                      <option value="1" <?php if($user[0]->account_type == 1){echo "selected";} ?>>Individual</option>
                      <option value="2" <?php if($user[0]->account_type == 2){echo "selected";} ?>>Corporate</option>
                      <option value="3" <?php if($user[0]->account_type == 3){echo "selected";} ?>>Government</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Region</label>
                    <select class="form-control"  name="region">
                      <option value="Domestic" <?php if($user[0]->region == "Domestic"){echo "selected";} ?>>Domestic</option>
                      <option value="International" <?php if($user[0]->region == "International"){echo "selected";} ?>>International</option>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="email">Customer Name</label>
                    <input type="text" class="form-control" value="{{ $user[0]->name  }}" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Phone</label>
                    <input type="text" class="form-control" value="{{ $user[0]->phone  }}" name="phone">
                </div>      
                @elseif($user_type == 'employees')
                <div class="form-group">
                    <label for="email">First Name</label>
                    <input type="text" class="form-control" value="{{ $user[0]->first_name  }}" name="first_name" placeholder="First Namae">
                </div>
                <div class="form-group">
                    <label for="email">Last Name</label>
                    <input type="text" class="form-control" value="{{ $user[0]->last_name  }}" name="last_name" placeholder="Last Namae">
                 </div>
                 @endif 
                
                <div class="form-group">
                    <label for="password">Photo</label>
                    <input type="file" class="form-control fileinput" name="photo">
                </div>
                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="text" class="form-control" value="{{ $user[0]->email  }}" name="email" <?php if(Auth::user()->role != 1){echo "readonly";} ?>>
                </div>
                
                @if($user_type == 'employees')
                <div class="form-group">
                 <label for="email">Role</label>
                <select class="form-control"  name="role" <?php if(Auth::user()->role != 1){echo "readonly";} ?>>
                  @foreach($roles as $role)
                  <option value="{{ $role->id }}" <?php if($user[0]->role == $role->id){echo "selected";} ?>>{{ $role->name }}</option>
                  @endforeach
                </select>
                </div>
                @endif
            
                <div class="form-group">
                    <a class="btn btn-primary" id="edit_user"><i class="fa fa-pencil"></i> Update Information</a> </div>
                </div>
            </div>
         </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection