@extends(livepos_getThemeView()) 

@section('sideMenubar')
            <li>
              <a href="{{ livepos_asset('dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="active">
              <a href="{{ livepos_asset('dashboard/product') }}">
                <i class="fa fa-dropbox"></i> <span>Products</span>
                <i class="fa fa-lg fa-angle-right pull-right text-green"></i>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
@endsection