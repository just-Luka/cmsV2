<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Redirect to dashboard
Route::get('/manage', function(){
    return redirect()->route('backend.dashboard', ['locale'=>App::getLocale()]);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware'=>'fileManage'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::group(['prefix'=>'manage', 'namespace'=>'Backend','middleware'=>'permission'], function() {
    Route::group(['prefix'=>'{locale}','middleware'=>'localization'],function($locale){
        /* dashboard */
        Route::get('/dashboard', 'IndexController@index')->name('backend.dashboard');
        /* menus */
        Route::get('/menus', 'MenuController@index')->name('backend.menus.index');
        Route::get('/menus/create/{parentID?}', 'MenuController@create')->name('backend.menus.create');
        Route::post('/menus/store', 'MenuController@store')->name('backend.menus.store');
        Route::get('/menus/edit/{id}', 'MenuController@edit')->name('backend.menus.edit');
        Route::post('/menus/update/{id}', 'MenuController@update')->name('backend.menus.update');
        Route::get('/menus/inside/{id}','MenuController@inside')->name('backend.menus.inside');
        Route::get('/menus/trans/{id}','MenuController@trans')->name('backend.menus.trans');
        Route::post('/menus/trans/action/{id}','MenuController@transAction')->name('backend.menus.transAction');
        Route::post('/menus/visible/{id}','MenuController@visible')->name('backend.menus.visible');
        Route::post('/menus/destroy/{id}', 'MenuController@destroy')->name('backend.menus.destroy');
        /* pages */
        Route::get('/pages','PageController@index')->name('backend.pages.index');
        Route::get('/pages/create','PageController@create')->name('backend.pages.create');
        Route::post('/pages/store','PageController@store')->name('backend.pages.store');
        Route::get('/pages/show','PageController@show')->name('backend.pages.show');
        Route::get('/pages/edit/{id}','PageController@edit')->name('backend.pages.edit');
        Route::post('/pages/update/{id}','PageController@update')->name('backend.pages.update');
        Route::get('/pages/trans/{id}','PageController@trans')->name('backend.pages.trans');
        Route::post('/pages/trans/action/{id}','PageController@transAction')->name('backend.pages.transAction');
        Route::post('/pages/visible/{id}','PageController@visible')->name('backend.pages.visible');
        Route::post('/pages/destroy/{id}','PageController@destroy')->name('backend.pages.destroy');
        /* translation */
        Route::get('/translation', 'TranslationController@index')->name('backend.translation.index');
        Route::get('/translation/create', 'TranslationController@create')->name('backend.translation.create');
        Route::post('/translation/store', 'TranslationController@store')->name('backend.translation.store');
        Route::get('/translation/edit/{id}', 'TranslationController@edit')->name('backend.translation.edit');
        Route::post('/translation/update/{id}', 'TranslationController@update')->name('backend.translation.update');
        Route::post('/translation/destroy/{id}', 'TranslationController@destroy')->name('backend.translation.destroy');
        /* languages */
        Route::get('/languages', 'LanguageController@index')->name('backend.languages.index');
        Route::get('/switcher', 'LanguageController@switchLang')->name('backend.languages.switch');
        Route::get('/languages/create', 'LanguageController@create')->name('backend.languages.create');
        Route::post('/languages/store', 'LanguageController@store')->name('backend.languages.store');
        Route::get('/languages/remove', 'LanguageController@remove')->name('backend.languages.remove');
        Route::post('/languages/destroy', 'LanguageController@destroy')->name('backend.languages.destroy');
        /* media */
        Route::get('/media', 'MediaController@index')->name('backend.media.index');
        Route::get('/media/files', 'MediaController@files')->name('backend.media.files');
        Route::get('/media/images', 'MediaController@images')->name('backend.media.images');
        /* users */
        Route::get('/users', 'UserController@index')->name('backend.users.index');
        Route::get('/users/show', 'UserController@show')->name('backend.users.show');
        Route::get('/users/create', 'UserController@create')->name('backend.users.create');
        Route::post('/users/store', 'UserController@store')->name('backend.users.store');
        Route::get('/users/edit/{id}', 'UserController@edit')->name('backend.users.edit');
        Route::post('/users/update/{id}', 'UserController@update')->name('backend.users.update');
        Route::post('/users/destroy/{id}', 'UserController@destroy')->name('backend.users.destroy');
        /* roles */
        Route::get('/roles', 'RoleController@index')->name('backend.roles.index');
        Route::get('/roles/create', 'RoleController@create')->name('backend.roles.create');
        Route::post('/roles/store', 'RoleController@store')->name('backend.roles.store');
        Route::get('/roles/show', 'RoleController@show')->name('backend.roles.show');
        Route::get('/roles/edit/{id}', 'RoleController@edit')->name('backend.roles.edit');
        Route::post('/roles/update/{id}', 'RoleController@update')->name('backend.roles.update');
        Route::post('/roles/destroy/{id}', 'RoleController@destroy')->name('backend.roles.destroy');
        /* banners */
        Route::get('/banners', 'BannerController@index')->name('backend.banners.index');
        Route::get('/banners/create', 'BannerController@create')->name('backend.banners.create');
        Route::post('/banners/store', 'BannerController@store')->name('backend.banners.store');
        Route::get('/banners/edit/{id}', 'BannerController@edit')->name('backend.banners.edit');
        Route::post('/banners/update/{id}', 'BannerController@update')->name('backend.banners.update');
        Route::get('/banners/trans/{id}', 'BannerController@trans')->name('backend.banners.trans');
        Route::post('/banners/trans/action/{id}', 'BannerController@transAction')->name('backend.banners.transAction');
        Route::post('/banners/visible/{id}', 'BannerController@visible')->name('backend.banners.visible');
        Route::post('/banners/destroy/{id}', 'BannerController@destroy')->name('backend.banners.destroy');
        /* products */
        Route::get('/products', 'ProductController@index')->name('backend.products.index');
        Route::get('/products/create', 'ProductController@create')->name('backend.products.create');
        Route::post('/products/store', 'ProductController@store')->name('backend.products.store');
        Route::get('/products/edit/{id}', 'ProductController@edit')->name('backend.products.edit');
        Route::post('/products/update/{id}', 'ProductController@update')->name('backend.products.update');
        Route::get('/products/trans/{id}', 'ProductController@trans')->name('backend.products.trans');
        Route::post('/products/trans/action/{id}', 'ProductController@transAction')->name('backend.products.transAction');
        Route::post('/products/visible/{id}', 'ProductController@visible')->name('backend.products.visible');
        Route::post('/products/destroy/{id}', 'ProductController@destroy')->name('backend.products.destroy');
        /* sales */
        Route::get('/sales', 'SoldController@index')->name('backend.sales.index');
        /* posts */
        Route::get('/posts', 'PostController@index')->name('backend.posts.index');
        Route::get('/posts/create', 'PostController@create')->name('backend.posts.create');
        Route::post('/posts/store', 'PostController@store')->name('backend.posts.store');
        Route::get('/posts/show', 'PostController@show')->name('backend.posts.show');
        Route::get('/posts/edit/{id}', 'PostController@edit')->name('backend.posts.edit');
        Route::post('/posts/update/{id}', 'PostController@update')->name('backend.posts.update');
        Route::get('/posts/trans/{id}', 'PostController@trans')->name('backend.posts.trans');
        Route::post('/posts/trans/action/{id}', 'PostController@transAction')->name('backend.posts.transAction');
        Route::post('/posts/visible/{id}', 'PostController@visible')->name('backend.posts.visible');
        Route::post('/posts/destroy/{id}', 'PostController@destroy')->name('backend.posts.destroy');
        /* categories */
        Route::get('/categories', 'CategoryController@index')->name('backend.categories.index');
        Route::get('/categories/create', 'CategoryController@create')->name('backend.categories.create');
        Route::post('/categories/store', 'CategoryController@store')->name('backend.categories.store');
        Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('backend.categories.edit');
        Route::post('/categories/update/{id}', 'CategoryController@update')->name('backend.categories.update');
        Route::get('/categories/trans/{id}', 'CategoryController@trans')->name('backend.categories.trans');
        Route::post('/categories/trans/action/{id}', 'CategoryController@transAction')->name('backend.categories.transAction');
        Route::post('/categories/visible/{id}', 'CategoryController@visible')->name('backend.categories.visible');
        Route::post('/categories/destroy/{id}', 'CategoryController@destroy')->name('backend.categories.destroy');
        /* sliders */
        Route::get('/sliders', 'SliderController@index')->name('backend.sliders.index');
        Route::get('/sliders/create', 'SliderController@create')->name('backend.sliders.create');
        Route::post('/sliders/store', 'SliderController@store')->name('backend.sliders.store');
        Route::get('/sliders/edit/{id}', 'SliderController@edit')->name('backend.sliders.edit');
        Route::post('/sliders/update/{id}', 'SliderController@update')->name('backend.sliders.update');
        Route::get('/sliders/trans/{id}', 'SliderController@trans')->name('backend.sliders.trans');
        Route::post('/sliders/trans/action/{id}', 'SliderController@transAction')->name('backend.sliders.transAction');
        Route::post('/sliders/visible/{id}', 'SliderController@visible')->name('backend.sliders.visible');
        Route::post('/sliders/destroy/{id}', 'SliderController@destroy')->name('backend.sliders.destroy');
        /* events */
        Route::get('/events', 'EventController@index')->name('backend.events.index');
        Route::get('/events/create', 'EventController@create')->name('backend.events.create');
        Route::post('/events/store', 'EventController@store')->name('backend.events.store');
        Route::get('/events/edit/{id}', 'EventController@edit')->name('backend.events.edit');
        Route::post('/events/update/{id}', 'EventController@update')->name('backend.events.update');
        Route::get('/events/trans/{id}', 'EventController@trans')->name('backend.events.trans');
        Route::post('/events/trans/action/{id}', 'EventController@transAction')->name('backend.events.transAction');
        Route::post('/events/visible/{id}', 'EventController@visible')->name('backend.events.visible');
        Route::post('/events/destroy/{id}', 'EventController@destroy')->name('backend.events.destroy');
        /* Brands */
        Route::get('/brands', 'BrandController@index')->name('backend.brands.index');
        Route::get('/brands/create', 'BrandController@create')->name('backend.brands.create');
        Route::post('/brands/store', 'BrandController@store')->name('backend.brands.store');
        Route::get('/brands/edit/{id}', 'BrandController@edit')->name('backend.brands.edit');
        Route::post('/brands/update/{id}', 'BrandController@update')->name('backend.brands.update');
        Route::get('/brands/trans/{id}', 'BrandController@trans')->name('backend.brands.trans');
        Route::post('/brands/trans/action/{id}', 'BrandController@transAction')->name('backend.brands.transAction');
        Route::post('/brands/visible/{id}', 'BrandController@visible')->name('backend.brands.visible');
        Route::post('/brands/destroy/{id}', 'BrandController@destroy')->name('backend.brands.destroy');
        /* Tags */
        Route::get('/tags', 'TagController@index')->name('backend.tags.index');
        Route::get('/tags/create', 'TagController@create')->name('backend.tags.create');
        Route::post('/tags/store', 'TagController@store')->name('backend.tags.store');
        Route::get('/tags/edit/{id}', 'TagController@edit')->name('backend.tags.edit');
        Route::post('/tags/update/{id}', 'TagController@update')->name('backend.tags.update');
        Route::get('/tags/trans/{id}', 'TagController@trans')->name('backend.tags.trans');
        Route::post('/tags/trans/action/{id}', 'TagController@transAction')->name('backend.tags.transAction');
        Route::post('/tags/visible/{id}', 'TagController@visible')->name('backend.tags.visible');
        Route::post('/tags/destroy/{id}', 'TagController@destroy')->name('backend.tags.destroy');
        /* Offers */
        Route::get('/offers', 'OfferController@index')->name('backend.offers.index');
        Route::get('/offers/create', 'OfferController@create')->name('backend.offers.create');
        Route::post('/offers/store', 'OfferController@store')->name('backend.offers.store');
        Route::get('/offers/edit/{id}', 'OfferController@edit')->name('backend.offers.edit');
        Route::post('/offers/update/{id}', 'OfferController@update')->name('backend.offers.update');
        Route::get('/offers/trans/{id}', 'OfferController@trans')->name('backend.offers.trans');
        Route::post('/offers/trans/action/{id}', 'OfferController@transAction')->name('backend.offers.transAction');
        Route::post('/offers/visible/{id}', 'OfferController@visible')->name('backend.offers.visible');
        Route::post('/offers/destroy/{id}', 'OfferController@destroy')->name('backend.offers.destroy');
        /* Api */
        Route::get('/requests/attachment/{modelName}', 'ApiController@getAttachment')->name('backend.requests.attachment');
    });
});

