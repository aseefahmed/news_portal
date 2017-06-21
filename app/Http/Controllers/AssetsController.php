<?php
namespace App\Http\Controllers;

use App\Courier;
use App\Asset;
use Validator;
use Session;
use Redirect;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class AssetsController extends Controller
{
    public function add()
	{
		$data['couriers'] = Courier::where('status', 'Confirmed')->get();
		return view('admin.add_assets', $data);	
	}
	
	/*protected function validator(array $data)
    {
        return Validator::make($data, [
            'courier_id' => 'required',
            'given_date' => 'required',
        ]);
    }*/
	
	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
   /* protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }*/
	
	public function store(Request $request)
	{	
		$courier_id = $request->input('courier_id');
		$given_date = $request->input('given_date');
		$comments = $request->input('comments');
		$item_name = $request->input('item_name');
		$item_description = array_filter($request->input('item_description'));
		$created_date = date("Y-m-d H:i:s");
		$updated_date = date("Y-m-d H:i:s");
		
		$i=0;
		foreach($item_description as $key=> $item_description_value)
		{
			DB::insert('INSERT INTO courier_assets_list (courier_id, item_name, item_description, created_at, updated_at) VALUES (?,?,?,?,?)', array($courier_id, $item_name[$i], $item_description_value, $created_date, $updated_date));
			$i++;
		}		
		DB::insert('INSERT INTO assets (courier_id, given_date, comment, created_at, updated_at) VALUES (?,?,?,?,?)', array($courier_id, $given_date, $comments, $created_date, $updated_date));			
		return  redirect()->back()->with('flash-message','Courier Assets Information Saved successfully!'); 
		
		//$request->session()->flash('status', 'Courier Assets Information Saved successfully!');
		//Session::flash('status', 'Courier Assets Information Saved successfully!');
		//return redirect('/dashboard/assets/add');
		
		//return redirect()->back()->with('status', 'IT WORKS!');
		
		/*if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::back()->withErrors($messages)->withInput($request->all()); 
		}*/
		//return redirect()->back()->with('status', 'IT WORKS!');	
    	//return redirect('/dashboard/assets/add');
	}
	
	public function fetchAssetsList()
    {
        $data['couriers'] = Courier::get();
		$data['assets'] = DB::table('assets')->join('couriers', 'couriers.id', '=', 'assets.courier_id')->select('assets.*', 'couriers.first_name as courier_first_name', 'couriers.last_name as courier_last_name')->get();
        return view('admin.assets', $data);
    }
	
	public function viewAssets($id) {
		$data['asset'] = DB::table('assets')->join('couriers', 'couriers.id', '=', 'assets.courier_id')->where('assets.id', $id)->select('assets.*', 'couriers.first_name as courier_first_name', 'couriers.last_name as courier_last_name')->get();
		//dd($data['asset'][0]->courier_id);
		$data['asset_list'] = DB::table('courier_assets_list')->join('couriers', 'couriers.id', '=', 'courier_assets_list.courier_id')->where('courier_assets_list.courier_id', $data['asset'][0]->courier_id)->select('courier_assets_list.*')->get();
        return view('admin.assets_details', $data);
	}
}
