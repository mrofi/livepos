<?php

use Illuminate\Database\Seeder;

use livepos\ProductCategory;
use livepos\ProductBrand;
use livepos\Supplier;
use livepos\Customer;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->delete();
        
        ProductCategory::create(['category' => trans('livepos.productCategory.general')]);
        
        DB::table('product_brands')->delete();
        
        ProductBrand::create(['brand' => trans('livepos.productBrand.generic')]);

        factory(livepos\ProductBrand::class, 50)->create();

        DB::table('suppliers')->delete();
        
        Supplier::create(['supplier' => trans('livepos.supplier.generic')]);

        factory(livepos\Supplier::class, 50)->create();

        DB::table('customers')->delete();
        
        Customer::create(['customer' => 'No Customer']);


        DB::table('products')->delete();
    
    }
}
