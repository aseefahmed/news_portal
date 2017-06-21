@extends('layouts.admin.dashboard')
@section('content')
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12">
    <a class="btn btn-wide btn-success" href="{{ url('news/add') }}">ADD News</a>
  </div>
</div>
<div class="col-sm-12" ng-controller="NewsController">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-body  table-responsive">
        <table class="table table-striped responsive-table" id="responsive-table">
          <thead>
            <tr>
              <th>Image </th>
              <th>News Title </th>
              <th>Category </th>
              <th>Author</th>
              <th>Status</th>
              <th>Created At</th>
              <th class="text-right">Action</th>
            </tr>
          </thead>
          <tbody>
          
          @foreach($news_list as $news)
          <tr>
            <td width="8%"><img src="{{ asset('public/images/news/featured/'.$news->featured_image)}}" height="40px"></td>
            <td>{{ $news->title }}</td>
            <td>
				<?php 
					$str = "";
					foreach(findNewsCategories($news->id) as $cat)
					{
						$str = $str."<code>$cat->category_name</code>/";
					}
					echo substr($str, 0, -1);
				?>
			</td>
            <td>{{ findUserDetails($news->created_by)[0]->first_name }} {{ findUserDetails($news->created_by)[0]->last_name }}</td>
            <td>
				@if($news->flag == 0)
					<span class="badge x-warning">Draft</span>
				@elseif($news->flag == 1)
					<span class="badge x-info">Published</span>
				@endif
			</td>
            <td>{{ date_format(date_create($news->created_at), 'd/M/Y') }}</td>
            <td class="text-right">
            	<a href="{{ url('news/view/'.$news->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
                <a href="{{ url('news/edit/'.$news->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                <a class="btn btn-danger" ng-click="deleteNews({{ $news->id }})"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
            </tbody>
          
        </table>
      </div>
    </div>
	<div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header state modal-success">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Remove News</h4>
				</div>
				<div class="modal-body" style="">
					Are you sure you want perform this action.
					<div class="row">
						<div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
							<div class="modal-footer"> <a ng-click="confirmRemoveNews()" type="button" class="btn btn-success">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>

						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
  </div>
  
</div>
@endsection