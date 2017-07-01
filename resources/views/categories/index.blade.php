@extends('layouts.admin.dashboard')
@section('content')
<div class="pull-left" style="padding-left:15px;">
  <div class="col-xs-12">
    <a class="btn btn-wide btn-success" href="{{ url('categories/add') }}">ADD CATEGORY</a>
  </div>
</div>
<div class="col-sm-12" ng-controller="NewsController">
  <div class="container-fluid padding-25 sm-padding-10">
    <div class="panel panel-transparent clearfix">
      <div class="panel-body  table-responsive">
        <div class="col-md-12 text-center">
            {{ $catagories->links() }}
        </div>
        <table class="table table-striped responsive-table" id="responsive-table">
          <thead>
            <tr>
              <th># </th>
              <th>Catagory </th>
            </tr>
          </thead>
          <tbody>
          @if(count($catagories) == 0)
			  <td>No data available.</td>
		  @endif
		  
          @foreach($catagories as $key=>$cat)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $cat->category_name }}</td>
          </tr>
          @endforeach
            </tbody>
          
        </table>
        <div class="col-md-12 text-center">
            {{ $catagories->links() }}
        </div>
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