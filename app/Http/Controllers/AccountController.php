<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Account;

class AccountController extends Controller
{
    public function loadDepositForm()
	{
		if(Auth::user()->role != 12)
		{
			$manager = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
			$data['employees'] = DB::table('users')->get();
			$data['orders'] = DB::table('orders')->where('branch_id', $manager[0]->id)->where('paid', '')->get();
			$data['accounts'] = DB::table('accounts')->where('user_id', Auth::user()->id)->paginate(10);
			
		}
		else 
		{
			$data['accounts'] = DB::table('accounts')->where('is_accepted', '0')->paginate(10);
		}
			
		return view('accounts.deposit_form', $data);
	}
	
	public function acceptAmount($id, $flag)
	{
		
		DB::table('accounts')->where('id', $id)->update(
			[
				'is_accepted' => $flag
			]
		); 
		
		if($flag == 1)
		{
			$orders = DB::table('accounts')->where('id', $id)->get();
			//return $orders[0]->orders;
			$orderlists = unserialize($orders[0]->orders);
			foreach($orderlists as $order)
			{
				DB::table('orders')->where('id', $order)->update(
					[
						'customer_receivable_status' => '1' //approved
					]
				);
			} 
		}
		//return unserialize($orders[0]->orders);
	}
	
	public function showDisburseStatus()
	{
		/* $data['customers'] = DB::table('orders')->select('user_id', 
										DB::raw('count(*) as total_orders'), 
										DB::raw('SUM(customer_receivable) as total_receivable_amount'), 
										DB::raw('SUM(price) as nrb_receivable_amount'), 
										DB::raw('SUM(customer_received_amount) as total_received_amount'))
										->groupBy('user_id')->get(); */
		$data['customers'] = DB::table('orders')->where('customer_receivable', '>', 0)->where('customer_receivable_status', 1)->get();
		return view('accounts.disburse', $data);
	}
	public function submitDeposit(Request $request)
	{
		$account = new Account();
		$account->id = time();
		$account->payment_method = $request->payment_method;
		$account->bank = $request->bank;
		$account->acc_no = $request->account;
		$account->ref = $request->ref;
		$account->amount = $request->amount;
		if($request->payment_method == "cash")
		{
			$account->cash_receiver = $request->cash_receiver;
		}
		$account->user_id = Auth::user()->id;
		$account->orders = serialize($request->orders) ;
		if($request->receipt){
            $file_extension = $request->file('receipt')->guessExtension();
            $file_name = "bank_receipt_".time().".".$file_extension;
            $request->file('receipt')->move('../uploads/bank_receipts', $file_name);
            $account->receipt = $file_name;
        }
		$account->save();
		$arr = array();
		if(count($request->orders) > 0)
		{
			foreach($request->orders as $order)
			{
				array_push($arr, $order);
			}
		}
		DB::table('orders')->whereIn('id', $arr)->update(['paid'=>'1']);
		return $arr;
	}
}
