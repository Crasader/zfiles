<?php

namespace app\Controllers;
use Couchbase\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Files;

//include('../../vendor/PHPMailer/class.smtp.php');
//include "../../vendor/PHPMailer/class.phpmailer.php";


/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 6/22/2017
 * Time: 11:12 AM
 */
class Test123Controller extends \BaseController
{
    function index(){
        $tc = new \TestCron();

        $tc->value = '1234';

        $tc->save();
    }
    
    function uploadTheme(){
        return View::make('user.test123Upload')->with('data', '');
    }
    
    function testPay(){

        return View::make('user.test-pay')->with('data', '');
    }

    function testPaySuccess(){
        echo $_GET['payer_email'];
    }

}