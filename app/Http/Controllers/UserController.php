<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Users_location;
use App\Users_location_ar;
use App\Booking;
use App\Booking_ar;
use Route;
use Session;

class UserController extends Controller
{
    public function all_users(){
        $this->admins();
        $users = DB::table('users')->orderBy('id','asc')->get();
        if(Session::get('lang') == "en") {
            return view('cp.users.all_users',['users'=>$users]);
        }else{
            return view('cp-ar.users.all_users',['users'=>$users]);
        }
    }

    public function add_user(){
        $this->admins();
        if(Session::get('lang') == "en") {
            return view('cp.users.add_user');
        }else{
            return view('cp-ar.users.add_user');
        }
    }

    public function insert_user(Request $request){
        $this->admins();
        $data = $this->validate(request(),
            [
                'name'             =>'required|min:6',
                'email'            =>'required|email',
                'password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                'c_password'       =>'required|same:password',
                'phone1'           =>'required|unique:users|min:10|max:16|regex:/(?=[0-9])*/',
                //'phone2'           =>'min:10|max:16|regex:/(?=[0-9])*/',
            ],[],
            [
                'name'             =>'name must contains characters &',
                'email'            =>'email must be like [example@example.com] &',
                'password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                'c_password'       =>'password confirmation',
                'phone1'           =>'Phone Number',
                //'phone2'           =>'Another Phone Number',
            ]
        );

        if(md5($_POST['password']) == md5($_POST['c_password'])){
            if($_POST['phone1'] != $_POST['phone2']) {
                $userData = DB::table('users')
                    ->where("email", "=", $_POST['email'])
                    ->get();
                if (sizeof($userData) < 1) {
                    if ($request->file('photo')) {
                        $filenameWithExtention = $request->file('photo')->getClientOriginalName();
                        $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                        $extention = $request->file('photo')->getClientOriginalExtension();
                        $fileNameStore = $fileName . '_' . time() . '.' . $extention;
                        $path = $request->file('photo')->storeAs('public/user_images', $fileNameStore);
                        $add            = new User();
                        $add->name      = $_POST['name'];
                        $add->email     = $_POST['email'];
                        $add->password  = md5($_POST['password']);
                        $add->phone1    = $_POST['phone1'];
                        $add->phone2    = $_POST['phone2'];
                        $add->photo     = $fileNameStore;
                        $add->save();
                    }else{
                        $add            = new User();
                        $add->name      = $_POST['name'];
                        $add->email     = $_POST['email'];
                        $add->password  = md5($_POST['password']);
                        $add->phone1    = $_POST['phone1'];
                        $add->phone2    = $_POST['phone2'];
                        $add->save();
                    }
                    if(Session::get('lang') == "en") {
                        return redirect('/all/users');
                    }else{
                        return redirect('/ar/all/users');
                    }
                } else {
                    session()->flash('insert_message', 'email alrady exists, Try another email. . .');
                    if(Session::get('lang') == "en") {
                        return redirect('/add/user');
                    }else{
                        return redirect('/ar/add/user');
                    }
                }
            }else{
                session()->flash('insert_message', 'You must enter different two phone numbers');
                if(Session::get('lang') == "en") {
                    return redirect('/add/user');
                }else{
                    return redirect('/ar/add/user');
                }
            }
        } else{
            session()->flash('insert_message','Wrong password Confirmation. . .');
            if(Session::get('lang') == "en") {
                return redirect('/add/user');
            }else{
                return redirect('/ar/add/user');
            }
        }
    }

    public function edit_user($id){
        $this->admins();
        $users=DB::table('users')
            ->where('id', '=' ,Route::input('id'))->get();
        if(Session::get('lang') == "en") {
            return view('cp.users.edit_user',['users'=>$users]);
        }else{
            return view('cp-ar.users.edit_user',['users'=>$users]);
        }
    }

    public function update_user(Request $request,$id){
        $this->admins();
        $data = $this->validate(request(),
            [
                'name'             =>'required|min:6',
                'email'            =>'required|email',
                'password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                'c_password'       =>'required|same:password',
                'phone1'           =>'required|unique:users|min:10|max:16|regex:/(?=[0-9])*/',
                //'phone2'           =>'min:10|max:16|regex:/(?=[0-9])*/',
            ],[],
            [
                'name'             =>'name must contains characters &',
                'email'            =>'email must be like [example@example.com] &',
                'password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                'c_password'       =>'password confirmation',
                'phone1'           =>'Phone Number',
                //'phone2'           =>'Another Phone Number',
            ]
        );
        if(request('phone1') != request('phone2')) {
            if ($request->file('photo')) {
                $filenameWithExtention = $request->file('photo')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
                $extention = $request->file('photo')->getClientOriginalExtension();
                $fileNameStore = $fileName . '_' . time() . '.' . $extention;
                $path = $request->file('photo')->storeAs('public/user_images', $fileNameStore);
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name'      => request('name'),
                        'email'     => request('email'),
                        'phone1'    => request('phone1'),
                        'phone2'    => request('phone2'),
                        'photo'     => $fileNameStore,
                    ]);
            }else{
                DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'name'      => request('name'),
                        'email'     => request('email'),
                        'phone1'    => request('phone1'),
                        'phone2'    => request('phone2'),
                    ]);
            }
            session()->flash('insert_message', 'Record updated successfully');
            if(Session::get('lang') == "en") {
                return redirect('/all/users');
            }else{
                return redirect('/ar/all/users');
            }
        }else{
            session()->flash('insert_message', 'You must enter different two phone numbers');
            if(Session::get('lang') == "en") {
                return redirect('/edit/user/' . $id);
            }else{
                return redirect('/ar/edit/user/' . $id);
            }
        }
    }

    public function delete_user($id){
        $this->admins();
        User::destroy($id);
        $userLocations = DB::table('users_locations')
            ->where("user_id","=",$id)->get();
        foreach ($userLocations as $location){
            Users_location::destroy($location->l_id);
        }
        $userLocations_ar = DB::table('users_locations_ar')
            ->where("user_id","=",$id)->get();
        foreach ($userLocations_ar as $location_ar){
            Users_location_ar::destroy($location_ar->l_id);
        }
        //
        $bookings = DB::table('bookings')
            ->where("user_id","=",$id)->get();
        foreach ($bookings as $booking){
            Booking::destroy($booking->b_id_generator);
        }
        $bookings_ar = DB::table('bookings_ar')
            ->where("user_id","=",$id)->get();
        foreach ($bookings_ar as $booking_ar){
            Booking_ar::destroy($booking_ar->b_id_generator);
        }
        return back();
    }
}
