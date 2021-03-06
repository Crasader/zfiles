<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use uploadSettings;
use Input;
use Carbon;
use User;
use Files;
use File;
use LockFile;
use Mail;
use EmailTemplates;
use EmailSettings;
use Hash;
use Redirect;
use Response;
use Request;
use Auth;
use Validator;
use Session;
use PHPMailer;

class UserController extends \BaseController {
    
    protected $urlUsername;
    protected $userInfo;
    protected $userFiles;
    protected $isAdmin;
    protected $totalFilesSize;
    protected $adminPreviewMode;
    protected $userFilesPaginate;
    protected $topAds;
    protected $bottomAds;
    
    function __construct() {

        
        ## Get UserName From Url 
        $this->urlUsername = Request::path();
        $this->urlUsername = explode("/",$this->urlUsername);
        $this->urlUsername = $this->urlUsername[1];
                        
        ## Get User Personal Info
        $this->userInfo  = User::where('username', '=', $this->urlUsername)->first();
        if(!$this->userInfo ){
            die('a');
        }
        ## Get User Files Info
        $this->userFiles = Files::where('userID', '=', $this->userInfo['id'])
            ->get();        
        ## If Admin Preview Mode = true, this Variable will return true
        $this->adminPreviewMode = ( defined('ADMIN_PREVIEW_MODE') ? true : false );
        ## Get User Type ( Admin - Normal )
        $this->isAdmin = ($this->userInfo->level === 'admin') ? true : false;
        
        ## Get Total Files Size
        $this->totalFilesSize = 0;
        
        foreach($this->userFiles as $file){
            
            $this->totalFilesSize += $file['fileSize'];
        }
        
        ## ads Data
        
        $this->topAds = DB::table('advertising')
            ->where('adsPage','=','profile')
            ->where('adsPosition','=','top')
            ->pluck('adsContent');
        
        $this->bottomAds = DB::table('advertising')
            ->where('adsPage','=','profile')
            ->where('adsPosition','=','bottom')
            ->pluck('adsContent');

        
        ## Function To Handle Files Size
        
        function size ( $type, $sub = null ){
            if($sub === null){
                
                $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                $base = 1024;
                $class = min((int)log($type , $base) , count($si_prefix) - 1);

                return @$disk_free_space = sprintf('%1.2f' ,
                $type / pow($base,$class)) . ' ' .      $si_prefix[$class] ;
            
            }
        }
        

        function convertFromBytes($from,$return){
            $number=$from;

            switch($return){

                    case "MB":
                        return round($number/pow(1024,2),2);
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

    public function unpaid(){
        $data = array(
            'title'            => 'Unpaid',
            'nav'              => 'unpaid',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'isAdmin'          => $this->isAdmin,
            'userName'         => Auth::user()->username,

        );
        return View::make('user.unpaid')->with('data', $data);
    }
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard() {

	    $status_id = Auth::user()->status_id;

	    $uploadSettingsId = null;

	    if ($status_id == 5){
	        $uploadSettingsId = 3;
        }else{
	        $uploadSettingsId = 2;
        }

        // Check User Avilable Space 
        $userFilesSize = $this->totalFilesSize;
        $userDiskSpace = uploadSettings::find($uploadSettingsId)->userDiskSpace;
        
        $userAvailableDiskSpace = $userDiskSpace - $userFilesSize;
        
        if($userAvailableDiskSpace < uploadSettings::find($uploadSettingsId)->maxFileSize){
            $MaxUploadSize = $userAvailableDiskSpace;
        }else{
            $MaxUploadSize = uploadSettings::find($uploadSettingsId)->maxFileSize;
        }
        // 
        
           
        $data = array(
            'title'            => 'Dashboard',
            'nav'              => 'dashboard',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName'         => $this->userInfo['username'],
            'isAdmin'          => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'totalFiles'       => count($this->userFiles),
            'totalFreeDiskSpace' => size($userAvailableDiskSpace),
            'totalFilesSize'   =>  size($this->totalFilesSize),
            'totalDownloadedFiles' => DB::table('files')
            ->where('userID', '=', $this->userInfo['id'])->sum('fileDownloadCounter')
        );
        
        
        return View::make('user.dashboard')->with('data',$data);
	}

    
    public function upload() {

        $user = Auth::user();

        $uploadSettingsId = null;

        if ($user->status_id == 5){
            $uploadSettingsId = 3;
        }else{
            $uploadSettingsId = 2;
        }
		
        // Check User Avilable Space 
        $userFilesSize = $this->totalFilesSize;
        $userDiskSpace = uploadSettings::find($uploadSettingsId)->userDiskSpace;
        
        $userAvailableDiskSpace = $userDiskSpace - $userFilesSize;
        
        if($userAvailableDiskSpace < uploadSettings::find($uploadSettingsId)->maxFileSize){
            $MaxUploadSize = $userAvailableDiskSpace;
        }else{
            $MaxUploadSize = uploadSettings::find($uploadSettingsId)->maxFileSize;
        }
        //         
        
        
        $data = array(
            'title'            => 'Upload',
            'nav'              => 'upload',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName'         => $this->userInfo['username'],
            'isAdmin'          => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            // User Files Loop Data
            'userFiles'        =>$this->userFiles,
            'MaxUploadSize' => convertFromBytes($MaxUploadSize,'MB'),
            'uploadSettingsId' => $uploadSettingsId

        );
        
        return View::make('user.upload')->with('data',$data);
	}



    // This Function To Return Needed data To Files Table
    public function files() {
		 ini_set('zlib.output_compression', 'Off');

        //  
            $this->userFilesPaginate = Files::where('userID', '=', $this->userInfo['id'])
            ->orderBy('id','desc')
            ->paginate(20);

        $data = array(
            'title'            => 'My files',
            'nav'   => 'files',
            'settings' => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName' => $this->userInfo['username'],
            'isAdmin'  => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'           => $this->bottomAds,
            // User Files Loop Data
            'totalFiles' => count($this->userFiles),
            'userFiles'  =>   $this->userFilesPaginate

        );
        
        return View::make('user.files')->with('data',$data);
	}


    // This Function Used To Delete a File	
    public function deleteFile() {
        
        $file = Files::find(Input::get('id'));
        // check If User Own This File
        if($this->userInfo['id'] === $file->userID || $this->adminPreviewMode ){
            
            $fileName = $file->filePath;
            $fileName = explode("/",$fileName);
            $fileName = end($fileName);
            $fileExt  = $file->fileExt;             

            $filePath = public_path('../up-files/').$fileName.'.'.$fileExt;

            $delete = File::delete($filePath);

            $delete = true;

            if($delete){
                //delete number of download
                $user = User::find($this->userInfo['id']);

                $user->last_number_of_download = $user->last_number_of_download - Files::find(Input::get('id'))->fileDownloadCounter;

                $user->save();

                    // Delete File From files table
                Files::find(Input::get('id'))->delete();
                
                // Delete File From lockedfiles table If Exists
                $isLock = LockFile::where('fileId','=',Input::get('id'))->delete();


 
                return Response::json('deleted success');
            }else{
                return Response::json('Delete Is Faild');
            }

        }else{
            return Response::json('You Cant Delete This File !');

        }
    }

    //delete all file
    public function deleteAllFile(){
        $allFile = DB::table('files')->where('userID', '=', $this->userInfo['id'])->get();

        $user = User::find($this->userInfo['id']);

        foreach ($allFile as $k => $v){
            $user->last_number_of_download = $user->last_number_of_download - $v->fileDownloadCounter;

            $f = Files::find($v->id);

            $f->delete();
        }

        $user->save();

        return Response::json('deleted success');
    }
    
    // This Function Used To Lock ( Set Password ) a File.
    public function lockFile() {
        
        $file = Files::find(Input::get('eid'));

        if($this->userInfo['id'] === $file->userID || $this->adminPreviewMode ){
            
                if($file) {
                    
                    $lockExists = LockFile::where('fileId','=',$file->id)->first();
                    
                    if( $lockExists && trim(Input::get('password')) === '' ){
                            
                            $lockExists->delete();
                            return Response::json('unLock success');

                    }elseif( $lockExists && trim(Input::get('password')) !== '' ){
                    
                        $lockExists->filePassword = Hash::make(Input::get('password'));
                        $lockExists->save();
                        return Response::json('Change Password success');
                    
                    }else if(!$lockExists && trim(Input::get('password')) !== ''){
                        $lockedFiles = new LockFile;

                        $lockedFiles->fileId = Input::get('eid');
                        $lockedFiles->userID = $this->userInfo['id'];
                        $lockedFiles->filePassword = Hash::make(Input::get('password'));

                        if($lockedFiles->save()){
                            // If Lock Success
                            return Response::json('Lock success');

                        }else{
                            // If Lock Is Fail
                            return Response::json('Lock Is Fails');
                        }
                    }
                }

        }else{
            // If File Not Exsits 
            return Response::json('You Cant Lock This File !');

        }
    }


    // This Function Used To Show Pages index.
    public function pages() {
        if (Auth::user()->plan_id == 1 && Auth::user()->pay_status == 0){
            return Redirect::to('user/' . Auth::user()->username . '/' . 'unpaid' );
        }
        
          // Check User Avilable Space 
        $userFilesSize = $this->totalFilesSize;
        $userDiskSpace = uploadSettings::find(1)->userDiskSpace;
        
        $userAvailableDiskSpace = $userDiskSpace - $userFilesSize;
        
        if($userAvailableDiskSpace < uploadSettings::find(1)->maxFileSize){
            $MaxUploadSize = $userAvailableDiskSpace;
        }else{
            $MaxUploadSize = uploadSettings::find(1)->maxFileSize;
        }
        // 
        
           
        $data = array(
            'title'            => 'Pages',
            'nav'              => 'pages',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName'         => $this->userInfo['username'],
            'isAdmin'          => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'pages'            => DB::table('pages')
                                    ->orderBy('pageOrder','ASC')
                                    ->paginate(20) 
        );
        
        
        return View::make('user.pages')->with('data',$data);
	
    }
    
    
    
    // This Function Used To Change User Settings.
    public function settings() {
        $data = array(
            'title'            => 'Setting',
            'nav'              => 'Settings',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName'         => $this->userInfo['username'],
            'userInfo'         => $this->userInfo,
            'isAdmin'          => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
        );
        
        
        return View::make('user.settings')->with('data',$data);
    }

    public function changeSettings(){
        
        // Get Form Inputs
        $inputs = Input::all();
        
        $rules  = array (); 
        
        if($inputs['email'] !== $this->userInfo['email']){
            
            $rules['email'] = 'required|email|unique:users,email';

        }

        if($inputs['paypal_email'] !== $this->userInfo['paypal_email']){

            $rules['paypal_email'] = 'required';

        }


        if($inputs['username'] !== $this->userInfo['username']){
            
            $rules['username'] = 'min:5|regex:/^[A-Za-z0-9_.-]+$/|max:15|unique:users,username';

        }        
        
        if($inputs['password'] !== $this->userInfo['password']){
            
            $rules['password'] = 'min:6|confirmed';
            $rules['password_confirmation'] = '';

        }
        
        $validator = Validator::make($inputs,$rules);
        
        if( $validator->fails() ){
            
            return Redirect::back()
                    ->withInput($inputs)
                    ->withErrors($validator);
        }else {
            
            $user = User::find($this->userInfo['id']);
            
            $user->username = strtolower($inputs['username']);
            $user->email = $inputs['email'];
            $user->paypal_email = $inputs['paypal_email'];
            
            if($inputs['password'] !== ''){
                $user->password = Hash::make( $inputs['password'] );
            }

            if( $user->save() ){
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::intended('user/'.strtolower($inputs['username']).'/settings');

                }else{

                    return Redirect::to('user/'.strtolower($inputs['username']).'/settings')
                            ->withInput()
                            ->WithErrors(' Please check your entry and try again..');
                }
            }
        
    }

    public function upgrade(){

        $data = array(
            'title'            => 'Upgrade',
            'nav'              => 'upgrade',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'isAdmin'          => $this->isAdmin,
            'userName'         => Auth::user()->username,

        );

        return View::make('user.upgrade')->with('data', $data);
    }

    public function transaction(){
        $data = array(
            'title'            => 'Transaction',
            'nav'              => 'transaction',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'isAdmin'          => $this->isAdmin,
            'userName'         => Auth::user()->username,
            'user'         => Auth::user(),

        );

        return View::make('user.transaction')->with('data', $data);
    }

    public function profit(){

        $user = Auth::user();

        $plan = '';

        $user->status_id == 5 ? $plan = \Plans::find(3) : $plan = \Plans::find(2);

        $number_of_download = DB::table('files')
            ->selectRaw('*, sum(fileDownloadCounter) as sum')->where('userID','=', $user->id)->first()->sum - $user->last_number_of_download;

        $number_of_referral = $user->number_of_referral - $user->last_number_of_referral;

        $invoices = DB::table('require_withdraw')
                ->where('user_id', '=', $user->id)
                ->orderBy('date', 'desc')
                ->get();

        $data = array(
            'title'    => 'My Profit',
            'nav'      => 'profit',
            'settings' => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'userName' => $this->userInfo['username'],
            'isAdmin'  => $this->isAdmin,
            'topAds'           => $this->topAds,
            'bottomAds'           => $this->bottomAds,
            'plan' => $plan,
            'number_of_download' => $number_of_download,
            'number_of_referral' => $number_of_referral,
            'invoices' => $invoices

        );

        return View::make('user.profit')->with('data', $data);
    }

    public function requireWithdraw(){
        $user = Auth::user();

        if(empty($user->paypal_email)){

            Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Notice !</strong> 
                  Please enter your Paypal Email before sending a request payment
                </div>
                ');

            return Redirect::to('user/' . Auth::user()->username . '/settings' );
        }

        $rw = new \RequireWithdraw();

        $rw->user_id = $user->id;
        $rw->date = date('Y-m-d');

        $number_of_download = DB::table('files')
                ->selectRaw('*, sum(fileDownloadCounter) as sum')->where('userID','=', $user->id)->first()->sum - $user->last_number_of_download;

        $number_of_referral = $user->number_of_referral - $user->last_number_of_referral;

        $plan = null;

        $user->status_id == 5 ? $plan = 3 : $plan = 2;

        $rw->profit = $number_of_download * \Plans::find($plan)->profit / 1000 + $number_of_referral * \Plans::find($plan)->referral_profit ;

        $rw->status = 0;

        $rw->save();

        //update last number of download and last number of referral
        $user->last_number_of_download = $number_of_download;
        $user->last_number_of_referral = $number_of_referral;

        $user->save();

        return Redirect::back();
    }

    public function confirmEmail(){
        $data = array(
            'title'            => 'Confirm Email',
            'nav'              => 'confirm_email',
            'settings'         => Settings::find(1),
            'adminPreviewMode' =>  $this->adminPreviewMode,
            'topAds'           => $this->topAds,
            'bottomAds'        => $this->bottomAds,
            'isAdmin'          => $this->isAdmin,
            'userName'         => Auth::user()->username,

        );

        return View::make('user.confirmEmail')->with('data', $data);
    }

    public function sendBackEmail(){
        $this->sendConfirmEmail(Auth::user()->id, Auth:: user()->email);

        return Redirect::to('user/' . Auth::user()->username . '/confirm_email' );
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

    function reCaptcha(){

    }
}
