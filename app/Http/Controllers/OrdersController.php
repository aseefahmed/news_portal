<?php

namespace App\Http\Controllers;

use App\Courier;
use App\District;
use App\DocType;
use App\ItemOrder;
use App\LocationOrder;
use App\Notification;
use App\Order;
use App\OrderStatus;
use App\ShipmentPurpose;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
	/*
	 * Order Flag
	 * 0 = Pending
	 * 1 = Approved
	 * 3 = Accepted by the courier
	 * 4 = Denied by the courier
	 * 5 = Assigned to the courier
	 */

	public function fetchOrdersList($order_status, $from_date=null, $to_date=null, $order_id=null)
	{
		$data['order_id'] = $order_id;
		$data['order_status'] = $order_status;
		$data['from_date'] = $from_date;

		if($from_date!='na' && isset($from_date))
			$data['from_date'] = substr($from_date, 0, 4)."-".substr($from_date, 4, 2)."-".substr($from_date, 6, 2);
		else if($from_date=='na' || !isset($from_date))
		{
			/* $year = Date('Y');
			$month = Date('m');
			$data['from_date']  = $year."-".$month."-01"; */
			$data['from_date']  = "";
		}
			
		
		if($to_date!='na' && isset($to_date))
			$data['to_date'] = substr($to_date, 0, 4)."-".substr($to_date, 4, 2)."-".substr($to_date, 6, 2);
		else if($to_date=='na' || !isset($to_date) )
		{
			/* $year = Date('Y');
			$month = Date('m');
			$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$data['to_date']  = $year."-".$month."-".$day; */
			$data['to_date']  = "";
		}

		if($order_status == 'pending')
		{
				$orders= DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('orders.flag', 0);
				if($order_id)
				{
					$orders = $orders->where('orders.id', $order_id);
				}
				$data['orders'] = $orders->orderBy('orders.id', 'desc')->select('orders.*', 'customers.name as sender_name')->paginate(10);

		}
		else if($order_status == 'approved')
		{
			if(Auth::user()->role == 1) // if Admin
			{
				$data['locations'] = DB::table('locations')->get();
				$orders = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', '!=', 0);
				if($order_id)
				{
					$orders = $orders->where('orders.id', $order_id);
				}
				$data['orders'] = $orders->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->paginate(10);
			}
			else if(Auth::user()->role == 3) // if Manager
			{
				$location_id = DB::table('locations')->where('manager_id', Auth::user()->id)->get();

				$data['locations'] = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
				$orders = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 1)->where('location_id', $location_id[0]->id);
				if($order_id)
				{
					$orders = $orders->where('orders.id', $order_id);
				}
				$data['orders'] = $orders->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name');
			}



		}
		else if($order_status == 'new')
		{
			$data['locations'] = DB::table('locations')->get();
			//$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', '!=', 0)->where('assigned_courier', Auth::user()->id)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.assigned_courier', Auth::user()->id)->where('order_statuses.status_type', 5);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'active')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->join('couriers', 'couriers.id', '=', 'orders.assigned_courier')->whereIn('orders.flag', [2,14, 18]);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'picked')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 2);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'dropped')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 3);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'transferred')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 4);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'hold')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 11);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'delivered')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 9);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'returned')
		{
			$data['locations'] = DB::table('locations')->get();
			$orders = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 10);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'delivered_request')
		{
			$data['locations'] = DB::table('locations')->get();
			$data['orders'] = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier');
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->where('orders.flag', 9)->where('orders.assigned_courier', Auth::user()->id)->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'list')
		{
			$data['locations'] = DB::table('locations')->get();
			$data['orders'] = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier');
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->paginate(10);
		}
		else if($order_status == 'assign')
		{
			$location_id = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
			$coverage_areas = DB::table('location_upazillas')->where('location_id', $location_id[0]->id)->get();
			$my_area = array();
			$i = 0;

			foreach ($coverage_areas as $area) {
				$my_area[$i] = $area->upazilla_id;
				$i++;
			}
			//$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('location_id', $location_id[0]->id)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
			$orders = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->leftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->whereIn('sender_upazilla', $my_area)->orWhere('branch_id', $location_id[0]->id);
			if($order_id)
			{
				$orders = $orders->where('orders.id', $order_id);
			}
			$data['orders'] = $orders->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->paginate(10);

		}
		
		return view('admin.orders', $data);
	}

	public function loadOrdersList()
	{
		$data['orders'] = DB::table('orders')->select('orders.flag')->get();
        
		return $data;
	}
	public function viewStatements(Request $request, $duration)
	{
		$data['duration'] = $duration;
		$data['orders'] = DB::table('orders')
			   ->select(DB::raw('count(id) as `total_orders`'), DB::raw("MONTH(created_at) as this_month"), DB::raw("YEAR(created_at) as this_year"), DB::raw("CONCAT_WS(', ',YEAR(created_at),MONTHNAME(created_at)) as monthyear"))
               ->groupBy('monthyear')
			   ->orderBy('this_month')
               ->get();
       $data['customers'] = DB::table('customers')
	       ->select(DB::raw('count(id) as `total_customers`'), DB::raw("MONTHNAME(created_at) as this_month"), DB::raw("YEAR(created_at) as this_year"), DB::raw("CONCAT_WS(', ',YEAR(created_at),MONTHNAME(created_at)) as monthyear"))
	       ->groupBy('monthyear')
	       ->get();
	    $data['no_of_customer'] = DB::table('customers')->count();
        if(Auth::user()->role == 9)
        {
            $data['no_of_order'] = DB::table('orders')->where('assigned_courier', Auth::user()->id)->where('flag', 5)->count();
            $data['no_of_order_delivered'] = DB::table('orders')->where('assigned_courier', Auth::user()->id)->where('flag', 9)->count();
            $data['no_of_order_pending'] = DB::table('orders')->where('assigned_courier', Auth::user()->id)->where('flag', 0)->count();
            $data['no_of_order_approved'] = DB::table('orders')->where('assigned_courier', Auth::user()->id)->where('flag', 1)->count();
        }
        else if(Auth::user()->role == 8)
        {
            $location = DB::table('locations')->where('manager_id', Auth::user()->id)->get();

            if(count($location) == 0)
            {

                $data['no_of_order'] = 0;
                $data['no_of_courier'] = 0;
                $data['no_of_order_delivered'] = 0;
                $data['no_of_order_pending'] = 0;
                $data['no_of_order_approved'] = 0;
            }
            else
            {

                $data['no_of_order'] = DB::table('orders')->where('location_id', $location[0]->id)->count();
                $data['no_of_courier'] = DB::table('courier_locations')->where('location_id', $location[0]->id)->count();
                $data['no_of_order_delivered'] = DB::table('orders')->where('branch_id', $location[0]->id)->where('flag', 9)->count();
                $data['no_of_order_pending'] = DB::table('orders')->where('branch_id', $location[0]->id)->where('flag', 0)->count();
                $data['no_of_order_approved'] = DB::table('orders')->where('branch_id', $location[0]->id)->where('flag', 1)->count();
            }
        }
        else
        {
            $data['no_of_order'] = DB::table('orders')->count();
            $data['no_of_order_delivered'] = DB::table('orders')->where('flag', 9)->count();
            $data['no_of_order_pending'] = DB::table('orders')->where('flag', 0)->count();
            $data['no_of_order_approved'] = DB::table('orders')->where('flag', 1)->count();
            $data['no_of_courier'] = DB::table('couriers')->count();
        }
        return $data;
        /*$pdf = PDF::loadView('welcome', $data);
		return $pdf->download('invoice.pdf');
		return view('statements.index', $data);*/
		
	}
	public function updateOrder(Request $request)
	{
		DB::table('orders')->where('id', $request->pk)->update(
				[
						$request->name => $request->value
				]
		);
	}

	public function findCustomerOrders(Request $request)
	{
		$data['orders'] = DB::table("orders")->where('user_id', $request->complain_customer_id)->get();
		return view('ajax_views.orders_list', $data);
	}

	public function viewReports()
	{
		if(Auth::user()->role == 9)
		{
			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('assigned_courier', Auth::user()->id)->where('flag', 9)->select('orders.*', 'customers.name')->get();
		}
		else if(Auth::user()->role == 8) 
		{
			$manager = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
			$data['couriers'] = DB::table('couriers')->join('courier_locations', 'courier_locations.courier_id', '=', 'couriers.id')->where('location_id', $manager[0]->id)->where('couriers.status', 'Confirmed')->select('couriers.*')->get();
			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('branch_id', $manager[0]->id)->where('flag', 9)->select('orders.*', 'customers.name')->get();

		}
		else if(Auth::user()->role == 1 || Auth::user()->role == 18 ) 
		{
			$data['couriers'] = DB::table('couriers')->where('couriers.status', 'Confirmed')->select('couriers.*')->get();
			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->select('orders.*', 'customers.name')->where('flag', 9)->get();
		}
		return view('accounts.accounts', $data);
	}

	public function filterAccountReport(Request $request)
	{
		if(Auth::user()->role == 9)
		{
			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('assigned_courier', Auth::user()->id)->where('pickup_date','>=', $request->from_date)->where('pickup_date','<=', $request->to_date)->where('flag', 9)->where('handedover', '')->select('orders.*', 'customers.name')->get();
		}
		else if(Auth::user()->role == 8)
		{
			
			$manager = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
			$data['couriers'] = DB::table('couriers')->join('courier_locations', 'courier_locations.courier_id', '=', 'couriers.id')->where('location_id', $manager[0]->id)->where('couriers.status', 'Confirmed')->select('couriers.*')->get();
			$orders = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('branch_id', $manager[0]->id)->where('pickup_date','>=', $request->from_date)->where('pickup_date','<=', $request->to_date)->where('flag', 9)->where('handedover', '');
			if($request->courier_id !="all")
				$orders->where('assigned_courier', $request->courier_id);
			$data['orders'] = $orders->select('orders.*', 'customers.name')->get();
		}
		else if(Auth::user()->role == 1 || Auth::user()->role == 18)
		{
			
			$data['couriers'] = DB::table('couriers')->where('couriers.status', 'Confirmed')->select('couriers.*')->get();
			$orders = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('pickup_date','>=', $request->from_date)->where('pickup_date','<=', $request->to_date)->where('flag', 9);
			if($request->courier_id !="all")
				$orders->where('assigned_courier', $request->courier_id);
			$data['orders'] = $orders->select('orders.*', 'customers.name')->get();
		}
		return view('accounts.accounts', $data);
	}


	public function handOverMoney($order_id, $flag="")
	{
		DB::table('orders')->where('id', $order_id)->update(
				[
					'handedover' => $flag
				]
			);
	}

	public function loadOrders($order_status)
	{
		if($order_status == 'pending')
		{
			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('orders.flag', 0)->select('orders.*', 'customers.name as sender_name')->get();
		}
		else if($order_status == 'approved')
		{
			if(Auth::user()->role == 1) // if Admin
			{
				$data['locations'] = DB::table('locations')->get();
				$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 1)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
			}
			else if(Auth::user()->role == 3) // if Manager
			{
				$location_id = DB::table('locations')->where('manager_id', Auth::user()->id)->get();

				$data['locations'] = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
				$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 1)->where('location_id', $location_id[0]->id)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
			}
			else if(Auth::user()->role == 9) // if Courier
			{
				$data['locations'] = DB::table('locations')->get();
				$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.flag', 1)->where('assigned_courier', Auth::user()->id)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
			}
		}
		else if($order_status == 'assign')
		{

			$data['locations'] = DB::table('locations')->where('manager_id', Auth::user()->id)->get();
			$location_id = DB::table('locations')->where('manager_id', Auth::user()->id)->get();

			$data['orders'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('location_id', $location_id[0]->id)->select('orders.*', 'customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->get();
		}
		return $data;
	}

	public function printReceipt($order_id)
	{
		$data['order'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->where('orders.id', $order_id)->select('orders.*', 'customers.name as customer_name', 'customers.email as customer_email')->get();
		$data['item_details'] = DB::table('item_orders')->where('order_id', $order_id)->get();
		return view("print_templates.order_receipt", $data);
	}
	public function deleteOrderDetails($id)
	{
		Order::find($id)->delete();
	}

	public function addOrder(Request $request)
	{
		$time = time();
		$order = new Order();
		$order->id = $time;
		$order->user_id = $request->user_id;
		$order->sender_phone = $request->sender_phone;
		$order->sender_street = $request->sender_street;
		/*$order->sender_address_1 = $request->sender_address_1;
		$order->sender_city = $request->sender_city;
		$order->sender_state = $request->sender_state;*/
		$order->sender_district = $request->sender_district;
		$order->sender_zipcode = $request->sender_zipcode;
		$order->sender_upazilla = $request->sender_upazilla;
		$order->sender_country = $request->sender_country;
		$order->reciever_name = $request->reciever_name;
		$order->reciever_email = $request->reciever_email;
		$order->reciever_phone = $request->reciever_phone;
		$order->reciever_street = $request->reciever_street;
		$order->receiver_district = $request->receiver_district;
		/*$order->reciever_address_1 = $request->reciever_address_1;
		$order->reciever_city = $request->reciever_city;
		$order->reciever_state = $request->reciever_state;*/

		$order->reciever_zipcode = $request->receiver_zipcode;
		$order->receiver_upazilla = $request->receiver_upazilla;
		$order->reciever_country = $request->reciever_country;
		$order->shipment_item_type = $request->doc_type;
		$order->pickup_date = $request->pickup_date;
		$order->shipping_cost = $request->shipping_amount;
		$order->shipment_purpose = $request->shipment_purpose;
		$order->created_at = Date('Y-m-d H:i:s');

		if(Auth::user()->role != 1)
		{
			$order->location_id = findManagerLocation(Auth::user()->id)[0]->id;
			$order->branch_id = findManagerLocation(Auth::user()->id)[0]->id;
		}
		else {
			$location = DB::table('location_upazillas')->where('upazilla_id', $request->sender_upazilla)->select('location_id')->get();
			$order->branch_id = $location[0]->location_id;
		}
		$order->payment_method = $request->payment_method;
		$customer_recievable = $request->shipping_amount;
		foreach($request->shipment_info as $item){

			$order_item = new ItemOrder();
			$order_item->order_id = $order->id;
			$order_item->item_name = $item[4];
			$order_item->qty = $item[5];
			$order_item->weight = $item[6];
			$order_item->item_price = $item[7];
			$order_item->sku = $item[8];
			$order_item->discount = $item[9];
			$order_item->subtotal = $item[10];
			$customer_recievable += $item[10];
			$order_item->height = $item[11];
			$order_item->width = $item[12];
			$order_item->length = $item[13];
		/*	$order_item->shipping_cost = $item[11];
			$order_item->total_cost = $item[12];*/
			$order_item->save();
		}
		$order->delivery_type = $request->delivery_type;

		$price = explode("_", $request->price);
		if($request->doc_type == 'parcel')
		{
			$order->shipping_time = $price[0];
			$order->price = $price[1];
		}
		else
		{
			$order->shipping_time = 72;
			$order->price = $request->price;
		}

		$order->customer_receivable = $customer_recievable;
		$order->flag = 0;
		//$order->tracking_id = time().uniqid();
		$order->save();

		$customer = findCustomerDetails($order->user_id);
		$district_details = findDistrictDetails($request->sender_district);
		$order_status = new OrderStatus();
		$order_status->user_id = Auth::user()->id;
		$order_status->order_id = $time;
		$order_status->courier_id = 0;
		$order_status->status_title = "Order has been generated by ".Auth::user()->first_name." ".Auth::user()->last_name;
		$order_status->public_status_title = "Order Created by ".$customer[0]->name.", ".$district_details[0]->name. " at ".date_format(date_create($order->created_at), 'g:s A, dS M, Y');
		$order_status->description = '';
		$order_status->status_type = 0; // Order has been created
		$order_status->save();

		return $order->id;
	}

	public function denyOrder(Request $request)
	{
		DB::table('order_statuses')->where('order_id', $request->order_id)->update(
				[
						'status_type' => null
				]
		);
		$courier = Courier::where('id', $request->courier_id)->get();
		$order_status = new OrderStatus();
		$order_status->user_id = Auth::user()->id;
		$order_status->order_id = $request->order_id;
		$order_status->courier_id = $request->courier_id;
		$order_status->status_title = "Order has been denied by ".$courier[0]->first_name." ".$courier[0]->last_name;
		if($request->deny_reason == "Other")
		{
			$order_status->description = $request->deny_reason_2;
		}
		else
		{
			$order_status->description = $request->deny_reason;
		}

		$order_status->status_type = 15; // Order denied by the courier
		$order_status->save();

		$order = DB::table('orders')->where('id', $request->order_id)->update(
				[
						'flag' => 15, // Denied by courier
						'assigned_courier' => 0,
				]
		);

		$notification  = new Notification();
		$notification->user_id = findBranchManagerByOrderId($order_status->order_id);
		$notification->order_id = $order_status->order_id;
		$notification->flag = '0';
		$notification->description = $order_status->status_title;
		$notification->save();
	}

	public function AcceptOrder(Request $request)
	{
		DB::table('order_statuses')->where('order_id', $request->order_id)->update(
				[
						'status_type' => null
				]
		);
		$courier = Courier::where('id', $request->courier_id)->get();
		$order_status = new OrderStatus();
		$order_status->user_id = Auth::user()->id;
		$order_status->order_id = $request->order_id;
		$order_status->courier_id = $request->courier_id;
		$order_status->status_title = "Order has been accepted by ".$courier[0]->first_name." ".$courier[0]->last_name;
		$order_status->description = "";
		$order_status->status_type = 14; // Order accepted by the courier
		$order = DB::table('orders')->where('id', $request->order_id)->update(
				[
						'flag' => 14, // Accepted by courier
				]
		);
		$order_status->save();

		$notification  = new Notification();
		$notification->user_id = findBranchManagerByOrderId($order_status->order_id);
		$notification->order_id = $order_status->order_id;
		$notification->flag = '0';
		$notification->description = $order_status->status_title;
		$notification->save();
	}
	public function filterSearchOrder(Request $request)
	{
		echo 4;
	}

	public function handoverAll($data)
	{
		$results = explode("_", $data);
		
		foreach($results as $result)
		{
			DB::table('orders')->where('id', $result)->update(['handedover'=>'3']);
		}
		return $results;
	}

	public function disburseMoney($data)
	{
		$results = explode("_", $data);
		
		foreach($results as $result)
		{
			$payment_date = Date('Y-m-d');
			DB::table('orders')->where('id', $result)->update(['customer_receivable_status'=>'2', 'payment_date'=>$payment_date]);
		}
		return $results;
	}
	public function getUpazilla($dist_id)
	{
		$data['upazillas'] = DB::table('upazillas')->join('location_upazillas', 'location_upazillas.upazilla_id', '=', 'upazillas.id')->where('district_id', $dist_id)->orderBy('name')->select('upazillas.id','upazillas.name')->get();
		return view('ajax_views.upazillas', $data);
	}
	public function getOrderDetails($id)
	{
		$data['complains'] = DB::table('complains')->where('order_id', $id)->get();
		$data['order'] = DB::table('orders')->join('customers', 'customers.id', '=', 'orders.user_id')->join('districts as sender_dist', 'sender_dist.id', '=', 'orders.sender_district')->join('upazillas as sender_upazilla', 'sender_upazilla.id', '=', 'orders.sender_upazilla')->join('upazillas as receiver_upazilla', 'receiver_upazilla.id', '=', 'orders.receiver_upazilla')->join('districts as receiver_dist', 'receiver_dist.id', '=', 'orders.receiver_district')->leftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.id', $id)->select('orders.*', 'customers.name', 'customers.email', 'sender_dist.name as sender_district', 'receiver_dist.name as receiver_district', 'sender_upazilla.name as sender_upazilla_name', 'receiver_upazilla.name as receiver_upazilla', 'couriers.first_name', 'couriers.last_name')->get();
		$data['items'] = DB::table('item_orders')->where('order_id', $id)->get();
		$data['order_statuses'] = DB::table('order_statuses')->leftJoin('users', 'users.id', '=', 'order_statuses.user_id')->leftJoin('couriers', 'couriers.id', '=', 'order_statuses.courier_id')->leftJoin('orders', 'orders.id', '=', 'order_statuses.order_id')->where('orders.id', $id)->select('orders.*', 'order_statuses.status_type', 'order_statuses.description', 'order_statuses.status_title', 'order_statuses.created_at')->get();
		$data['locations'] = DB::table('locations')->where('flag', 1)->get();
		/*Mail::send('email.demo', ['user' => $data], function ($m) use ($data) {
			$m->from('aseefahmed@gmail.com', 'Your Application');

			$m->to('aseefahmed@gmail.com', "Aseef Ahmed")->subject('Your Reminder!');
		});*/

		return view('admin.order_details', $data);
	}

	public function trackOrder($tracking_id)
	{
		///$data['locations'] = DB::table('locations')->get();
		$data['orders'] = DB::table('order_statuses')->join('orders', 'orders.id', '=', 'order_statuses.order_id')->join('customers', 'customers.id', '=', 'orders.user_id')->LeftJoin('couriers', 'couriers.id', '=', 'orders.assigned_courier')->where('orders.id', $tracking_id)->orWhere('orders.sender_phone', $tracking_id)->select('orders.*','customers.name as sender_name', 'couriers.first_name as c_first_name' , 'couriers.last_name as c_last_name')->distinct('order_id')->get();
		$data['tracking_id'] = $tracking_id;
		return view('admin.track_list', $data);
	}

	public function assignCourier($order_id, $courier_id, $location_id)
	{
		$courier = DB::table('couriers')->where('id', $courier_id)->get();
		DB::table('orders')->where('id', $order_id)->update(
				[
						'assigned_courier' => $courier_id,
						'location_id' => $location_id,
						'flag' => 5 // assigned to courier
				]
		);

		$order = new OrderStatus();
		$order->user_id = Auth::user()->id;
		$order->order_id = $order_id;
		$order->courier_id = $courier_id;
		$order->status_type = 5;
		$order->status_title = "Order has been assigned to courier by ".Auth::user()->first_name." ".Auth::user()->last_name." to ".$courier[0]->first_name." ".$courier[0]->last_name;
		$order->public_status_title = "Order has been assigned to rider.";
		$order->save();


		DB::table('location_order')->insert(
				[
						'order_id' => $order_id,
						'courier_id' => $courier_id,
						'location_id' => $location_id,
				]
		);

		$notification  = new Notification();
		$notification->user_id = $courier_id;
		$notification->order_id = $order_id;
		$notification->flag = '0';
		$notification->description = "Order has been assigned to you.";
		$notification->save();
	}
	public function changeStatus($order_id, $status, $location_id=null)
	{
		if($location_id != 0)
		{
			$arr = [
					'flag' => $status,
					'location_id' => $location_id,
					'branch_id' => $location_id,
			];
		}
		else
		{
			$arr = [
					'flag' => $status,
			];
		}
		DB::table('orders')->where('id', $order_id)->update($arr);

		$order_status = new OrderStatus();
		$order_status->id = time();
		$order_status->user_id = Auth::user()->id;
		$order_status->order_id = $order_id;
		$order_status->courier_id = 0;

		$email_data['branch_manager'] = findBranchManagerEmail($order_id);
		if($status == 1)
		{
			$order_status->status_title = "Order has been approved by ". Auth::user()->first_name." ".Auth::user()->last_name;
			$order_status->public_status_title = "Order has been accepted.";

			/*$email_data['details'] = $order_status->status_title;

			Mail::send('email.order_status_changed', ['info' => $email_data], function ($m) use($email_data){
            $m->from('aseefahmed@gmail.com', 'NRB Express');

            $m->to($email_data['branch_manager'])->subject('Notification! Order status has been changed.');
       		 });*/
		}
		else if($status == 2)
		{
			$order_status->status_title = "Order has been Picked Up by ".Auth::user()->first_name." ".Auth::user()->last_name;
			$order_status->public_status_title = "Order has been pickup up.";
		}
		else if($status == 3)
		{
			$loc = findLocationDetails($location_id);
			$order_status->status_title = "Order has been Dropped Off to ".$loc[0]->location_name." by ".Auth::user()->first_name." ".Auth::user()->last_name;
			$courier_location = findCourierLocation(Auth::user()->id);
			$courier_location = $courier_location[0]->location_name;
			$order_status->public_status_title = "Dispatched From ".$courier_location." hub  to ".$loc[0]->location_name." hub.";
		}
		else if($status == 4)
		{
			$order_status->status_title = "Order has been Transferred to the nearest branch by ".Auth::user()->first_name." ".Auth::user()->last_name;
		}
		else if($status == 18)
		{
			$courier_location = findCourierLocation(Auth::user()->id);
			$courier_location = $courier_location[0]->location_name;
			$order_status->status_title = "Courier ".Auth::user()->first_name." ".Auth::user()->last_name." went for delivery from ${courier_location}. ";
			$order_status->public_status_title = "Rider went for delivery";
		}
		else if($status == 19)
		{
			$branch_manager_location = findManagerLocation(Auth::user()->id);
			$order_status->status_title = "Parcel has been arrived to ".$branch_manager_location[0]->location_name." hub.";

			$order_status->public_status_title = "Arrived to ".$branch_manager_location[0]->location_name." hub.";
		}
		else if($status == 5)
		{
			$order_status->status_title = "Order has been assigned to a courier ".Auth::user()->first_name." ".Auth::user()->last_name;
			$order_status->public_status_title = "Order has been assigned to rider.";
		}
		else if($status == 11)
		{
			$order_status->status_title = "Order has been Hold on by ".Auth::user()->first_name." ".Auth::user()->last_name;
		}
		else if($status == 9)
		{
			$order_status->status_title = "Order has been delivered by	". Auth::user()->first_name." ".Auth::user()->last_name;
			$order_status->public_status_title = "Order has been delivered.";
			DB::table('orders')->where('id', $order_id)->update(
					[
						'delivery_time' => date("Y-m-d H:i:s", time())
					]
			);
		}
		else if($status == 10)
		{
			$order_status->status_title = "Order has been returned ".Auth::user()->first_name." ".Auth::user()->last_name;
		}

		$order_status->description = "";
		$order_status->status_type = 1; // Order has been approved
		$order_status->save();

		$notification  = new Notification();
		$notification->user_id = findBranchManagerByOrderId($order_status->order_id);
		$notification->order_id = $order_status->order_id;
		$notification->flag = '0';
		$notification->description = $order_status->status_title;
		$notification->save();

	}

	public function changeNotificationStatus($notification_id, $order_id)
	{
		DB::table('notifications')->where('id', $notification_id)->update(
				[
					'flag' => '1'
				]
		);

		return redirect('dashboard/order/'.$order_id);
	}
	public function loadAddOrderForm()
	{
		$data['districts'] = District::OrderBy('name')->get();
		$data['doc_types'] = DocType::get();
		$data['shipment_purposes'] = ShipmentPurpose::get();
		return view('admin.add_order_form', $data);
	}
	
	/////////////////////////Mobile APIs//////////////////////////////////////////
	
}
