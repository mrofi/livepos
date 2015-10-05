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
                    <a href="#add" data-toggle="modal" data-target="#modal-add-edit" data-action="add" class="btn bg-maroon"><i class="fa fa-plus"></i> {{ ucwords(trans('livepos.customer.add')) }}</a>
                  </div>
                  <div class="box-tools .pull-right">
                    <button class="btn bg-maroon btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div> <!--.box-header--> 
                <!--<div class="box-body bg-blue">-->
                <!--  <div class="box-title row">-->
                <!--    <div class="col-sm-6">-->
                <!--      <h3>TEs</h3>  -->
                <!--    </div>-->
                    
                <!--    <hr>-->
                <!--  </div>-->
                <!--</div>-->
                <div class="box-footer">
                  <table class="table table-hover" id="customer-table">
                      <thead>
                          <tr class="bg-navy">
                              <th>{{ trans('livepos.customer.name') }}</th>
                              <th>{{ trans('livepos.customer.identityType') }}</th>
                              <th>{{ trans('livepos.customer.identityNumber') }}</th>
                              <th>{{ trans('livepos.customer.address') }}</th>
                              <th>{{ trans('livepos.customer.contact1') }}</th>
                              <th>{{ trans('livepos.customer.contact2') }}</th>
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
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">customer</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <div class="form-group">
                <label for="customer" class="col-sm-3 control-label">{{ trans('livepos.customer.name') }}</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="customer" name="customer" autofocus placeholder="{{ trans('livepos.customer.name') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="identity" class="col-sm-3 control-label">{{ trans('livepos.customer.identity') }}</label>
                <div class="col-sm-3">
                  <select name="id_type" id="identity" class="form-control" data-placeholder="{{ trans('livepos.customer.identityType') }}">
                    <option value="ktp">KTP</option>
                    <option value="sim">SIM</option>
                    <option value="kartu-pelajar">Kartu Pelajar</option>
                    <option value="etc">Lain-lain</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="id_no" name="id_no" autofocus placeholder="{{ trans('livepos.customer.identityNumber') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="address" name="address" class=col-sm-3 "control-label">{{ trans('livepos.customer.address') }}</label>
                <div class="col-sm-9">
                  <textarea name="address" id="address" class="form-control" placeholder="{{ trans('livepos.customer.address') }}"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="contact1" name="contact1" class="col-sm-3 control-label">{{ trans('livepos.customer.contact1') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="contact1" name="contact1" autofocus placeholder="{{ trans('livepos.customer.contact1') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="contact2" name="contact2" class="col-sm-3 control-label">{{ trans('livepos.customer.contact2') }}</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="contact2" name="contact2" autofocus placeholder="{{ trans('livepos.customer.contact2') }}">
                </div>
              </div>
            </div>
            <div class="modal-footer bg-navy">
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
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.customer.delete') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.confirmDelete') }} {{ trans('livepos.customer.name') }} <span id="customer"></span> ?</p>
            </div>
            <div class="modal-footer bg-navy">
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
    var dataTables = $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! action('Backend\Customer@anyData') !!}',
        columns: [
            { data: 'customer', name: 'customer' },
            { data: 'id_type', name: 'id_type' },
            { data: 'id_no', name: 'id_no' },
            { data: 'address', name: 'address' },
            { data: 'contact1', name: 'contact1' },
            { data: 'contact2', name: 'contact2' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    
    var modal = $('#modal-add-edit'), modalDelete = $('#modal-delete'), form = modal.find('form'), formDelete = modalDelete.find('form');
    modal.on('show.bs.modal', function( event ) {
      var button = $(event.relatedTarget), 
          title = '{{ trans('livepos.customer.add') }}',
          content = {customer: '', id_type: '', id_no: '', address: '', contact1: '', contact2: ''},
          action = "{{ livepos_asset('api/customer') }}";
          method = 'POST';
      
      if (button.data('action') == 'edit') {
        title = '{{ trans('livepos.customer.edit') }}';
        content.customer = button.data('customer');
        content.id_type = button.data('id_type');
        content.id_no = button.data('id_no');
        content.address = button.data('address');
        content.contact1 = button.data('contact1');
        content.contact2 = button.data('contact2');
        action += '/'+button.data('id');
        method = 'PUT';
      }
          
      modal.find('.modal-title').text(title);
      modal.find('.modal-body #customer').val(content);
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
      formDelete.attr('action', "{{ livepos_asset('api/customer') }}/"+button.data('id'))
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

