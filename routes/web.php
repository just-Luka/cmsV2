<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password (added in v6.2)
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Redirect to page with available lang
Route::get('/', function(){
    return redirect()->route('frontend.main.index',['locale' => App::getLocale()]);
});

// Here should be my routes
Route::group(['prefix'=>'{locale}','middleware'=>'localization','namespace'=>'Frontend'], function($locale)
{
    Route::get('/', 'IndexController@index')->name('frontend.main.index');
    Route::get('/categories/{slug}', 'CategoryController@index')->name('frontend.categories.index');
    Route::get('/tags/{slug}', 'TagController@index')->name('frontend.tags.index');
    Route::get('/products/{slug}', 'ProductController@index')->name('frontend.products.index');
    Route::get('/products/show/{id}', 'ProductController@single')->name('frontend.products.show'); //api
    Route::get('/offers/{slug}', 'OfferController@index')->name('frontend.offers.index');
    Route::get('/Brands/{slug}', 'BrandController@index')->name('frontend.brands.index');
    Route::get('/posts/{slug}', 'PostController@index')->name('frontend.posts.index');
    Route::get('{slug?}/{secondSlug?}', 'PageController@index')->name('frontend.pages.index');
});

