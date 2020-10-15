<?php

use App\Http\Middleware\adminCheck;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::any('{slug}', function(){
	return view('welcome');
});

// Route::prefix('app')->middleware([adminCheck::class])->group(function(){
	

	
// });

Route::post('/app/upload', 'UserController@upload');
Route::post('/app/delete_image', 'UserController@deleteImage');

Route::post('app/registration', 'UserController@registration');
Route::post('app/login', 'UserController@login');
Route::post('app/email_check', 'UserController@emailCheck');
Route::get('app/get_email', 'UserController@codeCheck');
Route::post('app/code_check', 'UserController@codeCheck');
Route::post('app/new_password', 'UserController@newPassword');
Route::get('/', 'UserController@index');



Route::get('app/get_userData', 'UserController@getUserData');
Route::post('app/edit_profile', 'UserController@editProfile');
Route::post('app/edit_password', 'UserController@editPassword');



Route::get('app/get_events', 'EventController@getEvents');
Route::get('/app/single_events/{id}', 'EventController@singleEvents');
Route::post('/app/add_eventDetails', 'EventController@addEventDetails');
Route::post('/app/add_eventSpeaker', 'EventController@addEventSpeaker');
Route::post('/app/add_eventSponsor', 'EventController@addEventSponsor');
Route::get('/app/get_eventsSpeakers/{id}', 'EventController@getEventsSpeakers');
Route::get('/app/get_eventsSponsors/{id}', 'EventController@getEventsSponsors');
Route::post('/app/edit_eventSponsor', 'EventController@editEventSponsor');
Route::post('/app/add_newEventSponsor', 'EventController@addNewEventSponsor');
Route::post('/app/delete_sponsor', 'EventController@deleteSponsor');
Route::post('/app/add_newEventSpeaker', 'EventController@addNewEventSpeaker');
Route::post('/app/edit_eventSpeaker', 'EventController@editEventSpeaker');





Route::any('{slug}', 'UserController@index');

// Route::any('{slug}', 'UserController@home')->where('slug', '([A-z\d-/_.]+)?');


// Route::get('/new', 'TestController@controllerMethod');

// Route::any('{slug}', function(){
// 	return view('welcome');
// });