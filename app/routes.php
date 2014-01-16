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
/*------------------------------Admin routes-------------------------------*/
Route::get('admin/jobs/approve/all',array('before'=>'auth','uses'=>'JobsController@getApproveAll'));
Route::get('admin/job/{id}/delete',array('before'=>'auth','uses'=>'JobsController@getDeleteJobPost'));
Route::post('admin/approve/all',array('before'=>'auth','uses'=>'JobsController@postApproveAll'));
Route::post('admin/job/disapprove',array('before'=>'auth','uses'=>'JobsController@postDisApprove'));
Route::get('admin/job/{id}/edit',array('before'=>'auth','uses'=>'JobsController@getEdit'));
Route::post('admin/job/update',array('before'=>'auth','uses'=>'JobsController@postEdit'));
Route::get('admin/jobs',array('before'=>'auth','uses'=>'JobsController@getIndex'));



/*-------------------------------------------------------------------------*/
Route::get('job/search',array('uses'=>'JoblistingController@getSearch'));
Route::get('job/{id}/detail',array('uses'=>'JoblistingController@getDetails'));
Route::get('job/list',array('uses'=>'JoblistingController@getIndex'));
Route::get('job/create',array('uses'=>'JoblistingController@getCreate','as'=>'JobListings.create'));
Route::post('job/create',array('uses'=>'JoblistingController@postCreate','as'=>'JobListings.create','as'=>'JobListings.store'));
Route::get('job/{id}/destroy',array('uses'=>'JoblistingController@getIndex','as'=>'JobListings.destroy'));

// JobListings.edit


Route::get('clean',function(){
    Setting::set('providers.listing','[A-Za-z]+');
    dd(Setting::get('providers.listing'));
// Schema::drop('oauths');
// Schema::drop('orchestra_options');
// Schema::drop('password_reminders');
// Schema::drop('roles');
// Schema::drop('users');
// Schema::drop('user_meta');
// Schema::drop('user_role');
});
Route::get('hybridauth',function(){
    require_once( __DIR__."/../vendor/hybridauth/hybridauth/hybridauth/Hybrid/Auth.php" );
    require_once( __DIR__."/../vendor/hybridauth/hybridauth/hybridauth/Hybrid/Endpoint.php" );
    Hybrid_Endpoint::process();
});
Route::get('/unlink/{provider}','LoginController@unlinkProvider')->where('provider',Setting::get('providers.listing','[A-Za-z]+'))->before('auth');
Route::get('/login/{provider}','LoginController@login')->where('provider',Setting::get('providers.listing','[A-Za-z]+'));
Route::get('/register/{provider}','LoginController@register')->where('provider',Setting::get('providers.listing','[A-Za-z]+'));
Route::get('login',function(){
    if(Auth::guest()){
        return View::make('test');
    }
    return Redirect::to('/admin');
});
Route::get('/logout',function(){
    Auth::logout();
    return Redirect::to('/');
});
Route::get('/', function()
{
    return View::make('hello');
});

