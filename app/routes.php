<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



if (Request::is('admin') || Request::is('admin/*') ){
    View::addLocation(public_path().'');
}

## Check Token ( For csrf attack Protection )
Route::when('*', 'csrf', array('post','put', 'delete'));

Route::group( array('before'=>'websiteStatus') , function () {
    ##user confirm email
    Route::get('confirm/{key}', 'app\\Controllers\\UserConfirmEmailController@index');

    ##Test
    Route::get('testPay123','app\\Controllers\\Test123Controller@testPay');

    Route::get('testPaySuccess123','app\\Controllers\\Test123Controller@testPaySuccess');
    
    ##Test
    Route::get('test123','app\\Controllers\\Test123Controller@index');

    ## Homepage Route 
    Route::get('/','app\\Controllers\\HomeController@index');
    ## upload file
    Route::post('uploadFile','app\\Controllers\\UploadController@uploadFile');
    ## Guest upload file
    Route::post('guestUploadFile','app\\Controllers\\UploadController@guestUploadFile');
    ## Show Guest Session Files
    Route::get('guest/{guestSession}','app\\Controllers\\GuestSessionController@show');
    Route::delete('guest/{guestSession}/delete','app\\Controllers\\GuestSessionController@delete');
    Route::put('guest/{guestSession}/lock','app\\Controllers\\GuestSessionController@lock');
    Route::post('guest/{guestSession}/sendFiles','app\\Controllers\\GuestSessionController@sendFiles');         

    ## show File
    Route::get('file/{path}','app\\Controllers\\FilesController@showFile');
    ## Download File
    Route::post('file/{path}','app\\Controllers\\FilesController@downloadFile');
    Route::post('file/{path}/downloadLocked','app\\Controllers\\FilesController@downloadLockedFile');
    Route::get('page/{id}','app\\Controllers\\AdminPagesSettingsController@show');

});

## Signed Out Group ( Auth::check == true )
Route::group( array('before'=>'hasAuth'), function () {
    
    ## Login - Signup Controller
    Route::get('auth/{type}','app\\Controllers\\AuthController@index');
    Route::post('auth/login','app\\Controllers\\AuthController@login');
    Route::post('auth/signup','app\\Controllers\\AuthController@signup');
    Route::get('password/remind','app\\Controllers\\RemindersController@getRemind');
    Route::post('password/remind','app\\Controllers\\RemindersController@postRemind');
    Route::get('password/reset/{token}','app\\Controllers\\RemindersController@getReset');
    Route::post('password/reset/{token}','app\\Controllers\\RemindersController@postReset');
});


