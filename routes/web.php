<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
 * ==============================+===============================
 * Developed By : ANDREW AKRAM ALBERT ZAKI
 * Contact Me At:
 * Email : andrewalbert93501@gmail.com
 * Phone : +2 011 28 5700 38
 * LinkedIn : https://www.linkedin.com/in/andrew-akram-2167a0154/
 * ==============================+===============================
*/
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//=============================================================================
//================== Admmin Panel routes ======================================
//=============================================================================

// login page for companies
/*Route::get('/','AdminController@indexCompany');
Route::get('/ar','AdminController@indexCompany_ar');*/

// login methods for companies
Route::post('/login/company','SubadminController@loginCompany');
Route::post('/ar/login/company','SubadminController@loginCompany');

//changeLanguae
Route::get('/changeLanguae','Controller@changeLanguae');

//home page in admin panel
Route::get('/','AdminController@content');
Route::get('/ar','AdminController@content');

//register & login pages
Route::get('/registerx501', 'AdminController@registerPage');
Route::get('/login', 'AdminController@loginPage');
Route::get('/ar/login', 'AdminController@loginPage_ar');

//register & login functions
Route::post('/register', 'AdminController@register');
Route::post('/login', 'AdminController@login');


//for redirect to forget_password page
Route::get('/forget_password', 'AdminController@forget_password');

//for redirect to new_password page
Route::get('/newPassword', 'AdminController@newPassword');

//login with new password
Route::post('/login_newPassword', 'AdminController@login_newPassword');

//logout
Route::get('/logout', 'AdminController@logout');

////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

//go to search
Route::get('/searchResult',"HomeController@searchResult");
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

//go to all_companies page
Route::get('/all/companies',"CompanyController@all_companies");
Route::get('/ar/all/companies',"CompanyController@all_companies");

//go to add company page
Route::get('/add/company',"CompanyController@add_company");
Route::get('/ar/add/company',"CompanyController@add_company");

//go to add_new_company
Route::post('/add/new/company',"CompanyController@insert_company");
Route::post('/ar/add/new/company',"CompanyController@insert_company");

//go to edit_company page
Route::get('/edit/company/{c_id}',"CompanyController@edit_company");
Route::get('/ar/edit/company/{c_id}',"CompanyController@edit_company");

//go to update_company
Route::post('/update/company/{c_id}',"CompanyController@update_company");
Route::post('/ar/update/company/{c_id}',"CompanyController@update_company");

//go to delete_company
Route::get('/delete/company/{c_id}',"CompanyController@delete_company");
Route::get('/ar/delete/company/{c_id}',"CompanyController@delete_company");

///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////
//go to all_employees page
Route::get('/all/employees',"EmployeeController@all_employees");
Route::get('/ar/all/employees',"EmployeeController@all_employees");

//go to add employee page
Route::get('/add/employee',"EmployeeController@add_employee");
Route::get('/ar/add/employee',"EmployeeController@add_employee");

//go to add_new_employee
Route::post('/add/new/employee',"EmployeeController@insert_employee");
Route::post('/ar/add/new/employee',"EmployeeController@insert_employee");

//go to edit_employee page
Route::get('/edit/employee/{e_id}',"EmployeeController@edit_employee");
Route::get('/ar/edit/employee/{e_id}',"EmployeeController@edit_employee");

//go to update_employee
Route::post('/update/employee/{e_id}',"EmployeeController@update_employee");
Route::post('/ar/update/employee/{e_id}',"EmployeeController@update_employee");

//go to delete_employee
Route::get('/delete/employee/{e_id}',"EmployeeController@delete_employee");
Route::get('/ar/delete/employee/{e_id}',"EmployeeController@delete_employee");
/*
 * ==============================+===============================
 * Developed By : ANDREW AKRAM ALBERT ZAKI
 * Contact Me At:
 * Email : andrewalbert93501@gmail.com
 * Phone : +2 011 28 5700 38
 * LinkedIn : https://www.linkedin.com/in/andrew-akram-2167a0154/
 * ==============================+===============================
*/