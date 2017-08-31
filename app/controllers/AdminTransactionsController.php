<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 7/10/2017
 * Time: 1:58 PM
 */

namespace app\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Settings;
use View;
use DB;

class AdminTransactionsController extends \BaseController
{
    public function index(){

        $data = array(
            'title' => 'Transactions',
            'ul' => 'transactions',
            'active' => 'transactions',
            'transactions' => DB::table('transactions')
                ->orderBy('id','desc')
                ->paginate(10),
            'settings'=> Settings::find(1),
        );

        return View::make('admin.transactions')->with('data', $data);
    }

    public function reject($id){

        $transaction = \Transactions::find($id);

        $transaction->status = 1;

        $transaction->save();

        $user = \User::find($transaction->user_id);

        $user->status_id = 1;

        $user->save();

        return Redirect::back();

    }

    public function approve($id){

        $transaction = \Transactions::find($id);

        $transaction->status = 2;

        $transaction->save();

        $user_id = $transaction->user_id;

        $user = \User::find($user_id);

        $user->status_id = 5;

        $user->save();

        return Redirect::back();

    }

    public function deleteAll(){
        DB::table('transactions')->delete();

        Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Payments Deleted Successfully .
                </div>
                ');

        return Redirect::back();
    }

}