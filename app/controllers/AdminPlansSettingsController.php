<?php
/**
 * Created by PhpStorm.
 * User: vuquo
 * Date: 6/19/2017
 * Time: 12:34 AM
 */

namespace app\Controllers;

use Illuminate\Support\Facades\DB;
use Settings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use  Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use uploadSettings;

class AdminPlansSettingsController extends \BaseController
{
    function __construct() {

        ## Function To Handle Files Size

        function convertToBytes($from,$return){

            $number=$from;
            switch($return){
                case "KB":
                    return $number*1024;
                case "MB":
                    return $number*pow(1024,2);
                case "GB":
                    return $number*pow(1024,3);
                case "TB":
                    return $number*pow(1024,4);
                case "PB":
                    return $number*pow(1024,5);
                default:
                    return $from;
            }
        }

        function convertFromBytes($from,$return){

            $number=$from;
            switch($return){
                case "KB":
                    return $number/1024;
                case "MB":
                    return $number/pow(1024,2);
                case "GB":
                    return $number/pow(1024,3);
                case "TB":
                    return $number/pow(1024,4);
                case "PB":
                    return $number/pow(1024,5);
                default:
                    return $from;
            }
        }

    }

    function index(){
        $data = array(
            'title' => 'Show Plans',
            'ul' => 'plans',
            'active' => 'plans',
            'settings'=> Settings::find(1),
            'plans' => \Plans::all()
        );

        return View::make('admin.plans')->with('data',$data);
    }

    function edit($id){

        $plan = \Plans::find($id);

        $data = array(
            'title' => 'Edit Plan',
            'ul' => 'plans',
            'active' => 'editPlan',
            'settings'=> Settings::find(1),
            'plan' => $plan
        );

        return View::make('admin.editPlan')->with('data', $data);
    }

    function store($id){
        // Get Form Inputs
        $inputs = Input::all();

        $rules  = array (
            'name'            => 'required',
            'price'           => 'required|numeric',
            'profit'          => 'required|numeric',
            'referral_profit' => 'required|numeric'
        );

        $validator = Validator::make($inputs,$rules);

        if( $validator->fails() ){


            return Redirect::back()
                ->withErrors($validator)
                ->withInput($inputs);
        }else{

            $plan = \Plans::find($id);

            $plan->name = $inputs['name'];
            $plan->price = $inputs['price'];
            $plan->profit = $inputs['profit'];
            $plan->referral_profit = $inputs['referral_profit'];


            if( $plan->save() ){
                return Redirect::back()
                    ->with('success',true);


            }else{

                return Redirect::back()
                    ->withInput()
                    ->WithErrors(' Please check your entry and try again..');
            }

        }
    }


    function deletePlan($id){
        $plan = \Plans::find($id);

        if($plan->delete()){

            Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Plan deleted Successfully .
                </div>
                ');

        }

        return Redirect::back();
    }

    function uploadSettings($id){


        //
        $data = array(
            'title' => 'Upload Settings',
            'planName' => \Plans::find($id)->name,
            'active' => 'upload',
            'settings'=> Settings::find(1),
            'uploadSettings'=> uploadSettings::find($id),
            'maxFileSize'=> convertFromBytes(uploadSettings::find($id)->maxFileSize,'MB'),
            'userDiskSpace'=> convertFromBytes(uploadSettings::find($id)->userDiskSpace,'MB'),
            'id' => $id

        );
        return View::make('admin.upload')->with('data',$data);
    }

    function saveUploadSettings($id){


        $input = Input::all();

        $validator = Validator::make(
            array(
                'maxFileSize' => $input['maxFileSize'],
                'maxUploadsFiles' => $input['maxUploadsFiles'],
                'AllowedFilesType' => $input['AllowedFilesType'],
                'userDiskSpace' => $input['userDiskSpace'],
                //'fileExpireLimit' => $input['fileExpireLimit']
            ),

            array(
                'maxFileSize' => 'required|numeric',
                'maxUploadsFiles' => 'required|numeric',
                'AllowedFilesType' => 'required',
                'userDiskSpace' => 'required|numeric',
                //'fileExpireLimit' => 'required|numeric',

            )
        );

        if ($validator->fails()){

            return Redirect::to('admin/upload')
                ->withInput()
                ->WithErrors($validator);

        }else{

            $save = uploadSettings::find($id);



            $save->maxFileSize       = convertToBytes($input['maxFileSize'],'MB') ;
            $save->maxUploadsFiles    = $input['maxUploadsFiles'];
            $save->AllowedFilesExt    = $input['AllowedFilesType'];
            $save->userDiskSpace       = convertToBytes($input['userDiskSpace'],'MB') ;
            $id == 0 ? $save->fileExpireLimit    = $input['fileExpireLimit'] : '';

            if( $save->save() ){

                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');

                return Redirect::back();
            }
        }


    }

}