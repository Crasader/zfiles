<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 7/12/2017
 * Time: 6:10 PM
 */

namespace app\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use User;
use Auth;

class UserConfirmEmailController extends \BaseController
{
    public function index($key){
        $user = DB::table('users')->where('confirm_email_key', $key)->first();

        $user = User::find($user->id);

        $user->confirm_email_status = 1;

        $user->save();

        if (Auth::check()){
            if (Auth::user()->id == $user->id){


                return Redirect::to('user/' . Auth::user()->username);
            }else{
                Auth::logout();

                return Redirect::to('auth/login');
            }
        }else{
            return Redirect::to('auth/login');
        }

    }

    public function error(){


    }

}