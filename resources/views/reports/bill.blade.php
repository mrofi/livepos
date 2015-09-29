@extends('print')

@section('contentMain')
	<style>
		.max-width {
			width: 8cm;
		}

		.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {
		    padding: 3px;
		}
	</style>
	<div class="row max-width text-center">
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
              <th>Qty</th>
              <th>Discount</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
	      @foreach($detail->details as $det)
			<tr>
				<td colspan="3">{{ strtoupper($det->product_name).' @ '.(livepos_toCurrency($det->selling_price * $det->converter)).'/'.$det->unit }}</td>
			</tr>	
			<tr>
				<td>{{ livepos_round($det->quantity) }}</td>
				<td>{{ livepos_toCurrency($det->discount) }}</td>
				<td>{{ livepos_toCurrency($det->amount) }}</td>
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
              <th style="width:50%">Subtotal:</th>
              <td>{{ livepos_toCurrency($detail->amount) }}</td>
            </tr>
            <tr>
              <th>Discount:</th>
              <td>{{ livepos_toCurrency($detail->discount) }}</td>
            </tr>
            <tr class="success">
              <th>Total:</th>
              <th>{{ livepos_toCurrency($detail->total_amount) }}</th>
            </tr>
            <tr>
              <th>Cash:</th>
              <td>{{ livepos_toCurrency($detail->cash) }}</td>
            </tr>
            <tr>
              <th>Change:</th>
              <td>{{ livepos_toCurrency($detail->change) }}</td>
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
              <th>ID Customer:</th>
              <td>{{ $detail->customer->id }}</td>
            </tr>
            @endif
            <tr>
              <th style="width: 50%">Tanggal Transaksi:</th>
              <td>{{ livepos_dateTimeToShow($detail->updated_at) }}</td>
            </tr>
            <tr>
              <th>Point:</th>
              <td>{{ $detail->point }}</td>
            </tr>
            </tr>
              <th>Total Point Anda:</th>
              <td>{{ $detail->customer->totalPoint or $detail->point }}</td>
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