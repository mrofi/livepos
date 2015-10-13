<?php

namespace livepos\Http\Controllers\Backend;

use livepos\Http\Requests;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use livepos\Http\Controllers\BackendController;

use livepos\Stock as Model;
use livepos\Product;
use livepos\ProductMeta;

class Stock extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('backend.stock');
    }

    public function anyData()
    {
    	$metas = ProductMeta::all();

        $product_metas = [];
        foreach ($metas as $meta) {
            $product_metas[$meta->product_id][$meta->meta_key] = $meta->meta_value;
        }

    	$data = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
                        ->join('product_brands', 'products.brand_id', '=', 'product_brands.id')
                        ->select(['products.id', 'products.category_id', 'products.brand_id',
                            'products.name', 'products.barcode', 'product_brands.brand', 
                            'product_categories.category', 'products.unit', 'products.active', 'products.min_stock']);

        return  Datatables::of($data)
            ->editColumn('unit', function($data) use($product_metas) {
                if (!isset($product_metas[$data->id]['multi_unit'])) return $data->unit;
                $units = [$data->unit];
                foreach (json_decode($product_metas[$data->id]['multi_unit']) as $multi_unit) {
                    $units[] = $multi_unit->unit;
                }
                return implode(', ', $units);
            })
        	->editColumn('min_stock', function($data) {
        		$quantity = Product::find($data->id)->stock;
        		$color = ($quantity <= $data->min_stock) ? 'bg-red' : '';
        		return '<div class="'.$color.'">'.livepos_round($data->min_stock).' '.$data->unit.'</div>';
        	})
            ->addColumn('quantity', function ($data) use($product_metas) {
            	$quantity = Product::find($data->id)->stock;
            	if (!isset($product_metas[$data->id]['multi_unit'])) return $data->unit;
                $units = [];
                foreach (json_decode($product_metas[$data->id]['multi_unit']) as $multi_unit) {
                    $units[] = floor($quantity / $multi_unit->quantity) .' '. $multi_unit->unit;
                }
                $all_units = implode(' | ', $units);

                return $quantity.' '.$data->unit.' ('.$all_units.')';
            })
            ->addColumn('action', function ($data) use($product_metas) {
        		$quantity = Product::find($data->id)->stock;
                $button = '<a href="#change-'.$data->id.'" data-id="'.$data->id.'" data-name="'.$data->name.'" data-quantity="'.$quantity.'" data-action="change" data-toggle="modal" data-target="#stock-modal-change" class="btn-link btn btn-xs pull-right"><i class="fa fa-refresh"></i> '.trans('livepos.stock.change').'</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);

    }
}
