<?php

use Illuminate\Database\Seeder;

use livepos\ProductCategory;
use livepos\ProductBrand;
use livepos\Supplier;

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

        DB::table('suppliers')->delete();
        
        Supplier::create(['supplier' => trans('livepos.supplier.generic')]);
    }
}
