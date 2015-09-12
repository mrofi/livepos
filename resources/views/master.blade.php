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
                <li><a href="{{ livepos_asset('dashboard/product') }}"><i class="fa fa-circle-o"></i> Products</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/category') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/brand') }}"><i class="fa fa-circle-o"></i> Brands</a></li>
                <li><a href="{{ livepos_asset('dashboard/product/stock') }}"><i class="fa fa-circle-o"></i> Stock</a></li>
              </ul>
            </li>
@endsection

<?php if (!isset($thePage)) $thePage = ''; ?>  

@section('pageTitle', trans('livepos.'.$thePage.'.title'))
@section('subTitle', trans('livepos.'.$thePage.'.tagline'))