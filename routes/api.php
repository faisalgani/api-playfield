<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\facilities_category;

use App\Http\Controllers\Mobile\C_facilities;
use App\Http\Controllers\Mobile\C_event;
use App\Http\Controllers\Mobile\C_news;
use App\Http\Controllers\Mobile\C_class;
use App\Http\Controllers\Mobile\C_room;


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

// CMS ADMIN
$router->group(['prefix' => 'v1'], function () use ($router) {
    //FACILITIES CATEGORY
    Route::get('category_facilites', [facilities_category::class, 'get']);
    Route::post('category_facilites', [facilities_category::class, 'create']);
    Route::delete('category_facilites', [facilities_category::class, 'delete']);
    Route::put('category_facilites/{id}', [facilities_category::class, 'update']);    
});

// MOBILE

// FACILITIES
Route::get('get_facilities', [C_facilities::class, 'get']);
Route::get('get_detail_facilities/{id}', [C_facilities::class, 'get_detail']);

// EVENT
Route::get('get_event', [C_event::class, 'get']);
Route::get('get_event/{name}', [C_event::class, 'get']);

// NEWS
Route::get('get_news', [C_news::class, 'get']);
Route::get('get_breaking_news', [C_news::class, 'get_breaking_news']);
Route::get('get_detail_news/{id}', [C_news::class, 'get_detail']);

// BUSINNES INDEX
// Route::get('get_business_index/{id}', [C_news::class, 'get']);


// CLASS
Route::get('get_group_class', [C_class::class, 'get_group_class']);
Route::get('get_detail_class/{id}', [C_class::class, 'get_detail_class']);

// ROOM
Route::get('get_room', [C_room::class, 'get_room']);
Route::get('get_detail_room/{id}', [C_room::class, 'get_detail_room']);
Route::get('get_room_schedule/{id}/{date}', [C_room::class, 'get_room_schedule']);
