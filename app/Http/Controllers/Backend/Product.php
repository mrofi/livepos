<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Product as Model;
use livepos\ProductBrand;
use livepos\ProductCategory;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Product extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $model = new Model;
        $product = $model->get_init_data();
        $categories = ProductCategory::all();
        $brands = ProductBrand::all();
        return view('backend.product', compact('product', 'categories', 'brands'));
    }
    
    public function anyData()
    {

        $data = Model::join('product_categories', 'products.category_id', '=', 'product_categories.id')
                        ->join('product_brands', 'products.brand_id', '=', 'product_brands.id')
                        ->select(['products.id', 'products.name', 'product_brands.brand', 
                                    'product_categories.category', 'products.unit', 'products.purchase_price',
                                    'products.selling_price', 'products.active', 'products.min_stock']);
        return  Datatables::of($data)
            ->editColumn('purchase_price', '{!! livepos_round($purchase_price) !!}')
            ->editColumn('selling_price', '{!! livepos_round($selling_price) !!}')
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" ';
                    $button .= ' data-id="'.$data->id.'"';
                    $button .= ' data-name="'.$data->name.'"';
                    $button .= ' data-brand="'.$data->brand.'"';
                    $button .= ' data-category="'.$data->category.'"';
                    $button .= ' data-unit="'.$data->unit.'"';
                    $button .= ' data-purchase_price="'.livepos_round($data->purchase_price).'"';
                    $button .= ' data-selling_price="'.livepos_round($data->selling_price).'"';
                    $button .= ' data-active="'.$data->active.'"';
                    $button .= ' data-min_stock="'.livepos_round($data->min_stock).'"';
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-brand="'.$data->brand.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> Delete</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);

    }
}
