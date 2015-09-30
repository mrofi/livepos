<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\ProductBrand as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Brand extends BackendController
{
    public function getIndex()
    {
        return view('backend.brand');
    }
    
    public function anyData()
    {
        $data = Model::select(['id', 'brand']);
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" data-id="'.$data->id.'" data-brand="'.$data->brand.'" data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= ' | <a href="#view-product-by-brand-'.$data->id.'" class="btn-link btn btn-xs"><i class="fa fa-list"></i> View Products</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-brand="'.$data->brand.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);;
    }
}
