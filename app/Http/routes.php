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

Route::get('/', ['as' => 'home', 'uses' => 'MainController@home']);

Route::post('/add', ['as' => 'add', 'uses' => 'MainController@add']);

Route::get('/{address}', ['as' => '', 'uses' => 'MainController@redirectUrl']);

Route::get('statistics/{address}', ['as' => '', 'uses' => 'MainController@statistics']);

Route::post('statistics/', ['as' => '', 'uses' => 'MainController@statisticsUrlShort']);