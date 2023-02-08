<?php

use Illuminate\Http\Request;
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
Route::group(['namespace' => '\Modules\Customer\Http\Controllers\Api', 'as' => 'frontend.', 'middleware' => 'api', 'prefix' => ''], function () {

    /*
     *
     *  Frontend Customers Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'customers';
    $controller_name = 'CustomersController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/{id}/{slug?}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
});

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Customer\Http\Controllers\Api', 'as' => 'backend.', 'middleware' => ['api'], 'prefix' => 'admin'], function () {
 
    /*
     *
     *  Backend Customers Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'customers';
    $controller_name = 'CustomersApiController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::resource("$module_name", "$controller_name");
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });