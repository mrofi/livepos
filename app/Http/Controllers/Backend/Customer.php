<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Customer as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Customer extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('backend.customer');
    }

    public function anyData()
    {
        $data  = Model::select('*');

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $button = '<a href="#edit-'.$data->id.'" ';
                $button .= ' data-id="'.$data->id.'"';
                $button .= ' data-customer="'.$data->customer.'"';
                $button .= ' data-id_type="'.$data->id_type.'"';
                $button .= ' data-id_no="'.$data->id_no.'"';
                $button .= ' data-address="'.$data->address.'"';
                $button .= ' data-contact1="'.$data->contact1.'"';
                $button .= ' data-contact2="'.$data->contact2.'"';
                    
                $button .= ' data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-customer="'.$data->customer.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> Delete</a>';
                return $button;        
            })
            ->removeColumn('id')
            ->make(true);
    }
}
