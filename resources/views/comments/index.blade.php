@extends('layouts.admin.dashboard')
@section('content')

<div class="col-sm-12" ng-controller="NewsController">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-body  table-responsive">
        <div class="col-md-12 text-center">
            {{ $comments->links() }}
        </div>
        <table class="table table-striped responsive-table" id="responsive-table">
          <thead>
            <tr>
              <th># </th>
              <th>Comments </th>
              <th>Status </th>
              <th>Submitted At</th>
              <th>Submitted By</th>
            </tr>
          </thead>
          <tbody>
          @if(count($comments) == 0)
			  <td>No data available.</td>
		  @endif
		  
          @foreach($comments as $index=>$comment)
          <tr>
			<td>{{$index+1}} </th>
			<td>
				<?php echo wordwrap($comment->details,190,"<br>\n");?><br><br> 
				<!--a href="{{ url('news/view/'.$comment->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
                <a href="{{ url('news/edit/'.$comment->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a-->  
                @if($comment->flag == '0')
					<a class="btn btn-success" ng-click="changeCommentStatus({{ $comment->id }}, 1)"><i class="fa fa-check"></i></a>
				@elseif($comment->flag == '1')
					<a class="btn btn-danger" ng-click="changeCommentStatus({{ $comment->id }}, 2)"><i class="fa fa-trash"></i></a>
				@elseif($comment->flag == '2')
					<a class="btn btn-primary" ng-click="changeCommentStatus({{ $comment->id }}, 1)"><i class="fa fa-refresh"></i></a>
				@endif
			</th>
			<td>
				@if($comment->flag == 0)
					<span class="badge x-warning">Pending</span>
				@elseif($comment->flag == 1)
					<span class="badge x-success">Active</span>
				@elseif($comment->flag == 2)
					<span class="badge x-danger">Deleted</span>
				@endif
			</th>
			<td>{{ $comment->created_at }} </th>
			<td>{{ findUserDetails($comment->user_id)[0]->first_name }} {{ findUserDetails($comment->user_id)[0]->last_name }} </th>
          </tr>
          @endforeach
            </tbody>
          
        </table>
        <div class="col-md-12 text-center">
            {{ $comments->links() }}
        </div>
      </div>
    </div>
	<div class="modal fade" id="modalSlideUp2" tabindex="-1" role="dialog" aria-labelledby="modal-success-label" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header state modal-success">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-success-label"><i class="fa fa-location-arrow"></i>Remove Comment</h4>
				</div>
				<div class="modal-body" style="">
					Are you sure you want perform this action.
					<div class="row">
						<div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
							<div class="modal-footer"> <a ng-click="confirmRemoveComment()" type="button" class="btn btn-success">Ok</a> <a type="button" class="btn btn-default" data-dismiss="modal">Close</a> </div>

						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
  </div>
  
</div>
@endsection