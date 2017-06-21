@extends('layouts.admin.dashboard')
@section('content')
<div class="col-sm-12">
  <div class="col-sm-12" ng-controller="LocationController">
    <div class="container-fluid padding-25 sm-padding-10">
      <div class="panel panel-transparent clearfix">
        <div class="panel-body clearfix">
          <div class="col-md-12">
            <div class="panel  b-primary bt-sm">
              <div class="panel-header">
                <h5 class="panel-title">Assets Givent to a Courier</h5>
              </div>
              <div class="panel-content">
                <div class="p-info">
                  <ul>
                    <li><span>Courier Name</span> {{$asset[0]->courier_first_name}} {{$asset[0]->courier_last_name}}</li>
                    <li><span>Given Date</span> {{ date_format(date_create($asset[0]->given_date), 'j F, Y') }}</li>
                  </ul>
                  <ul>
                    <li><span>Comments/Remarks</span> {{ $asset[0]->comment }}</li>
                    <li><span>Created At</span> {{ date_format(date_create($asset[0]->created_at), 'j F, Y, g:i a') }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            
      <div class="panel">
        <div class="panel-content">
          <div class="widget-list list-left-element list-sm">
            <ul>            
            @foreach($asset_list as $asset)
            <li><a href="javascript:void(0);">
            	<div class="left-element"><i class="fa fa-check color-warning"></i></div>
                <div class="text"> 
                <span class="title">{{ $asset->item_name }}</span> 
                <span class="subtitle">{{ $asset->item_description }}</span>
                </div>
                </a>
            </li>
            @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection