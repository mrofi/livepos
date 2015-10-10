<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Product as Model;
use livepos\ProductMeta;
use livepos\ProductBrand;
use livepos\ProductCategory;
use livepos\Http\Requests;
use Illuminate\Support\Collection;
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

    public function anyMultiUnit($id = null)
    {
        $data = new Collection();
        if ($id == null) return Datatables::of($data)->make(true);
    }

    public function anyMultiPrice($id = null)
    {
        $data = new Collection();
        if ($id == null) return Datatables::of($data)->make(true);
    }
    
    public function anyData()
    {

        $metas = ProductMeta::all();

        $product_metas = [];
        foreach ($metas as $meta) {
            $product_metas[$meta->product_id][$meta->meta_key] = $meta->meta_value;
        }

        $data = Model::join('product_categories', 'products.category_id', '=', 'product_categories.id')
                        ->join('product_brands', 'products.brand_id', '=', 'product_brands.id')
                        ->select(['products.id', 'products.category_id', 'products.brand_id',
                            'products.name', 'products.barcode', 'product_brands.brand', 
                            'product_categories.category', 'products.unit', 'products.purchase_price',
                            'products.selling_price', 'products.active', 'products.min_stock']);

        return  Datatables::of($data)
            ->editColumn('purchase_price', '{!! livepos_toCurrency($purchase_price) !!}')
            ->editColumn('unit', function($data) use($product_metas) {
                if (!isset($product_metas[$data->id]['multi_unit'])) return $data->unit;
                $units = [$data->unit];
                foreach (json_decode($product_metas[$data->id]['multi_unit']) as $multi_unit) {
                    $units[] = $multi_unit->unit;
                }
                return implode(', ', $units);
            })
            ->editColumn('selling_price', function($data) use($product_metas) {
                if (!isset($product_metas[$data->id]['multi_price'])) return livepos_toCurrency($data->selling_price);
                $prices = [$data->selling_price];
                foreach (json_decode($product_metas[$data->id]['multi_price']) as $multi_price) {
                    $prices[] = $multi_price->selling_price;
                }
                asort($prices);
                return livepos_toCurrency(head($prices)).' - '.livepos_toCurrency(last($prices));
            })
            ->addColumn('action', function ($data) use($product_metas) {
                $button = '<a href="#edit-'.$data->id.'" ';
                    $button .= ' data-id="'.$data->id.'"';
                    $button .= ' data-name="'.$data->name.'"';
                    $button .= ' data-barcode="'.$data->barcode.'"';
                    $button .= ' data-brand_id="'.$data->brand_id.'"';
                    $button .= ' data-category_id="'.$data->category_id.'"';
                    $button .= ' data-brand="'.$data->brand.'"';
                    $button .= ' data-category="'.$data->category.'"';
                    $button .= ' data-unit="'.$data->unit.'"';
                    $button .= ' data-purchase_price="'.livepos_round($data->purchase_price).'"';
                    $button .= ' data-selling_price="'.livepos_round($data->selling_price).'"';
                    $button .= ' data-active="'.$data->active.'"';
                    $button .= ' data-min_stock="'.livepos_round($data->min_stock).'"';
                    $button .= ' data-multi_unit=\''.(isset($product_metas[$data->id]['multi_unit']) ? $product_metas[$data->id]['multi_unit'] : '0').'\'';
                    $button .= ' data-multi_price=\''.(isset($product_metas[$data->id]['multi_price']) ? $product_metas[$data->id]['multi_price'] : '0').'\'';
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-brand="'.$data->brand.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);

    }
}
