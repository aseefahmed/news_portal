@extends('layouts.admin.dashboard')
@section('content')
<form class="form-horizontal form-stripe" id="addNewsForm">
<div class="row animated fadeInUp" ng-controller="NewsController">

	<input type="hidden" name="flag" id="flag">
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
								  {{ $news[0]->title }}
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Status</label>
								  <div class="col-sm-9">
								  @if($news[0]->flag == 0)
										<span class="badge x-warning">Draft</span>
									@elseif($news[0]->flag == 1)
										<span class="badge x-info">Published</span>
									@endif
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Created At</label>
								  <div class="col-sm-9">
								  {{ date_format(date_create($news[0]->created_at), 'g:s A, dS M, Y') }}
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Last Modified At</label>
								  <div class="col-sm-9">
								  {{ date_format(date_create($news[0]->updated_at), 'g:s A, dS M, Y') }}
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Categories</label>
								  <div class="col-sm-9">
									<?php 
										$str = "";
										foreach(findNewsCategories($news[0]->id) as $cat)
										{
											$str = $str."<code>$cat->category_name</code>/";
										}
										echo substr($str, 0, -1);
										if(strlen($str) == 0)
											echo "<code>Not Categorized</code>";
									?>
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Tags</label>
								  <div class="col-sm-9">
									<?php 
										$str = "";
										foreach(findNewsTags($news[0]->id) as $cat)
										{
											$str = $str."<code>$cat->tag_name</code>/";
										}
										echo substr($str, 0, -1);
										if(strlen($str) == 0)
											echo "<code>Not Tagged</code>";
									?>
								  </div>
							  </div>
							  
							  <div class="form-group">
								  <label for="name" class="col-sm-3 control-label">Language</label>
								  <div class="col-sm-9">
								  {{ ucwords($news[0]->language) }}
								  </div>
							  </div>
							  <div class="form-group">
								  <label for="password3" class="col-sm-3 control-label">Details</label>
								  <div class="col-sm-9">
									<?php 
										echo $news[0]->details;
									?>
								  </div>
							  </div>
							  
						   </form>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-4">
			<a class="btn btn-success btn-block" href="{{ url('news/edit/'.$news[0]->id) }}">Modify This News</a>
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