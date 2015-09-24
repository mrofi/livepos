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
                    <h1 class="box-title" style="font-size: 2.5em; margin-right: 10px;">@if(isset($detail)) {{ livepos_round($detail->total_amount) }} @else 0 @endif</h1>
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

    var formInput = $('#form-input-product');

    formInput.submit(function(e){
      e.preventDefault();
      url = formInput.attr('action');
      $.post(url, formInput.serialize(), function(data) {
        if (data.message == 'ok') {
          if ($('#input-selling_id').val() == '') {
            location.href = '{{ livepos_asset("dashboard/selling/") }}'+data.created.selling_id;
          }
          dataTables.draw();
          formInput[0].reset();
          $('#display-product').text('');
          $('#input-product')[0].focus();
        }
      })

    })

    @if(isset($detail))
    var dataTables = $('#selling-table').DataTable({
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
    @endif
    var modal = $('#modal-add-edit'), modalDelete = $('#modal-delete'), form = modal.find('form'), formDelete = modalDelete.find('form');
    modal.on('show.bs.modal', function( event ) {
      var button = $(event.relatedTarget), 
          title = '{{ trans('livepos.supplier.add') }}',
          content = {supplier: '', address: '', contact1: '', contact2: ''},
          action = "{{ livepos_asset('api/supplier') }}";
          method = 'POST';
      
      if (button.data('action') == 'edit') {
        title = '{{ trans('livepos.supplier.edit') }}';
        content.supplier = button.data('supplier');
        content.address = button.data('address');
        content.contact1 = button.data('contact1');
        content.contact2 = button.data('contact2');
        action += '/'+button.data('id');
        method = 'PUT';
      }
          
      modal.find('.modal-title').text(title);
      modal.find('.modal-body #supplier').val(content);
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
      formDelete.attr('action', "{{ livepos_asset('api/supplier') }}/"+button.data('id'))
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
        } else {
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

