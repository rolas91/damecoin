<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
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
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 1 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
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

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }} {{ Auth::user()->lastName }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
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
                                <a href="/perfil" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">Cerrar Session</a>
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
                <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }} {{ Auth::user()->lastName }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            @if (Auth::user()->rol->name == 'administrator')
                <li class="header">Menu</li>
                <li>
                    <a href="{{ url('/admin') }}">
                        <i class="fa fa-dashboard"></i> <span>Home</span>
                        <span class="pull-right-container">
                            <!--
              <small class="label pull-right bg-green">new</small>
              -->
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/analitycs')}}">
        
          <i class="fa fa-line-chart"></i> <span>Analytics</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
          <a href="{{url('admin/users')}}">
            <i class="fa fa-users"></i> <span>Usuarios</span>
            <span class="pull-right-container">
            </span>
          </a>
	  </li>
	  <li>
			<a href="{{url('admin/balance')}}">
			  <i class="fa  fa-balance-scale"></i> <span>Balance</span>
			  <span class="pull-right-container">
			  </span>
			</a>
		  </li>
		  <li>
			<a href="{{url('admin/wallets')}}">
			  <i class="fa fa-google-wallet"></i> <span>Wallets</span>
			  <span class="pull-right-container">
			  </span>
			</a>
      </li>
      <li>
			<a href="{{url('admin/criptoWallet')}}">
			  <i class="fa fa-google-wallet"></i> <span>Crypto a Wallets</span>
			  <span class="pull-right-container">
			  </span>
			</a>
      </li>
      
      <li>
        <a href="{{url('admin/cripto')}}">
          <i class="fa fa-bitcoin"></i> <span>Criptodivisas</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/currency')}}">
          <i class="fa  fa-money"></i> <span>Divisas</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/country')}}">
          <i class="fa fa-money"></i> <span>Países</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/circunstancia')}}">
          <i class="fa fa-money"></i> <span>Circunstancias</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/payment-limit')}}">
          <i class="fa  fa-lock"></i> <span>PaymentLimit</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li>
        <a href="{{url('admin/payment-method-state')}}">
          <i class="fa  fa-lock"></i> <span>PaymentMethodState</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>

                        <i class="fa fa-line-chart"></i> <span>Analytics</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/transfe') }}">
                        <i class="fa fa-cogs"></i> <span>Transferencias</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/balance') }}">
                        <i class="fa  fa-balance-scale"></i> <span>Balance</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/wallets') }}">
                        <i class="fa fa-google-wallet"></i> <span>Wallets</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/cripto') }}">
                        <i class="fa fa-bitcoin"></i> <span>Criptodivisas</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/currency') }}">
                        <i class="fa  fa-money"></i> <span>Divisas</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/country') }}">
                        <i class="fa fa-money"></i> <span>Países</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/circunstancia') }}">
                        <i class="fa fa-money"></i> <span>Circunstancias</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/payment-limit') }}">
                        <i class="fa  fa-lock"></i> <span>PaymentLimit</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/payment-method-state') }}">
                        <i class="fa  fa-lock"></i> <span>PaymentMethodState</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li class="treeview" style="height: auto;">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Config Landings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li>
                            <a href="{{ url('admin/payment-method') }}">
                                <i class="fa  fa-lock"></i> <span>PaymentMethods</span>
                                <span class="pull-right-container">
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('admin/landings') }}">
                                <i class="fa  fa-lock"></i> <span>Landings</span>
                                <span class="pull-right-container">
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('admin/stripe-account') }}">
                        <i class="fa  fa-cc-stripe"></i> <span>Stripe Account</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/support-recurly') }}">
                        <i class="fa  fa-registered"></i> <span>Master Account</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>

                    <a href="{{ url('admin/flutterwave') }}">
                        <i class="fa fa-cc-stripe"></i> <span>Flutterwave Keys</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>

                    <a href="{{ url('admin/stripe') }}">
                        <i class="fa fa-cc-stripe"></i> <span>Stripe Keys</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li>

                    <a href="{{ url('admin/paypal-gateway-links') }}">
                        <i class="fa fa-paypal"></i> <span>PayPal Account</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/masterpassword') }}">
                        <i class="fa  fa-asterisk"></i> <span>Master Password</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>

                <li class="treeview" style="height: auto;">
                    <a href="#">
                        <i class="fa fa-cogs"></i>
                        <span>Config</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li><a href="{{ url('password') }}"><i class="fa fa-asterisk"></i> Password</a></li>

                        <li><a href="{{ url('admin/bank') }}"><i class="fa fa-bank"></i> Cuenta Bancaria</a></li>

                    </ul>
                </li>
            @endif

            @if (Auth::user()->rol->name == 'agente')
                <li class="header">Menu</li>
                <li>
                    <a href="{{ url('/admin') }}">
                        <i class="fa fa-dashboard"></i> <span>Home</span>
                        <span class="pull-right-container">
                            <!--
              <small class="label pull-right bg-green">new</small>
              -->
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/users') }}">
                        <i class="fa fa-users"></i> <span>Usuarios</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/balance') }}">
                        <i class="fa  fa-balance-scale"></i> <span>Balance</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/wallets') }}">
                        <i class="fa fa-google-wallet"></i> <span>Wallets</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
