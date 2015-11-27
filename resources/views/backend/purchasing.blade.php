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
                      {{ livepos_toCurrency($detail->total_amount) }}
                      </h1>
                    </div>
                  </div>
                </div>
                <div class="space">&nbsp;</div>
                <div class="box-body bg-gray">
                  <form id="form-add-product" action="{{ livepos_asset('api/purchasingDetail') }}" method="post">
                    <input type="hidden" name="purchasing_id" value="{{ $detail->id }}">
                    <div class="row">
                      <div class="col-md-4">  
                        <div class="control-label">
                          <label for="" class="control-label">{{ trans('livepos.purchasing.chooseProduct') }}</label> 
                          <div class="pull-right">
                            <a href="#modal-product-add-edit" data-toggle="modal" class="btn-link">{{ trans('livepos.product.new') }}</a>
                          </div>
                        </div>
                        <input autocomplete="off" type="text" id="input-product" class="input-product input-lg form-control text-black" placeholder="{{ trans('livepos.purchasing.chooseProduct') }}">
                        <input type="hidden" id="input-product_id" class="input-product_id" name="product_id" value="">
                        <input type="hidden" id="input-product_name" class="input-product_name" name="product_name" value="">
                        <input type="hidden" id="input-converter" class="input-converter" name="converter" value="">
                        <input type="hidden" id="input-unit" class="input-unit" name="unit" value="">
                        <input type="hidden" id="input-purchase_price" class="input-purchase_price" name="purchase_price" value="">
                      </div>
                      <div class="col-md-4 row">  
                        <div class="col-xs-7">  
                          <label class="control-label">{{ trans('livepos.product.purchase_price') }}</label>
                          <input type="text" id="input-price" name="price" class="input-mask-currency input-price input-lg form-control text-black" placeholder="{{ trans('livepos.price') }}">
                        </div>
                        <div class="col-xs-5">
                          <label class="control-label">{{ trans('livepos.quantity') }}</label>
                          <input type="number" min="0" step="any" id="input-quantity" name="quantity" class="input-lg form-control text-black" placeholder="Qty">
                        </div>
                      </div>
                      <div class="col-md-4 row">  
                        <div class="col-xs-7">
                          <label class="control-label">{{ trans('livepos.discount') }}</label>
                          <input type="text" id="input-discount" name="discount" class="input-mask-currency input-lg form-control text-black" placeholder="{{ trans('livepos.discount') }}">
                        </div>
                        <div class="col-xs-5 text-right">  
                          <label class="control-label">{{ trans('livepos.add') }}</label>
                          <button id="button-add" type="submit" class="input-lg btn bg-navy btn-block"><i class="fa fa-plus"></i> {{ trans('livepos.purchasing.addProduct') }}</button>
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
                              <th style="min-width: 100px;"></th>
                          </tr>
                      </thead>
                  </table>
                  <div class="well">
                    <div class="row">
                      <div class="col-sm-6">
                        <form action="#" id="form-add-discount" class="form-inline">
                          <input type="hidden" name="_method" value="put">
                          <div class="input-group input-group-lg">
                            <input type="text" class="input-mask-currency form-control" name="discount" placeholder="{{ trans('livepos.addDiscount') }}">
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
                              <td class="subtotal-amount" id="subtotal-amount-1">{{ livepos_toCurrency($detail->amount) }}</td>
                            </tr>
                            <tr>
                              <th>{{ trans('livepos.discount') }} (<a href="#" id="delete-discount-amount" class="btn btn-link"><i class="fa fa-times"></i> {{ trans('livepos.clear') }}</a>):</th>
                              <td class="discount-amount">{{ livepos_toCurrency($detail->discount) }}</td>
                            </tr>
                            <tr>
                              <th>{{ trans('livepos.total') }}:</th>
                              <td><h3 class="total-amount" id="total-amount-2">{{ livepos_toCurrency($detail->total_amount) }}</h3></td>
                            </tr>
                            <tr>
                              <td>
                                <a href="#" data-target="#modal-delete" data-toggle="modal" data-id="{{ $detail->id }}" data-reload="true" class="btn btn-lg btn-block bg-navy"><i class="fa fa-trash-o"></i> {{ trans('livepos.discard') }}</a>
                              </td>
                              <td>
                                <a href="#" data-target="#modal-purchasing-process" data-toggle="modal" class="btn btn-lg btn-block bg-yellow-v2"><i class="fa fa-check"></i>  {{ trans('livepos.process') }}</a>
                              </td>
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
                              <th style="min-width: 100px;"></th>
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
          <div class="modal-header bg-yellow-v2">
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
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
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
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
              <input type="hidden" name="_method" id="method" value="delete">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.yes') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal process -->
    <div class="modal fade" id="modal-purchasing-unlock">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.purchasing.unlock') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.purchasing.confirmUnlock') }} <span id="purchasing"></span>?</p>
            </div>
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
              <input type="hidden" name="_method" id="purchasing-method" value="post">
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
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.purchasing.detail') }}</h4>
          </div>
          <form id="form-edit-product" class="inline-form" action="{{ livepos_asset('api/purchasingDetail') }}" method="post">
            <input type="hidden" name="purchasing_id" value="{{ $detail->id }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">  
                  <label class="control-label">{{ trans('livepos.purchasing.chooseProduct') }}</label>
                  <input autocomplete="off" type="text" id="input-product-modal" class="input-product input-lg form-control text-black" placeholder="{{ trans('livepos.purchasing.chooseProduct') }}">
                  <input type="hidden" id="input-product_id-modal" class="input-product_id" name="product_id" value="">
                  <input type="hidden" id="input-product_name-modal" class="input-product_name" name="product_name" value="">
                  <input type="hidden" id="input-converter-modal" class="input-converter" name="converter" value="">
                  <input type="hidden" id="input-unit-modal" class="input-unit" name="unit" value="">
                  <input type="hidden" id="input-purchase_price-modal" class="input-purchase_price" name="purchase_price" value="">
                </div>
                <div class="col-md-4 row">  
                  <div class="col-xs-7">  
                    <label class="control-label">{{ trans('livepos.product.purchase_price') }}</label>
                    <input type="text" id="input-price-modal" name="price" class="input-mask-currency input-price input-lg form-control text-black" placeholder="{{ trans('livepos.price') }}">
                  </div>
                  <div class="col-xs-5">
                    <label class="control-label">{{ trans('livepos.quantity') }}</label>
                    <input type="number" min="0" step="any" id="input-quantity-modal" name="quantity" class="input-lg form-control text-black" placeholder="Qty">
                  </div>
                </div>
                <div class="col-md-4 row">  
                  <div class="col-xs-5">
                    <label class="control-label">{{ trans('livepos.discount') }}</label>
                    <input type="text" id="input-discount-modal" name="discount" class="input-mask-currency input-lg form-control text-black" placeholder="{{ trans('livepos.discount') }}">
                  </div>
                  <div class="col-xs-7 text-right">  
                    <label class="control-label">{{ trans('livepos.amount') }}</label>
                    <input type="text" readonly="true" id="input-amount-modal" class="input-mask-currency input-lg form-control text-black" placeholder="{{ trans('livepos.amount') }}">
                  </div>
                </div>
              </div>
              
              <div class="row">&nbsp;</div>
            </div>
            <div class="modal-footer bg-navy">
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
          <div class="modal-header bg-yellow-v2">
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
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.yes') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- modal process -->
    <div class="modal fade" id="modal-purchasing-process">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-yellow-v2">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">{{ trans('livepos.purchasing.process') }}</h4>
          </div>
          <form class="form-horizontal" method="POST">
            <div class="modal-body">
              <div class="alert alert-warning alert-dismissable hide">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span class="message"></span>
              </div>
              <p>{{ trans('livepos.purchasing.confirmProcess') }} <span id="purchasing"></span>?</p>
            </div>
            <div class="modal-footer bg-navy">
              <input type="hidden" class="input-mask-numeric" name="input-mask" value="0">
              <input type="hidden" name="_method" id="purchasing-method" value="post">
              <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('livepos.cancel') }}</button>
              <button type="submit" class="btn btn-primary">{{ trans('livepos.yes') }}</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- produt add -->
    <!-- modal add /edit -->
    <div class="modal fade" id="modal-product-add-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-yellow-v2">
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
                <label for="barcode" class="col-sm-3 control-label">{{ trans('livepos.product.barcode') }}</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="barcode" name="barcode" autofocus placeholder="{{ trans('livepos.product.barcode') }}">
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
                      <input type="text" class="form-control" id="multi-unit-unit" placeholder="{{ trans('livepos.product.unit') }}">
                    </div>
                    <div class="col-xs-3">
                      <input type="number" min="0" step="any" class="form-control" id="multi-unit-quantity" placeholder="{{ trans('livepos.product.quantityPerSmallUnit') }}">
                    </div>
                    <div class="col-xs-3">
                      <input type="text" class="form-control" id="multi-unit-barcode" placeholder="{{ trans('livepos.product.barcode') }}">
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
                            <th>{{ trans('livepos.product.barcode') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <div class="form-group">
                <label for="purchase_price" class="col-sm-3 control-label">{{ trans('livepos.product.purchasePrice') }}</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control input-mask-currency" id="purchase_price" name="purchase_price" autofocus placeholder="{{ trans('livepos.product.purchasePrice') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="selling_price" class="col-sm-3 control-label">{{ trans('livepos.product.sellingPrice') }}</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control input-mask-currency" id="selling_price" name="selling_price" value="0" autofocus placeholder="{{ trans('livepos.product.sellingPrice') }}">
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
                      <input type="text" class="input-mask-currency form-control" id="multi-price-price"placeholder="{{ trans('livepos.product.sellingPricePerSmallUnit') }}">
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
                <div class="col-sm-5">
                  <select name="category_id" id="category_id" class="form-control" data-placeholder="{{ trans('livepos.product.chooseCategory') }}">
                  @if(isset($categories))
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" >{{ $category->category }}</option>
                  @endforeach
                  @endif  
                  </select>
                </div>
                <div class="col-sm-4">
                  <a href="#add-category" class="btn btn-link" data-toggle="collapse">{{ trans('livepos.category.add') }}</a>
                </div>
              </div>
              <div class="collapse" id="add-category">
                <div class="well">
                  <div class="form-group">
                    <label for="add-category-input" class="control-label col-xs-3">{{ trans('livepos.category.new') }}</label>
                    <div class="col-xs-6">
                      <input type="text" id="add-category-input" class="form-control">
                    </div>
                    <div class="col-xs-3">
                      <a class="btn btn-block bg-navy" id="add-category-submit">{{ trans('livepos.add') }}</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="brand_id" class="col-sm-3 control-label">{{ trans('livepos.product.chooseBrand') }}</label>
                <div class="col-sm-5">
                  <select name="brand_id" id="brand_id" class="form-control" data-placeholder="{{ trans('livepos.product.chooseBrand') }}">
                  @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" >{{ $brand->brand }}</option>
                  @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <a href="#add-brand" class="btn btn-link" data-toggle="collapse">{{ trans('livepos.brand.add') }}</a>
                </div>
              </div>
              <div class="collapse" id="add-brand">
                <div class="well">
                  <div class="form-group">
                    <label for="add-brand-input" class="control-label col-xs-3">{{ trans('livepos.brand.new') }}</label>
                    <div class="col-xs-6">
                      <input type="text" id="add-brand-input" class="form-control">
                    </div>
                    <div class="col-xs-3">
                      <a class="btn btn-block bg-navy" id="add-brand-submit">{{ trans('livepos.add') }}</a>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="form-group input-init-stock">
                <label for="init_stock" class="col-sm-3 control-label">{{ trans('livepos.product.init_stock') }}</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control input-mask-numeric" id="init_stock" name="init_stock" autofocus placeholder="{{ trans('livepos.product.init_stock') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="min_stock" class="col-sm-3 control-label">{{ trans('livepos.product.min_stock') }}</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control input-mask-numeric" id="min_stock" name="min_stock" autofocus placeholder="{{ trans('livepos.product.min_stock') }}">
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
            <div class="modal-footer bg-navy">
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
            { data: 'price', name: 'price' },
            { data: 'quantity', name: 'purchasing_details.quantity' },
            { data: 'discount', name: 'purchasing_details.discount' },
            { data: 'amount', name: 'purchasing_details.amount' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    var products = {};
    var productLabels = [];
    var inputProduct = $('.input-product');
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
        form = $(this)[0].$element.parents('form');
        form.find('.input-product_id').val( products[ item ].id );
        form.find('.input-converter').val( products[ item ].converter );
        form.find('.input-unit').val( products[ item ].unit );
        form.find('.input-purchase_price').val( products[ item ].purchase_price );
        form.find('.input-product_name').val( item );
        price = products[ item ].purchase_price * products[ item ].converter;
        form.find('.input-price').autoNumeric('set', price )[0].focus();
        return item;
      }

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
        } else if(c.is('.input-mask-numeric') || c.is('.input-mask-currency')) {
          c.autoNumeric('set', cx);
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
      $.post(_form.attr('action'), _form.autoNumeric('getString'), function( data ) {
        if (data.message == 'ok') {
          dataTables.draw(false);
          _form.parents('.modal').modal('hide');
          if (data.created) {
             location.replace('{{ livepos_asset("dashboard/purchasing") }}' + '/'+data.created.id+'/detail');
          }
          @if(isset($detail))
          if (data.updated) {
             location.reload();
          }
          if (data.deleted) {
            location.href='{{ livepos_asset("dashboard/purchasing") }}';
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
    $('#form-add-product').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.post(form.attr('action'), form.autoNumeric('getString'), function(data) {
        if (data.message == 'ok') {
          dataTables.draw(false);
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
      form.find('#input-product-modal')[0].focus();
      form.attr('action', '{{ livepos_asset('api/purchasingDetail') }}'+'/'+button.data('id'));
      $('#input-product_id-modal').val( button.data('product_id') );
      $('#input-converter-modal').val( button.data('converter') );
      $('#input-unit-modal').val( button.data('unit') );
      $('#input-purchase_price-modal').val( button.data('purchase_price') );
      $('#input-product_name-modal').val( button.data('product_name') );
      $('#input-product-modal').val( button.data('product_name') );
      $('#input-price-modal').autoNumeric('set', button.data('purchase_price') * button.data('converter'));
      $('#input-quantity-modal').val(button.data('quantity'));
      $('#input-discount-modal').autoNumeric('set', button.data('discount'));
      $('#input-amount-modal').autoNumeric('set', button.data('amount'));
    });

    $('#form-edit-product').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.post(form.attr('action'), form.autoNumeric('getString'), function(data) {
        if (data.message == 'ok') {
          dataTables.draw(false);
          form[0].reset();
          modalDetail.modal('hide');
        }
      }, 'json')
    });

    var countAmountModal = function(){
      var purchase_price = $('#input-price-modal').autoNumeric('get');
      var discount = $('#input-discount-modal').autoNumeric('get');
      var quantity = $('#input-quantity-modal').val();
      var amount = purchase_price * quantity - discount;
      $('#input-amount-modal').autoNumeric('set', amount);
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
          dataTables.draw(false);
          form[0].reset();
          modalDetailDelete.modal('hide');
        }
      }, 'json')
    })

    dataTables.on('draw.dt', function() {
      $.get('{{ livepos_asset("api/purchasing/$detail->id") }}', {}, function(data) {
        if (data.id) {
          $('.subtotal-amount').text(data.amount.toString().toRp());
          $('.discount-amount').text(data.discount.toString().toRp());
          $('.total-amount').text(data.total_amount.toString().toRp());
        }
      })
    })

    $('#form-add-discount').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.post('{{ livepos_asset("api/purchasing/".$detail->id) }}', form.autoNumeric('getString'), function(data) {
        if (data.message == 'ok') {
          dataTables.draw(false);
          form[0].reset();
          $('#input-product')[0].focus();
        }
      })
    })

    $('#delete-discount-amount').click(function(e) {
      e.preventDefault();
      $.post('{{ livepos_asset("api/purchasing/".$detail->id) }}', {_method: 'put', discount: 0}, function(data) {
        if (data.message == 'ok') {
          dataTables.draw(false);
          $('#input-product')[0].focus();
        }
      })
    })

    // product add 
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

    multiPriceCollapse.find(':input').on('keydown, keypress', function(e) {
      if (e.which == '13') {
        e.preventDefault();
        multiPriceCollapse.find('#multi-price-add').click();
        return false;
      }
      return true;
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
      _new.selling_price = multiPriceCollapse.find('#multi-price-price').autoNumeric('get');

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
      if (!regex.test($(this).autoNumeric('get'))) {
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
            { data: 'barcode', name: 'barcode' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })

    multiUnitCollapse.find(':input').on('keydown, keypress', function(e) {
      if (e.which == '13') {
        e.preventDefault();
        multiUnitCollapse.find('#multi-unit-add').click();
        return false;
      }
      return true;
    })
    multiUnitCollapse.find('#multi-unit-add').click(function(e){
      e.preventDefault();
      var _new = {
        unit: multiUnitCollapse.find('#multi-unit-unit').val(),
        quantity: multiUnitCollapse.find('#multi-unit-quantity').val(),
        barcode: multiUnitCollapse.find('#multi-unit-barcode').val(),
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
    
    var addCategoryCollapse = $('#add-category');
    addCategoryCollapse.on('shown.bs.collapse', function() {
      $('#category_id').prop('disabled', true);
      $('#add-category-input')[0].focus();
    }).on('hide.bs.collapse', function() {
      $('#category_id').prop('disabled', false).click();
    });
    $('#add-category-submit').click(function(e) {
      e.preventDefault();
      $.post('{{ livepos_asset("api/productCategory") }}', {category: $('#add-category-input').val() }, function( data ) {
        if (data.message == 'ok') {
          $('#category_id').append('<option value="'+ data.created.id+'">'+data.created.category+'</option>')
            .find('[value='+data.created.id+']').prop('selected', true)
            .end().select2();
        }
      }, 'json');
      $('#add-category-input').val('');
      addCategoryCollapse.collapse('hide');
    })
    $('#add-category-input').on('keydown, keypress', function(e) {
      if (e.which == '13') {
        e.preventDefault();
        $('#add-category-submit').click();
        return false;
      }
      return true;
    })

    var addBrandCollapse = $('#add-brand');
    addBrandCollapse.on('shown.bs.collapse', function() {
      $('#brand_id').prop('disabled', true);
      $('#add-brand-input')[0].focus();
    }).on('hide.bs.collapse', function() {
      $('#brand_id').prop('disabled', false).click();
    });
    $('#add-brand-submit').click(function(e) {
      e.preventDefault();
      $.post('{{ livepos_asset("api/productBrand") }}', {brand: $('#add-brand-input').val() }, function( data ) {
        if (data.message == 'ok') {
          $('#brand_id').append('<option value="'+ data.created.id+'">'+data.created.brand+'</option>')
            .find('[value='+data.created.id+']').prop('selected', true)
            .end().select2();
        }
      }, 'json');
      $('#add-brand-input').val('');
      addBrandCollapse.collapse('hide');
    })
    $('#add-brand-input').on('keydown, keypress', function(e) {
      if (e.which == '13') {
        e.preventDefault();
        $('#add-brand-submit').click();
        return false;
      }
      return true;
    })

    var regex = /[^\W_]/;
    var productModal = $('#modal-product-add-edit'), productForm = productModal.find('form');
    productModal.on('show.bs.modal', function( event ) {
      multiPriceDataTables.clear().draw(false);
      multiUnitDataTables.clear().draw(false);
      productForm[0].reset();
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
        content.barcode = button.data('barcode'),
        content.category_id = button.data('category_id'),
        content.brand_id = button.data('brand_id'),
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
      }
          
      productModal.find('.modal-title').text(title);
      productModal.find('.modal-body #product').val(content);
      productModal.find('.modal-footer #method').val(method);
      productForm.attr('action', action)
        .find('.error-label').remove().end()
        .find('.form-group').removeClass('has-warning').end()
        .find('.alert.cloned').remove();
      for (x in content) {
        cx = content[x];
        c = productModal.find('.modal-body #'+x);
        if (c.is('select') && cx) {
          c.find('[value='+cx+']').prop('selected', true).end().select2();
        } else if(c.is('input[type=checkbox]')) {
          if (c.attr('value') == cx) c.prop('checked', true);
        } else if(c.is('.input-mask-numeric') || c.is('.input-mask-currency')) {
          c.autoNumeric('set', cx);
        } else {
          c.val(cx)
        }
      }

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
          var _multi_price_datas = $.extend(true, {}, content.multi_price);
          var _multi_price_data = [];
          for(x in _multi_price_datas) {
            _multi_price_data[x] = _multi_price_datas[x]; 
            _multi_price_data[x].action = '<a href="#" class="multi-price-delete">Delete</a>';
            _multi_price_data[x].selling_price = _multi_price_data[x].selling_price.toString().toRp();
          }
          window._multi_price_data = content.multi_price;
          console.log(window._multi_price_data);
          multiPriceDataTables.rows.add(_multi_price_data).draw(false);
        }

    }).on('shown.bs.modal', function() {
      productModal.find('.modal-body [autofocus]')[0].focus();
      productModal.find('select').select2();
    }).on('hide.bs.modal', function() {
      multiPriceCollapse.collapse('hide');
      multiUnitCollapse.collapse('hide');
      addCategoryCollapse.collapse('hide');
      addBrandCollapse.collapse('hide');
      $('#multi_price').prop('checked', false);
      $('#multi_unit').prop('checked', false);
      multiPriceCollapse.find('input').val('');
      multiUnitCollapse.find('input').val('');
      $('.input-init-stock').removeClass('hide');
      $('#category_id').find('[value=1]').prop('selected', true).end().select2();
      $('#brand_id').find('[value=1]').prop('selected', true).end().select2();

    });

     var product_error_handling = function(_form, data) {
      for (x in data) {
        err = data[x];
        _form.find('[name='+x+']').after('<label class="error-label control-label" for="inputError"><i class="fa fa-times-circle-o"></i> '+err[0]+'</label>')
          .parents('.form-group').addClass('has-warning');
      } 
      var $alert = _form.find('.modal-body .alert').clone().prependTo(_form.find('.modal-body')).addClass('cloned');
      $alert.find('.message').text(data.error ? data.error : '{{ trans('livepos.errorHappening') }}');
      $alert.removeClass('hide');
    }
    
    var product_submit_handling = function(_form, event) {
      event.preventDefault();
      _form.find('.form-group').removeClass('has-warning');
      _form.find('.form-group .error-label').remove();
      _form.find('.modal-body .alert.cloned').remove();
      _form.find('#multi_unit_data').val(JSON.stringify(window._multi_unit_data));
      _form.find('#multi_price_data').val(JSON.stringify(window._multi_price_data));
      $.post(_form.attr('action'), _form.autoNumeric('getString'), function( data ) {
        if (data.message == 'ok') {
          dataTables.draw(false);
          _form.parents('.modal').modal('hide');
        } else {
          error_handling(_form, data);
        };
      }, 'json').error( function(xhr, textStatus, errorThrown) {
        product_error_handling(_form, $.parseJSON(xhr.responseText));
      });
      return false;
    };
    
    form.on('submit', function( event ) {
      _form = $(this);
      return product_submit_handling(form, event);
    });
    
    productForm.on('submit', function( event ) {
      _form = $(this);
      return product_submit_handling(_form, event);
    });

    var modalProses = $('#modal-purchasing-process'),
        formProcess = modalProses.find('form'),
        urlProcess = '{{ livepos_asset('api/purchasing/lock/'.$detail->id) }}';

        formProcess.on('submit', function(e) {
          e.preventDefault();
          $.post(urlProcess, {}, function(data) {
            if (data.message == 'ok')
            {
              location.href = '{{ livepos_asset('dashboard/purchasing') }}';
            }
          }, 'json').error( function(xhr, textStatus, errorThrown) {
            product_error_handling(formProcess, $.parseJSON(xhr.responseText));
          });
          return false;
        })


  @endif
    var modalUnlock = $('#modal-purchasing-unlock'),
        formUnlock = modalUnlock.find('form'),
        urlUnlock = '{{ livepos_asset('api/purchasing/unlock/') }}';

        modalUnlock.on('shown.bs.modal', function(e) {
          button = $(e.relatedTarget);
          formUnlock.data('id', button.data('id'));
          console.log(formUnlock)
        })

        formUnlock.on('submit', function(e) {
          e.preventDefault();
          $.post(urlUnlock + formUnlock.data('id'), {}, function(data) {
            if (data.message == 'ok')
            {
              location.href = '{{ livepos_asset('dashboard/purchasing') }}';
            }
          }, 'json').error( function(xhr, textStatus, errorThrown) {
            product_error_handling(formUnlock, $.parseJSON(xhr.responseText));
          });
          return false;
        })
});
</script>
@endpush

