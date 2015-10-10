<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Purchasing as Model;
use livepos\PurchasingDetail as ModelDetail;
use livepos\Supplier as SupplierModel;
use livepos\Product as ProductModel;
use livepos\ProductBrand as BrandModel;
use livepos\ProductCategory as CategoryModel;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Purchasing extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
    	$suppliers = SupplierModel::all();

    	return view('backend.purchasing')->with(compact('suppliers'));
    }

    public function anyData()
    {
    	$data = Model::join('suppliers', 'purchasings.supplier_id', '=', 'suppliers.id')
    					->select(['purchasings.id', 'purchasings.bill_date', 'purchasings.bill_no', 
    						'suppliers.supplier', 'purchasings.total_amount']);

    	return Datatables::of($data)
    		->addColumn('action', function ($data) {
                $button = '<a href="'.action('Backend\Purchasing@detail', ['id' => $data->id]).'" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-supplier="'.$data->supplier.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->editColumn('total_amount', '{!! livepos_toCurrency($total_amount) !!}')
            ->editColumn('bill_date', '{!! livepos_dateToShow($bill_date) !!}')
            ->removeColumn('id')
            ->make(true);
    }

    public function detail($id)
    {
        $detail = Model::findOrFail($id);
        $detail->bill_date = livepos_dateToShow($detail->bill_date);
        $suppliers = SupplierModel::all();
        $products = ProductModel::with('metas')->get();
        $brands = BrandModel::all();
        $categories = CategoryModel::all();
        $product = (new ProductModel)->get_init_data();

        return view('backend.purchasing')->with(compact('detail', 'suppliers', 'products', 'brands', 'categories', 'product')); 
    }

    public function products()
    {
        return ProductModel::with('metas')->get();
    }

    public function detailData($id)
    {
        $datas = ModelDetail::select('*')->where('purchasing_id', $id);

        $collection = [];
        $no = 0;
        foreach($datas->get() as $row)
        {
            $collection[$row->id] = ++$no;
        }

        $no = 0;

        return Datatables::of($datas)
            ->addColumn('price', function ($data) {
                return livepos_toCurrency($data->purchase_price * $data->converter);
            })
            ->editColumn('quantity', '{!! livepos_round($quantity) !!}')
            ->editColumn('discount', '{!! livepos_round($discount) !!}')
            ->editColumn('amount', '{!! livepos_toCurrency($amount) !!}')
            ->addColumn('action', function ($data) {
                $d = '';
                foreach ($data->toArray() as $key => $value) {
                    $d .= ' data-'.$key.'="'.livepos_round($value).'" ';
                }

                $button = '<a href="#edit-'.$data->id.'" class="btn-link btn btn-xs" data-action="edit" data-target="#detail-edit" data-toggle="modal" '.$d.'><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-action="delete" data-toggle="modal" data-target="#detail-delete" '.$d.' class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->editColumn('created_at', function($data) use($collection) {
                return $collection[$data->id];
            })
            ->removeColumn('id')
            ->make(true);
    }
}
