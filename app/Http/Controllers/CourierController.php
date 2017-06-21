<?php

namespace App\Http\Controllers;

use App\Courier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CourierController extends Controller
{
    public function fetchCouriersList()
    {
        $data['couriers'] = Courier::where('status', '!=', 'Deleted')->paginate(10);
        return view('admin.couriers', $data);
    }



    public function loadCouriers()
    {
        $data['couriers'] = Courier::get();
        return $data;
    }

    public function viewCourierDetails($id)
    {
        $data['courier'] = Courier::where('id', $id)->get();
        $data['references'] = json_decode( $data['courier'][0]->references);
        $data['count'] = User::where('id', $id)->count(); //check where the courier exists in users table
        return view('admin.courier_details', $data);
    }

    public function editCourierDetails($id)
    {
        $data['courier'] = Courier::where('id', $id)->get();
        $data['references'] = json_decode( $data['courier'][0]->references);

        return view('admin.edit_courier_details', $data);
    }
    public function loadAddCourierForm()
    {
        return view('admin.add_courier_form');
    }

    public function updateCourier(Request $request)
    {
        DB::table('couriers')->where('id', $request->id)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'religion' => $request->religion,
                'nationality' => $request->nationality,
                'national_id_number' => $request->national_id_number,
                'blood_group' => $request->blood_group,
                'maritial_status' => $request->maritial_status,
                'contact_no_home' => $request->contact_no_home,
                'contact_no_work' => $request->contact_no_work,
                'contact_no_other' => $request->contact_no_other,
                'permanent_address' => $request->permanent_address,
                'present_address' => $request->present_address,
                'comments' => $request->comments,
                'status' => $request->status,
            ]
        );

        $courier = Courier::find($request->id);
        if($request->photo){
            $file_extension = $request->file('photo')->guessExtension();
            $photo_file_name = "photo_".time().".".$file_extension;
            $request->file('photo')->move('../uploads/images/pictures', $photo_file_name);
            $courier->picture = $photo_file_name;
        }
        if($request->cv){
            $file_extension = $request->file('cv')->guessExtension();
            $file_name = "cv_".time().".".$file_extension;
            $request->file('cv')->move('../uploads/images/courier/resume', $file_name);
            $courier->cv = $file_name;
        }
        if($request->national_id_number_doc){
            $file_extension = $request->file('national_id_number_doc')->guessExtension();
            $ni_file_name = "ni_".time().".".$file_extension;
            $request->file('national_id_number_doc')->move('../uploads/images/courier/ni', $ni_file_name);
            $courier->national_id_number_doc = $ni_file_name;
        }
        $courier->save();
    }

    public function viewSummeries()
    {

        //$data['couriers'] = Courier::where('status', '!=', 'Deleted')->get();
        if(Auth::user()->role == 1)
        {
            $location = findManagerLocation(Auth::user()->id);
            $data['my_location'] = $location;
            $data['couriers'] = DB::table('couriers')->leftJoin('orders', 'orders.assigned_courier', '=', 'couriers.id')->where('couriers.status', '!=', 'Deleted')->groupBy('couriers.id')->select('couriers.*', DB::raw('count(orders.assigned_courier) as total_assigned_task'))->get();
        }
        else
        {
            $location = findManagerLocation(Auth::user()->id);
            $data['my_location'] = $location;
            $data['couriers'] = DB::table('couriers')->leftJoin('orders', 'orders.assigned_courier', '=', 'couriers.id')->where('couriers.status', '!=', 'Deleted')->groupBy('couriers.id')->select('couriers.*', DB::raw('count(orders.assigned_courier) as total_assigned_task'))->get();
        }

        return view('admin.couriers_summeries', $data);
    }

    public function deleteCourier($id)
    {
        DB::table('couriers')->where('id', $id)->update(
            [
                'status' => 'Deleted'
            ]
        );
        return redirect('dashboard/couriers/all');
    }

    public function addCourier(Request $request)
    {
        $count = User::where('email', $request->email)->count();
        if($count == 1)
        {
            return -1;
        }
        $time = time();
        $user = new User();
        $user->id = $time;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 9;
        $user->save();

        $courier = Courier::create($request->all());
        $courier->id = $time;
        $courier->present_address = $request->present_address;
        $courier->permanent_address = $request->permanent_address;
        $courier->references = $request->references;
        $courier->experiences = $request->experiences;
        $courier->status = 'Confirmed';

        if($request->cv){
            $file_extension = $request->file('cv')->guessExtension();
            $file_name = "cv_".time().".".$file_extension;
            $request->file('cv')->move('../uploads/images/courier/resume', $file_name);

            $courier->cv = $file_name;
        }else{
            $file_name = "";
        }
        if($request->police_verification){
            $file_extension = $request->file('police_verification')->guessExtension();
            $file_name = "police_verification_".time().".".$file_extension;
            $request->file('police_verification')->move('../uploads/images/courier/police_verifications', $file_name);
        }else{
            $file_name = "";
        }
        if($request->experience_certificate){
            $file_extension = $request->file('experience_certificate')->guessExtension();
            $file_name = "experience_certificate_".time().".".$file_extension;
            $request->file('experience_certificate')->move('../uploads/images/courier/experience_certificates', $file_name);
        }else{
            $file_name = "";
        }
        if($request->national_id_number_doc){
            $file_extension = $request->file('national_id_number_doc')->guessExtension();
            $ni_file_name = "ni_".time().".".$file_extension;
            $request->file('national_id_number_doc')->move('../uploads/images/courier/ni', $ni_file_name);

            $courier->national_id_number_doc = $ni_file_name;
        }else{
            $ni_file_name = "";
        }
        if($request->dob_doc){
            $file_extension = $request->file('dob_doc')->guessExtension();
            $dob_file_name = "dob_".time().".".$file_extension;
            $request->file('dob_doc')->move('../uploads/images/courier/dob', $dob_file_name);

            $courier->dob_doc = $dob_file_name;
        }else{
            $dob_file_name = "";
        }
        if($request->address_verification_doc){
            $file_extension = $request->file('address_verification_doc')->guessExtension();
            $address_file_name = "address_".time().".".$file_extension;
            $request->file('address_verification_doc')->move('../uploads/images/courier/address', $address_file_name);

            $courier->address_verification_doc = $address_file_name;
        }else{
            $address_file_name = "";
        }
        if($request->exp_certificate){
            $file_extension = $request->file('exp_certificate')->guessExtension();
            $exp_certificate = "exp_certificate_".time().".".$file_extension;
            $request->file('exp_certificate')->move('../uploads/images/courier/exp_certificate', $exp_certificate);

            $courier->exp_certificate = $exp_certificate;
        }else{
            $exp_certificate = "";
        }
        if($request->photo){
            $file_extension = $request->file('photo')->guessExtension();
            $photo_file_name = "photo_".time().".".$file_extension;
            $request->file('photo')->move('../uploads/images/pictures', $photo_file_name);

            $courier->picture = $photo_file_name;
        }else{
            $photo_file_name = "";
        }

        if($courier->save())
        {
            return $user->id;
        }
    }

    public function removeFromBranch($courier_id)
    {
        DB::table("courier_locations")->where('courier_id', $courier_id)->delete();
    }

    public function changeCourierStatus($courier_id, $flag)
    {

        if($flag == 'Confirmed')
        {
            DB::table('couriers')->where('id', $courier_id)->update([
                'status' => 'Inactive'
            ]);

            return 'Inactive';
        }
        else
        {
            DB::table('couriers')->where('id', $courier_id)->update([
                'status' => 'Confirmed'
            ]);
            $courier = DB::table('couriers')->where('id', $courier_id)->get();
            $count = DB::table('users')->where('email', $courier[0]->email)->count();
            if($count == 0)
            {
                $user = new User();
                $user->id = $courier_id;
                $user->first_name = $courier[0]->first_name;
                $user->last_name = $courier[0]->last_name;
                $user->email = $courier[0]->email;
                $user->temporary_password = mt_rand(100000, 999999);
                $user->password = Hash::make($user->temporary_password);
                $user->save();
            }


            return 'Confirmed';
        }
    }


}
