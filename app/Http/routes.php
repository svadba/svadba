<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
        
        Route::group(['prefix' => 'admin'], function(){
            Route::get('admin','AdminController@admin')->middleware('role');
            Route::get('blogAdmin','AdminController@blogAdmin')->middleware('role:2');
            Route::get('adManager','AdminController@adManager')->middleware('role:3');
            Route::get('requestManager','AdminController@requestManager')->middleware('role:4');
        });

        //group contractor
        Route::group(['prefix' => 'contractors'], function(){
            Route::get('my','ContController@my')->middleware('role:3');
            Route::get('all','ContController@all')->middleware('role:3');
            Route::get('add','ContController@add')->middleware('role:3');
            Route::post('save','ContController@save')->middleware('role:3,5');
            Route::get('view/{contractor}','ContController@view')->middleware('role:3');
            Route::get('delete/{contractor}','ContController@delete')->middleware('role:3,5');
        });

        //group advert
        Route::group(['prefix' => 'adverts'], function(){
            Route::get('my', 'AdvertController@my')->middleware('role:3');
            Route::get('all', 'AdvertController@all')->middleware('role:3');
            Route::post('save', 'AdvertController@save')->middleware('role:3,5');
            Route::get('add/{contractor}', 'AdvertController@add')->middleware('role:3');
            Route::get('view/{advert}', 'AdvertController@add')->middleware('role:3');
            Route::get('edit/{advert}', 'AdvertController@edit')->middleware('role:3');
            Route::get('delete/{advert}', 'AdvertController@delete')->middleware('role:3,5');
        });

});

Route::get('/test_method', 'TestController@test_method');
//Route::get('/addrole', 'AddRoleController@index');