## Signed In Group ( Auth::check == true )
Route::group( array('before'=>'auth'), function () {
    
    Route::group( array('before'=>'isAdmin') , function () {

        ## Admin Home Routes        
        Route::get('admin','app\\Controllers\\AdminController@index');
        
        ## settings routes
        Route::get('admin/settings','app\\Controllers\\AdminController@settings');
        Route::post('admin/settings','app\\Controllers\\AdminController@saveSettings');
        
        ## Uploader Settings Route
        //Route::get('admin/upload','app\\Controllers\\AdminUploadSettingsController@index');
        //Route::post('admin/upload','app\\Controllers\\AdminUploadSettingsController@saveUploadSettings');
        
        ## Files Settings Route
        Route::get('admin/files','app\\Controllers\\AdminFilesSettingsController@index');
        
        Route::get('admin/files/delete/{id}','app\\Controllers\\AdminFilesSettingsController@deleteFile');
        
        Route::get('admin/files/deleteAll','app\\Controllers\\AdminFilesSettingsController@deleteAll');                   
        
        Route::get('admin/guestFiles','app\\Controllers\\AdminFilesSettingsController@guestFiles');
        
        
    Route::get('admin/guestFiles/delete/{id}','app\\Controllers\\AdminFilesSettingsController@deleteguestFile');
        
        Route::get('admin/guestFiles/deleteAll','app\\Controllers\\AdminFilesSettingsController@deleteAllguestFiles');
        
        Route::get('admin/guestFiles/deleteExpired','app\\Controllers\\AdminFilesSettingsController@deleteExpiredFiles');

        ## plans Settings Route
        Route::get('admin/plans','app\\Controllers\\AdminPlansSettingsController@index');

        Route::get('admin/plan/edit/{id}','app\\Controllers\\AdminPlansSettingsController@edit');
        Route::post('admin/plan/edit/{id}','app\\Controllers\\AdminPlansSettingsController@store');

        Route::get('admin/plan/uploadSettings/{id}','app\\Controllers\\AdminPlansSettingsController@uploadSettings');
        Route::post('admin/plan/uploadSettings/{id}','app\\Controllers\\AdminPlansSettingsController@saveUploadSettings');

        ##Payment Method
        Route::get('admin/payments','app\\Controllers\\AdminPaymentSettingsController@index');

        Route::get('admin/payments/edit/{id}','app\\Controllers\\AdminPaymentSettingsController@edit');
        Route::post('admin/payments/edit/{id}','app\\Controllers\\AdminPaymentSettingsController@update');

        Route::get('admin/payments/status/{id}','app\\Controllers\\AdminPaymentSettingsController@status');

        ## Transactions
        Route::get('admin/transactions','app\\Controllers\\AdminTransactionsController@index');
        Route::get('admin/transactions/reject/{id}','app\\Controllers\\AdminTransactionsController@reject');
        Route::get('admin/transactions/approve/{id}','app\\Controllers\\AdminTransactionsController@approve');
        Route::get('admin/transactions/deleteAll','app\\Controllers\\AdminTransactionsController@deleteAll');

        ## users Settings Route
        Route::get('admin/users','app\\Controllers\\AdminUsersSettingsController@index');
        Route::get('admin/user/create','app\\Controllers\\AdminUsersSettingsController@create');
        Route::post('admin/user/create','app\\Controllers\\AdminUsersSettingsController@store');

        Route::get('admin/users/upgrade_downgrade/{id}','app\\Controllers\\AdminUsersSettingsController@upgrade_downgrade');

        Route::get('admin/users/delete/{id}','app\\Controllers\\AdminUsersSettingsController@deleteUser');
        
        Route::get('admin/users/deleteAll','app\\Controllers\\AdminUsersSettingsController@deleteAll');

        ##invoice
        Route::get('admin/invoice/index','app\\Controllers\\AdminInvoicesController@index');
        Route::get('admin/invoice/create','app\\Controllers\\AdminInvoicesController@create');
        Route::get('admin/invoice/success','app\\Controllers\\AdminInvoicesController@success');
        Route::get('admin/invoice/delete/{id}','app\\Controllers\\AdminInvoicesController@delete');
        Route::get('admin/invoice/deleteAll','app\\Controllers\\AdminInvoicesController@deleteAll');

        ##require
        Route::get('admin/require/index','app\\Controllers\\AdminRequiresController@index');
        Route::get('admin/require/delete/{id}','app\\Controllers\\AdminRequiresController@delete');
        Route::get('admin/require/deleteAll','app\\Controllers\\AdminRequiresController@deleteAll');

        ## Email Settings Route
        Route::get('admin/email','app\\Controllers\\AdminEmailSettingsController@index');
        
        Route::post('admin/email','app\\Controllers\\AdminEmailSettingsController@saveEmailSettings');
        
        Route::get('admin/emailTemplates','app\\Controllers\\AdminEmailSettingsController@emailTemplates');
     
        Route::post('admin/emailTemplates','app\\Controllers\\AdminEmailSettingsController@saveEmailTemplates');
        
        ## Themes & Templates Settings Routes
        Route::get('admin/themes','app\\Controllers\\AdminTemplateDesignSettingsController@themes');
        
        Route::get('admin/themes/activate/{name}','app\\Controllers\\AdminTemplateDesignSettingsController@savetheme');   
        
        Route::get('admin/themeCustomize','app\\Controllers\\AdminTemplateDesignSettingsController@themesCustomize');
  
        Route::post('admin/themeCustomize','app\\Controllers\\AdminTemplateDesignSettingsController@saveThemesCustomize');
        
        ## Pages Settings Controller
        Route::get('admin/pages','app\\Controllers\\AdminPagesSettingsController@index');
        
        Route::get('admin/pages/create','app\\Controllers\\AdminPagesSettingsController@create');
        
        Route::post('admin/pages/create','app\\Controllers\\AdminPagesSettingsController@store');
        
        Route::get('admin/pages/edit/{id}','app\\Controllers\\AdminPagesSettingsController@edit');
        
        Route::post('admin/pages/edit/{id}','app\\Controllers\\AdminPagesSettingsController@update');
        
        Route::get('admin/pages/delete/{id}','app\\Controllers\\AdminPagesSettingsController@destroy');

        
        ## Advertising Settings Controller
        Route::get('admin/advertising','app\\Controllers\\AdminAdvertisingSettingsController@index');
        
        Route::post('admin/advertising','app\\Controllers\\AdminAdvertisingSettingsController@saveAds');
        
        Route::PUT('admin/advertising/adsContent','app\\Controllers\\AdminAdvertisingSettingsController@getAdsContent');

        ## plugins Settings Route
        Route::get('admin/plugins','app\\Controllers\\AdminPluginsSettingsController@index');
        
        ## Social Settings Route
        Route::get('admin/social','app\\Controllers\\AdminsocialSettingsController@index');
        Route::post('admin/social','app\\Controllers\\AdminsocialSettingsController@saveUploadSettings');

    });

    Route::group( array('before'=>'checkUserFrofileAccess|websiteStatus') , function () {

        Route::group( ['before' => 'checkConfirmSetting|checkConfirmEmailStatus'], function () {
            ##Confirm email
            Route::get('user/{username}/confirm_email', 'app\\Controllers\\UserController@confirmEmail');

            ## Send back email
            Route::get('user/{username}/send_back_email', 'app\\Controllers\\UserController@sendBackEmail');
        });

        Route::group( ['before' => 'checkConfirmEmail'], function (){


            ## User Test Pay Route
            Route::get('user/{username}/testPay','app\\Controllers\\PayController@index');

            ##create transaction when user click paypal button
            Route::get('user/{username}/create_transaction','app\\Controllers\\PayController@create_transaction');

            ## User Pay Successfully
            Route::get('user/{username}/pay_success','app\\Controllers\\PayController@pay_success');

            ## User Upgrade Successfully
            Route::get('user/{username}/upgrade_success','app\\Controllers\\PayController@upgrade_success');

            ## User Upgrade Route
            Route::get('user/{username}/upgrade','app\\Controllers\\UserController@upgrade');

            ## User Profit Route
            Route::get('user/{username}/profit','app\\Controllers\\UserController@profit');

            ## User Transaction Route
            Route::get('user/{username}/transaction','app\\Controllers\\UserController@transaction');

            ## User Require Withdraw Route
            Route::post('user/{username}/require_withdraw','app\\Controllers\\UserController@requireWithdraw');

            ## User Unpaid Route
            Route::get('user/{username}/unpaid','app\\Controllers\\UserController@unpaid');
            ## User Dashboard Route
            Route::get('user/{username}','app\\Controllers\\UserController@dashboard');
            ## Upload Route
            Route::get('user/{username}/upload','app\\Controllers\\UserController@upload');
            ## User upload Post Route
            Route::post('user/{username}/uploadFile','app\\Controllers\\UploadController@uploadFile');
            ## User Files Route
            Route::get('user/{username}/files','app\\Controllers\\UserController@files');
            ## Delete File Ajax
            Route::delete('user/{username}/files/delete','app\\Controllers\\UserController@deleteFile');
            ## Delete All File Ajax
            Route::delete('user/{username}/files/deleteAll','app\\Controllers\\UserController@deleteAllFile');
            ## Lock File Ajax
            Route::put('user/{username}/files/lock','app\\Controllers\\UserController@lockFile');
             ## Send Files Route
            Route::get('user/{username}/send','app\\Controllers\\SendFilesController@files');
            Route::post('user/{username}/send','app\\Controllers\\SendFilesController@sendFiles');
            ## Settings Route
            Route::get('user/{username}/settings','app\\Controllers\\UserController@settings');
            Route::post('user/{username}/settings','app\\Controllers\\UserController@changeSettings');
            ## Pages
            Route::get('user/{username}/pages','app\\Controllers\\UserController@pages');
        });


    });
    
    ## Logout Route 
    Route::get('logout','app\\Controllers\\AuthController@logout');

});

