<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Customer;
use App\Order;
use App\Permission;
use App\PermissionUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mail;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function viewLoginForm()
    {
        if (Auth::viaRemember()) {
            return redirect('dashboard');
        }
        else {
            return view('login.index');
        }

    }

    public function processRecoverPassword(Request $request)
    {
        $user_count = DB::table('users')->where('email', $request->recovered_email)->count();
        if($user_count == 0)
        {
            return -1;
        }
        else 
        {
            $verification_code = md5(uniqid());
            DB::table('users')->where('email', $request->recovered_email)->update(
                    [

                        'reset_verification_code' => $verification_code,
                        'password_reseted' => 0,
                        'reset_verification_code_sent_at' => date_format(date_create(Date('Y-m-d H:i:s')),'Y-m-d H:i:s'),
                    ]
                );

            $user = DB::table('users')->where('email', $request->recovered_email)->get();
            Mail::send('email.reset_password', ['user' => $user], function ($m) use ($user) {
                $m->from('info@nrbxpress.com', 'NRB Express');

                $m->to($user[0]->email)->subject('Recover your password.');
            });
            return -2;
        }
    }

    public function loadRecoverPasswordForm($verification_code)
    {
        $count = DB::table('users')->where('reset_verification_code', $verification_code)->where('password_reseted', 0)->count();
        if($count > 0)
        {
                $password = rand(100000, 999999);
                DB::table('users')->where('reset_verification_code', $verification_code)->update(
                    [

                        'password' => Hash::make($password),
                        'password_reseted' => 1
                    ]
                );

                $user = DB::table('users')->where('reset_verification_code', $verification_code)->get();

                Mail::send('email.password_reset_done', ['user' => $user, 'password' => $password], function ($m) use ($user) {
                    $m->from('info@nrbxpress.com', 'NRB Express');

                    $m->to($user[0]->email)->subject('You password has been reset');
                });  
                return view("pages.password_reset_notification"); 
        }
        else 
        {
            
                return view("pages.error"); 
        }
    }

    public function processLogin(Request $request)
    {
        $user = User::where('email', $request->username)->get();
        if($user[0]->role == 9)
        {
            $courier = Courier::where('email', $request->username)->get();

            if($courier[0]->status == 'Inactive')
            {
                return 2;
            }
        }
        if(!empty($request->rememeber))
        {
            $rememberme = true;
        }
        else
        {
            $rememberme = false;
        }

        if(Auth::attempt(['email' => $request->username, 'password' => $request->password], $rememberme))
        {
            return 1;
        }
        else
        {
            return -1;
        }
    }

    public function checkEmail(Request $request)
    {
        if($request->user_type == 'clients')
        {
            $count = Customer::where('email', $request->email)->count();
        }
        else if($request->user_type == 'employees')
        {
            $count = User::where('email', $request->email)->count();
        }

        if($count == 1)
            return -1;
        else if($count == 0)
            return 1;
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function getUserDetails($id)
    {
        $data['user'] = Customer::where('id', $id)->select('customers.email', 'customers.phone', 'customers.account_type')->get();
        $data['user_details'] = DB::table('orders')->where('user_id', $id)->get();
        $data['addresses_list'] = DB::table('orders')->where('user_id', $id)->select('sender_street')->distinct('sender_street')->get();
        return $data;
    }

    public function fetchReceiverDetails($name)
    {
        $data['user_details'] = Order::where('reciever_name', $name)->select('reciever_street')->distinct('reciever_street')->get();
        return $data;
    }
    public function loadUsersList($user_type)
    {
        $data['user_type'] = $user_type;
        $data['users'] = DB::table('users')->join('roles', 'users.role', '=', 'roles.id')->where('users.role', '!=', 0)->select('users.*', 'roles.name as role_name')->orderBy('first_name', 'asc')->orderBy('last_name', 'desc')->paginate(10);
        $data['permissions'] = DB::table('cms_categories')->get();
        return view('admin.users_list', $data);
    }

    public function resetPassword(Request $request)
    {
        $user = User::findOrFail(1);

        Mail::send('email.demo', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, 'NRBExpress')->subject('Your Reminder!');
        });
        echo 'Basics Email was sent!';
    }
    public function forgetPassword()
    {
        return view('login.forget-password');
    }

    public function getUsersList($user_type)
    {
        if($user_type == 'clients')
        {
            $data['users'] = Customer::orderBy('name', 'asc')->get();
        }
        else
        {
            $data['users'] = DB::table('users')->join('roles', 'users.role', '=', 'roles.id')->where('users.role', '!=', 0)->select('users.*', 'roles.name as role_name')->get();
        }

        return $data;

    }

    public function registerUser(Request $request)
    {
        $count = User::where('email', $request->email_address)->count();
        if($count > 0)
            return -1; // Email address already exists
        else
        {

            if($request->account_type)
            {
                $customer = new Customer();
                $customer->name = $request->first_name;
                $customer->account_type = $request->account_type;
                $customer->email = $request->email_address;
                $customer->phone = $request->phone;
                $customer->region = $request->region;
                $customer->password = Hash::make($request->email);
                $customer->status = 1;
                $customer->save();
            }
            else
            {
                $user = new User();
                $user->id = time();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email_address;
                $user->password = Hash::make($request->password);
                $user->role = $request->role;
                $user->save();
                if(count($request->permissions) > 0 )
                {
                    foreach($request->permissions as $permission)
                    {
                        $user_permission = new PermissionUser();
                        $user_permission->user_id = $user->id;
                        $user_permission->category_id = $permission;
                        $user_permission->save();
                    }
                }
            }
        }
    }

    public function viewRoles()
    {
        return view('admin.roles');
    }

    public function changePassword($id=null)
    {
        if($id)
        {
            $data['id'] = $id;
            $data['email'] = User::where('id', $id)->get()[0]->email;
        }
        else
        {
            $data['id'] = Auth::user()->id;
            $data['email'] = Auth::user()->email;
        }
        return view('admin.change_password_form', $data);
    }

    public function generatePassword($id=null)
    {
        if($id)
        {
            $data['id'] = $id;
            $courier = Courier::where('id', $id)->select('email', 'first_name', 'last_name')->get();
            $data['email'] = $courier[0]->email;
            $data['first_name'] = $courier[0]->first_name;
            $data['last_name'] = $courier[0]->last_name;
        }
        else
        {
            $data['id'] = Auth::user()->id;
            $data['email'] = Auth::user()->email;
        }
        return view('admin.add_password_form', $data);
    }

    public function doGeneratePassword(Request $request)
    {

        $user = new User();
        $user->id = $request->id;
        $user->email = $request->new_email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->new_password);
        $user->role = 9;
        $user->save();
        return 2;
    }

    public function doPasswordUpdate(Request $request)
    {
        $user = User::find($request->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        } else
        {
            return -1;
        }


    }

    public function viewPermissions()
    {
        return view('admin.permissions');
    }

    public function getRoles()
    {
        $data['roles'] = Role::get();
        return $data;
    }

    public function addRoles(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->name = $request->name;
        $role->save();
    }

    public function getPermissions()
    {
        $data['permissions'] = Permission::get();
        return $data;
    }

    public function addPermissions(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
    }

    public function deleteUser($user_type, $id)
    {
        $data['user_type'] = $user_type;
        if($user_type == 'clients')
        {
            DB::table('customers')->where('id', $id)->delete();
        }
        else if($user_type == 'employees')
        {
            DB::table('users')->where('id', $id)->delete();
        }
    }

    public function viewUserDetails($user_type, $id)
    {
        $data['user_type'] = $user_type;
        if($user_type == 'employees')
        {
            $data['user'] = DB::table('users')->join('roles', 'roles.id', '=', 'users.role')->where('users.id', $id)->select('users.*', 'roles.name as role_name')->get();
        }
        else if($user_type == 'clients')
        {
            $data['user'] = DB::table('customers')->where('id', $id)->get();
        }

        return view('admin.user_details', $data);
    }

    public function updateUser(Request $request)
    {
		$arr = Array();
		if($request->photo){
            $file_extension = $request->file('photo')->guessExtension();
            $file_name = "photo_".time().".".$file_extension;
            $request->file('photo')->move('../uploads/images/pictures', $file_name);
			
			if($request->user_type == 'clients')
			{
				$arr = [
						'name' => $request->name,
						'email' => $request->email,
						'account_type' => $request->account_type,
						'image' => $file_name,
					];
				
				
				$user = DB::table('customers')->where('id', $request->user_id)->update($arr);
			}
			else if($request->user_type == 'employees')
			{
				$arr = [
						'first_name' => $request->first_name,
						'last_name' => $request->last_name,
						'email' => $request->email,
						'role' => $request->role,
						'image' => $file_name,
					];
					
				$user = DB::table('users')->where('id', $request->user_id)->update($arr);

			}
            
        }else{
            if($request->user_type == 'clients')
			{
				$arr = [
						'name' => $request->name,
						'email' => $request->email,
						'account_type' => $request->account_type
					];
				
				
				$user = DB::table('customers')->where('id', $request->user_id)->update($arr);
			}
			else if($request->user_type == 'employees')
			{
				$arr = [
						'first_name' => $request->first_name,
						'last_name' => $request->last_name,
						'email' => $request->email,
						'role' => $request->role
					];
					
				$user = DB::table('users')->where('id', $request->user_id)->update($arr);

			}
        }
		
        
    }

    public function editUserDetails($user_type, $id)
    {
        $data['user_type'] = $user_type;
        $data['roles'] = DB::table('roles')->get();
        if($user_type == 'employees')
        {
            $data['user'] = DB::table('users')->join('roles', 'roles.id', '=', 'users.role')->where('users.id', $id)->select('users.*', 'roles.name as role_name')->get();
        }
        else if($user_type == 'clients')
        {
            $data['user'] = DB::table('customers')->where('id', $id)->get();
        }

        return view('admin.edit_user_details', $data);
    }

    public function assignPermission($role_id)
    {
        $data['role_id'] = $role_id;
        $data['role'] = Role::where('id', $role_id)->get();
        return view('admin.assign_permissions', $data);
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('/');
    }

    public function assignPermissionToRole($val, $role, $permission_id)
    {
        $count = DB::table('permission_role')->where('role_id', $role)->where('permission_id', $permission_id)->count();
        if($count == 1)
        {
            DB::table('permission_role')->where('role_id', $role)->where('permission_id', $permission_id)->delete();
        }
        else
        {
            $result = DB::table('permission_role')->insert([
                'permission_id' => $permission_id,
                'role_id' => $role
            ]);
        }


    }
	
	//////////////////////////////Mobile APIs////////////////////////////////
	public function processMobileLogin(Request $request)
    {
		$data['image_base_url'] = "http://www.nrbxpress.com/uploads/images/pictures/";
        $user = User::where('email', $request->username)->where('device_type', $request->device_type)->where('device_token', $request->device_token	)->get();
		if(count($user) == 0)
		{
			$data['status'] = "error";
			$data['message'] = "Login credintials did not match.";
			return $data;
		}
        if($user[0]->role == 9)
        {
            $courier = Courier::where('email', $request->username)->get();
			$courier_pic = $courier[0]->picture;
            if($courier[0]->status == 'Inactive')
            {
				$data['status'] = "error";
				$data['message'] = "The courier is not active.";
                return $data;
            }
        }
        if(!empty($request->rememeber))
        {
            $rememberme = true;
        }
        else
        {
            $rememberme = false;
        }

        if(Auth::attempt(['email' => $request->username, 'password' => $request->password], $rememberme))
        {
			$data['status'] = "success";
			$data['message'] = "Login has been successfull.";
			$data['role'] = $user[0]->role;
			$data['users_details'] = $user[0];
			if($user[0]->role == 9)
			{
				$data['users_details']['image']= $courier_pic;
			}
            return $data;
        }
        else
        {
            return -1;
        }
    }
}
