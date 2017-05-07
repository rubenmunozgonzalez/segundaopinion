<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('front_end.home');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    //==========================Bankend  Route================================================//
    Route::any('/consultas/login', array('as' => 'signIn', 'uses' => 'Admin\AdminUser@loginForm'));
    Route::any('/consultas/admin', array('as' => 'admin', 'uses' => 'Admin\AdminUser@loginForm'));
    Route::any('/consultas-admin/login', array('as' => 'admin', 'uses' => 'Admin\AdminUser@loginForm'));
    Route::any('/adminLoginCheck', array('as' => 'adminLoginCheck', 'uses' => 'Admin\AdminUser@adminLoginCheck'));
    
    Route::any('/doctorDashboard', array('as' => 'doctorDashboard', 'uses' => 'Admin\AdminUser@doctorDashboard'));
    Route::any('/patientDashboard', array('as' => 'patientDashboard', 'uses' => 'Admin\AdminUser@patientDashboard'));

    Route::any('/adminForgotPassword', array('as' => 'adminForgotPassword', 'uses' => 'Admin\AdminUser@AdminForgotPassword'));
    Route::any('/adminForgotPass', array('as' => 'adminForgotPass', 'uses' => 'Admin\AdminUser@adminForgotPass'));

    Route::any('/adminChangePassword', array('as' => 'adminChangePassword', 'uses' => 'Admin\AdminUser@adminChangePassword'));
    Route::any('/adminChangePass', array('as' => 'adminChangePass', 'uses' => 'Admin\AdminUser@adminChangePass'));

    Route::get('/logout', array('as' => 'logout', 'uses' => 'Admin\AdminUser@getLogOut'));

    //==========================Front End  Route================================================//

    Route::any('/', array('as' => 'homePage', 'uses' => 'FrontEnd\HomeController@homePage'));

    Route::any('/doctorRegDetail',array('as' => 'doctorRegDetail', 'uses' => 'FrontEnd\HomeController@doctorRegDetail'));
    Route::any('/patientRegDetail',array('as' => 'patientRegDetail', 'uses' => 'FrontEnd\HomeController@patientRegDetail'));
    Route::any('/joinPage',array('as' => 'joinPage', 'uses' => 'FrontEnd\HomeController@joinPage'));
    Route::any('/signUpDoctor',array('as'=>'signUpDoctor','uses'=>'FrontEnd\HomeController@signUpDoctor'));
    Route::any('/signUpPatient',array('as'=>'signUpPatient','uses'=>'FrontEnd\HomeController@signUpPatient'));
    Route::any('/acceptConditions',array('as'=>'acceptConditions','uses'=>'FrontEnd\HomeController@acceptConditions'));
    Route::any('/conditionsAccepted',array('as'=>'conditionsAccepted','uses'=>'FrontEnd\HomeController@conditionsAccepted'));

    Route::post('/addPatient',array('as'=>'addPatient','uses'=>'FrontEnd\HomeController@addPatient'));
    Route::post('/updatePatient',array('as'=>'updatePatient','uses'=>'FrontEnd\HomeController@updatePatient'));
    Route::post('/addDoctor', array('as' => 'addDoctor', 'uses' => 'FrontEnd\HomeController@addDoctor'));
    Route::post('/updateDoctor',array('as'=>'updateDoctor','uses'=>'FrontEnd\HomeController@updateDoctor'));
    Route::any('/registrationSuccessMassege', array('as' => 'registrationSuccessMassege', 'uses' => 'FrontEnd\HomeController@registrationSuccessMassege'));
    Route::any('/confiormEmail/{id}', array('as' => 'confiormEmail', 'uses' => 'FrontEnd\HomeController@confiormEmail'));

    Route::get('/cookies-policy', 'FrontEnd\HomeController@cookie_policy');

    // Payment routes
    Route::any('payment', array(
     'as' => 'payment',
     'uses' => 'PaypalController@postPayment',
    ));

    // this is after make the payment, PayPal redirect back to your site
     Route::get('payment/status', array(
     'as' => 'payment.status',
     'uses' => 'PaypalController@getPaymentStatus',
    ));

    Route::get('fileentry', 'FileEntryController@index');
    Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
    Route::post('fileentry/add',[
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);

    Route::get('excel/testExport',['as' => 'testExport', 'uses' => 'ExcelController@testExport']);
});
