<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\ProductCategory as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Category extends BackendController
{
    public function getIndex()
    {
        return view('backend.category');
    }
    
    public function anyData()
    {
        $data = Model::select(['id', 'category']);
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" data-id="'.$data->id.'" data-category="'.$data->category.'" data-action="edit" data-toggle="modal" data-target="#modal-category" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
                $button .= ' | <a href="#view-product-by-category-'.$data->id.'" class="btn-link btn btn-xs"><i class="fa fa-list"></i> View Products</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-category="'.$data->category.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> Delete</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);;
    }
}
