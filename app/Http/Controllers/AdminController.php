<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin;
use App\User;
use App\Comment;
Use App\Booking;
use App\Company;

use Session;

class AdminController extends Controller
{
    public function indexCompany(){
        return view('indexCompany');
    }

    public function indexCompany_ar(){
        return view('indexCompany-ar');
    }

    public function indexcp(){
        return view('indexcp');
    }
    public function indexcp_ar(){
        return view('indexcp-ar');
    }

    public function content(){
        $this->admins();
        if(Session::get('lang') == "en") {
            return view('cp.parts.content');
        }else{
            return view('cp-ar.parts.content');
        }
    }

    public function __construct()
    {
        return view("cp.signin.login");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function forget_password() {
        return view("cp.signin.forgetpass");
    }

    public function newpassword(){
        return view("cp.signin.newpass");
    }

    public function login_newpassword(){
        $data = $this->validate(request(),
            [
                'a_email'         =>'required|email',
                'a_password'      =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                'a_c_password'    =>'required|same:a_password',
            ],[],
            [
                'a_email'         =>'email must be like [example@example.com] &',
                'a_password'      =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                'a_c_password'    =>'password confirmation',
            ]
        );
        if(md5($_POST['a_password']) == md5($_POST['a_c_password'])){
            $admin=DB::table('admins')->where("a_email","=",$_POST['a_email'])->get();
            if(sizeof($admin) > 0){
                DB::table('admins')
                    ->where('a_email',"=",$_POST['a_email'])
                    ->update([
                        'a_password' => md5($_POST['a_password'])
                    ]);
                session_start();
                Session::put('a_email',$_POST['a_email']);
                return redirect('/');
            }else{
                session()->flash('insert_message','email Not Found, Try again. . .');
                return redirect('/');
            }
        }else{
            session()->flash('insert_message','password Confirmation Error, Try again. . .');
            return redirect('/newpassword');
        }
    }

    public function logout(Request $request) {
        if(Session::get('lang') == "en") {
            Session::flush();
            $_POST = array();
            return redirect('/');
        }else{
            Session::flush();
            $_POST = array();
            return redirect('/ar');
        }
    }

    public function loginPage(){
        Session::put('lang',"en");
        return view("cp.signin.login");
    }
    public function loginPage_ar(){
        Session::put('lang',"ar");
        return view("cp-ar.signin.login");
    }

    public function login(Request $request){
        $data = $this->validate(request(),
            [
                'a_email'     =>'required',
                'a_password'  =>'required',
            ],[],
            [
                'a_email'     =>'a_email',
                'a_password'  =>'a_password',
            ]
        );
        $adminData = DB::table('admins')
            ->where("a_email"   ,    "=", $_POST['a_email'])
            ->where("a_password",    "=", md5($_POST['a_password']))
            ->get();
        if(sizeof($adminData) < 1){
            if(Session::get('lang') == "en") {
                session()->flash('insert_message','Wrong email or password');
                return redirect('login');
            }else{
                session()->flash('insert_message','خطأ في البريد الالكتروني او كلمة المرور');
                return redirect('ar/login');
            }
        }else{
            Session::put('a_email',$_POST['a_email']);
            Session::put('subadmin',"0");
            if(Session::get('lang') == "en") {
                return redirect('/');
            }else{
                return redirect('/ar');
            }
        }
    }

    public function registerPage(){
        return view("cp.signin.register");
    }

    public function register(){
        $data = $this->validate(request(),
            [
                'a_name'             =>'required|min:6||max:20|regex:/(?=[a-zA-Z])+(?=[0-9])*/',
                'a_email'            =>'required|email|unique:admins',
                'a_password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                'a_c_password'       =>'required|same:a_password',
            ],[],
            [
                'a_name'             =>'name must contains characters &',
                'a_email'            =>'email must be like [example@example.com] &',
                'a_password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                'a_c_password'       =>'password confirmation',
            ]
        );
        if(md5($_POST['a_password']) == md5($_POST['a_c_password'])){
            $adminData = DB::table('admins')
                ->where("a_email",    "=", $_POST['a_email'])
                ->get();
            if(sizeof($adminData) < 1){
                $add                  = new Admin();
                $add->a_name        = $_POST['a_name'];
                $add->a_email         = $_POST['a_email'];
                $add->a_password      = md5($_POST['a_password']);
                $add->save();

                session_start();
                Session::put('subadmin',"0");
                Session::put('a_email',$_POST['a_email']);

                return redirect('/');
            }else{
                session()->flash('insert_message','email alrady exists, Try another email. . .');
                return redirect('/registerx501');
            }
        }
        else{
            session()->flash('insert_message','Wrong password Confirmation. . .');
            return redirect('/registerx501');
        }
    }

}
