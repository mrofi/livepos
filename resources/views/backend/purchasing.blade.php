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
                    <div class="col-sm-4">
                      <div class="box-title">
                        <a href="#add" data-toggle="modal" data-target="#modal-add-edit" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> {{ ucwords(trans('livepos.purchasing.add')) }}</a>
                        @if(isset($detail))
                        <a href="#edit" data-toggle="modal" data-target="#modal-add-edit" data-action="edit" class="btn bg-maroon btn-round"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-round bg-maroon"><i class="fa fa-arrow-left"></i></a>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-8 row">
                      @if(isset($detail))
                      <div class="col-xs-5">
                        <div class="box-title">
                          <i class="fa fa-calendar"></i> {{ $detail->bill_date }}
                        </div>
                      </div>
                      <div class="col-xs-7">
                        <div class="box-title">
                          <i class="fa fa-file-o"></i> {{ $detail->transaction_no }}
                        </div>
                      </div>
                      @endif
                    </div>
                    <div class="col-md-6 row">
                      @if(isset($detail))
                      <div class="col-sm-4 row">
                        
                        <h3>
                          <small>Date </small> {{ $detail->bill_date }}  
                        </h3>
                      </div>
                      <div class="col-sm-8 row">
                        <h3>
                          <small>Purchasing No.</small> {{ $detail->transaction_no }}
                        </h3>
                      </div>
                      @endif
                        
                        
                      <h3>
                      </h3>
                    </div>
                  </div>
                      
                  <div class="box-tools .pull-right">
                    <button class="btn bg-maroon btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div> <!--.box-header--> 
              @if(isset($detail))
                <div class="box-body bg-gray">
                  <div class="box-title row">
                    <div class="col-md-6">
                      
                      {!! $detail->supplier->supplier !!}
                    </div>
                  </div>
                </div>
              @endif
                <div class="box-footer">
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

