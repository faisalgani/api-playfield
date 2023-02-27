<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\facilities_category;

use App\Http\Controllers\Mobile\C_facilities;
use App\Http\Controllers\Mobile\C_event;
use App\Http\Controllers\Mobile\C_news;
use App\Http\Controllers\Mobile\C_class;
use App\Http\Controllers\Mobile\C_room;
use App\Http\Controllers\Mobile\C_business_index;
use App\Http\Controllers\Mobile\C_member;


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
Route::get('get_detail_event/{id}', [C_event::class, 'get_detail_event']);

// NEWS
Route::get('get_news', [C_news::class, 'get']);
Route::get('get_news/{name}', [C_news::class, 'get']);
Route::get('get_breaking_news', [C_news::class, 'get_breaking_news']);
Route::get('get_detail_news/{id}', [C_news::class, 'get_detail']);

// BUSINNES INDEX
Route::get('get_business_index', [C_business_index::class, 'get']);
Route::get('get_business_index/{name}', [C_business_index::class, 'get']);
Route::get('get_detail_business/{id}', [C_business_index::class, 'get_detail']);


// CLASS
Route::get('get_group_class', [C_class::class, 'get_group_class']);
Route::get('get_detail_class/{id}', [C_class::class, 'get_detail_class']);
Route::post('group_class_booked', [C_class::class, 'group_class_booked']);

// ROOM
Route::get('get_room', [C_room::class, 'get_room']);
Route::get('get_room/{name}', [C_room::class, 'get_room']);
Route::get('get_detail_room/{id}', [C_room::class, 'get_detail_room']);
Route::get('get_room_schedule/{id}/{date}', [C_room::class, 'get_room_schedule']);
Route::post('booked_room', [C_room::class, 'booked_room']);

// MEMBER
Route::get('my-profile/{id}', [C_member::class, 'get_member_profile']);
Route::get('my-membership/{id}', [C_member::class, 'get_membership']);
Route::post('my-business_index', [C_member::class, 'save_business_index']);
Route::put('edit-my-profile', [C_member::class, 'edit_my_profile']);
Route::get('my-class-booking/{id}', [C_member::class, 'get_member_class_booking']);
Route::get('my-room-booking/{id}', [C_member::class, 'get_member_room_booking']);