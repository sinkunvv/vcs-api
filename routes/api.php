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
    // ランキング取得
    // Route::get('{user_id}/{slide_id}',  'Api\StorageController@getData');
    Route::get('{slide_name}',  'Api\StorageController@get');
    Route::post('insert/slide',  'Api\StorageController@insertSlide');
    Route::post('insert/page',  'Api\StorageController@insertPage');
});