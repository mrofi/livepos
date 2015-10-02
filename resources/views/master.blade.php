@extends(livepos_getThemeView()) 

@section('sideMenubar')
            <li class="{{ livepos_activeMenu('dashboard', $thePage) }}">
              <a href="{{ livepos_asset('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="{{ livepos_activeMenu('product', $thePage) }}"><a href="{{ livepos_asset('dashboard/product') }}"><i class="fa fa-dropbox"></i> <span>Products</span></a></li>
            <li class="{{ livepos_activeMenu('category', $thePage) }}"><a href="{{ livepos_asset('dashboard/product/category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
            <li class="{{ livepos_activeMenu('brand', $thePage) }}"><a href="{{ livepos_asset('dashboard/product/brand') }}"><i class="fa fa-tags"></i> <span>Brands</span></a></li>
            <li class="{{ livepos_activeMenu('stock', $thePage) }}"><a href="{{ livepos_asset('dashboard/product/stock') }}"><i class="fa fa-flask"></i> <span>Stocks</span></a></li>
            <li class="{{ livepos_activeMenu('supplier', $thePage) }}"><a href="{{ livepos_asset('dashboard/product/supplier') }}"><i class="fa fa-truck"></i> <span>Suppliers</span></a></li>
            <li class="{{ livepos_activeMenu('customer', $thePage) }}">
              <a href="{{ livepos_asset('dashboard/customer') }}">
                <i class="fa fa-users"></i> <span>Customers</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="{{ livepos_activeMenu('purchasing', $thePage) }}">
              <a href="{{ livepos_asset('dashboard/purchasing') }}">
                <i class="fa fa-paper-plane"></i> <span>Purchasing</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="{{ livepos_activeMenu('selling', $thePage) }}">
              <a href="{{ livepos_asset('dashboard/selling') }}">
                <i class="fa fa-shopping-cart"></i> <span>Selling</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="{{ livepos_activeMenu('multilevel', $thePage) }}">
              <a href="{{ livepos_asset('dashboard/multilevel') }}">
                <i class="fa fa-star"></i> <span>Multilevel</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="{{ livepos_asset('auth/logout') }}">
                <i class="fa fa-power-off text-red"></i> <span>Logout</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
@endsection

<?php if (!isset($thePage)) $thePage = ''; ?>  

@section('pageTitle', trans('livepos.'.$thePage.'.title'))
@section('subTitle', trans('livepos.'.$thePage.'.tagline'))