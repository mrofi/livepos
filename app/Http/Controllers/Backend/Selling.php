<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

use livepos\Selling as Model;
use livepos\SellingDetail as ModelDetail;
use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Selling extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return view('backend.selling');
    }

    public function detail(Request $request, $id)
    {
        $detail = Model::where('id', $id)->firstOrFail();
    	// $detail = Model::where('done', '0')->where('id', $id)->firstOrFail();

        // if ($detail->cash > 0) return redirect('dashboard/selling/'.$id.'/print'); 

    	return view('backend.selling')->with(compact('detail'));
    }

    public function toPrint(Request $request, $id)
    {
        $detail = Model::where('id', $id)->firstOrFail();
        // $detail = Model::where('done', '1')->where('id', $id)->firstOrFail();

    	return view('reports.bill2')->with(compact('detail'));
    }

    public function anyDataDetail($id)
    {
    	$datas = ModelDetail::select('*')->where('selling_id', $id);

        $collection = [];
        $no = 0;
        foreach($datas->get() as $row)
        {
            $collection[$row->id] = ++$no;
        }

        $no = 0;

        return Datatables::of($datas)
            ->editColumn('product_name', '{!! $product_name." - ".strtoupper($unit)." (".livepos_toCurrency($selling_price * $converter).")" !!}')
            ->editColumn('quantity', '{!! livepos_round($quantity) !!}')
            ->editColumn('discount', '{!! livepos_toCurrency($discount) !!}')
            ->editColumn('amount', '{!! livepos_toCurrency($amount) !!}')
            ->addColumn('action', function ($data) {
                $d = '';
                foreach ($data->toArray() as $key => $value) {
                    $d .= ' data-'.$key.'="'.livepos_round($value).'" ';
                }
                $button = '<a href="#delete-'.$data->id.'" data-action="delete" data-toggle="modal" data-target="#detail-delete" '.$d.' class="btn-link btn btn-xs pull-right"><i class="fa fa-trash-o"></i> '.trans('livepos.delete').'</a>';
                return $button;        
            })
            ->editColumn('created_at', function($data) use($collection) {
                return $collection[$data->id];
            })
            ->removeColumn('id')
            ->make(true);
    }

}
