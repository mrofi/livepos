@extends('print')

@section('contentMain')
  <style media="print, all">
    body {
      width: 8cm;
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

    <div class="row max-width">
      <div class="col-xs-12 table-responsive">
          <table class="table table-condensed">
            <tr>
              <td colspan="2" class="text-center"><strong>Pencairan Point Pelanggan</strong></td>
            </tr>
            <tr>
              <th>{{ trans('livepos.customer.id') }}:</th>
              <td><strong>{{ strtoupper($customer->customer) }}</strong></td>
            </tr>
            <tr>
              <th style="width: 50%">Tanggal :</th>
              <td>{{ livepos_dateTimeToShow($redeem->updated_at) }}</td>
            </tr>
            <tr>
              <th>{{ trans('livepos.point') }}:</th>
              <td><strong>Rp. {{ livepos_toCurrency($nominal, '') }}*</strong></td>
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
          <small>Dicetak pada {{ livepos_dateTimeToShow(\Carbon::now()) }}</small>
        </p>
      </div>
    </div>
@endsection