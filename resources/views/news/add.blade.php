@extends('layouts.admin.dashboard')
@section('content')
<form class="form-horizontal form-stripe" id="addNewsForm">
<div class="row animated fadeInUp" ng-controller="NewsController">

	<input type="hidden" name="flag" id="flag">
	{{ csrf_field() }}
		<div class="col-sm-12 col-md-8">
			<h4 class="section-subtitle"><b>Add</b> News</h4>
			<div class="panel">
				<div class="panel-content">
					<div class="row">
						<div class="col-md-12">
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">News Title</label>
								  <div class="col-sm-9">
									  <input type="text" class="form-control" name="news_title" placeholder="Name">
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="username" class="col-sm-3 control-label">News Category</label>
								  <div class="col-sm-9">
										<select class="form-control select2js" style="width: 100%" name="categories[]" id="categories" multiple>
										  @foreach($categories as $category)
											<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										  @endforeach
										</select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="email3" class="col-sm-3 control-label">Featured Image</label>
								  <div class="col-sm-9">
									  <input type="file" class="form-control fileinput" name="featured_image" placeholder="Email">
								  </div>
							  </div>
							  
							  <div class="form-group">
								  <label for="password3" class="col-sm-3 control-label">Details</label>
								  <div class="col-sm-9">
									  <textarea id="news_details" name="news_details" style="height: 300px"></textarea>
								  </div>
							  </div>
							  
						   </form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-4">
			<h4 class="section-subtitle"><b>&nbsp;</h4>
			<div class="panel">
				<div class="panel-content">
					<div class="row">
					<label for="righticon" class="col-sm-2 control-label"><code>Language</code></label>
						<div class="col-sm-12">
							<div class="radio radio-custom radio-inline radio-primary">
								<input type="radio" id="ln_bn" name="language" value="bangla" checked>
								<label for="ln_bn">Bangla</label>
							</div>
							<div class="radio radio-custom radio-inline radio-primary">
								<input type="radio" id="ln_us" name="language" value="english">
								<label for="ln_us">English</label>
							</div>
						</div>
						
						<div class="col-sm-12" style="margin-top:15px">
								<a class="btn btn-primary savePostBtn" flag="0">Save as Draft</a>
								<a class="btn btn-success savePostBtn" flag="1">Publish</a>
						</div>
						

					</div>
				</div>
			</div>
		</div>
</div>
</form>
@endsection