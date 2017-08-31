<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 7/31/2017
 * Time: 12:16 PM
 */

namespace app\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;
use Settings;
use Illuminate\Support\Facades\DB;
use RequireWithdraw;

class AdminRequiresController extends \BaseController
{
    public function index(){
        $data = array(
            'title' => 'Show Requires',

            'ul' => 'invoices',
            'active' => 'require',
            'settings'=> Settings::find(1),
            'requires' => DB::table('require_withdraw')->where('status', '=', 0)->orderBy('require_withdraw.id', 'desc')->paginate(10)
        );

        return View::make('admin.requireWithdraw')->with('data', $data);

    }

    function delete($id){
        $invoice = \RequireWithdraw::find($id);

        $invoice->delete();

        return Redirect::back();
    }

    public function deleteAll(){
        DB::table('require_withdraw')->delete();

        Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Requires Deleted Successfully .
                </div>
                ');

        return Redirect::back();
    }
}