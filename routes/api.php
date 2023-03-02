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
use App\Http\Controllers\Mobile\C_partner;
use App\Http\Controllers\Mobile\C_setting_apps;


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
Route::get('get_detail_facilities', [C_facilities::class, 'get_detail']);
// Route::get('get_detail_facilities/' ,['id' =>'{id}' ], [C_facilities::class, 'get_detail']);

// EVENT
Route::get('get_event', [C_event::class, 'get']);
Route::get('get_detail_event', [C_event::class, 'get_detail_event']);

// NEWS
Route::get('get_news', [C_news::class, 'get']);
Route::get('get_news', [C_news::class, 'get']);
Route::get('get_breaking_news', [C_news::class, 'get_breaking_news']);
Route::get('get_detail_news', [C_news::class, 'get_detail']);

// BUSINNES INDEX
Route::get('get_business_index', [C_business_index::class, 'get']);
Route::get('get_detail_business', [C_business_index::class, 'get_detail']);


// CLASS
Route::get('get_group_class', [C_class::class, 'get_group_class']);
Route::get('get_detail_class', [C_class::class, 'get_detail_class']);
Route::post('group_class_booked', [C_class::class, 'group_class_booked']);
Route::get('get_private_class', [C_class::class, 'get_private_class']);
Route::get('upcoming_class', [C_class::class, 'get_upcoming_class']);
Route::get('our_recommendation', [C_class::class, 'get_our_recommendation']);
Route::get('our_recommendation_all', [C_class::class, 'get_our_recommendation_all']);


// ROOM
Route::get('get_room', [C_room::class, 'get_room']);
Route::get('get_detail_room', [C_room::class, 'get_detail_room']);
Route::get('get_room_schedule   ', [C_room::class, 'get_room_schedule']);
Route::post('booked_room', [C_room::class, 'booked_room']);

// MEMBER
Route::get('my_profile', [C_member::class, 'get_member_profile']);
Route::get('my_membership', [C_member::class, 'get_membership']);
Route::post('my_business_index', [C_member::class, 'save_business_index']);
Route::put('edit_my_profile', [C_member::class, 'edit_my_profile']);
Route::get('my_class_booking', [C_member::class, 'get_member_class_booking']);
Route::get('my_room_booking', [C_member::class, 'get_member_room_booking']);

// PARTNER
Route::get('our_partner', [C_partner::class, 'get_partner']);
Route::get('detail_partner_category', [C_partner::class, 'detail_category_partner']);
Route::get('detail_partner', [C_partner::class, 'detail_partner']);

// ABOUT & TC
Route::get('about', [C_setting_apps::class, 'get_about']);
Route::get('term_and_conditions', [C_setting_apps::class, 'get_tc']);
Route::get('privacy_and_policy', [C_setting_apps::class, 'get_privacy']);

// Concierge Number
Route::get('concierge_number', [C_setting_apps::class, 'get_concierge_number']);