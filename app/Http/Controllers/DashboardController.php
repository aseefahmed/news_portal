<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $data['no_of_customer'] = 12;
        $data['no_of_order'] = 12;
        $data['no_of_order_delivered'] = 12;
        $data['no_of_order_pending'] = 12;
        $data['no_of_order_approved'] = 12;
        $data['no_of_courier'] = 12;
     
        return view('admin.dashboard', $data);
    }
}
