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
                  <form id="form-add-product" action="{{ livepos_asset('api/purchasingDetail') }}" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <label class="control-label">{{ trans('livepos.purchasing.chooseProduct') }}</label>
                        <select id="input-product" class="input-lg form-control text-black" autofocus data-placeholder="{{ trans('livepos.purchasing.chooseProductOptionText') }}">
                          <option value=""></option>
                        @foreach($products->toArray() as $product)
                                    <option value="{{ $product['id'] }},0" 
                                    data-meta_id="0" data-meta_convert="1" data-meta_unit="{{ $product['unit'] }}"  
                                    @foreach($product as $key => $value)
                                      @if(!is_array($value)) data-{{$key}}="{{ livepos_round($value)}}" @endif 
                                    @endforeach
                                  > {{ ucwords($product['name']) }} --- {{ strtoupper($product['unit']) }}</option>
                          @if(isset($product['metas']))
                            @foreach($product['metas'] as $meta)
                              @if($meta['meta_key'] == 'multi_unit')
                                @foreach(json_decode($meta['meta_value'], true) as $meta_value)
                                  <option value="{{ $product['id'] }},{{ $meta['id'] }}"
                                    data-meta_id="{{ $meta['id'] }}"  
                                    data-meta_convert="{{ $meta_value['quantity']}}" 
                                    data-meta_unit="{{ $meta_value['unit'] }}" 
                                    @foreach($product as $key => $value)
                                      @if(!is_array($value)) data-{{$key}}="{{ livepos_round($value)}}" @endif 
                                    @endforeach
                                  >{{ ucwords($product['name']) }} --- {{ strtoupper($meta_value['unit']) }} ({{ $meta_value['quantity'] }} {{ $product['unit'] }})</option>
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                        </select>
                      </div>
                      <div class="col-md-4 row">  
                        <div class="col-xs-7">  
                          <label class="control-label">{{ trans('livepos.product.purchase_price') }}</label>
                          <input type="number" min="0" step="any" id="input-price" class="input-price input-lg form-control text-black" placeholder="{{ trans('livepos.price') }}">
                        </div>
                        <div class="col-xs-5">
                          <label class="control-label">{{ trans('livepos.quantity') }}</label>
                          <input type="number" min="0" step="any" id="input-quantity" class="input-lg form-control text-black" placeholder="Qty">
                        </div>
                      </div>
                      <div class="col-md-4 row">  
                        <div class="col-xs-7">
                          <label class="control-label">{{ trans('livepos.discount') }}</label>
                          <input type="number" min="0" step="any" id="input-discount" class="input-lg form-control text-black" placeholder="{{ trans('livepos.discount') }}">
                        </div>
                        <div class="col-xs-5 text-right">  
                          <label class="control-label">{{ trans('livepos.add') }}</label>
                          <button id="button-add" type="submit" class="input-lg btn bg-black btn-block"><i class="fa fa-plus"></i> {{ trans('livepos.purchasing.addProduct') }}</button>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">&nbsp;</div>
                  </form>
                </div>
              @endif
                <div class="box-footer">
                  @if(isset($detail))
                  <table class="table table-hover" id="purchasing-details-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>#</th>
                              <th>{{ trans('livepos.product.name') }}</th>
                              <th>{{ trans('livepos.product.unit') }}</th>
                              <th>{{ trans('livepos.product.purchase_price') }}</th>
                              <th>{{ trans('livepos.quantity') }}</th>
                              <th>{{ trans('livepos.discount') }}</th>
                              <th>{{ trans('livepos.amount') }}</th>
                              <th></th>
                          </tr>
                      </thead>
                  </table>
                  <div class="well">
                    <div class="row">
                      <div class="col-sm-6">
                        <form action="#" id="form-add-discount" class="form-inline">
                          <input type="hidden" name="_method" value="put">
                          <div class="input-group input-group-lg">
                            <input type="text" class="form-control" name="discount" placeholder="{{ trans('livepos.addDiscount') }}">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-primary">{{ trans('livepos.saveDiscount') }}</button>
                            </div><!-- /btn-group -->
                          </div> 
                        </form>
                      </div>
                      <div class="col-sm-6">
                        <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th style="width:50%">{{ trans('livepos.subTotal') }}:</th>
                              <td class="subtotal-amount" id="subtotal-amount-1">{{ $detail->amount }}</td>
                            </tr>
                            <tr>
                              <th>{{ trans('livepos.discount') }} (<a href="#" id="delete-discount-amount" class="btn btn-link"><i class="fa fa-times"></i> {{ trans('livepos.clear') }}</a>):</th>
                              <td class="discount-amount">{{ $detail->discount }}</td>
                            </tr>
                            <tr>
                              <th>{{ trans('livepos.total') }}:</th>
                              <td class="total-amount" id="total-amount-2">{{ $detail->total_amount }}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
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
  
  @if(isset($detail))
    <div class="modal fade" id="detail-edit">
      <div class="modal-dialog livepos-full">
        <div class="modal-content">
          <div class="modal-header bg-maroon">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.purchasing.detail') }}</h4>
          </div>
          <form id="form-edit-product" class="inline-form" action="{{ livepos_asset('api/purchasingDetail') }}" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <label class="control-label">{{ trans('livepos.purchasing.chooseProduct') }}</label>
                  <select id="input-product-modal" class="input-lg form-control text-black" autofocus data-placeholder="{{ trans('livepos.purchasing.chooseProductOptionText') }}">
                    <option value=""></option>
                  @foreach($products->toArray() as $product)
                              <option value="{{ $product['id'] }},0" 
                              data-meta_id="0" data-meta_convert="1" data-meta_unit="{{ $product['unit'] }}"  
                              @foreach($product as $key => $value)
                                @if(!is_array($value)) data-{{$key}}="{{ livepos_round($value)}}" @endif 
                              @endforeach
                            > {{ ucwords($product['name']) }} --- {{ strtoupper($product['unit']) }}</option>
                    @if(isset($product['metas']))
                      @foreach($product['metas'] as $meta)
                        @if($meta['meta_key'] == 'multi_unit')
                          @foreach(json_decode($meta['meta_value'], true) as $meta_value)
                            <option value="{{ $product['id'] }},{{ $meta['id'] }}"
                              data-meta_id="{{ $meta['id'] }}"  
                              data-meta_convert="{{ $meta_value['quantity']}}" 
                              data-meta_unit="{{ $meta_value['unit'] }}" 
                              @foreach($product as $key => $value)
                                @if(!is_array($value)) data-{{$key}}="{{ livepos_round($value)}}" @endif 
                              @endforeach
                            >{{ ucwords($product['name']) }} --- {{ strtoupper($meta_value['unit']) }} ({{ $meta_value['quantity'] }} {{ $product['unit'] }})</option>
                          @endforeach
                        @endif
                      @endforeach
                    @endif
                  @endforeach
                  </select>
                </div>
                <div class="col-md-4 row">  
                  <div class="col-xs-7">  
                    <label class="control-label">{{ trans('livepos.product.purchase_price') }}</label>
                    <input type="number" min="0" step="any" id="input-price-modal" class="input-price input-lg form-control text-black" placeholder="{{ trans('livepos.price') }}">
                  </div>
                  <div class="col-xs-5">
                    <label class="control-label">{{ trans('livepos.quantity') }}</label>
                    <input type="number" min="0" step="any" id="input-quantity-modal" class="input-lg form-control text-black" placeholder="Qty">
                  </div>
                </div>
                <div class="col-md-4 row">  
                  <div class="col-xs-7">
                    <label class="control-label">{{ trans('livepos.discount') }}</label>
                    <input type="number" min="0" step="any" id="input-discount-modal" class="input-lg form-control text-black" placeholder="{{ trans('livepos.discount') }}">
                  </div>
                  <div class="col-xs-5 text-right">  
                    <label class="control-label">{{ trans('livepos.amount') }}</label>
                    <input type="number" min="0" step="any" readonly="true" id="input-amount-modal" class="input-lg form-control text-black" placeholder="{{ trans('livepos.amount') }}">
                  </div>
                </div>
              </div>
              
              <div class="row">&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.save') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal delete -->
    <div class="modal fade" id="detail-delete">
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
              <p>{{ trans('livepos.confirmDelete') }} {{ trans('livepos.product.name') }} <span id="product-detail-delete"></span> ?</p>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.yes') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  @endif
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
            { data: 'created_at', name: 'created_at' },
            { data: 'product_name', name: 'purchasing_details.product_name' },
            { data: 'unit', name: 'purchasing_details.unit' },
            { data: 'purchase_price', name: 'purchasing_details.purchase_price' },
            { data: 'quantity', name: 'purchasing_details.quantity' },
            { data: 'discount', name: 'purchasing_details.discount' },
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
             location.replace('{{ livepos_asset("dashboard/purchasing") }}' + '/'+data.created.id+'/detail');
          }
          @if(isset($detail))
          if (data.updated) {
             location.reload();
          }
          @endif
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

    // DETAIL
  @if(isset($detail))
    $('#input-product, #input-product-modal').on('change', function(){
      var product = $(this).find(':selected'),
          converter = product.data('meta_convert'),
          price = product.data('purchase_price') * converter;
      countAmountModal();
      $(this).parents('form').find('.input-price').val(price)[0].focus();
    });

    $('#form-add-product').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      var post = {};
      var input_product = $('#input-product :selected');
      post.purchasing_id = '{{ $detail->id }}';
      post.product_id = input_product.data('id');
      post.product_name = input_product.data('name');
      post.unit = input_product.data('meta_unit');
      post.purchase_price = $('#input-price').val();
      post.discount = $('#input-discount').val();
      post.quantity = $('#input-quantity').val();
      post.amount = post.purchase_price * post.quantity - post.discount;
      $.post(form.attr('action'), post, function(data) {
        if (data.message == 'ok') {
          dataTables.draw();
          form[0].reset();
          $('#input-product')[0].focus();
        }
      }, 'json')
    })

    var modalDetail = $('#detail-edit');

    modalDetail.on('show.bs.modal', function(e){
      var button = $(e.relatedTarget);
      var modal = $(this);
      var form = modal.find('form');
      form.find('select')[0].focus();
      form.attr('action', '{{ livepos_asset('api/purchasingDetail') }}'+'/'+button.data('id'));
      $('#input-product-modal').find('[data-id='+button.data('product_id')+'][data-meta_unit='+button.data('unit')+']').prop('selected', true);
      $('#input-price-modal').val(button.data('purchase_price'));
      $('#input-quantity-modal').val(button.data('quantity'));
      $('#input-discount-modal').val(button.data('discount'));
      $('#input-amount-modal').val(button.data('amount'));
    });

    $('#form-edit-product').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      var post = {};
      var input_product = $('#input-product-modal :selected');
      post.purchasing_id = '{{ $detail->id }}';
      post.product_id = input_product.data('id');
      post.product_name = input_product.data('name');
      post.unit = input_product.data('meta_unit') == '0' ? input_product.data('unit') : input_product.data('meta_unit');
      post.purchase_price = $('#input-price-modal').val();
      post.discount = $('#input-discount-modal').val();
      post.quantity = $('#input-quantity-modal').val();
      post.amount = $('#input-amount-modal').val();
      post._method = 'put';
      if (post.amount < 0) return;
      $.post(form.attr('action'), post, function(data) {
        if (data.message == 'ok') {
          dataTables.draw();
          form[0].reset();
          modalDetail.modal('hide');
        }
      }, 'json')
    });

    var countAmountModal = function(){
      var purchase_price = $('#input-price-modal').val();
      var discount = $('#input-discount-modal').val();
      var quantity = $('#input-quantity-modal').val();
      var amount = purchase_price * quantity - discount;
      $('#input-amount-modal').val(amount);
    };

    $('#form-edit-product').find('input').on('change', function(){
      countAmountModal();
    })

    $('#input-price-modal').on('focus', function(){
      countAmountModal();
    })

    var modalDetailDelete = $('#detail-delete');
    modalDetailDelete.on('show.bs.modal', function(e){
      var button = $(e.relatedTarget);
      $('#product-detail-delete').text(button.data('product_name'));
      $(this).find('form').attr('action', '{{ livepos_asset('api/purchasingDetail') }}'+'/'+button.data('id'));
    });

    modalDetailDelete.find('form').on('submit', function(e){
      e.preventDefault();
      var form = $(this);
      var post = {};
      post._method = 'delete';
      $.post(form.attr('action'), post, function(data) {
        if (data.message == 'ok') {
          dataTables.draw();
          form[0].reset();
          modalDetailDelete.modal('hide');
        }
      }, 'json')
    })

    dataTables.on('draw.dt', function() {
      $.get('{{ livepos_asset("api/purchasing/$detail->id") }}', {}, function(data) {
        if (data.id) {
          $('.subtotal-amount').text(data.amount);
          $('.discount-amount').text(data.discount);
          $('.total-amount').text(data.total_amount);
        }
      })
    })

    $('#form-add-discount').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.post('{{ livepos_asset("api/purchasing/".$detail->id) }}', form.serialize(), function(data) {
        if (data.message == 'ok') {
          dataTables.draw();
          form[0].reset();
          $('#input-product')[0].focus();
        }
      })
    })

    $('#delete-discount-amount').click(function(e) {
      e.preventDefault();
      $.post('{{ livepos_asset("api/purchasing/".$detail->id) }}', {_method: 'put', discount: 0}, function(data) {
        if (data.message == 'ok') {
          dataTables.draw();
          $('#input-product')[0].focus();
        }
      })
    })
  @endif
});
</script>
@endpush

