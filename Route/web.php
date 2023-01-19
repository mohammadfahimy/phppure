<?php

use App\Core\Routes\Route;


Route::get('/proje/product/{productslug}','productController@index');
Route::post('/proje/product/{productslug}','productController@index');
Route::get('/proje/cart/','cartController@index');
Route::post('/proje/cart/','cartController@index');
Route::get('/proje/checkoute/','checkouteController@index');
Route::post('/proje/checkoute/','checkouteController@index');
Route::get('/proje/','homeController@index');
Route::get('/proje/payment/','paymentController@index');
Route::get('/proje/payment/payonhome/','paymentController@payonhome');

// Route::post('/proje/','homeController@index');

