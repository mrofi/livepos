@extends('print')

@section('contentMain')
  <style media="print, all">
    body {
      width: 7cm;
    }

    body {
      font-size: 8pt;
    }

    .invoice {
      margin-top: 0;
      margin-bottom: 0;
    }

    .page-header {
      margin-top: 0;
      margin-bottom: 0;
    }
    .table-responsive, .table {
      border: 0;
      margin-bottom: 0!important;
    }
    .table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
        padding: 1px;
    }
  </style>
  <div id="receipt" class="row max-width text-center">
      <div class="col-xs-12">
        <h2 class="page-header">
          {{ config('livepos.company') }}
          <small>
            {!! config('livepos.companyaddress') !!}
          </small>
        </h2>
      </div><!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row max-width">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped table-condensed">
          <thead>
            <tr>
              <th>{{ trans('livepos.quantity') }}</th>
              <th>{{ trans('livepos.product.name') }}</th>
              <th class="text-right">{{ trans('livepos.discount') }}</th>
              <th class="text-right">{{ trans('livepos.amount') }}</th>
            </tr>
          </thead>
          <tbody>
        @foreach($detail->details as $det)
      <tr>
        <td>{{ livepos_round($det->quantity * $det->converter) }}</td>
        <td>{{ strtoupper($det->product_name) }}</td>
        <td class="text-right">{{ livepos_toCurrency($det->discount, '') }}</td>
        <td class="text-right">{{ livepos_toCurrency($det->amount, '') }}</td>
      </tr> 
        @endforeach
          </tbody>
        </table>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row max-width">
      <div class="col-xs-12 table-responsive">
          <table class="table table-condensed">
            <tr>
              <th style="width:50%">{{ trans('livepos.subTotal') }}:</th>
              <td class="text-right">{{ livepos_toCurrency($detail->amount) }}</td>
            </tr>
            <tr>
              <th>{{ trans('livepos.discount') }}:</th>
              <td class="text-right">{{ livepos_toCurrency($detail->discount) }}</td>
            </tr>
            <tr class="success">
              <th>{{ trans('livepos.total') }}:</th>
              <th class="text-right">{{ livepos_toCurrency($detail->total_amount) }}</th>
            </tr>
            <tr>
              <th>{{ trans('livepos.pay') }}:</th>
              <td class="text-right">{{ livepos_toCurrency($detail->cash) }}</td>
            </tr>
            <tr>
              <th>{{ trans('livepos.payChange') }}:</th>
              <td class="text-right">{{ livepos_toCurrency($detail->change) }}</td>
            </tr>
          </table>
        </div>
    </div>
    <div class="row max-width">
      <div class="col-xs-12 table-responsive">
          <table class="table table-condensed">
            @if($detail->customer->id != '1')
            <tr>
              <td colspan="2">Selamat Datang, {{ strtoupper(str_limit($detail->customer->customer, 15)) }}</td>
            </tr>
            <tr>
              <th>{{ trans('livepos.customer.id') }}:</th>
              <td>{{ $detail->customer->id }}</td>
            </tr>
            @endif
            <tr>
              <th>{{ trans('livepos.selling.transactionNumber') }}:</th>
              <td>{{ $detail->transaction_no }}</td>
            </tr>
            <tr>
              <th style="width: 50%">{{ trans('livepos.selling.transactionDate') }}:</th>
              <td>{{ livepos_dateTimeToShow($detail->updated_at) }}</td>
            </tr>
            <tr>
              <th>{{ trans('livepos.point') }}:</th>
              <td>Rp. {{ livepos_toCurrency($detail->point, '') }}*</td>
            </tr>
            <tr>
              <td colspan="2"><small>* Syarat &amp; Ketentuan Berlaku</small>   
            </tr>
          </table>
        </div>
    </div>
    <div class="row max-width">
      <div class="col-xs-12">
        <p class="text-center">
          <strong>Terima kasih atas kunjungan Anda</strong> <br>
          <small>Penukaran Point setiap tgl 14 - 17 tiap bulannya</small>
        </p>
      </div>
    </div>
@endsection

@section('footer')
<div class="text-center hidden-print">
  <a href="javascript: history.back()" class="btn btn-danger hidden-print"><i class="fa fa-arrow-left"></i></a>
  <a href="{{ url('dashboard/selling') }}" class="btn btn-primary hidden-print"><i class="fa fa-shopping-cart"></i> Penjualan Baru</a>
</div>
@endsection