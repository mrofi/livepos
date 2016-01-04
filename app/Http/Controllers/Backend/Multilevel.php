<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Multilevel as Model;
use livepos\Commision;
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
        $multilevels = Model::with('customer')->get()->keyBy('id')->all();

        $data  = Model::join('customers', 'multilevels.customer_id', '=', 'customers.id')
                ->select(['multilevels.id', 'multilevels.customer_id as code', 'customers.customer as customer', 'multilevels.upline_id as upline', 'multilevels.level', 'multilevels.created_at']);

        $collection = [];
        $no = 0;
        foreach($data->get() as $row)
        {
            $collection[$row->id] = ++$no;
        }

        return Datatables::of($data)
            ->addColumn('action', function ($data)  use ($multilevels) {
                $commision = Commision::where('multilevel_id', $data->id)->where('redeem', '0')->sum('commision');

                $button = '<a href="#redeem-'.$data->id.'" data-id="'.$data->id.'"  data-action="redeem" data-toggle="modal" data-target="#modal-redeem" data-commision="'.$commision.'" class="btn-link btn btn-xs"><i class="fa fa-money"></i> Pencairan Point</a>';
                $button .= '<a href="#edit-'.$data->id.'" data-id="'.$data->id.'" data-customer="'.$data->customer. ' - (ID = '.$data->code.')" data-customer-id="'.$data->code.'" data-upline="'.($data->upline == '0' ? '-' : $multilevels[$data->upline]->customer->customer. ' - (ID = '.$multilevels[$data->upline]->customer->id.')').'" data-upline-id="'.$data->upline.'" data-upline-customer-id="'.($data->upline == '0' ? '-' : $multilevels[$data->upline]->customer->id).'" data-action="edit" data-toggle="modal" data-target="#modal-add-edit" class="btn-link btn btn-xs pull-right"><i class="fa fa-pencil"></i> '.trans('livepos.edit').'</a>';
                $button .= '<a href="#delete-'.$data->id.'" data-id="'.$data->id.'" data-customer="'.$data->customer.'" data-action="delete" data-toggle="modal" data-target="#modal-delete" class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->editColumn('upline', function($data) use ($multilevels) {
                return ($data->upline == '0') ? '-' : $multilevels[$data->upline]->customer->customer;
            })
            ->addColumn('commision', function($data) {
                $commision = Commision::where('multilevel_id', $data->id);
                $all = $commision->sum('commision');
                $left = $commision ->where('redeem', '0')->sum('commision'); 
                return livepos_toCurrency($left, '').' of '.livepos_toCurrency($all, '');
            })
            ->make(true);
    }

    public function printRedeem(Request $request, $id)
    {
        $redeem = \livepos\Commision::where('redeem', '1')->where('multilevel_id', $id)->orderBy('updated_at', 'DESC')->first();

        $nomimal = 0;

        if ($redeem) 
        {
            $redeems = \livepos\Commision::where('redeem', '1')->where('multilevel_id', $id)->where('updated_at', $redeem->updated_at);
    
            $nomimal = $redeems->sum('commision');

            $multilevel =  \livepos\Multilevel::find($redeem->multilevel_id);

            $customer = \livepos\Customer::find($multilevel->customer_id);

            return view('reports.redeem', ['redeem' => $redeem, 'nominal' => $nomimal, 'customer' => $customer]);
        }
    }
}
