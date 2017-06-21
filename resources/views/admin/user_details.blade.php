@extends('layouts.admin.dashboard')

@section('content')

{{--<div class="pull-left" style="padding-left:15px;">

  <div class="col-xs-12"> <a href="{{ url('dashboard/clients/list') }}" class="btn btn-wide btn-success" >USERS LIST</a> </div>

</div>--}}

@if(true)

  <div class="pull-left" style="padding-left:15px;">

    <div class="col-xs-12">

      <a href="{{ url('password/change/'.$user[0]->id) }}" class="btn btn-wide btn-danger" >Change Password</a>
      <a href="{{ url('edit/employees/'.$user[0]->id) }}" class="btn btn-wide btn-primary" >Edit Profile</a>

    </div>

  </div>

@endif

<div class="col-sm-12">

  <div class="container-fluid padding-25 sm-padding-10">

    <div class="panel panel-transparent clearfix">

      <div class="panel-header">

        <h5 class="panel-title">Details Information</h5>

      </div>

      <div class="panel-content">

        <div class="p-info">

          <ul>

            <li><span>Employee Name</span> @if($user_type == 'clients')

              <p>{{ $user[0]->name  }}</p>

              @elseif($user_type == 'employees')

              <p>{{ $user[0]->first_name  }} {{ $user[0]->last_name  }}</p>

              @endif </li>

            <li> @if($user_type == 'clients') <span>Account Type</span> @if($user[0]->account_type == 1)

              <p>Individual</p>

              @elseif($user[0]->account_type == 2)

              <p>Government</p>

              @elseif($user[0]->account_type == 3)

              <p>Corporate</p>

              @endif

              @elseif($user_type == 'employees') <span>Role</span>

              <p>{{ ucwords($user[0]->role_name)  }}</p>

              @endif </li>
               @if($user_type == 'clients')	
            <li><span>Region</span> {{ $user[0]->region }}</li>
            @endif
              
              

          </ul>

          <ul>

            <li><span>Email Address</span> {{ $user[0]->email }}</li>
             @if($user_type == 'clients')	
            <li><span>Phone</span> {{ $user[0]->phone }}</li>
            @endif
            <li><span>Created At</span> {{ date_format(date_create($user[0]->created_at), 'Y-m-d') }}</li>

            

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>

</div>

@endsection