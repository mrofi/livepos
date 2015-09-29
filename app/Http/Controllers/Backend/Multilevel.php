<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Multilevel as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Multilevel extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('backend.multilevel');
    }

    public function anyData()
    {
        $data  = Model::join('customers', 'multilevels.customer_id', '=', 'customers.id')->select(['customers.id', 'customers.customer', 'multilevels.upline_id', 'multilevels.created_at']);

        $collection = [];
        $no = 0;
        foreach($data->get() as $row)
        {
            $collection[$row->id] = ++$no;
        }

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" ';
                $button .= ' data-id="'.$data->id.'"';
                $button .= ' data-customer_id="'.$data->customer_id.'"';
                $button .= ' data-upline_id="'.$data->upline_id.'"';
                $button .= ' data-level="'.$data->level.'"';
                    
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-customer="'.$data->customer.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> Delete</a>';
                return $button;        
            })
            ->editColumn('created_at', function($data) use($collection) {
                return $collection[$data->id];
            })
            ->make(true);
    }
}
