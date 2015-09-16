@extends('master')

@section('contentMain')
    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
          <div class="row">
            <section class="col-xs-12">
              <div class="box box-solid">
                <div class="box-header bg-gray-light">
                  <div class="row">
                    <div class="col-sm-4 col-md-5">
                        <a href="#add" data-toggle="modal" data-target="#modal-add-edit" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> <span class="hidden-sm">{{ ucwords(trans('livepos.purchasing.add')) }}</span></a>
                        @if(isset($detail))
                        <a href="{{ livepos_asset('dashboard/purchasing') }}" class="btn btn-round bg-maroon"><i class="fa fa-arrow-left"></i></a>
                        <div class="pull-right">  
                            <a href="#edit" data-toggle="modal" title="{{ ucwords(trans('livepos.edit')) }}" data-target="#modal-add-edit" data-id="{{ $detail->id }}" data-bill_date="{{ $detail->bill_date }}" data-supplier_id="{{ $detail->supplier_id }}" data-bill_no="{{ $detail->bill_no }}" data-action="edit" class="btn bg-maroon btn-round"><i class="fa fa-pencil"></i></a>
                            <div class="visible-xs" style="width: 75px;">&nbsp;</div>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-8 col-md-7 row">
                      <div class="row visible-xs">&nbsp;</div>
                      @if(isset($detail))
                      <div class="col-xs-5">
                        <div class="box-title">
                          <i class="fa fa-calendar hidden-xs"></i> {{ $detail->bill_date }}
                        </div>
                      </div>
                      <div class="col-xs-7">
                        <div class="box-title">
                          <i class="fa fa-file-o hidden-xs"></i> {{ $detail->transaction_no }}
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                      
                  <div class="box-tools .pull-right">
                    <button class="btn bg-maroon btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div> <!--.box-header--> 
              @if(isset($detail))
                <div class="box-body bg-gray">
                  <div class="box-title row">
                    <div class="col-md-4">
                      <div class="box-title">{{ trans('livepos.supplier.name') }}</div>
                      <h3>
                      {{ $detail->supplier->supplier }}
                      </h3>
                    </div>
                    <div class="col-md-4">
                      <div class="box-title">{{ trans('livepos.purchasing.transactionNumber') }}</div>
                      <h3>
                      {{ $detail->bill_no }}
                      </h3>
                    </div>
                    <div class="col-md-4 text-right">  
                      <h1 id="total-amount-1" class="total-amount">
                      {{ $detail->total_amount }}
                      </h1>
                    </div>
                  </div>
                </div>
                <div class="box-body bg-navy">
                  <div class="box-title row">
                    <div class="col-sm-6 col-md-8">
                      <label class="control-label">{{ trans('livepos.purchasing.chooseProduct') }}</label>
                      <select id="input-product" class="form-control text-black">
                        <option value>Pilih Produk untuk ditambahkan</option>
                      </select>
                    </div>
                    <div class="col-sm-6 col-md-4 row">  
                      <div class="col-xs-4">
                        <label class="control-label">{{ trans('livepos.quantity') }}</label>
                        <input type="text" id="input-quantity" class="form-control text-black" placeholder="Qty">
                      </div>
                      <div class="col-xs-8 text-right">  
                        <label class="control-label">{{ trans('livepos.add') }}</label>
                        <button id="button-add" class="btn bg-black btn-block"><i class="fa fa-plus"></i> {{ trans('livepos.purchasing.addProduct') }}</button>
                      </div>
                    </div>
                  </div>
                  <div class="row">&nbsp;</div>
                </div>
              @endif
                <div class="box-footer">
                  @if(isset($detail))
                  <table class="table table-hover" id="purchasing-details-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.product.name') }}</th>
                              <th>{{ trans('livepos.product.unit') }}</th>
                              <th>{{ trans('livepos.purchase_price') }}</th>
                              <th>{{ trans('livepos.quantity') }}</th>
                              <th>{{ trans('livepos.discount') }}</th>
                              <th>{{ trans('livepos.amount') }}</th>
                              <th></th>
                          </tr>
                      </thead>
                  </table>
                  @else
                  <table class="table table-hover" id="purchasings-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.date') }}</th>
                              <th>{{ trans('livepos.purchasing.billNumber') }}</th>
                              <th>{{ trans('livepos.supplier.name') }}</th>
                              <th>{{ trans('livepos.totalAmount') }}</th>
                              <th></th>
                          </tr>
                      </thead>
                  </table>
                  @endif
                </div>
              </div><!--.box--> 
            </section>
          </div><!-- /.row -->
    </section>
    <!--end of Main Content-->
    
    <!-- modal add /edit -->
    <div class="modal fade" id="modal-add-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-maroon">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">Purchasing</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <div class="form-group">
                <label for="bill_date" class="col-sm-3 control-label">{{ trans('livepos.purchasing.billDate') }}</label>
                <div class="col-sm-3"><input type="text" data-provide="datepicker" class="form-control" id="bill_date" name="bill_date" placeholder="{{ trans('livepos.purchasing.billDate') }}"></div>
              </div>
              <div class="form-group">
                <label for="supplier_id" class="col-sm-3 control-label">{{ trans('livepos.supplier.name') }}</label>
                <div class="col-sm-6">
                  <select name="supplier_id" id="supplier_id" class="form-control" data-placeholder="{{ trans('livepos.supplier.name') }}">
                  @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="bill_no" class="col-sm-3 control-label">{{ trans('livepos.purchasing.billNumber') }}</label>
                <div class="col-sm-8"><input type="text" class="form-control" id="bill_no" name="bill_no" autofocus placeholder="{{ trans('livepos.purchasing.billNumber') }}"></div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="_method" id="method" >
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.close') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.save') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- modal delete -->
    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-maroon">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.purchasing.delete') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.confirmDelete') }} {{ trans('livepos.purchasing.name') }} <span id="purchasing"></span> ?</p>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="_method" id="method" value="delete">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.yes') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
