<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/webservice', function () {
    return view('v1.webservices');
});

Route::get('/view', function () {
    return view('v1.view');
});

Route::get('/check_version', function () {
     $laravel = app();
  	echo $laravel::VERSION;
});



Route::group(['prefix' => ''], function() {
	// Response Status Code //
	define('SUCCESS', '200');
	define('NO_CONTENT', '204');
	define('UNAUTHORIZED', '401');
	define('BAD_REQUEST', '400');
	define('NOT_FOUND', '404');
	define('UPGRADE', '426');
	define('NOT_ACCEPTABLE', '406');
	define('LIMIT_REACHED', '429');

});

//Route::get('v1/verify_email/{user_id}',);
Route::get('v1/verify-email/{user_id}',"v1\UserController@verify_email");

Route::group(['prefix' => 'v1'], function() {
	Route::post('signup','v1\UserController@signup')->name('signup');
	Route::post('socialSignup','v1\UserController@socialSignup')->name('socialSignup');
	Route::any('login','v1\UserController@login')->name('login');
	
	Route::any('forgotPassword','v1\UserController@forgotPassword')->name('forgotPassword');
	/* tokens start Here--*/

	
	//Route::get('resetPasswordForm/{token}','v1\Usercontroller@resetPasswordForm')->name('resetPasswordForm');
	//Route::any('setNewPassword','v1\Usercontroller@setNewPassword')->name('setNewPassword');
	
//Route::middleware(['AuthAPI'])->group(function () {

	Route::get('getInterest','v1\UserController@getInterest')->name('getInterest');
	Route::get('getWorkplace','v1\UserController@getWorkplace')->name('getWorkplace'); 


	Route::any('getDays','v1\UserController@getDays')->name('getDays');
	Route::any('getTimes','v1\UserController@getTimes')->name('getTimes');
	Route::post('createProfile','v1\UserController@createProfile')->name('createProfile');
	Route::post('otherUserProfile/{other_user_id}','v1\UserController@viewProfile');
	Route::get('getProfile','v1\UserController@MyProfile');
	Route::post('updateProfile','v1\UserController@updateProfile');
	Route::post('changePassword','v1\UserController@changePassword')->name('changePassword');

	Route::any('logout','v1\UserController@logout')->name('logout');

	Route::post('delete-account','v1\UserController@deleteAccount');
	Route::get('disable-account','v1\UserController@disableUser');

	/*Route::get('/suggestions','v1\UserController@getSuggestions')->name('suggestions');*/

	Route::get('users/blockUser/{blockUserId}','v1\UserController@blockUser')->name('blockUser');
	Route::get('users/blocked-users','v1\UserController@AllBlockedUser');
	Route::get('users/unblock/{other_user_id}','v1\UserController@unblockUser'); 

	Route::post('users/match/{other_user_id}','v1\UserController@matchUser')->name('match');

	Route::get('users/unmatch/{other_user_id}','v1\UserController@unmatchUser');
	Route::get('users/my-matches','v1\UserController@getAllMatch');

	Route::post('users/{userId}/reports','v1\UserController@reportUser')->name('reports');

	Route::post('users/send-message/{receiverId}','v1\UserController@insertMessages');
	Route::get('users/get-message/{other_user}/','v1\UserController@getMessages');
	Route::post('users/delete-messages/{other_user}','v1\UserController@hideMyMessages');
	
	Route::get('users/last-messages-list','v1\UserController@getLastMessage');
	
	Route::get('users/preference','v1\UserController@userPreference');
	Route::post('users/update-preference','v1\UserController@updateUserPreference');
	Route::post('users/suggestions','v1\UserController@userSuggest');
	
	Route::get('users/notification/{other_user_id}',"v1\UserController@notifyMe");
	/*After create profile---*/
//});

    Route::post('addcard','v1\UserController@addcard')->name('addcard');
	Route::post('addBank','v1\UserController@addBank')->name('addBank');
	Route::get('userHome','v1\UserController@userHome')->name('userHome');
	Route::any('services_details','v1\UserController@services_details')->name('services_details');
	Route::post('post_service','v1\UserController@addNewService')->name('addNewService');
	Route::post('getConfirmPost','v1\UserController@getConfirmPost')->name('getConfirmPost');
	Route::post('addMoreServices','v1\UserController@addMoreServices')->name('addMoreServices');
	
	Route::post('subscriptionPlan','v1\UserController@subscriptionPlan')->name('subscriptionPlan');
	Route::post('notification','v1\UserController@notification')->name('notification');  //for on off notification
	Route::post('contactUs','v1\UserController@contactUs')->name('contactUs');  //for on off notification
	Route::get('articleList','v1\UserController@articleList')->name('articleList');  //for on off notification
	Route::post('articleDetails','v1\UserController@articleDetails')->name('articleDetails');  //for on off notification
	Route::post('report_bug','v1\UserController@reportABug')->name('report_bug');  //for on off notification
  	
	Route::post("subscriptions",'v1\UserController@subscriptions')->name("subscriptions.store");


	
});
