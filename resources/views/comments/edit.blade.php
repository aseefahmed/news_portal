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
    <script src="//cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
	<script src="{{ asset('public/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<form class="form-horizontal form-stripe" id="editNewsForm">
<div class="row animated fadeInUp" ng-controller="NewsController">

	<input type="hidden" name="flag" id="flag">
	<input type="hidden" name="news_id" value="{{ $news[0]->id }}">
	{{ csrf_field() }}
		<div class="col-sm-12 col-md-8">
			<h4 class="section-subtitle"><b>News</b> Details</h4>
			<div class="panel">
				<div class="panel-content">
					<div class="row">
						<div class="col-md-12">
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">News Title</label>
								  <div class="col-sm-9">
								  <input type="text" class="form-control" name="news_title" placeholder="Name" value="{{ $news[0]->title }}">
								  </div>
							  </div>
							  
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Status</label>
								  <div class="col-sm-9">
								    <div class="col-sm-12">
										<div class="radio radio-custom radio-inline radio-primary">
											<input type="radio" id="flag_{{$news[0]->flag}}" name="flag" value="0" <?php if($news[0]->flag==0){echo "checked";} ?>>
											<label for="flag_{{$news[0]->flag}}">Draft</label>
										</div>
										<div class="radio radio-custom radio-inline radio-primary">
											<input type="radio" id="ln_us" name="flag" value="1" <?php if($news[0]->flag==1){echo "checked";} ?>>
											<label for="ln_us">Publish</label>
										</div>
									</div>
								  </div>
							  </div>
							    <?php 
									$cat_arr = array();
									foreach(findNewsCategories($news[0]->id) as $cat)
									{
										array_push($cat_arr, $cat->category_name);
									}
								?>
							  <div class="form-group">
								  <label for="username" class="col-sm-3 control-label">News Category</label>
								  <div class="col-sm-9">
										<select <?php if(Auth::user()->role == 2){echo "disabled";} ?> class="form-control select2js" style="width: 100%" name="categories[]" id="categories" multiple>
										  @foreach($categories as $category)
											<option value="{{ $category->id }}" <?php if(in_array($category->category_name, $cat_arr)){echo "selected";} ?>>{{ $category->category_name }}</option>
										  @endforeach
										</select>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Language</label>
								  <div class="col-sm-9">
								    <div class="col-sm-12">
										<div class="radio radio-custom radio-inline radio-primary">
											<input type="radio" id="ln_bn" name="language" value="bangla" <?php if($news[0]->language=='bangla'){echo "checked";} ?>>
											<label for="ln_bn">Bangla</label>
										</div>
										<div class="radio radio-custom radio-inline radio-primary">
											<input type="radio" id="ln_us" name="language" value="english" <?php if($news[0]->language=='english'){echo "checked";} ?>>
											<label for="ln_us">English</label>
										</div>
									</div>
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
									<textarea id="news_details" name="news_details" style="height: 300px">{{ $news[0]->details }}</textarea>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="password3" class="col-sm-3 control-label">&nbsp;</label>
								  <div class="col-sm-9">
									<a class="btn btn-success" id="updateNewsBtn" news_id="{{ $news[0]->id }}">Update</a>
								  </div>
							  </div>
							  
						   </form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-4">
			<a class="btn btn-success btn-block" href="{{ url('news/view/'.$news[0]->id) }}">Preview</a>
			<div class="panel b-primary bt-sm ">
                <div class="panel-header">
                    <h5 class="panel-title">Featured Image</h5>
                </div>
                <div class="panel-content text-center" style="height:300px;">
                 
                            <img class="img1 text-center col-md-12" src="{{ asset('public/images/news/featured/'.$news[0]->featured_image) }}" height="250px;">
                       
                </div>
            </div>
		</div>
</div>
</form>
@endsection