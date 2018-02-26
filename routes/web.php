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

Route::get("/{any}", 'SpaController@index')->where("any", ".*");
Route::get("/authorize", "OauthController@hpauthorize");
Route::get("/access", "OauthController@hpaccesToken");
Route::get("/toekn", "OauthController@hpToekn");