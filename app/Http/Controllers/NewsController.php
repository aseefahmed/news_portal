<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\NewsType;

use App\Http\Requests;

class NewsController extends Controller
{
    public function index()
    {
    	if(Auth::user()->role == 1)
    	{
    			$data['news_list'] = DB::table('news')->get();
    	}
    	else if(Auth::user()->role == 3)
    	{
    			$data['news_list'] = DB::table('news')->where('created_by', Auth::user()->id)->get();
    	}
    	return view('news.index', $data);
    }

    public function addNews()
    {
		$data['categories'] = DB::table('cms_categories')->get();
    	return view('news.add', $data);
    }
	
	public function submitNews(Request $request)
	{
		$news = new News();
		$news->id = time();
		$news->title = $request->news_title;
		$news->details = $request->news_details;
		$news->flag = $request->flag;
		$news->created_by = Auth::user()->id;
		$news->language = $request->language;
		if($request->featured_image){
            $file_extension = $request->file('featured_image')->guessExtension();
            $file_name = "featured_images_".time().".".$file_extension;
            $request->file('featured_image')->move('public/images/news/featured', $file_name);

            $news->featured_image = $file_name;
        }else{
            $file_name = "";
        }
		$news->save();
		if(count($request->categories) > 0 )
		{
			foreach($request->categories as $category)
			{
				$news_types = new NewsType();
				$news_types->news_id = $news->id;
				$news_types->category_id = $category;
				$news_types->save();
			}
		}
	}
	
	public function viewNews($id)
	{
		$data['news'] = DB::table('news')->where('id', $id)->get();
		return view('news.details', $data);
	}
	
	public function removeNews($id)
	{
		DB::table('news')->where('id', $id)->delete();
	}
	
	public function editNews($id)
	{
		$data['news'] = DB::table('news')->where('id', $id)->get();
		$data['categories'] = DB::table('cms_categories')->get();
		return view('news.edit', $data);
	}
	
	public function editNewsSubmit(Request $request)
	{
		$news = News::find($request->id);
		$news->title = $request->news_title;
		$news->language = $request->language;
		$news->details = $request->news_details;
		$news->flag = $request->flag;
		if($request->featured_image){
            $file_extension = $request->file('featured_image')->guessExtension();
            $file_name = "featured_images_".time().".".$file_extension;
            $request->file('featured_image')->move('public/images/news/featured', $file_name);

            $news->featured_image = $file_name;
        }
		$news->save();
		if(count($request->categories) > 0 )
		{
			foreach($request->categories as $category)
			{
				$news_types = new NewsType();
				$news_types->news_id = $news->id;
				$news_types->category_id = $category;
				$news_types->save();
			}
		}
		
		
	}
}
