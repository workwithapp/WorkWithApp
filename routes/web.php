<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('services_view',function(){
	 return view('v1/webservices');
});

Route::get('/', function () {
    return view('welcome');
});



//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("admin/contact_us","admin@contactUs");
Route::get("admin/report_bugs","admin@reportBugs");


Route::any('admin/','admin@dashboard');
Route::any('admin/signin','admin@signin');
Route::get('admin/login','admin@login');
Route::any('admin/logout','admin@logout');
Route::get('admin/get_users','admin@get_users');
Route::get('admin/get_spList','admin@get_spList');
Route::any('admin/changeStatus/{token}/{token1}/{user_type}','admin@changeStatus');
Route::get('admin/adminProfileForm','admin@adminProfileForm');
Route::post('admin/AdminProfile','admin@AdminProfile');
Route::get('admin/change_password_view','admin@change_password_view');
Route::post('admin/change_password','admin@change_password');
Route::get('admin/add_services','admin@add_services');


Route::post('admin/insert_services','admin@insert_services');
Route::post('admin/addServiceTimePrice','admin@addServiceTimePrice');
Route::get('admin/report_management','admin@report_management');
Route::get('admin/appointment_management','admin@appointment_management');
Route::get('admin/getappointmentdetails/{poat_id}','admin@getappointmentdetails');
Route::get('admin/job_forword/{poat_id}','admin@job_forword');

Route::get('admin/getadmin_profile','admin@getadmin_profile');
Route::get('admin/view_services','admin@view_services');
Route::get('admin/edit_services_list/{id}','admin@edit_services_list');
Route::get('admin/addPriceTime/{id}','admin@addPriceTime');
Route::post('admin/reply_report','admin@reply_report');
Route::post('admin/updatejobforword','admin@updatejobforword');

Route::get('admin/getuserdetails/{user_id}/{user_type}','admin@getuserdetails');
Route::get('admin/single_message/{message_id}','admin@single_message');
Route::get('admin/rejection_reason/{reason_id}','admin@rejection_reason');
Route::get('admin/postnoti/{post_id}','admin@postnoti');

Route::get('admin/view_payment_transactions','admin@view_payment_transactions');
Route::get('admin/adminAddCard','admin@adminAddCard');
Route::post('admin/addAdminCard','Adminpaymentcontroller@card_save');
Route::get('admin/sendsp_payment/{id}','admin@sendsp_payment');
Route::get('admin/refund_amount/{id}','Adminpaymentcontroller@refund_amount');
Route::get('email_verified',function(){
	echo "Your email has been verified,please login in workwith app";
});

Route::get('account-verify/{user_id}',"v1\UserController@verify_email");