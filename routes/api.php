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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function() {
    // スライド情報
    Route::get('{slide_name}',  'Api\StorageController@get');
    Route::post('insert/slide',  'Api\StorageController@insertSlide');
    Route::post('insert/page',  'Api\StorageController@insertPage');

    Route::get('user/{uid}',  'Api\UserController@get');
    Route::get('user/limit/{uid}',  'Api\UserController@limit');
    Route::post('user/update',  'Api\UserController@update');
});