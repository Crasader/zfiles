<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 6/21/2017
 * Time: 11:55 PM
 */

namespace app\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Transactions;

class PayController extends \BaseController
{
    function index(){
        return View::make('user.test-pay')->with('data','');
    }

    function create_transaction($type){
        $user = Auth::user();

        $transaction = new \Transactions();

        $transaction->user_id = $user->id;
        $transaction->payment_method_id = 1;
        $transaction->pay_status = 0;
        $transaction->transactionDate = date('Y-m-d H:i:s');

        if ($user->status_id == 3 ){
            $transaction->content = "Pay for " . \Plans::find(3)->name . " Plan";
        }elseif ($user->status_id == 1){
            $transaction->content = "Upgrade from " . \Plans::find(2)->name . " Plan to " . \Plans::find(3)->name . " Plan";
        }

        $transaction->save();


        echo DB::table('transactions')->orderBy('id', 'desc')->first()->id;
    }

    function pay_success(){
        $user = Auth::user();

        //change user's status
        $user->status_id = 4;

        $user->save();

        //create a transaction
        $id = Input::get('id');

        //txnId
        $txnId = Input::get('tx');

        $transaction = Transactions::find($id);

        $transaction->pay_status = 1;
        $transaction->txnId = $txnId;

        //save
        $transaction->save();

        //return
        return Redirect::to('user/' . Auth::user()->username );
    }


    function upgrade_success(){
        $user = Auth::user();

        //change user's status
        $user->status_id = 4;

        $user->save();

        //create a transaction
        $id = Input::get('id');

        //txnId
        $txnId = Input::get('tx');

        $transaction = Transactions::find($id);

        $transaction->pay_status = 1;
        $transaction->txnId = $txnId;

        //save
        $transaction->save();

        //return
        return Redirect::to('user/' . Auth::user()->username );
    }

}