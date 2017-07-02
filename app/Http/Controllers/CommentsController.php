<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function index()
	{
		$data['comments'] = DB::table('comments')->paginate(10);
		return view('comments.index', $data);
	}
	
	public function removeComment($id, $flag)
	{
		DB::table('comments')->where('id', $id)->update([
			'flag' => $flag //deleted
		]);
	}
}
