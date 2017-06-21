<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Complain;

use App\Http\Requests;

class ComplainController extends Controller
{
    public function index()
    {
    	$data['complains'] = DB::table('complains')->get();
    	$data['customers'] = DB::table('customers')->get();
    	return view('complains.index', $data);
    }

    public function submitCustomerComplain(Request $request)
    {
    	$complain = new Complain();
    	$complain->user_id = $request->complain_customer_id;
    	$complain->order_id = $request->customer_order_ref;
    	$complain->details = $request->complain_details;
    	$complain->flag = 0; // 0= Complain not resolved yet; 1 = complain resolved
    	$complain->save();

    }

    public function resolveComplain($id, $flag)
    {
    	DB::table('complains')->where('id', $id)->update(
    			[
    				'flag' => $flag
    			]
    		);
    	
    }
}