@endsection

@push('scriptJs')
<script>
$(function() {
  @if(isset($detail))
    var dataTables = $('#purchasing-details-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ livepos_asset('dashboard/purchasing/detailData/'.$detail->id) }}',
        columns: [
            { data: 'product_name', name: 'purchasing_details.product_name' },
            { data: 'unit', name: 'purchasing_details.unit' },
            { data: 'purchase_price', name: 'purchasing_details.purchase_price' },
            { data: 'quantity', name: 'purchasing_details.quantity' },
            { data: 'disocunt', name: 'purchasing_details.disocunt' },
            { data: 'amount', name: 'purchasing_details.amount' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
  @else
    var dataTables = $('#purchasings-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! action('Backend\Purchasing@anyData') !!}',
        columns: [
            { data: 'bill_date', name: 'purchasings.bill_date' },
            { data: 'bill_no', name: 'purchasings.bill_no' },
            { data: 'supplier', name: 'suppliers.supplier' },
            { data: 'total_amount', name: 'purchasings.total_amount' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
  @endif
    
    var modal = $('#modal-add-edit'), modalDelete = $('#modal-delete'), form = modal.find('form'), formDelete = modalDelete.find('form');
    modal.on('show.bs.modal', function( event ) {
      var button = $(event.relatedTarget), 
          title = '{{ trans('livepos.purchasing.add') }}',
          content = {bill_date: '{{ livepos_dateToShow() }}', bill_no: '', supplier_id: ''}, 
          action = "{{ livepos_asset('api/purchasing') }}";
          method = 'POST';
      
      if (button.data('action') == 'edit') {
        title = '{{ trans('livepos.purchasing.edit') }}';
        content['bill_date'] = button.data('bill_date');
        content['bill_no'] = button.data('bill_no');
        content['supplier_id'] = button.data('supplier_id');
        action += '/'+button.data('id');
        method = 'PUT';
        $('.input-init-stock').addClass('hide');
      }
      
      if (!button.data('action')) return;
      modal.find('.modal-title').text(title);
      modal.find('.modal-body #purchasing').val(content);
      modal.find('.modal-footer #method').val(method);
      form.attr('action', action)
        .find('.error-label').remove().end()
        .find('.form-group').removeClass('has-warning').end()
        .find('.alert.cloned').remove();
      for (x in content) {
        cx = content[x];
        c = modal.find('.modal-body #'+x);
        if (c.is('select')) {
          opt = c.find('option');
          if (opt.attr('value') == cx) opt.attr('selected', 'selected');
        } else if(c.is('input[type=checkbox]')) {
          if (c.attr('value') == cx) c.attr('checked', 'checked');
        } else {
          c.val(cx)
        }
      }

    }).on('shown.bs.modal', function() {
      modal.find('.modal-body [autofocus]')[0].focus();
    });
    
    modalDelete.on('show.bs.modal', function(event){
      var button = $(event.relatedTarget);
      formDelete.attr('action', "{{ livepos_asset('api/purchasing') }}/"+button.data('id'))
        .find('.alert.cloned').remove();
      
    });
    
    var error_handling = function(_form, data) {
      for (x in data) {
        err = data[x];
        _form.find('[name='+x+']').after('<label class="error-label control-label" for="inputError"><i class="fa fa-times-circle-o"></i> '+err[0]+'</label>')
          .parents('.form-group').addClass('has-warning');
      } 
      var $alert = _form.find('.modal-body .alert').clone().prependTo(_form.find('.modal-body')).addClass('cloned');
      $alert.find('.message').text(data.error ? data.error : '{{ trans('livepos.errorHappening') }}');
      $alert.removeClass('hide');
    }
    

    var submit_handling = function(_form, event) {
      event.preventDefault();
      _form.find('.form-group').removeClass('has-warning');
      _form.find('.form-group .error-label').remove();
      _form.find('.modal-body .alert.cloned').remove();
      $.post(_form.attr('action'), _form.serialize(), function( data ) {
        if (data.message == 'ok') {
          dataTables.draw();
          _form.parents('.modal').modal('hide');
          if (data.created) {
             location.href += '/'+data.created.id+'/detail';
          }
          error_handling(_form, data);
        };
      }, 'json').error( function(xhr, textStatus, errorThrown) {
        error_handling(_form, $.parseJSON(xhr.responseText));
      });
      return false;
    };
    
    form.on('submit', function( event ) {
      _form = $(this);
      return submit_handling(form, event);
    });
    
    formDelete.on('submit', function(event){
      event.preventDefault();
      _form = $(this);
      return submit_handling(_form, event);
    }); 

});
</script>
@endpush

