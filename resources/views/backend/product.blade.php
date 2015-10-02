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
                    <a href="#add" data-toggle="modal" data-target="#modal-add-edit" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> {{ ucwords(trans('livepos.product.add')) }}</a>
                  </div>
                  <div class="box-tools .pull-right">
                    <button class="btn bg-maroon btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div> <!--.box-header--> 
                <!-- <div class="box-body bg-gray">
                  <div class="box-title row">
                    <div class="col-sm-6">
                     <h3>TEs</h3> 
                    </div>
                    
                    <hr>
                  </div>
                </div> -->
                <div class="box-footer">
                  <table class="table table-hover" id="products-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.product.name') }}</th>
                              <th>{{ trans('livepos.brand.name') }}</th>
                              <th>{{ trans('livepos.category.name') }}</th>
                              <th>{{ trans('livepos.unit') }}</th>
                              <th>{{ trans('livepos.product.purchase_price') }}</th>
                              <th>{{ trans('livepos.product.selling_price') }}</th>
                              <th style="min-width: 100px;"></th>
                          </tr>
                      </thead>
                  </table>
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
            <h4 class="modal-title text-center">Product</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">{{ trans('livepos.product.name') }}</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="name" name="name" autofocus placeholder="{{ trans('livepos.product.name') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="unit" class="col-sm-3 control-label">{{ trans('livepos.product.smallUnit') }}</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="unit" name="unit" autofocus placeholder="{{ trans('livepos.product.unit') }}">
                </div>
                <div class="col-sm-6">
                  <label>
                    <input type="checkbox" id="multi_unit" name="multi_unit" value="1" data-target="#multi-unit" data-toggle="collapse"> {{ trans('livepos.product.useMultiUnit') }}
                  </label>
                </div>
              </div>
              <div class="collapse" id="multi-unit">
                <div class="well">
                  <div class="box-title">{{ trans('livepos.product.addUnitTitle')}}</div>
                  <hr>
                  <div class="form-group">
                    <div class="col-xs-3">
                      <label for="multi-unit-quantity">{{ trans('livepos.product.addUnit') }}</label>
                    </div>
                    <div class="col-xs-3">
                      <input type="text" class="form-control" id="multi-unit-unit"placeholder="{{ trans('livepos.product.unit') }}">
                    </div>
                    <div class="col-xs-3">
                      <input type="number" min="0" step="any" class="form-control" id="multi-unit-quantity"placeholder="{{ trans('livepos.product.quantityPerSmallUnit') }}">
                    </div>
                    <div class="col-xs-3">
                      <a href="#" class="btn bg-navy" id="multi-unit-add">{{ trans('livepos.add') }}</a>
                    </div>
                  </div>
                  <table id="multi-unit-table" class="table table-hover">
                    <thead>
                        <tr class="bg-navy">
                            <th>{{ trans('livepos.product.unit') }}</th>
                            <th>{{ trans('livepos.product.quantity') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <div class="form-group">
                <label for="purchase_price" class="col-sm-3 control-label">{{ trans('livepos.product.purchasePrice') }}</label>
                <div class="col-sm-4">
                  <input type="number" min="0" step="any" class="form-control" id="purchase_price" name="purchase_price" autofocus placeholder="{{ trans('livepos.product.purchasePrice') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="selling_price" class="col-sm-3 control-label">{{ trans('livepos.product.sellingPrice') }}</label>
                <div class="col-sm-4">
                  <input type="number" min="0" step="any" class="form-control" id="selling_price" name="selling_price" value="0" autofocus placeholder="{{ trans('livepos.product.sellingPrice') }}">
                </div>
                <div class="col-sm-4">
                  <label>
                    <input type="checkbox" id="multi_price" name="multi_price" value="1" data-target="#multi-price" data-toggle="collapse"> {{ trans('livepos.product.useMultiPrice') }}
                  </label>
                </div>
              </div>
              <div class="collapse" id="multi-price">
                <div class="well">
                  <div class="box-title">{{ trans('livepos.product.addPriceTitle')}}</div>
                  <hr>
                  <div class="form-group">
                    <div class="col-xs-3">
                      <label for="multi-price-quantity">{{ trans('livepos.product.addPrice') }}</label>
                    </div>
                    <div class="col-xs-3">
                      <input type="number" min="0" step="any" class="form-control" id="multi-price-quantity"placeholder="{{ trans('livepos.quantity') }}">
                    </div>
                    <div class="col-xs-3">
                      <input type="number" min="0" step="any" class="form-control" id="multi-price-price"placeholder="{{ trans('livepos.product.sellingPricePerSmallUnit') }}">
                    </div>
                    <div class="col-xs-3">
                      <a href="#" class="btn bg-navy" id="multi-price-add">{{ trans('livepos.add') }}</a>
                    </div>
                  </div>
                  <table id="multi-price-table" class="table table-hover">
                    <thead>
                        <tr class="bg-navy">
                            <th>{{ trans('livepos.product.quantity') }}</th>
                            <th>{{ trans('livepos.product.sellingPrice') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <div class="form-group">
                <label for="category_id" class="col-sm-3 control-label">{{ trans('livepos.product.chooseCategory') }}</label>
                <div class="col-sm-6">
                  <select name="category_id" id="category_id" class="form-control" data-placeholder="{{ trans('livepos.product.chooseCategory') }}">
                  @if(isset($categories))
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" >{{ $category->category }}</option>
                  @endforeach
                  @endif  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="brand_id" class="col-sm-3 control-label">{{ trans('livepos.product.chooseBrand') }}</label>
                <div class="col-sm-6">
                  <select name="brand_id" id="brand_id" class="form-control" data-placeholder="{{ trans('livepos.product.chooseBrand') }}">
                  @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" >{{ $brand->brand }}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <hr>
              <div class="form-group input-init-stock">
                <label for="init_stock" class="col-sm-3 control-label">{{ trans('livepos.product.init_stock') }}</label>
                <div class="col-sm-3">
                  <input type="number" min="0" step="any" class="form-control" id="init_stock" name="init_stock" autofocus placeholder="{{ trans('livepos.product.init_stock') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="min_stock" class="col-sm-3 control-label">{{ trans('livepos.product.min_stock') }}</label>
                <div class="col-sm-3">
                  <input type="number" min="0" step="any" class="form-control" id="min_stock" name="min_stock" autofocus placeholder="{{ trans('livepos.product.min_stock') }}">
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label for="active" class="col-sm-3 control-label">{{ trans('livepos.product.active') }}</label>
                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="active" name="active" value="1">
                      {{ trans('livepos.product.active') }}
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="_method" id="method" >
              <input type="hidden" name="_multi_unit_data" id="multi_unit_data" >
              <input type="hidden" name="_multi_price_data" id="multi_price_data" >
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
            <h4 class="modal-title text-center">{{ trans('livepos.product.delete') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.confirmDelete') }} {{ trans('livepos.product.name') }} <span id="product"></span> ?</p>
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
    var regex = /[^\W_]/;
    var dataTables = $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! action('Backend\Product@anyData') !!}',
        columns: [
            { data: 'name', name: 'products.name' },
            { data: 'brand', name: 'product_brands.brand' },
            { data: 'category', name: 'product_categories.category' },
            { data: 'unit', name: 'products.unit' },
            { data: 'purchase_price', name: 'products.purchase_price' },
            { data: 'selling_price', name: 'products.selling_price' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    var multiPriceCollapse = $('#multi-price');
    multiPriceCollapse.on('show.bs.collapse', function(){
    }).on('hidden.bs.collapse', function(){
    }).on('shown.bs.collapse', function(){
      multiPriceCollapse.find('input')[0].focus();
    });

    var multiPriceDataTables = $('#multi-price-table').DataTable({
        paging: false,
        info: false,
        searching: false,
        data: [],
        columns: [
            { data: 'quantity', name: 'quantity' },
            { data: 'selling_price', name: 'products.selling_price' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })

    multiPriceCollapse.find('#multi-price-add').click(function(e){
      e.preventDefault();
      var _new = {
        quantity: multiPriceCollapse.find('#multi-price-quantity').val(),
        selling_price: multiPriceCollapse.find('#multi-price-price').val(),
        action: '<a href="#" class="multi-price-delete">Delete</a>'
      };
      var _data = window._multi_price_data;
      if (!_data) _data = [];
      if ( _new.quantity == 1 || ! regex.test(_new.selling_price) || ! regex.test(_new.quantity)) return;
      for( x in _data) {
        if (_data[x].quantity == _new.quantity) return;
      }
      multiPriceDataTables.row.add(_new).draw(false);
      _data.push(_new);
      window._multi_price_data = _data;
      multiPriceCollapse.find('input').val('');
      multiPriceCollapse.find('input')[0].focus();
    });

    $('#multi-price-table tbody').on('click', '.multi-price-delete', function(){
      var row = multiPriceDataTables.row($(this).parents('tr'));
      row.remove().draw(false);
      var _data = window._multi_price_data;
      for( x in _data) {
        if (x == row[0][0]) _data.splice(x, 1);
      }
      window._multi_price_data = _data;
    })

    $('#selling_price').change(function(){
      $('#multi_price').attr('disabled', false);
      if (!regex.test($(this).val())) {
        multiPriceDataTables.clear().draw(false);
        window._multi_price_data = [];
        multiPriceCollapse.collapse('hide');
        $('#multi_price').attr('checked', false).attr('disabled', true);
      } 
    });

    // multi unit
    $('#unit').change(function(){
      $('#multi_unit').attr('disabled', false);
      title = '{{ trans('livepos.product.quantity') }}' + ' ('+ $('#unit').val() +')';
      $('#multi-unit-table thead tr th:eq(1)').text(title);
      if (! regex.test($(this).val())) {
        multiUnitDataTables.clear().draw(false);
        window._multi_unit_data = [];
        multiUnitCollapse.collapse('hide');
        $('#multi_unit').attr('checked', false).attr('disabled', true);
      } 
    });

    var multiUnitCollapse = $('#multi-unit');
    multiUnitCollapse.on('show.bs.collapse', function(){
      title = '{{ trans('livepos.product.quantity') }}' + ' ('+ $('#unit').val() +')';
      $('#multi-unit-table thead tr th:eq(1)').text(title);
    }).on('hidden.bs.collapse', function(){
    }).on('shown.bs.collapse', function(){
      multiUnitCollapse.find('input')[0].focus();
    });

    var multiUnitDataTables = $('#multi-unit-table').DataTable({
        paging: false,
        info: false,
        searching: false,
        data: [],
        columns: [
            { data: 'unit', name: 'products.unit' },
            { data: 'quantity', name: 'quantity' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })

    multiUnitCollapse.find('#multi-unit-add').click(function(e){
      e.preventDefault();
      var _new = {
        unit: multiUnitCollapse.find('#multi-unit-unit').val(),
        quantity: multiUnitCollapse.find('#multi-unit-quantity').val(),
        action: '<a href="#" class="multi-unit-delete">Delete</a>'
      };
      var _data = window._multi_unit_data;
      if (!_data) _data = [];
      if (_new.unit == $('#unit').val() || ! regex.test(_new.unit) || ! regex.test(_new.quantity)) return;
      for( x in _data) {
        if (_data[x].unit == _new.unit) return;
      }
      multiUnitDataTables.row.add(_new).draw(false);
      _data.push(_new);
      window._multi_unit_data = _data;
      multiUnitCollapse.find('input').val('');
      multiUnitCollapse.find('input')[0].focus();
    });

    $('#multi-unit-table tbody').on('click', '.multi-unit-delete', function(){
      var row = multiUnitDataTables.row($(this).parents('tr'));
      row.remove().draw(false);
      var _data = window._multi_unit_data;
      for( x in _data) {
        if (x == row[0][0]) _data.splice(x, 1);
      }
      window._multi_unit_data = _data;
    })
    
    var modal = $('#modal-add-edit'), modalDelete = $('#modal-delete'), form = modal.find('form'), formDelete = modalDelete.find('form');
    modal.on('show.bs.modal', function( event ) {
      multiPriceDataTables.clear().draw(false);
      multiUnitDataTables.clear().draw(false);
      window._multi_unit_data = [];
      window._multi_price_data = [];
      var button = $(event.relatedTarget), 
          title = '{{ trans('livepos.product.add') }}',
          content = {!! json_encode($product) !!}, 
          action = "{{ livepos_asset('api/product') }}";
          method = 'POST';

      
      if (button.data('action') == 'edit') {
        title = '{{ trans('livepos.product.edit') }}';
        content.name = button.data('name'),
        content.category_id = button.data('category'),
        content.brand_id = button.data('brand'),
        content.min_stock = button.data('min_stock'),
        content.purchase_price = button.data('purchase_price'),
        content.selling_price = button.data('selling_price'),
        content.active = button.data('active'),
        content.unit = button.data('unit'),
        content.multi_unit = button.data('multi_unit');
        content.multi_price = button.data('multi_price');
        action += '/'+button.data('id');
        method = 'PUT';
        $('.input-init-stock').addClass('hide');

        if (content.multi_unit != '0') {
          multiUnitCollapse.collapse('show');
          $('#multi_unit').prop('checked', true);
          var _multi_unit_datas = content.multi_unit;
          var _multi_unit_data = [];
          for(x in _multi_unit_datas) {
            _multi_unit_data[x] = _multi_unit_datas[x]; 
            _multi_unit_data[x].action = '<a href="#" class="multi-unit-delete">Delete</a>';
          }
          window._multi_unit_data = _multi_unit_data;
          multiUnitDataTables.rows.add(_multi_unit_data).draw(false);
        }

        if (content.multi_price != '0') {
          multiPriceCollapse.collapse('show');
          $('#multi_price').prop('checked', true);
          var _multi_price_datas = content.multi_price;
          var _multi_unit_data = [];
          for(x in _multi_price_datas) {
            _multi_price_data[x] = _multi_price_datas[x]; 
            _multi_price_data[x].action = '<a href="#" class="multi-price-delete">Delete</a>';
          }
          window._multi_price_data = _multi_price_data;
          multiPriceDataTables.rows.add(_multi_price_data).draw(false);
        }
      }
          
      modal.find('.modal-title').text(title);
      modal.find('.modal-body #product').val(content);
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
          if (c.attr('value') == cx) c.prop('checked', true);
        } else {
          c.val(cx)
        }
      }

    }).on('shown.bs.modal', function() {
      modal.find('.modal-body [autofocus]')[0].focus();
    }).on('hide.bs.modal', function() {
      multiPriceCollapse.collapse('hide');
      multiUnitCollapse.collapse('hide');
      $('#multi_price').prop('checked', false);
      $('#multi_unit').prop('checked', false);
      multiPriceCollapse.find('input').val('');
      multiUnitCollapse.find('input').val('');
      $('.input-init-stock').removeClass('hide');

    });
    
    modalDelete.on('show.bs.modal', function(event){
      var button = $(event.relatedTarget);
      formDelete.attr('action', "{{ livepos_asset('api/product') }}/"+button.data('id'))
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
      _form.find('#multi_unit_data').val(JSON.stringify(window._multi_unit_data));
      _form.find('#multi_price_data').val(JSON.stringify(window._multi_price_data));
      $.post(_form.attr('action'), _form.serialize(), function( data ) {
        if (data.message == 'ok') {
          dataTables.draw(false);
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

