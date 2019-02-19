<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function admins(){
        Session_start();
        $admin_email=Session::get('a_email');
        if($admin_email) {
            return;
        } else {
            if(Session::get('lang') == "en") {
                return redirect::to('/login')->send();
            }else{
                return redirect::to('/ar/login')->send();
            }
        }
    }

    public function users(){
        Session_start();
        $user_email=Session::get('email');
        if($user_email) {
            return;
        } else {
            return redirect::to('/')->send();
        }
    }

    public function changeLanguae(){
        $this->admins();
        if(Session::get('lang') == "en") {
            Session::put('lang',"ar");
            $x = strpos ( url()->previous(), "public/",  0 );
            $x +=7;
            $url=substr_replace( url()->previous(), 'ar/', $x, 0);
            $newX = strpos ( $url, "ar/",  0 );
            $rest = substr($url, $newX, 35);
            return redirect("/".$rest);
        }else{
            Session::put('lang',"en");
            $url = str_replace( "/ar/","/", url()->previous());
            $x = strpos ( $url, "public/",  0 );
            $x +=7;
            $rest = substr( $url, $x, 35);
            return redirect("/".$rest);
        }
    }

    /*public function changeLanguaexx(){
        $this->admins();
        if(Session::get('lang') == "en") {
            Session::put('lang',"ar");
            $x = strpos ( url()->previous(), ".net",  0 );
            $x +=4;
            $url=substr_replace( url()->previous(), 'ar', $x, 0);
            $newX = strpos ( $url, "ar/",  0 );
            $rest = substr($url, $newX, 40);
            return redirect("/".$rest);
        }else{
            Session::put('lang',"en");
            $url = str_replace( "/ar","", url()->previous());
            $x = strpos ( $url, ".net",  0 );
            $x +=4;
            $rest = substr( $url, $x, 40);
            return redirect($url);
        }
    }*/

}
