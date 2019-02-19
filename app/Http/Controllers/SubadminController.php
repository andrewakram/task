<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Subadmin;
use App\Subadmin_ar;
use Route;
use Session;


class SubadminController extends Controller
{
    public function loginCompany(){
        $data = $this->validate(request(),
            [
                's_a_email'         =>'required',
                's_a_password'      =>'required',
            ],[],
            [
                's_a_email'         =>'Email',
                's_a_password'      =>'Password',
            ]
        );
        $subadminsData = DB::table('subadmins')
            ->where("s_a_email"   ,    "=", $_POST['s_a_email'])
            ->where("s_a_password",    "=", md5($_POST['s_a_password']))
            ->get();
        if(sizeof($subadminsData) < 1){
            if(Session::get('lang') == "en") {
                session()->flash('insert_message','Wrong email or password');
                return redirect('/');
            }else{
                session()->flash('insert_message','خطأ في البريد الالكتروني او كلمة المرور');
                return redirect('/ar');
            }
        }else{
            Session::put('a_email',$_POST['s_a_email']);
            Session::put('subadmin',"1");
            if(Session::get('lang') == "en") {
                return redirect('/cp');
            }else{
                return redirect('/ar/cp');
            }
        }
    }

    public function all_subadmins(){
        $this->admins();
        if(Session::get('lang') == "en") {
            $subadmins = DB::table('subadmins')->orderBy('s_a_id','desc')
                ->join("companies","companies.c_id","subadmins.company_id")
                ->select('s_a_id','c_name',
                    's_a_email','subadmins.created_at',
                    'subadmins.deleted_at')
                ->get();
            return view('cp.subadmins.all_subadmins',['subadmins'=>$subadmins]);
        }else{
            $subadmins = DB::table('subadmins_ar')->orderBy('s_a_id','desc')
                ->join("companies_ar","companies_ar.c_id","subadmins_ar.company_id")
                ->select('s_a_id','c_name',
                    's_a_email','subadmins_ar.created_at',
                    'subadmins_ar.deleted_at')
                    ->get();
            return view('cp-ar.subadmins.all_subadmins',['subadmins'=>$subadmins]);
        }
    }

