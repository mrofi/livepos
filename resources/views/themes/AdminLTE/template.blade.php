@section('top')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
@endsection

@section('head')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle', 'Not Title') | {{ strip_tags(config('livepos.title')) }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=2, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/themes/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/themes/AdminLTE/plugins/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/themes/AdminLTE/plugins/ionicons/2.0.1/css/ionicons.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="/themes/AdminLTE/plugins/datepicker/datepicker3.css">
    <!-- datatables -->
    <link rel="stylesheet" href="/themes/AdminLTE/plugins/datatables/datatables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/themes/AdminLTE/dist/css/skins/skin-yellow-v2.min.css">

    <style>
      .livepos-footer {
        width: 100%;
        margin-left: 0;
        position: fixed;
        bottom: 0;
      }
      .btn-round {
        border-radius: 50%;
      }

      .livepos-full {
        width: 90%;
      }
    </style>
    
    <!--pace-->
    <script src="/themes/AdminLTE/plugins/pace/pace.js"></script>
    <link href="/themes/AdminLTE/plugins/pace/themes/pace-theme-minimal.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="/themes/AdminLTE/plugins/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="/themes/AdminLTE/plugins/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
@endsection

@section('mid')
  </head>
  <body class="sidebar-collapse @yield('bodyClass', 'hold-transition skin-yellow sidebar-mini')">
@endsection

@section('bodyInit')
    <!-- Site wrapper -->
    <div class="wrapper">
@endsection

@section('header')
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ livepos_asset('dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="sidebar-toggle logo-mini" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! str_replace(' ', '', config('livepos.title')) !!}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      {{ auth()->user()->name }} - {{ auth()->user()->badge }}
                      <small>Member since {{ auth()->user()->created_at->format('d F Y') }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ livepos_asset('auth/logout') }}" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->
@endsection

@section('sidebarLeft')
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <img src="/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ auth()->user()->name }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> {{ auth()->user()->badge }}</a>
            </div>
          </div> -->
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            @yield('sideMenubar')
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->
@endsection

@section('contentInit')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
@endsection

@section('contentHeader')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('pageTitle', 'Blank page')
            <small>@yield('subTitle', 'it all starts here')</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ livepos_asset('dashboard') }}" title="{{ trans('livepos.dashboard.name') }}"><i class="fa fa-dashboard"></i> {!! config('livepos.title') !!}</a></li>
            <!--<li><a href="#">Examples</a></li>-->
            <li class="active">@yield('pageTitle')</li>
          </ol>
        </section>
@endsection

@section('contentMain')
        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            <div class="box-body">
              Start creating your amazing application!
            </div><!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
@endsection

@section('contentEnd')
      </div><!-- /.content-wrapper -->
@endsection

@section('footer')
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>v.</b> 0.3.0 <b><a href="https://twitter.com/m_rofi">MR</a></b>
        </div>
        <strong class="hidden-xs">&copy; 2015 {!! 2015 < ($year = \Carbon::now()->format('Y')) ? "- $year" : ""  !!} - Supported by <a href="http://inasaba.com">Inasaba Pekalongan</a>.</strong>
      </footer>
@endsection

@section('sidebarRight')
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
@endsection    
  
@section('bodyEnd')
    </div><!-- ./wrapper -->
@endsection

@section('script')
    <!-- jQuery 2.1.4 -->
    <script src="/themes/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/themes/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="/themes/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/themes/AdminLTE/plugins/fastclick/fastclick.min.js"></script>
    <!-- date-range-picker -->
    <script src="/themes/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/themes/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.id.js" charset="UTF-8"></script>
    <!-- DataTables -->
    <script src="/themes/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/themes/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap Typeahead -->
    <script src="/themes/AdminLTE/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/themes/AdminLTE/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/themes/AdminLTE/dist/js/demo.js"></script>


    <script>
      String.prototype.toRp = function(b,c,d,e) {
        e=function(f){return f.split('').reverse().join('')};b=e(parseInt(this,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return'Rp.\t'+e(d);
      }
      $(function() {
        $.fn.datepicker.defaults.format = "{{ config('livepos.dateformat') }}";
        $.fn.datepicker.defaults.language = "id";
        $.fn.datepicker.defaults.todayHighlight = true;

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

      })
    </script>
    
    <!-- Scripts -->
    @stack('scriptJs')
@endsection

@section('bottom')
  </body>
</html>
@endsection


{{-- RENDERING TEMPLATE --}}

@yield('top')
  @yield('head')
@yield('mid')
@yield('bodyInit')
  @yield('header')
  @yield('sidebarLeft')

  @yield('contentInit')
    @yield('contentHeader')
    @yield('contentMain')
  @yield('contentEnd')
  
  @yield('sidebarRight')
  
@yield('bodyEnd')
@yield('footer')
@yield('script')
@yield('bottom')



