<header class="main-header">
    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Dame</b>Coins</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dame</b>Coins</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications: style can be found in dropdown.less -->
          <!--
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">1</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 1 notifications</li>
              <li>
               
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 nuevos usuarios
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todas</a></li>
            </ul>
          </li>
        -->
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{url('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs"><span id="nameUs">{{ Auth::user()->name }}</span> <span id="nameLas">{{ Auth::user()->lastName }}</span></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                <p>
                    {{ Auth::user()->rol->name }}
                    <!--
                  <small>Miembro {{ Auth::user()->created_at }}</small>
                -->
                </p>
              </li>
              <!-- Menu Body -->
              <!--
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>
            -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/perfil" class="btn btn-default btn-flat">@lang('home_header.perfil')</a>
                </div>
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default btn-flat">@lang('home_header.logout')</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }} {{ Auth::user()->lastName }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
      
        <li>
            <a href="{{url('/home')}}">
            <i class="fa fa-dashboard"></i> <span>@lang('home_header.wallet')</span>
            <span class="pull-right-container">
              <!--
              <small class="label pull-right bg-green">new</small>
              -->
            </span>
          </a>
        </li>
        <li>
            <a href="{{url('/buy')}}/{{General::getCryptoDefault('btc')}}/{{General::getDivisaDefault()}}">
            <i class="fa  fa-bitcoin"></i> <span>@lang('home_header.buy')</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
            <a href="{{url('/deposit')}}/{{General::getDivisaDefault()}}">
            <i class="fa fa-money"></i> <span>@lang('home_header.deposit')</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        
        <li>
            <a href="{{url('/sell')}}/{{General::getCryptoDefault('btc')}}/{{General::getDivisaDefault()}}">
            <i class="fa  fa-bitcoin"></i> <span>@lang('home_header.sell')</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <li>
          <a href="{{ route('pending') }}">
            <i class="fa  fa-question-circle"></i> <span>@lang('home_header.pendiente')</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      {{--   <li>
            <a href="">
            <i class="fa fa-question-circle"></i> <span>@lang('home_header.help')</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li> --}}
          <li class="treeview" style="height: auto;">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>@lang('home_header.config')</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                  <li><a href="{{url('password')}}"><i class="fa fa-asterisk"></i> @lang('home_header.password')</a></li>
               
                <li><a href="{{url('perfil')}}"><i class="fa fa-user"></i> @lang('home_header.perfil')</a></li>
                <!--
                <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              -->
              </ul>
            </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>