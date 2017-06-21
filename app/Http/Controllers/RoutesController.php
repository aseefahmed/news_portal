<?php

namespace App\Http\Controllers;

use App\District;
use App\PriceChart;
use App\ShippingRate;
use App\Route;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RoutesController extends Controller
{
    public function fetchRoutesList()
    {
        $data['districts'] = District::get();
        $data['routes'] = DB::table('routes')->join('districts as sender', 'routes.from', '=', 'sender.id')->join('districts as receiver', 'routes.to', '=', 'receiver.id')->where('routes.flag', 1)->select('routes.id as id','sender.name as sender_dist', 'receiver.name as receiver_dist','sender.id as sender_dist_id', 'receiver.id as receiver_dist_id')->get();
        return view('admin.routes', $data);
    }

    public function getRouteDetails($id)
    {
		$data['packages'] = DB::table('shipping_packages')->get();
        $data['route'] = DB::table('routes')->join('districts as sender', 'routes.from', '=', 'sender.id')->join('districts as receiver', 'routes.to', '=', 'receiver.id')->where('routes.id', $id)->select('routes.id as id','sender.name as sender_dist', 'receiver.name as receiver_dist')->get();
        $data['prices'] = PriceChart::where('route_id',$id)->get();
        return view('admin.route_details', $data);
    }

    public function getDistrictList()
    {
        $data['districts'] = District::get();
        return $data;
    }

    public function deleteRoute($id)
    {
        DB::table('routes')->where('id', $id)->update(
            [
                'flag' => 0
            ]
        );
    }

    public function updateRoute(Request $request)
    {
        DB::table('routes')->where('id', $request->id)->update(
            [
                'from' => $request->sender_dist_id,
                'to' => $request->receiver_dist_id,
            ]
        );
    }

    public function addRoute()
    {

        return view('admin.add_route_form');
    }

    public function addPrice( Request $request)
    {
        $data['price'] = json_encode($request->all());
		$shipping_rate = new ShippingRate();
		
		$shipping_rate->weight = $request->weight;
		$shipping_rate->package_id = $request->delivery_type;
		$shipping_rate->hr_3 = $request->hr3;
		$shipping_rate->hr_4 = $request->hr4;
		$shipping_rate->hr_7 = $request->hr7;
		$shipping_rate->hr_8 = $request->hr8;
		$shipping_rate->hr_12 = $request->hr12;
		$shipping_rate->hr_24 = $request->hr24;
		$shipping_rate->hr_48 = $request->hr48;
		$shipping_rate->hr_120 = $request->hr120;
		$shipping_rate->save();
        /* $price_chart = new PriceChart();
        $price_chart->route_id	= $request->route_id;
        $price_chart->delivery_type	= $request->delivery_type;
        $price_chart->price_details	= $data['price'];
        $price_chart->weight	= $request->weight;
        $price_chart->save(); */

    }

    public function getPriceQuotion(Request $request)
    {
    $count = Route::where('from', $request->from)->where('to', $request->to)->count();

    if($count == 0)
    {
        return -1;
    }
    else
    {
        $route_id = Route::where('from', $request->from)->where('to', $request->to)->get();
        if($route_id[0]->id)
        {
            $price = PriceChart::where('route_id', $route_id[0]->id)->where('weight', $request->total_weight)->get();
            $price_count = PriceChart::where('route_id', $route_id[0]->id)->where('weight', $request->total_weight)->count();
            if($price_count == 0)
            {
                return -1;
            }
            else
            {
                //$price = json_decode($price);
                $pricelist = Array();
                $time = time();

                foreach($price as $key=>$prc)
                {
                    $pricelist[$key]['delivery_type'] = json_decode($prc->price_details)->delivery_type;
                    $pricelist[$key]['weight'] = json_decode($prc->price_details)->weight;
                    $pricelist[$key]['hr8'] = json_decode($prc->price_details)->hr8;
                    $pricelist[$key]['hr12'] = json_decode($prc->price_details)->hr12;
                    $pricelist[$key]['hr24'] = json_decode($prc->price_details)->hr24;
                    $pricelist[$key]['hr48'] = json_decode($prc->price_details)->hr48;
                    $pricelist[$key]['hr120'] = json_decode($prc->price_details)->hr120;
                    /*$pricelist[$key]['hr1'] = json_decode($prc->price_details)->hr1;
                    $pricelist[$key]['hr2'] = json_decode($prc->price_details)->hr2;*/
                    $pricelist[$key]['hr3'] = json_decode($prc->price_details)->hr3;
                    $pricelist[$key]['hr4'] = json_decode($prc->price_details)->hr4;
                    $pricelist[$key]['hr5'] = json_decode($prc->price_details)->hr5;
                }
                return $pricelist;
            }

        }
    }

}

    public function addNewRoute(Request $request)
    {
        $route = new Route();
        $route->from = $request->from;
        $route->to = $request->to;

        $route->flag = 1;

        $route->save();
    }

    public function getRelaventDistricts($id)
    {
        $data['districts'] = District::get();
        return $data;
    }
}
