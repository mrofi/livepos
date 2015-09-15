<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Purchasing as Model;
use livepos\Supplier as SupplierModal;
use livepos\Product as ProductModal;
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
    	$suppliers = SupplierModal::all();

    	return view('backend.purchasing')->with(compact('suppliers'));
    }

    public function anyData()
    {
    	$data = Model::join('suppliers', 'purchasings.supplier_id', '=', 'suppliers.id')
    					->select(['purchasings.id', 'purchasings.bill_date', 'purchasings.bill_no', 
    						'suppliers.supplier', 'purchasings.total_amount']);

    	return Datatables::of($data)
    		->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" ';
                $button .= ' data-id="'.$data->id.'"';
                $button .= ' data-bill_no="'.$data->bill_no.'"';
                $button .= ' data-bill_date="'.livepos_dateToShow($data->bill_date).'"';
                $button .= ' data-supplier_id="'.$data->supplier_id.'"';
                $button .= ' data-total_amount="'.$data->total_amount.'"';
                    
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-supplier="'.$data->supplier.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> Delete</a>';
                return $button;        
            })
            ->editColumn('bill_date', '{!! livepos_dateToShow($bill_date) !!}')
            ->removeColumn('id')
            ->make(true);
    }

    public function detail($id)
    {
        $detail = Model::findOrFail($id);
        $suppliers = SupplierModal::all();

        return view('backend.purchasing')->with(compact('detail', 'suppliers')); 
    }
}
