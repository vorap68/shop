<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','App\Http\Controllers\IndexController')->name('index'); 

Route::get('catalog/index','App\Http\Controllers\CatalogController@index')->name('catalog.index');
Route::get('catalog/product/{product:slug}','App\Http\Controllers\CatalogController@product')->name('catalog.product');
Route::get('catalog/category/{category:slug}','App\Http\Controllers\CatalogController@category')->name('catalog.category');
Route::get('catalog/brand/{brand:slug}','App\Http\Controllers\CatalogController@brand')->name('catalog.brand');
Route::get('catalog/search','App\Http\Controllers\CatalogController@search')->name('catalog.search');

Route::get('basket/index','App\Http\Controllers\BasketController@index')->name('basket.index');
Route::get('basket/checkout','App\Http\Controllers\BasketController@checkout')->name('basket.checkout');

Route::post('/basket/add/{id}', 'App\Http\Controllers\BasketController@add')
    ->where('id', '[0-9]+')
    ->name('basket.add');

Route::post('basket/plus/{id}','App\Http\Controllers\BasketController@plus')->where('id','[0-9]+')
        ->name('basket.plus');
Route::post('basket/minus/{id}','App\Http\Controllers\BasketController@minus')->where('id','[0-9]+')
        ->name('basket.minus');

Route::post('basket/remove/{id}', 'App\Http\Controllers\BasketController@remove')
    ->where('id', '[0-9]+')
    ->name('basket.remove');
Route::post('basket/clear', 'App\Http\Controllers\BasketController@clear')->name('basket.clear');
Route::post('basket/saveorder','App\Http\Controllers\BasketController@saveorder')->name('basket.saveorder');
Route::get('basket/success','App\Http\Controllers\BasketController@success')->name('basket.success');
Route::post('/basket/profile', 'App\Http\Controllers\BasketController@profile')->name('basket.profile');

Route::name('user.')->prefix('user')->group(function(){
     Route::get('index','App\Http\Controllers\UserController@index')->name('index');
    // Route::get('index','App\Http\Controllers\ProfileController@index')->name('index');
    Auth::routes();  
});

Route::name('admin.')->prefix('admin')->middleware('auth','admin')->group(function(){
    Route::get('index','App\Http\Controllers\Admin\IndexController')->name('index');
    Route::resource('category','App\Http\Controllers\Admin\CategoryController');
     Route::resource('brand','App\Http\Controllers\Admin\BrandController');
     Route::resource('product','App\Http\Controllers\Admin\ProductController');
          Route::get('order/index','App\Http\Controllers\Admin\OrderController@index')
                  ->name('order.index');
          Route::get('order/edit/{order}','App\Http\Controllers\Admin\OrderController@edit')
                  ->name('order.edit');
          Route::get('order/show/{order}','App\Http\Controllers\Admin\OrderController@show')
                  ->name('order.show');
          Route::put('order/{order}','App\Http\Controllers\Admin\OrderController@update')
                  ->name('order.update');
          Route::get('user/index','App\Http\Controllers\Admin\UserController@index')
                  ->name('user.index');
           Route::get('user/edit/{user}','App\Http\Controllers\Admin\UserController@edit')
                  ->name('user.edit');
            Route::put('user/{user}','App\Http\Controllers\Admin\UserController@update')
                  ->name('user.update');
     Route::resource('page','App\Http\Controllers\Admin\PageController');
 

});
Route::name('user.')->prefix('user')->middleware('auth')->group(function(){
      Route::get('profile/index','App\Http\Controllers\ProfileController@index')->name('profile.index');
      Route::get('profile/show/{profile}','App\Http\Controllers\ProfileController@show')->name('profile.show');
       Route::get('profile/create','App\Http\Controllers\ProfileController@create')->name('profile.create');
       Route::post('profile/store','App\Http\Controllers\ProfileController@store')->name('profile.store');
       Route::get('profile/edit/{profile}','App\Http\Controllers\ProfileController@edit')->name('profile.edit');
        Route::put('profile/update/{profile}','App\Http\Controllers\ProfileController@update')->name('profile.update');
        Route::delete('profile/{profile}','App\Http\Controllers\ProfileController@destroy')->name('profile.destroy');
        Route::get('order/index','App\Http\Controllers\OrderController@index')->name('order.index');
         Route::get('order/show/{order}','App\Http\Controllers\OrderController@show')->name('order.show');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

