<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

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


Route::get('tes', function()
{
    DB::table('users')->insert([
            'name' => 'Livepos Assistant',
            'username' => 'livepos',
            'email' => 'hiretweb+livepos@gmail.com',
            'password' => livepos_password('admin'),
        ]); 
});