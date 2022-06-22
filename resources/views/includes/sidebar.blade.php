
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="{{ route('home')}}" class="brand-link">
      <img src="{{ asset('/images/logo/materialize-logo.png')}}"
           alt="{{ config('app.name') }}"
           style="width:40%;border:0;align:center; margin:0 13px;">
           <span class="brand-text">WaveXPay</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">#Merhant Name</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ in_array(Request::segment(1),array('home')) ? 'active' : '' }}"> <i class="nav-icon fas fa-tachometer-alt"></i> <p>Dashboard</p> </a>
            </li>



            <li class="nav-header">Transactions</li>
            <li class="nav-item {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? 'active' : '' }}"> <i class="nav-icon fas fa-users"></i> <p>Transactions <i class="right fas fa-angle-left"></i></p> </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{ route('transactions/payments')}}" class="nav-link {{ Request::segment(2) === 'payments' ? 'active' : null }}"><i class="nav-icon far fa-circle text-success"></i><p>Payments</p> </a> </li>
                    <li class="nav-item"><a href="{{ route('transactions/refunds')}}" class="nav-link {{ Request::segment(2) === 'refunds' ? 'active' : null }}"><i class="nav-icon far fa-circle text-warning"></i><p>Refunds</p> </a></li>
                    <li class="nav-item"><a href="javascript:void(0)" class="nav-link {{ Request::segment(2) === 'batch-refunds' ? 'active' : null }}"><i class="nav-icon far fa-circle text-info"></i><p>Batch Refunds</p> </a></li>
                    <li class="nav-item"><a href="{{ route('transactions/orders')}}" class="nav-link {{ Request::segment(2) === 'orders' ? 'active' : null }}"><i class="nav-icon far fa-circle text-primary"></i><p>Orders</p> </a></li>
                    <li class="nav-item"><a href="{{ route('transactions/disputes')}}" class="nav-link {{ Request::segment(2) === 'disputes' ? 'active' : null }}"><i class="nav-icon far fa-circle text-danger"></i><p>Disputes</p> </a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('settlements')}}" class="nav-link {{ in_array(Request::segment(1),array('settlements')) ? 'active' : '' }}"> <i class="nav-icon far fa-plus-square"></i> <p>Settlements</p> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('payment-links')}}" class="nav-link {{ in_array(Request::segment(1),array('payment-links')) ? 'active' : '' }}"> <i class="nav-icon far fa-plus-square"></i> <p>Payment Links</p> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('payment-pages')}}" class="nav-link {{ in_array(Request::segment(1),array('payment-pages')) ? 'active' : '' }}"> <i class="nav-icon far fa-plus-square"></i> <p>Payment Pages</p> </a>
            </li>
            <li class="nav-header"></li>
            <li class="nav-item {{ in_array(Request::segment(1),array('invoices','items')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(Request::segment(2),array('invoices','items')) ? 'active' : '' }}"> <i class="nav-icon fas fa-users"></i> <p>Invoices <i class="right fas fa-angle-left"></i></p> </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="{{ route('invoices')}}" class="nav-link {{ Request::segment(1) === 'invoices' ? 'active' : null }}"><i class="nav-icon far fa-circle text-success"></i><p>Invoices</p> </a> </li>
                    <li class="nav-item"><a href="{{ route('items')}}" class="nav-link {{ Request::segment(1) === 'items' ? 'active' : null }}"><i class="nav-icon far fa-circle text-warning"></i><p>Items</p> </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('customer.index') }}" class="nav-link {{ in_array(Request::segment(1),array('customer')) ? 'active' : '' }}"> <i class="nav-icon fas fa-tachometer-alt"></i> <p>Customers</p> </a>
            </li>
            <li class="nav-item {{ in_array(Request::segment(1),array('pages')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ in_array(Request::segment(1),array('settings','countries','states')) ? 'active' : '' }}"> <i class="nav-icon fas fa-tachometer-alt"></i> <p>Settings <i class="right fas fa-angle-left"></i></p> </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="#" class="nav-link {{ Request::segment(1) === 'payment-templates' ? 'active' : null }}"><i class="nav-icon far fa-circle text-success"></i><p>Payment Templates</p> </a> </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ in_array(Request::segment(1),array('reports')) ? 'active' : '' }}"> <i class="nav-icon fas fa-tachometer-alt"></i> <p>Reports <i class="right fas fa-angle-left"></i></p> </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-circle text-success"></i><p>Report A</p> </a> </li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-circle text-warning"></i><p>Report B</p> </a> </li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-circle text-info"></i><p>Report C</p> </a> </li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-circle text-primary"></i><p>Report D</p> </a> </li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon far fa-circle text-danger"></i><p>Report E</p> </a> </li>
                </ul>
            </li>
            <li class="nav-header">Account</li>
            <li class="nav-item has-treeview {{ in_array(Request::segment(1),array('profile_update','change-password')) ? 'menu-open' : null }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-circle"></i> <p>My Account <i class="right fas fa-angle-left"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item"><a href="#" class="nav-link {{ Request::segment(1) === 'profile_update' ? 'active' : null }}"><i class="nav-icon far fa-circle text-success"></i><p>Profile Update</p> </a> </li>
                    <li class="nav-item"><a href="#" class="nav-link {{ Request::segment(1) === 'profile_update' ? 'active' : null }}"><i class="nav-icon far fa-circle text-warning"></i><p>Change Password B</p> </a> </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();    document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt nav-icon"></i> <p>Logout</p> </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </li>
        </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
