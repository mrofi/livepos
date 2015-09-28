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

    Route::controller('purchasing', 'Purchasing');

    Route::get('selling/{id}', 'Selling@detail');

    Route::controller('selling', 'Selling');

    Route::controller('/', 'Dashboard');
  
});

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware' => 'auth.api'], function()
{
    Route::resource('productCategory', 'ProductCategory'); 

    Route::resource('productBrand', 'ProductBrand'); 
    
    Route::resource('productMeta', 'ProductMeta'); 
    
    Route::get('product/search', 'Product@getSearch');

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

