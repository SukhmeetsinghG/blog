<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/front','Front@index');
Route::get('/products','Front@products');
Route::get('/products/details/{id}','Front@product_details');
Route::get('/products/categories','Front@product_categories');
Route::get('/products/brands','Front@product_brands');
Route::get('/blog','Front@blog');
Route::get('/blog/post','Front@blog_post');
Route::get('/contact-us','Front@contact_us');
Route::get('/login','Front@login');
Route::get('/logout','Front@logout');
Route::get('/cart','Front@cart');
Route::get('/checkout','Front@checkout');
Route::get('/search/{query}', 'Front@search');
Route::post('/cart', 'Front@cart');
// Authentication routes...
Route::get('auth/login', 'Front@login');
Route::post('auth/login', 'Front@authenticate');
Route::get('auth/logout', 'Front@logout');

// Registration routes...
Route::post('/register', 'Front@register');
Route::post('/checkmail', 'Front@checkmail');

Route::get('/checkmail', 'Front@checkmail');


Route::get('practice', function(){
  return view('user');
});
Route::post('pract-reg', 'User_details@register');
Route::get('practice/pract-login', function(){
  return view('userlogin');
});

Route::post('practice/pract-login', 'User_details@userlogin');
Route::get('practice/list', 'User_details@userlist')->middleware('authcheck');
Route::get('practice/edit/{id}', 'User_details@edituser');
Route::post('edit/{id}', 'User_details@updateuser');
Route::get('practice/delete/{id}', 'User_details@deleteuser');
Route::get('practice/logout', 'User_details@userlogout');

Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
//Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
//Route::get('redirect/google', 'SocialAuthController@callback');

Route::get('fileentry', 'FileEntryController@index');
Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
Route::post('fileentry/add',[ 
        'as' => 'addentry', 'uses' => 'FileEntryController@add']);
Route::get('remove/{id}', [ 'as' => 'remove' , 'uses' => 'FileEntryController@remove']);

Route::group(['middleware' => ['web']], function () {

    Route::get('payPremium', ['as'=>'payPremium','uses'=>'PaypalController@payPremium']);

   Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);

    Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);

    Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);

});

Route::get('formtest', function(){
	return view('formtest');
});
Route::post('formtest', 'User_details@formtest');

Route::get('my-test-mail','User_details@myTestMail');
Route::get('practice/mail/{id}', 'User_details@mailregisteration------');