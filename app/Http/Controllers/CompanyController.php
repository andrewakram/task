<?php

namespace App\Http\Controllers;

use App\Company;
use App\Company_ar;
use App\Service;
use App\Service_ar;
use App\Subadmin;
use App\Subadmin_ar;
use Illuminate\Http\Request;
use DB;
use Route;
use Session;

class CompanyController extends Controller
{
    public function all_companies(){
        $this->admins();
        if(Session::get('lang') == "en") {
            $companies = DB::table('companies')->orderBy('c_id','asc')->get();
            return view('cp.companies.all_companies',['companies'=>$companies]);
        }else{
            $companies = DB::table('companies_ar')->orderBy('c_id','asc')->get();
            return view('cp-ar.companies.all_companies',['companies'=>$companies]);
        }
    }

    public function add_company(){
        $this->admins();
        if(Session::get('lang') == "en") {
            return view('cp.companies.add_company');
        }else{
            return view('cp-ar.companies.add_company');
        }
    }

    public function insert_company(Request $request){
        $this->admins();
        $data = $this->validate(request(), [
            'c_name'            => 'required',
        ],[],[
            'c_name'            =>'Company Name',
        ]);
        if ($request->file('c_logo')) {
            $filenameWithExtention = $request->file('c_logo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file('c_logo')->getClientOriginalExtension();
            $fileNameStore = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file('c_logo')->storeAs('public/company_logos', $fileNameStore);
            $add                    = new Company();
            $add->c_name            = request('c_name');
            $add->c_email           = request('c_email');
            $add->c_website         = request('c_website');
            $add->c_logo            = $fileNameStore;
            $add->save();
            $addx                = new Company_ar();
            $addx->c_name            = request('c_name');
            $addx->c_email           = request('c_email');
            $addx->c_website         = request('c_website');
            $addx->c_logo            = $fileNameStore;
            $addx->save();
        }else{
            $add                    = new Company();
            $add->c_name            = request('c_name');
            $add->c_email           = request('c_email');
            $add->c_website         = request('c_website');
            $add->save();
            $addx                = new Company_ar();
            $addx->c_name            = request('c_name');
            $addx->c_email           = request('c_email');
            $addx->c_website         = request('c_website');
            $addx->save();
        }
        session()->flash('insert_message','Record added successfully');
        if(Session::get('lang') == "en") {
            return redirect('/all/companies');
        }else{
            return redirect('/ar/all/companies');
        }
    }

    public function edit_company($c_id){
        $this->admins();
        if(Session::get('lang') == "en") {
            $companies=DB::table('companies')
                ->where('c_id', '=' ,Route::input('c_id'))->get();
            return view('cp.companies.edit_company',['companies'=>$companies]);
        }else{
            $companies=DB::table('companies_ar')
                ->where('c_id', '=' ,Route::input('c_id'))->get();
            return view('cp-ar.companies.edit_company',['companies'=>$companies]);
        }
    }

    public function update_company(Request $request,$c_id){
        $this->admins();
        $data = $this->validate(request(), [
            'c_name'            => 'required',
        ],[],[
            'c_name'            =>'Company Name',
        ]);
        if ($request->file('c_logo')) {
            $filenameWithExtention = $request->file('c_logo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file('c_logo')->getClientOriginalExtension();
            $fileNameStore = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file('c_logo')->storeAs('public/company_logos', $fileNameStore);
            if(Session::get('lang') == "en") {
                DB::table('companies')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_name'            =>request('c_name'),
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                        'c_logo'            =>$fileNameStore
                    ]);
                DB::table('companies_ar')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                        'c_logo'            =>$fileNameStore
                    ]);
                session()->flash('insert_message','Record updated successfully');
                return redirect('/all/companies');
            }else{
                DB::table('companies_ar')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_name'            =>request('c_name'),
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                        'c_logo'            =>$fileNameStore
                    ]);
                DB::table('companies')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                        'c_logo'            =>$fileNameStore
                    ]);
                session()->flash('insert_message', 'تم تعديل البيانات بنجاح.');
                return redirect('/ar/all/companies');
            }
        }else{
            if(Session::get('lang') == "en") {
                DB::table('companies')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_name'            =>request('c_name'),
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                    ]);
                DB::table('companies_ar')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website'),
                    ]);
                session()->flash('insert_message','Record updated successfully');
                return redirect('/all/companies');
            }else{
                DB::table('companies_ar')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_name'            =>request('c_name'),
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website')
                    ]);
                DB::table('companies')
                    ->where('c_id', $c_id)
                    ->update([
                        'c_email'           =>request('c_email'),
                        'c_website'         =>request('c_website')
                    ]);
                session()->flash('insert_message', 'تم تعديل البيانات بنجاح.');
                return redirect('/ar/all/companies');
            }
        }
    }

    public function delete_company($c_id){
        $this->admins();
        Company::destroy($c_id);
        Company_ar::destroy($c_id);
        return back();
    }

}
