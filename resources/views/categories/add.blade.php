@extends('layouts.admin.dashboard')

@section('css_block')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/plugins/bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js_block')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('public/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<form class="form-horizontal form-stripe" id="addCatForm">
<div class="row animated fadeInUp" ng-controller="NewsController">

	<input type="hidden" name="flag" id="flag">
	{{ csrf_field() }}
		<div class="col-sm-12 col-md-8">
			<h4 class="section-subtitle"><b>ADD</b> CATEGORY</h4>
			<div class="panel">
				<div class="panel-content">
					<div class="row">
						<div class="col-md-12">
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Category Name</label>
								  <div class="col-sm-9">
									  <input type="text" class="form-control" name="category_name" placeholder="Category">
								  </div>
							  </div>
						</div>
						<div class="col-md-12">
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">&nbsp;</label>
								  <div class="col-sm-9">
										<div class="col-sm-12" style="margin-top:15px">
												<a class="btn btn-primary saveCatBtn" flag="0">Create Category</a>
										</div>
								  </div>
							  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</form>
<script>

</script>
@endsection