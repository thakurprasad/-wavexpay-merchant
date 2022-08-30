<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo url('/') ?>/home">
      <div class="sidebar-brand-icon rotate-n-0">
        <!--<i class="fas fa-laugh-wink"></i>-->
        <img src="<?php echo url('/') ?>/images/logo/wave_x_pay.png" width="100px;">
      </div>
      <!--<div class="sidebar-brand-text mx-3">competen<sup>SEA</sup></div>-->
    </a>
    @php 
      $merchant_id =  session()->get('merchant');
      $get_merchant_details = Helper::get_merchant_details($merchant_id);
    @endphp
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if($get_merchant_details->is_partner=='yes')
    <li class="nav-item active">
      <a class="nav-link" href="{{route('partner-dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    @else
    <li class="nav-item active">
      <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Transactions
    </div>
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="{{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? '' : 'collapsed' }}" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Transactions</span>
    </a>
    <div id="collapseOne" class="collapse {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Transactions:</h6>
        <a class="collapse-item {{ Request::segment(2) === 'payments' ? 'active' : null }}" href="{{ route('transactions/payments') }}">Payments</a>
        <a class="collapse-item {{ Request::segment(2) === 'refunds' ? 'active' : null }}" href="{{ route('transactions/refunds') }}">Refunds</a>
        <a class="collapse-item {{ Request::segment(2) === 'batch-refunds' ? 'active' : null }}" href="javascript:void(0)">Batch Refunds</a>
        <a class="collapse-item {{ Request::segment(2) === 'orders' ? 'active' : null }}" href="{{ route('transactions/orders') }}">Orders</a>
        <a class="collapse-item {{ Request::segment(2) === 'disputes' ? 'active' : null }}" href="{{ route('transactions/disputes') }}">Disputes</a>
        </div>
    </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Settlements
    </div>
    <li class="nav-item {{ in_array(Request::segment(1),array('settlements')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('settlements')}}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Settlements</span>
    </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
