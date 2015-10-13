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
                    <!-- <a href="#add" data-toggle="modal" data-target="#modal-add-edit" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> {{ ucwords(trans('livepos.product.add')) }}</a> -->
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
                  <table class="table table-hover" id="stocks-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.product.name') }}</th>
                              <th>{{ trans('livepos.brand.name') }}</th>
                              <th>{{ trans('livepos.category.name') }}</th>
                              <th>{{ trans('livepos.stock.min') }}</th>
                              <th>{{ trans('livepos.quantity') }}</th>
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

    <!-- modal delete -->
    <div class="modal fade" id="stock-modal-change">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.stock.change') }}</h4>
          </div>
          <form class="form-horizontal" action="{{ livepos_asset('api/productStock/') }}" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.stock.confirmChange') }} {{ trans('livepos.product.name') }} <strong id="stock-product"></strong> ?</p>
            	<div class="form-group">
            		<label for="quantity" class="control-label col-sm-3">{{ trans('livepos.product.quantity') }}</label>
            		<div class="col-sm-3">
            			<input type="text" autofocus class="form-control input-mask-numeric" name="quantity" id="stock-quantity" placeholder="{{ trans('livepos.product.quantity') }}">
            		</div>
            	</div>
            	<div class="form-group">
            		<label for="description" class="control-label col-sm-3">{{ trans('livepos.stock.changeDescription') }}</label>
            		<div class="col-sm-8">
            			<textarea class="form-control" autofocus name="description" id="stock-description" placeholder="{{ trans('livepos.stock.changeDescription').' ('.trans('livepos.required').')' }}"></textarea>
            		</div>
            	</div>
            </div>
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
              <input type="hidden" name="id" id="stock-id">
              <input type="hidden" name="_method" id="stock-method" value="put">
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
	var stockDataTables = $('#stocks-table').DataTable({
		processing: true,
        serverSide: true,
        ajax: '{!! action('Backend\Stock@anyData') !!}',
        columns: [
            { data: 'name', name: 'products.name' },
            { data: 'brand', name: 'product_brands.brand' },
            { data: 'category', name: 'product_categories.category' },
            { data: 'min_stock', name: 'products.min_stock' },
            { data: 'quantity', name: 'quantity' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
	});

	var stockModal = $('#stock-modal-change');
	var stockForm = stockModal.find('form');
	stockModal.on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget);
		$('#stock-product').text(button.data('name'));
		$('#stock-id').val(button.data('id'));
		$('#stock-quantity').autoNumeric('set', button.data('quantity'));
	}).on('shown.bs.modal', function() {
		stockModal.find('[autofocus]')[0].focus();
	}).on('hide.bs.modal', function() {
		stockForm[0].reset();
	});

	var stockErrorHandling = function(_form, data) {
	  for (x in data) {
	    err = data[x];
	    _form.find('[name='+x+']').after('<label class="error-label control-label" for="inputError"><i class="fa fa-times-circle-o"></i> '+err[0]+'</label>')
	      .parents('.form-group').addClass('has-warning');
	  } 
	  var $alert = _form.find('.modal-body .alert').clone().prependTo(_form.find('.modal-body')).addClass('cloned');
	  $alert.find('.message').text(data.error ? data.error : '{{ trans('livepos.errorHappening') }}');
	  $alert.removeClass('hide');
	}

	var stockSubmitHandling = function(_form, event) {
	  event.preventDefault();
	  _form.find('.form-group').removeClass('has-warning');
	  _form.find('.form-group .error-label').remove();
	  _form.find('.modal-body .alert.cloned').remove();
	  $.post(_form.attr('action')+$('#stock-id').val(), _form.autoNumeric('getString'), function( data ) {
	    if (data.message == 'ok') {
	      stockDataTables.draw(false);
	      _form.parents('.modal').modal('hide');
	    } else {
	      error_handling(_form, data);
	    };
	  }, 'json').error( function(xhr, textStatus, errorThrown) {
	    stockErrorHandling(_form, $.parseJSON(xhr.responseText));
	  });
	  return false;
	};

	stockForm.on('submit', function( event ) {
	  _form = $(this);
	  return stockSubmitHandling(_form, event);
	});

});
</script> 
@endPush