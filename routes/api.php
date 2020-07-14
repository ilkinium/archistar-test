<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->group(
    function () {
        //Create property route
        Route::post('/property', 'PropertyController@create');
        //Assign analytic type to a property route
        Route::post('/property/{id}/analytic', 'PropertyController@assignAnalytic');
        //Update analytic type with given property id route
        Route::match(['put', 'patch'], '/property/{id}/analytic', 'PropertyController@update');
        //Get all analytics for an inputted property route
        Route::get('/property/{id}', 'PropertyController@show');
        //Get analytics summary by query(conditions) route
        Route::post('/analytics-summary', 'PropertyController@index');
    }
);

