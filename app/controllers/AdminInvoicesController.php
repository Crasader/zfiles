<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 7/17/2017
 * Time: 12:18 AM
 */

namespace app\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;
use Plans;
use Settings;


class AdminInvoicesController extends \BaseController
{

    public function index(){
        $data = array(
            'title' => 'Show Invoices',

            'ul' => 'invoices',
            'active' => 'invoice',
            'settings'=> Settings::find(1),
            'invoices' => DB::table('invoices')->orderBy('invoices.id', 'desc')->paginate(10)
        );

        return View::make('admin.invoices')->with('data', $data);

    }

    public function create(){
        $userID = Input::get('userID');

        $profit = Input::get('profit');

        //$user = \User::find($userID);


        /*$profitDownload = 0;

        $tmp = DB::table('files')
            ->selectRaw('userID, sum(fileDownloadCounter) as sum')->groupBy('userID')
            ->where('userID','=', $user->id)
            ->first();

        if($tmp != null){
            $profitDownload = ($tmp->sum - $user->last_number_of_download)* Plans::find($user->status_id == 5 ? 3 : 2)->profit / 1000;

        }


        $profitReferral = ($user->number_of_referral - $user->last_number_of_referral) * Plans::find($user->status_id == 5 ? 3 : 2)->referral_profit;


        $profit = $profitDownload + $profitReferral;*/

        $invoice = new \Invoices();

        $invoice->user_id = $userID;
        $invoice->profit = $profit;
        $invoice->pay_date = date("Y-m-d");
        $invoice->pay_status = 0;

        $invoice->save();

        $lastInvoice = DB::table('invoices')->orderBy('id', 'DESC')->first();

        echo $lastInvoice->id;
        //echo $profit;
    }

    public function success(){

        //$userID = Input::get('userID');
        $invoiceID = Input::get('invoiceID');
        $requireId = Input::get('requireId');


        $invoice = \Invoices::find($invoiceID);

        $invoice->pay_status = 1;

        $invoice->save();

        /*DB::table('files')->where('userID', $userID)->delete();

        DB::table('users')->where('id', $userID)->update(['number_of_referral' => 0]);

        $user = \User::find($userID);

        //update last number of referral
        $user->last_number_of_referral = $user->number_of_referral;

        // update last number of download

        $user->last_number_of_download = DB::table('files')
            ->selectRaw('*, sum(fileDownloadCounter) as sum')->where('userID','=', $user->id)->first()->sum;

        $user->save();*/

        $require = \RequireWithdraw::find($requireId);

        $require->status = 1;

        $require->save();


        return Redirect::to('admin/invoice/index');

    }

    public function delete($id){
        $invoice = \Invoices::find($id);

        $invoice->delete();

        return Redirect::back();
    }

    public function deleteAll(){
        DB::table('invoices')->delete();

        Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Invoices Deleted Successfully .
                </div>
                ');

        return Redirect::back();
    }
}
