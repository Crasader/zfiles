<?php

namespace app\Controllers;

use PHPMailer;
use View;
use User;
use Settings;
use Input;
use Carbon;
use Hash;
use Validator;
use Redirect;
use Auth;
use Mail;
use EmailTemplates;
use EmailSettings;
use Illuminate\Support\Facades\DB;

class AuthController extends \BaseController {

    /**
     * Show Auth Page (login - Signup).
     *
     * @return Response
     */
    public function index($type) {
        //
        if($type === 'login' || $type === 'signup' ){
            
            $settings = Settings::find(1);
            
            $data = array(
                'title' => $settings['sitename'], 
                'type'  => $type
            );
            return View::make('home.login-signup')->with('data',$data);
        }

    }


	/**
	 * Check Login Form  
	 *
	 * @return Response
	 */
	public function login() {
		// Get Form Inputs
        $inputs = Input::all();

        $rules  = array (
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ); 
        
        $validator = Validator::make($inputs,$rules);
        
        if( $validator->fails() ){
            
            return Redirect::to('auth/login')
                    ->WithInput()
                    ->WithErrors($validator);
        }else {
            
            $method = array (
                'email'    => $inputs['email'],
                'password' => $inputs['password']
            );
            
            $auth = Auth::attempt($method,false); 
            
            if( $auth ) {
                $Updatelastlogin = User::find(Auth::user()->id);
                $Updatelastlogin->last_login = Carbon::now(); 
                $Updatelastlogin->save(); 
                return Redirect::intended('user/'.strtolower(Auth::user()->username));
            
            }else{
                
                return Redirect::to('auth/login')
                        ->WithInput()
                        ->WithErrors('Incorrect username or password..');
            }
        }
    }


	/**
	 * Store and Create New User
	 *
	 * @return Response
	 */
	public function signup() {

		// Get Form Inputs
        $inputs = Input::all();
        
        $rules  = array (
            'username'       => 'required|min:5|regex:/^[A-Za-z0-9_.-]+$/|max:15|unique:users,username',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ); 
        
        $validator = Validator::make($inputs,$rules);
        
        if( $validator->fails() ){
            
            
            return Redirect::to('auth/signup')
                    ->withErrors($validator)
                    ->withInput($inputs);
        }else {
            
            $user = new User;
            
            $user->username = strtolower($inputs['username']);
            $user->email = $inputs['email'];
            $user->password = Hash::make( $inputs['password'] );
            $user->level = 'user';
            $user->plan_id = $inputs['plan_id'];
	        $user->last_login = 'null';

	        $inputs['plan_id'] == 2 ? $user->status_id = 1 : $user->status_id = 3;

            if( $user->save() ){

                if ($inputs['referral_link'] != null){
                    $referral_user = User::find($inputs['referral_link']);

                    $referral_user->number_of_referral = $referral_user->number_of_referral + 1;

                    $referral_user->save();
                }


                $method = array (
                    'email'    => $inputs['email'],
                    'password' => $inputs['password'] 
                );

                $auth = Auth::attempt($method,false);

                if( $auth ) {

                    if (Auth::user()->plan_id == 1){
                        return Redirect::to('user/' . Auth::user()->username . '/' . 'unpaid');
                    }
                    
                    $data = array(
                        'username' => $inputs['username'],
                        'email' => $inputs['email'],
                    );
                    
                    /*$emailSubject = EmailTemplates::where('emailType','=','welcomeTemplate')
                                   ->pluck('emailSubject');

                    Mail::send('emails::auth.welcome',

                    array('data' => $data), function($message) use ($emailSubject){
                        $message->from(EmailSettings::find(1)->emailFromEmail, EmailSettings::find(1)->emailFromName);
                            
                        $message->to( Input::get("email"), Input::get("username") )->subject( $emailSubject );
                    });*/

                    //check if confirm email is enable
                    if (Settings::find(1)->confirm_email == 1){
                        $this->sendConfirmEmail(Auth::user()->id, $inputs['email']);

                        return Redirect::to('user/' . Auth::user()->username . '/confirm_email');

                    }

                    
                    return Redirect::intended('user/'.Auth::user()->username)->with('message',true);
                }else{
                    return Redirect::to('auth/signup')
                        ->withInput()
                        ->WithErrors(' Please check your entry and try again..');
                }
            }
        }
    }


    public function sendConfirmEmail($userId, $userEmail){
        $mail = new PHPMailer;
        // Set PHPMailer to use the sendmail transport
        $mail->isSendmail();
        //Set who the message is to be sent from
        $mail->setFrom('support@todayvideos.download', 'todayvideos.download');
        //Set an alternative reply-to address
        $mail->addReplyTo('support@todayvideos.download', 'todayvideos.download');
        //Set who the message is to be sent to
        $mail->addAddress($userEmail, 'user');
        //Set the subject line
        $mail->Subject = 'Confirm email';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        $key = md5($userId . date("Y-m-d H:i:s"));

        $user = User::find($userId);

        $user->confirm_email_key = $key;

        $user->save();

        $mail->MsgHTML("confirm link : " . url('confirm/' . $key));

        $mail->send();

    }



    /**
	 * Logout User
	 *
	 * @return Response
	 */    
    
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }


}
