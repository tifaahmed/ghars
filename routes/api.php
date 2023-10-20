<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
Route::get('app_setting', [ApiController::class, 'app_setting']);
Route::get('ads', [ApiController::class, 'ads']);
Route::get('currencies', [ApiController::class, 'currencies']);
Route::get('tutorials', [ApiController::class, 'tutorials']);
Route::post('login', [ApiController::class, 'login']);
Route::get('register', [ApiController::class, 'register_get']);
Route::post('register', [ApiController::class, 'register_post']);
Route::post('forget_password', [ApiController::class, 'forget_password']);
Route::get('home_screen', [ApiController::class, 'home_screen']);
Route::get('sponsorships', [ApiController::class, 'sponsorships']);
Route::get('sponsorship/{id}', [ApiController::class, 'sponsorship']);


Route::get('categories', [ApiController::class, 'categories']);
Route::get('products', [ApiController::class, 'products']);
Route::get('search', [ApiController::class, 'search']);
Route::get('product/{id}', [ApiController::class, 'product']);
Route::post('favorite_action/{id}', [ApiController::class, 'favorite_action']);
Route::post('cart_add', [ApiController::class, 'cart_add']);
Route::get('cart', [ApiController::class, 'cart']);
Route::post('cart_delete/{id}', [ApiController::class, 'cart_delete']);
Route::post('cart_edit/{id}', [ApiController::class, 'cart_edit']);
Route::post('address_save', [ApiController::class, 'address_save']);
Route::get('addresses', [ApiController::class, 'addresses']);
Route::get('address_info/{id}', [ApiController::class, 'address_info']);
Route::post('address_edit/{id}', [ApiController::class, 'address_edit']);
Route::post('address_delete/{id}', [ApiController::class, 'address_delete']);
Route::post('check_coupon', [ApiController::class, 'check_coupon']);
Route::post('checkout_info', [ApiController::class, 'checkout_info']);
Route::post('checkout', [ApiController::class, 'checkout']);
Route::get('orders', [ApiController::class, 'orders']);
Route::get('order/{id}', [ApiController::class, 'order']);
Route::get('profile', [ApiController::class, 'profile']);
Route::get('favourites', [ApiController::class, 'favourites']);
Route::get('profile_edit', [ApiController::class, 'profile_edit']);
Route::post('profile_update', [ApiController::class, 'profile_update']);
Route::post('update_password', [ApiController::class, 'update_password']);
Route::post('change_password', [ApiController::class, 'change_password']);
Route::get('branches', [ApiController::class, 'branches']);
Route::get('setting', [ApiController::class, 'setting']);
Route::get('page/{id}', [ApiController::class, 'page']);
Route::get('contact', [ApiController::class, 'contact_get']);
Route::post('contact', [ApiController::class, 'contact_post']);
Route::get('notifications', [ApiController::class, 'notifications']);
Route::get('countries', [ApiController::class, 'countries']);
Route::get('reorder/{id}', [ApiController::class, 'reorder']);