    public function add_subadmin(){
        $this->admins();
        if(Session::get('lang') == "en") {
            $companies=DB::select(' SELECT 
                          companies.c_id,
                          companies.c_name
                          FROM companies 
                          ORDER BY c_id DESC');
            return view('cp.subadmins.add_subadmin',['companies'=>$companies]);
        }else{
            $companies=DB::select(' SELECT 
                          companies_ar.c_id,
                          companies_ar.c_name
                          FROM companies_ar 
                          ORDER BY c_id DESC');
            return view('cp-ar.subadmins.add_subadmin',['companies'=>$companies]);
        }
    }

    public function insert_subadmin(Request $request){
        $this->admins();
        $data = $this->validate(request(),
            [
                'company_id'           =>'required',
                's_a_email'            =>'required|email|unique:subadmins',
                's_a_password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                's_a_confirm_password' =>'required|same:s_a_password',
                //'phone1'           =>'required|unique:users|min:10|max:16|regex:/(?=[0-9])*/',
                //'phone2'           =>'min:10|max:16|regex:/(?=[0-9])*/',
            ],[],
            [
                'company_id'           =>'company name',
                's_a_email'            =>'email must be like [example@example.com] &',
                's_a_password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                's_a_confirm_password'       =>'password confirmation',
                //'phone1'           =>'Phone Number',
                //'phone2'           =>'Another Phone Number',
            ]
        );
        if(md5($_POST['s_a_password']) == md5($_POST['s_a_confirm_password'])){
            if(Session::get('lang') == "en") {
                $userData = DB::table('subadmins')
                    ->where("s_a_email", "=", $_POST['s_a_email'])
                    ->get();
                if (sizeof($userData) < 1) {
                    $add                = new Subadmin();
                    $add->company_id    = $_POST['company_id'];
                    $add->s_a_email     = $_POST['s_a_email'];
                    $add->s_a_password  = md5($_POST['s_a_password']);
                    $add->save();
                    $addx                = new Subadmin_ar();
                    $addx->company_id     = $_POST['company_id'];
                    $addx->s_a_email     = $_POST['s_a_email'];
                    $addx->s_a_password  = md5($_POST['s_a_password']);
                    $addx->save();
                    return redirect('/all/subadmins');
                }else{
                    session()->flash('insert_message', 'email alrady exists, Try another email. . .');
                    return redirect('/add/subadmin');
                }
            }else{
                $userData = DB::table('subadmins_ar')
                    ->where("s_a_email", "=", $_POST['s_a_email'])
                    ->get();
                if (sizeof($userData) < 1) {
                    $add                = new Subadmin();
                    $add->company_id    = $_POST['company_id'];
                    $add->s_a_email     = $_POST['s_a_email'];
                    $add->s_a_password  = md5($_POST['s_a_password']);
                    $add->save();
                    $addx                = new Subadmin_ar();
                    $addx->company_id     = $_POST['company_id'];
                    $addx->s_a_email     = $_POST['s_a_email'];
                    $addx->s_a_password  = md5($_POST['s_a_password']);
                    $addx->save();
                    return redirect('/ar/all/subadmins');
                }else{
                    session()->flash('insert_message', 'البريد الالكتروني موجود بالفعل , حاول مرة اخري. . . ');
                    return redirect('/ar/add/subadmin');
                }
            }
        } else{
            session()->flash('insert_message','Wrong password Confirmation. . .');
            if(Session::get('lang') == "en") {
                return redirect('/add/subadmin');
            }else{
                session()->flash('insert_message','كلمتا المرور غير متطابقين . . . ');
                return redirect('/ar/add/subadmin');
            }
        }
    }

    public function edit_subadmin($s_a_id){
        $this->admins();
        if(Session::get('lang') == "en") {
            $companies=DB::select(' SELECT 
                          companies.c_id,
                          companies.c_name
                          FROM companies 
                          ORDER BY c_id DESC');
            $subadmins=DB::table('subadmins')
                ->where('s_a_id', '=' ,Route::input('s_a_id'))->get();
            return view('cp.subadmins.edit_subadmin',[
                'subadmins'=>$subadmins,
                'companies'=>$companies
            ]);
        }else{
            $companies=DB::select(' SELECT 
                          companies_ar.c_id,
                          companies_ar.c_name
                          FROM companies_ar 
                          ORDER BY c_id DESC');
            $subadmins=DB::table('subadmins_ar')
                ->where('s_a_id', '=' ,Route::input('s_a_id'))->get();
            return view('cp-ar.subadmins.edit_subadmin',[
                'subadmins'=>$subadmins,
                'companies'=>$companies
            ]);
        }
    }

    public function update_subadmin(Request $request,$s_a_id){
        $this->admins();
        $data = $this->validate(request(),
            [
                'company_id'           =>'required',
                's_a_email'            =>'required|email|unique:subadmins',
                //'s_a_password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                //'s_a_confirm_password' =>'required|same:s_a_password',
                //'phone1'           =>'required|unique:users|min:10|max:16|regex:/(?=[0-9])*/',
                //'phone2'           =>'min:10|max:16|regex:/(?=[0-9])*/',
            ],[],
            [
                'company_id'           =>'company name',
                's_a_email'            =>'email must be like [example@example.com] &',
                //'s_a_password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                //'s_a_confirm_password'       =>'password confirmation',
                //'phone1'           =>'Phone Number',
                //'phone2'           =>'Another Phone Number',
            ]
        );
            if(Session::get('lang') == "en") {
                DB::table('subadmins')
                    ->where('s_a_id', $s_a_id)
                    ->update([
                        'company_id'    => request('company_id'),
                        's_a_email'     => request('s_a_email'),
                    ]);
                DB::table('subadmins_ar')
                    ->where('s_a_id', $s_a_id)
                    ->update([
                        's_a_email'     => request('s_a_email'),
                    ]);
                session()->flash('insert_message', 'Record updated successfully.');
                return redirect('/all/subadmins');
            }else{
                DB::table('subadmins_ar')
                    ->where('s_a_id', $s_a_id)
                    ->update([
                        'company_id'    => request('company_id'),
                        's_a_email'     => request('s_a_email'),
                    ]);
                DB::table('subadmins')
                    ->where('s_a_id', $s_a_id)
                    ->update([
                        's_a_email'     => request('s_a_email'),
                    ]);
                session()->flash('insert_message', 'تم تعديل البيانات بنجاح.');
                return redirect('/ar/all/subadmins');
            }
    }

    public function delete_subadmin($s_a_id){
        $this->admins();
        Subadmin::destroy($s_a_id);
        Subadmin_ar::destroy($s_a_id);
        return back();
    }

    public function changePass_page($s_a_id){
        $this->admins();
        if(Session::get('lang') == "en") {
            $subadmins=DB::table('subadmins')
                ->where('s_a_id', '=' ,$s_a_id)->get();
            return view('cp.subadmins.changePass_subadmin',['subadmins'=>$subadmins]);
        }else{
            $subadmins=DB::table('subadmins_ar')
                ->where('s_a_id', '=' ,$s_a_id)->get();
            return view('cp-ar.subadmins.changePass_subadmin',['subadmins'=>$subadmins]);
        }
    }

    public function changePass_subadmin($s_a_id){
        $this->admins();
        $data = $this->validate(request(),
            [
                's_a_password'         =>'required|min:6|max:20|regex:/^.*(?=.{1,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[@&!$#%]).*$/|',
                's_a_confirm_password' =>'required|same:s_a_password',
            ],[],
            [
                's_a_password'         =>'password must contains at least 6 characters (at least one of a-z or A-Z and numbers and special characters) & digits &',
                's_a_confirm_password'       =>'password confirmation',
            ]
        );
        DB::table('subadmins')
            ->where('s_a_id', $s_a_id)
            ->update([
                's_a_password'      => request('s_a_password'),
            ]);
        DB::table('subadmins_ar')
            ->where('s_a_id', $s_a_id)
            ->update([
                's_a_password'      => request('s_a_password'),
            ]);
        if(Session::get('lang') == "en") {
            session()->flash('insert_message', 'Password changed successfully.');
            return redirect('/all/subadmins');
        }else{
            session()->flash('insert_message', 'تم تغيير كلمة المرور بنجاح.');
            return redirect('/ar/all/subadmins');
        }
    }
}
