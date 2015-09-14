@extends(livepos_getThemeView()) 

@section('sideMenubar')
            <li>
              <a href="{{ livepos_asset('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="treeview">
              <a href="{{ livepos_asset('dashboard/product') }}">
                <i class="fa fa-dropbox"></i>
                <span>Products</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ livepos_asset('dashboard/product') }}"><i class="fa fa-flask"></i> Products</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/category') }}"><i class="fa fa-tags"></i> Categories</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/brand') }}"><i class="fa fa-houzz"></i> Brands</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/stock') }}"><i class="fa fa-commenting-o"></i> Stock</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/supplier') }}"><i class="fa fa-truck"></i> Supplier</a></li>
              </ul>
            </li>
            <li>
              <a href="{{ livepos_asset('dashboard/customer') }}">
                <i class="fa fa-users"></i> <span>Customer</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="{{ livepos_asset('dashboard/purchasing') }}">
                <i class="fa fa-paper-plane"></i> <span>Purchasing</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
@endsection

<?php if (!isset($thePage)) $thePage = ''; ?>  

@section('pageTitle', trans('livepos.'.$thePage.'.title'))
@section('subTitle', trans('livepos.'.$thePage.'.tagline'))