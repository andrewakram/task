<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;
use App\Employee_ar;
use Route;
use Session;


class EmployeeController extends Controller
{
    public function all_employees(){
        $this->admins();
        if(Session::get('lang') == "en") {
            $employees = DB::table('employees')->orderBy('e_id','desc')
                ->join("companies","companies.c_id","employees.company_id")
                ->get();
            return view('cp.employees.all_employees',['employees'=>$employees]);
        }else{
            $employees = DB::table('employees_ar')->orderBy('e_id','desc')
                ->join("companies_ar","companies_ar.c_id","employees_ar.company_id")
                ->get();
            return view('cp-ar.employees.all_employees',['employees'=>$employees]);
        }
    }

    public function add_employee(){
        $this->admins();
        if(Session::get('lang') == "en") {
            $companies=DB::select(' SELECT 
                          companies.c_id,
                          companies.c_name
                          FROM companies 
                          ORDER BY c_id DESC');
            return view('cp.employees.add_employee',['companies'=>$companies]);
        }else{
            $companies=DB::select(' SELECT 
                          companies_ar.c_id,
                          companies_ar.c_name
                          FROM companies_ar 
                          ORDER BY c_id DESC');
            return view('cp-ar.employees.add_employee',['companies'=>$companies]);
        }
    }

    public function insert_employee(Request $request){
        $this->admins();
        $data = $this->validate(request(),
            [
                'e_fname'           =>'required',
                'e_lname'           =>'required',
                'company'           =>'required',
            ],[],
            [
                'e_fname'           =>'Employee First Name',
                'e_lname'           =>'Employee Last Name',
                'company'           =>'Company Name',
            ]
        );
        $add                = new Employee();
        $add->e_fname       = request('e_fname');
        $add->e_lname       = request('e_fname');
        $add->e_email       = request('e_email');
        $add->e_phone       = request('e_phone');
        $add->company_id    = request('company');
        $add->save();
        $addx                = new Employee_ar();
        $addx->e_fname       = request('e_fname');
        $addx->e_lname       = request('e_fname');
        $addx->e_email       = request('e_email');
        $addx->e_phone       = request('e_phone');
        $addx->company_id    = request('company');
        $addx->save();
        if(Session::get('lang') == "en") {
            return redirect('/all/employees');
        }else{
            return redirect('/ar/all/employees');
        }
    }

    public function edit_employee($e_id){
        $this->admins();
        if(Session::get('lang') == "en") {
            $employees = DB::table('employees')
                ->join("companies","companies.c_id","employees.company_id")
                ->where("e_id","=",$e_id)
                ->get();
            $companies=DB::select(' SELECT 
                          companies.c_id,
                          companies.c_name
                          FROM companies 
                          ORDER BY c_id DESC');
            return view('cp.employees.edit_employee',[
                'companies'=>$companies,
                'employees'=>$employees,
            ]);
        }else{
            $employees = DB::table('employees_ar')
                ->join("companies_ar","companies_ar.c_id","employees_ar.company_id")
                ->where("e_id","=",$e_id)
                ->get();
            $companies=DB::select(' SELECT 
                          companies_ar.c_id,
                          companies_ar.c_name
                          FROM companies_ar 
                          ORDER BY c_id DESC');
            return view('cp-ar.employees.edit_employee',[
                'companies'=>$companies,
                'employees'=>$employees,
            ]);
        }
    }

    public function update_employee(Request $request,$e_id){
        $this->admins();
        $data = $this->validate(request(),
            [
                'e_fname'           =>'required',
                'e_lname'           =>'required',
                'company'           =>'required',
            ],[],
            [
                'e_fname'           =>'Employee First Name',
                'e_lname'           =>'Employee Last Name',
                'company'           =>'Company Name',
            ]
        );
            if(Session::get('lang') == "en") {
                DB::table('employees')
                    ->where('e_id', $e_id)
                    ->update([
                        'e_fname'    => request('e_fname'),
                        'e_lname'    => request('e_lname'),
                        'e_email'    => request('e_email'),
                        'e_phone'    => request('e_phone'),
                        'company_id' => request('company'),
                    ]);
                DB::table('employees_ar')
                    ->where('e_id', $e_id)
                    ->update([
                        'e_email'    => request('e_email'),
                        'e_phone'    => request('e_phone'),
                        'company_id' => request('company'),
                    ]);
                session()->flash('insert_message', 'Record updated successfully.');
                return redirect('/all/employees');
            }else{
                DB::table('employees_ar')
                    ->where('e_id', $e_id)
                    ->update([
                        'e_fname'    => request('e_fname'),
                        'e_lname'    => request('e_lname'),
                        'e_email'    => request('e_email'),
                        'e_phone'    => request('e_phone'),
                        'company_id' => request('company'),
                    ]);
                DB::table('employees')
                    ->where('e_id', $e_id)
                    ->update([
                        'e_email'    => request('e_email'),
                        'e_phone'    => request('e_phone'),
                        'company_id' => request('company'),
                    ]);
                session()->flash('insert_message', 'تم تعديل البيانات بنجاح.');
                return redirect('/ar/all/employees');
            }
    }

    public function delete_employee($e_id){
        $this->admins();
        Employee::destroy($e_id);
        Employee_ar::destroy($e_id);
        return back();
    }

}
