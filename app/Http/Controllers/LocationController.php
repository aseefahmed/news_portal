<?php

namespace App\Http\Controllers;

use App\Courier;
use App\CourierLocation;
use App\Cycle;
use App\Location;
use App\LocationUpazilla;
use App\Upazilla;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function fetchLocationsList()
    {
        $data['locations'] = DB::table('locations')->join('users', 'users.id', '=', 'locations.manager_id')->where('locations.flag', 1)->select('locations.*', 'users.first_name', 'users.last_name')->get();
        $data['users'] = User::get();
        return view('admin.locations', $data);
    }

    public function loadLocations()
    {
        $data['locations'] = Location::where('flag', 1)->get();
        return $data;
    }

    public function deleteLocation($id)
    {
        DB::table('locations')->where('id', $id)->update(
            [
                'flag' => 0
            ]
        );
    }

    public function updateLocation(Request $request)
    {
        if($request->contact_name == 0)
        {
            $arr = [
                'location_name' => $request->location_name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
            ];
        }
        else
        {

            $arr = [
                'location_name' => $request->location_name,
                'address' => $request->address,
                'manager_id' => $request->contact_name,
                'contact_number' => $request->contact_number,
            ];
        }
        $location = DB::table('locations')->where('id', $request->id)->update($arr);
    }
    public function updateCycle(Request $request)
    {
        $cycle = Cycle::find($request->id);
        $cycle->bicycle_number = $request->cycle_number ;
        $cycle->given_date = $request->given_date ;
        $cycle->comments = $request->comments ;
        if($request->courier_id != "")
            $cycle->courier_id = $request->courier_id ;
        $cycle->save();
    }

    public function deleteCycle($id)
    {
        DB::table('cycles')->where('id', $id)->update(
            [
                'flag' => 0
            ]
        );
    }
    public function getLocations($id)
    {
        $data['locations'] = Location::where('id', $id)->get();
        return $data;
    }
    public function getCycles($id)
    {
        $data['cycles'] = Cycle::where('id', $id)->get();
        return $data;
    }
    public function getLocationbasedCourier($id)
    {
        $data['couriers'] = DB::table('courier_locations')->leftJoin('couriers', 'couriers.id', '=', 'courier_locations.courier_id')->where('courier_locations.location_id', $id)->where('couriers.status', 'Confirmed')->get();
        return view('ajax_views.couriers_list', $data);
    }

    public function loadEditLocationForm()
    {
        return view('admin.edit_location_form');
    }
    public function addLocation(Request $request)
    {
        $location = new Location();
        $location->location_name = $request->location_name;
        $location->address = $request->address;
        $location->manager_id = $request->contact_name;
        $location->contact_number = $request->contact_number;
        $location->flag = 1;
        $location->save();
    }
    public function addCycle(Request $request)
    {
        $location = new Cycle();
        $location->bicycle_number = $request->bicycle_number;
        $location->courier_id = $request->courier_id;
        $location->given_date = $request->given_date;
        $location->comments = $request->comments;
        $location->flag = 1;
        $location->save();
    }

    public function addAreaToLocation(Request $request)
    {
        $area_location = new LocationUpazilla();
        $area_location->location_id = $request->location_id;
        $area_location->upazilla_id = $request->area_id;
        $area_location->save();
    }
    public function viewLocation($id)
    {
        $data['location'] = Location::join('users', 'users.id', '=', 'locations.manager_id')->where('locations.id', $id)->select('locations.*', 'users.first_name', 'users.last_name')->get();
        $data['couriers'] = Courier::where('status', 'Confirmed')->get();
        $data['areas'] = Upazilla::where('district_id', 1)->OrderBy('name', 'asc')->get();
        $data['coverate_areas'] = DB::table('location_upazillas')->join('upazillas', 'upazillas.id', '=', 'location_upazillas.upazilla_id')->where('location_id', $id)->OrderBy('upazillas.name', 'asc')->select('upazillas.name', 'location_upazillas.upazilla_id', 'location_upazillas.location_id')->get();
        return view('admin.location_details', $data);
    }

    public function addCourierToLocation(Request $request)
    {
         $courier_location = new CourierLocation();
         $courier_location->location_id = $request->location_id;
         $courier_location->courier_id = $request->courier_id;
         $courier_location->save();


    }

    public function removeAreaFromLocation($area_id)
    {
        return DB::table('location_upazillas')->where('upazilla_id', $area_id)->delete();
    }
    public function checkCycleNumber($number)
    {
        $data['count'] = DB::table('cycles')->where('bicycle_number', $number)->count();
        return $data;
    }
    public function fetchCyclesList()
    {
        $data['cycles'] = DB::table('cycles')->join('couriers', 'couriers.id', '=', 'cycles.courier_id')->where('flag', 1)->select('cycles.*', 'couriers.first_name as courier_first_name', 'couriers.last_name as courier_last_name')->get();
        $data['couriers'] = Courier::get();
        return view('admin.cycles', $data);
    }
    public function getLocationBasedCouriersList($loc_id)
    {
        $data['couriers'] = DB::table('courier_locations')->leftJoin('couriers', 'couriers.id', '=', 'courier_locations.courier_id')->where('courier_locations.location_id', $loc_id)->where('couriers.status', 'Confirmed')->select('couriers.id','couriers.first_name','couriers.last_name', 'couriers.email', 'couriers.contact_no_work', 'couriers.blood_group', 'couriers.dob', 'couriers.picture')->get();
        return $data;
    }
}
