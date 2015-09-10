<?php

Route::get('/', function()
{
    if (!config('livepos.frontend')) return redirect('dashboard');
    
    // frontend view        
    return 'frontend';
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function()
{
   Route::get('/', function()
   {
      return 'home'; 
   });
   
   Route::get('tes', function()
   {
      return 'tes'; 
   });
 
});

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'auth.api'], function()
{
    Route::resource('productCategory', 'ProductCategory'); 
    
    Route::resource('productMeta', 'ProductMeta'); 
    
    Route::resource('product', 'Product'); 
        
    Route::resource('purchasing', 'Purchasing'); 
        
    Route::resource('purchasingDetail', 'PurchasingDetail'); 
        
    Route::resource('selling', 'Selling'); 
        
    Route::resource('sellingDetail', 'SellingDetail'); 
        
    Route::resource('supplier', 'Supplier');
    
    Route::resource('customer', 'Customer');
        
    Route::resource('user', 'User'); 
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLoginProcess');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

