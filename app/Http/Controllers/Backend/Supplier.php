<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Supplier as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Supplier extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('backend.supplier');
    }

    public function anyData()
    {
        $data  = Model::select('*');

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" ';
                $button .= ' data-id="'.$data->id.'"';
                $button .= ' data-supplier="'.$data->supplier.'"';
                $button .= ' data-address="'.$data->address.'"';
                $button .= ' data-contact1="'.$data->contact1.'"';
                $button .= ' data-contact2="'.$data->contact2.'"';
                    
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-supplier="'.$data->supplier.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);
    }
}
