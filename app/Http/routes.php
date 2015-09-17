<?php

Route::get('/', ['as' => 'home', function()
{
    if (!config('livepos.frontend')) return redirect('dashboard');
    
    // frontend view        
    return 'frontend';
}]);

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'namespace' => 'Backend'], function()
{
    Route::controller('product/category', 'Category');

    Route::controller('product/brand', 'Brand');
    
    Route::controller('product/supplier', 'Supplier');

    Route::controller('product', 'Product');
    
    Route::controller('customer', 'Customer');

    Route::get('purchasing/{id}/detail', 'Purchasing@detail');

    Route::get('purchasing/detailData/{id}', 'Purchasing@detailData');

    // Route::get('purchasing/products', 'Purchasing@products');

    Route::controller('purchasing', 'Purchasing');


    Route::controller('/', 'Dashboard');
  
});

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'auth.api'], function()
{
    Route::resource('productCategory', 'ProductCategory'); 

    Route::resource('productBrand', 'ProductBrand'); 
    
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
Route::controller('auth', 'Auth\AuthController');

// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLoginProcess');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');

// // Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

