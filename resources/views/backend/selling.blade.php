@extends('master')

@section('contentMain')
    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
          <div class="row">
            <section class="col-xs-12">
              <div class="box box-solid">
                <div class="box-header bg-gray-light">
                  <div class="box-title">
                    <a href="#add" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> {{ ucwords(trans('livepos.supplier.add')) }}</a>
                    <a href="#all" data-action="all" class="btn bg-maroon btn-round"><i class="fa fa-list"></i></a>
                  </div>
                  <div class="box-tools .pull-right">
                    <h1 class="box-title total-amount" id="total-amount-1" style="font-size: 2.5em; margin-right: 10px;">@if(isset($detail)) {{ livepos_round($detail->total_amount) }} @else 0 @endif</h1>
                    <button class="btn bg-maroon btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div> <!--.box-header--> 
                @if(isset($all))
                <div class="box-footer">
                  <table class="table table-hover" id="selling-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.supplier.name') }}</th>
                              <th>{{ trans('livepos.supplier.address') }}</th>
                              <th>{{ trans('livepos.supplier.contact1') }}</th>
                              <th>{{ trans('livepos.supplier.contact2') }}</th>
                              <th></th>
                          </tr>
                      </thead>
                  </table>
                </div>
                @else
                <div class="box-body row">
                  <div class="col-md-9 row">
                    <div class="col-md-12 row">
                      <form action="{{ livepos_asset('api/sellingDetail') }}" id="form-input-product">
                        <div class="form-group">
                          <div class="col-md-4">
                            <input autocomplete="off" type="text" id="input-product" class="form-control input-lg input-product bg-navy" placeholder="{{ trans('livepos.product.name') }}">
                            <input type="hidden" name="selling_id" id="input-selling_id" value="{{ $detail->id or ''}}">
                            <input type="hidden" name="product_id" id="input-product_id">
                            <input type="hidden" name="unit" id="input-unit">
                            <input type="hidden" name="purchase_price" id="input-purchase_price">
                            <input type="hidden" name="selling_price" id="input-selling_price">
                            <input type="hidden" name="converter" id="input-converter">
                          </div>
                          <div class="col-md-2">
                            <label class="control-label input-lg" id="display-product"></label>
                          </div>
                          <div class="col-md-6 row">
                            <div class="col-xs-4">
                              <input autocomplete="off" type="number" min="0" name="quantity" step="any" id="input-quantity" class="form-control input-lg input-product bg-navy" placeholder="{{ trans('livepos.quantity') }}">
                            </div>
                            <div class="col-xs-5">
                              <input autocomplete="off" type="number" min="0" name="discount" step="any" id="input-discount" class="form-control input-lg input-product bg-navy" placeholder="{{ trans('livepos.discount') }}">
                            </div>
                            <div class="col-xs-3">
                              <button class="btn bg-navy btn-block btn-lg"><i class="fa fa-plus"></i></button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    @if(isset($detail))
                    <div class="col-md-12">
                      <table class="table table-hover table-striped" id="selling-table">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>{{ trans('livepos.product.name') }}</th>
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
                        <div class="row">
                          <div class="col-sm-6">
                            <form action="#" id="form-add-customer" class="form-inline">
                              <input type="hidden" name="_method" value="put">
                              <div class="input-group input-group-lg">
                                <input type="text" class="form-control" name="customer" placeholder="{{ trans('livepos.customer') }}">
                                <input type="hidden" name="customer_id">
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-primary">{{ trans('livepos.save') }}</button>
                                </div><!-- /btn-group -->
                              </div> 
                            </form>
                          </div>
                          <div class="col-sm-6">
                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                  <th style="width:50%">{{ trans('livepos.customer.name') }}:</th>
                                  <td class="customer-name" id="subtotal-amount-1">{{ $detail->customer->customer }}</td>
                                </tr>
                                <tr>
                                  <th>{{ trans('livepos.selling.point') }}:</th>
                                  <td class="selling-point" id="subtotal-amount-1">{{ $detail->point }}</td>
                                </tr>
                                <tr>
                                  <th>{{ trans('livepos.totalPoint') }}:</th>
                                  <td class="total-point" id="total-amount-2">{{ $detail->customer->totalPoint or $detail->point}}</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                  <div class="col-md-3 row">
                    

                  </div>
                </div>
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
            <h4 class="modal-title text-center">supplier</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <div class="form-group">
                <label for="supplier" class="col-sm-3 control-label">{{ trans('livepos.supplier.name') }}</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="supplier" name="supplier" autofocus placeholder="{{ trans('livepos.supplier.name') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="address" name="address" class=col-sm-3 "control-label">{{ trans('livepos.supplier.address') }}</label>
                <div class="col-sm-9">
                  <textarea name="address" id="address" class="form-control" placeholder="{{ trans('livepos.supplier.address') }}"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="contact1" name="contact1" class="col-sm-3 control-label">{{ trans('livepos.supplier.contact1') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="contact1" name="contact1" autofocus placeholder="{{ trans('livepos.supplier.contact1') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="contact2" name="contact2" class="col-sm-3 control-label">{{ trans('livepos.supplier.contact2') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="contact2" name="contact2" autofocus placeholder="{{ trans('livepos.supplier.contact2') }}">
                </div>
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
            <h4 class="modal-title text-center">{{ trans('livepos.supplier.delete') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.confirmDelete') }} {{ trans('livepos.supplier.name') }} <span id="supplier"></span> ?</p>
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
    var products = {};
    var productLabels = [];
    var inputProduct  = $('#input-product');
    inputProduct.typeahead({
      source: function(query, process) {
        $.get('{{ livepos_asset("api/product/search") }}', {q: query}, function(data) {
          products = {};
          productLabels = [];

          $.each( data, function(i, e) {
            e.converter = 1;
            label = e.name + ' - ' + e.unit.toUpperCase();
            productLabels.push(label);
            products[ label ] = e;
            
            var q = u = [];
            var ne = {};
            
            for (x in e.metas) {
              if (e.metas[ x ].meta_key == 'multi_price') {
                q = $.parseJSON(e.metas[ x ].meta_value);
              } else if (e.metas[ x ].meta_key == 'multi_unit') {
                u = $.parseJSON(e.metas[ x ].meta_value);
              }
            }

            for (var i = 0; i < u.length; i++) {
              m = u[i];
              ne = $.extend(true, {}, e);
              ne.unit = m.unit;
              ne.converter = m.quantity;

              s = 1;
              for (var j = 0; j < q.length; j++) {
                n = q[j];
                if (n.quantity <= ne.converter && n.quantity > s) {
                  ne.selling_price = n.selling_price;
                  s = n.quantity;
                }
              }

              label = ne.name + ' - ' + ne.unit.toUpperCase();
              productLabels.push(label);
              products[ label ] = ne;
            }
          })
          process(productLabels);
        });
      }
      , updater: function( item ) {
        $('#input-product_id').val( products[ item ].id );
        $('#input-unit').val( products[ item ].unit );
        $('#input-purchase_price').val( products[ item ].purchase_price );
        $('#input-selling_price').val( products[ item ].selling_price );
        $('#input-converter').val( products[ item ].converter );
        label = products[ item ].selling_price * products[ item ].converter + ' @ ' + products[ item ].unit;
        $('#display-product').text(label);
        $('#input-quantity')[0].focus();
        return item;
      }

    });

    @if(isset($detail))
    var dataTables = $('#selling-table').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, 'desc']],
        paging: false,
        info: false,
        searching: false,
        ajax: '{!! action('Backend\Selling@anyDataDetail', ['id' => $detail->id]) !!}',
        columns: [
            { data: 'created_at', name: 'created_at' },
            { data: 'product_name', name: 'product_name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'discount', name: 'discount' },
            { data: 'amount', name: 'amount' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    dataTables.on('draw.dt', function() {
      $.get('{{ livepos_asset("api/selling/$detail->id") }}', {}, function(data) {
        if (data.id) {
          $('.subtotal-amount').text(data.amount.toString().toRp());
          $('.discount-amount').text(data.discount);
          $('.total-amount').text(data.total_amount.toString().toRp());
        }
      })
    })
    @endif

    var formInput = $('#form-input-product');

    formInput.submit(function(e){
      e.preventDefault();
      url = formInput.attr('action');
      $.post(url, formInput.serialize(), function(data) {
        if (data.message == 'ok') {
          if ($('#input-selling_id').val() == '') {
            location.href = '{{ livepos_asset("dashboard/selling/") }}'+data.created.selling_id;
            return;
          }
          dataTables.draw(false);
          formInput[0].reset();
          $('#display-product').text('');
          $('#input-product')[0].focus();
        }
      }, 'json');

    });

    $('#selling-table').on('click', 'tr a[data-target=#detail-delete]', function(e){
      e.preventDefault();
      var button = $(this);
      $.post('{{ livepos_asset("api/sellingDetail/") }}'+button.data('id'), {_method: 'delete'}, function( data ) {
        if (data.message == 'ok') {
          dataTables.draw(false);
        }
      })
    })

});
</script>
@endpush

