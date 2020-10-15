<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// use Illuminate\Routing\Route; 基本上route上不會再呼叫函式

Route::get('/', 'FrontController@index');

Route::get('/index', 'FrontController@index');

Route::get('/contact_us', 'FrontController@contact_us');

Route::get('/news', 'FrontController@news');
Route::get('/news_info/{news_id}', 'FrontController@news_info');



Route::get('/animals', 'FrontController@animals');

Route::get('/animals_info/{animals_id}', 'FrontController@animals_info'); //{number}物件number,問老師...

Route::get('/product', 'FrontController@product');

Route::get('/product_detail/{products_id}', 'FrontController@product_detail');


Route::post('/store_contact', 'FrontController@store_contact');//post傳值



// ['register'=>false]
Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    //Route Web.php
    Route::post('/ajax_upload_img','AdminController@ajax_upload_img');
    Route::post('/ajax_delete_img','AdminController@ajax_delete_img');

    Route::get('news', 'NewsController@index');
    Route::get('news/create', 'NewsController@create');
    Route::post('news/store', 'NewsController@store');
    Route::get('news/edit/{news_id}', 'NewsController@edit');
    Route::post('news/update/{news_id}', 'NewsController@update');
    Route::get('news/destroy/{news_id}', 'NewsController@destroy');

    Route::get('product', 'ProductController@index');
    Route::get('product/create', 'ProductController@create');
    Route::post('product/store', 'ProductController@store');
    Route::get('product/edit/{news_id}', 'ProductController@edit');
    Route::post('product/update/{news_id}', 'ProductController@update');
    Route::get('product/destroy/{news_id}', 'ProductController@destroy');

<<<<<<< HEAD
    Route::post('/ajax_upload_img','AdminController@ajax_upload_img');
    Route::post('/ajax_delete_img','AdminController@ajax_delete_img');

    Route::resource('productType', 'ProductTypeController');

=======
    Route::resource('productType', 'ProductTypeController')->except([
        'show'
    ]); //except 移除路徑
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857


});

// Route::prefix('admin')->group(function () {
//     Route::get('users', function () {
//         // Matches The "/admin/users" URL
//     });
// });
