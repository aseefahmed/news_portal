<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function index()
    {
		$data['catagories'] = DB::table('cms_categories')->paginate(10);
    	return view('categories.index', $data);
    }

    public function addCategories()
    {
    	return view('categories.add');
    }
	
	public function submitCategories(Request $request)
	{
		DB::table('cms_categories')->insert([
			'category_name' => $request->category_name
		]);
		
	}
}
