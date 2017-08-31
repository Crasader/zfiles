<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 6/25/2017
 * Time: 1:50 AM
 */

namespace app\Controllers;

use Illuminate\Support\Facades\View;
use Settings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AdminPaymentSettingsController extends \BaseController
{
    function index(){

        $data = array(
            'title' => 'Payments',
            'ul' => 'payments',
            'active' => 'payments',
            'payments' => \Payments::all(),
            'settings'=> Settings::find(1),
        );

        return View::make('admin.payments')->with('data', $data);
    }


    function edit($id){
        $data = array(
            'title' => 'Edit Payment',
            'ul' => 'editPayment',
            'active' => 'editPayment',
            'payment' => \Payments::find($id),
            'settings'=> Settings::find(1),
        );

        return View::make('admin.editPayment')->with('data', $data);
    }

    function update($id){
        $inputs = Input::all();

        $rules  = array (
            'name'   => 'required',
            'email'  => 'required',

        );

        $validator = Validator::make($inputs,$rules);

        if( $validator->fails() ){


            return Redirect::back()
                ->withErrors($validator)
                ->withInput($inputs);
        }else{

            $payment = \Payments::find($id);

            $payment->name = $inputs['name'];
            $payment->email = $inputs['email'];


            if( $payment->save() ){
                return Redirect::back()
                    ->with('success',true);


            }else{

                return Redirect::back()
                    ->withInput()
                    ->WithErrors(' Please check your entry and try again..');
            }

        }
    }

    function status($id){
        $payment = \Payments::find($id);

        if ($payment->status == 1){
            $payment->status = 0;

            $payment->save();
        }elseif($payment->status == 0){
            $payment->status = 1;
            $payment->save();
        }

        return Redirect::back();

    }

}