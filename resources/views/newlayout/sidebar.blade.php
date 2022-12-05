<ul class="navbar-nav sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="{{ url('/home') }}">
      <div class="sidebar-brand-icon rotate-n-0">
        <img src="{{ asset('images/logo/logo-2.png') }}" width="100%;">
      </div>
    </a>
    @php 
      $merchant_id =  session()->get('merchant');
      $get_merchant_details = Helper::get_merchant_details($merchant_id);
    @endphp
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
<div class="sidebar-menu-scroll">
    <!-- Nav Item - Dashboard -->
    @if($get_merchant_details->is_partner=='yes')
    <li class="nav-item active">
      <a class="nav-link" href="{{url('partner-dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span style="color:{{ in_array(Request::segment(1),array('','partner-dashboard')) ? '#FFFFFF;' : '' }}">Dashboard</span></a>
    </li>
    <li class="nav-item {{ in_array(Request::segment(1),array('affiliate-accounts')) ? 'active;' : '' }}">
      <a class="nav-link" href="{{url('affiliate-accounts')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span style="color:{{ in_array(Request::segment(1),array('affiliate-accounts')) ? '#FFFFFF;' : '' }}">Affiliate Accounts</span></a>
    </li>
    <li class="nav-item {{ in_array(Request::segment(1),array('affiliate-accounts')) ? 'active;' : '' }}">
      <a class="nav-link" href="{{url('rewards')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span style="color:{{ in_array(Request::segment(1),array('rewards')) ? '#FFFFFF;' : '' }}">Rewards</span></a>
    </li>
    @else
    <li class="nav-item active">
      <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span style="color:{{ in_array(Request::segment(2),array('','home')) ? '#FFFFFF;' : '' }}">Dashboard</span></a>
    </li>
    <!-- Divider -->
    
    
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="{{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? '' : 'collapsed' }}" aria-controls="collapseTwo">
      <i class=" fas fas-solid fa-piggy-bank"></i>       
        <span style="color:{{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? '#FFFFFF;' : '' }}">Transactions</span>
    </a>
    <div id="collapseOne" class="collapse {{ in_array(Request::segment(2),array('payments','refunds','batch-refunds','orders','disputes')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(2) === 'payments' ? 'active' : null }}" href="{{ route('transactions/payments') }}">Payments</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(2) === 'refunds' ? 'active' : null }}" href="{{ route('transactions/refunds') }}">Refunds</a>
        <!--<a style="color:#00008B;" class="collapse-item {{ Request::segment(2) === 'batch-refunds' ? 'active' : null }}" href="javascript:void(0)"><strong>Batch Refunds</strong></a>-->
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(2) === 'orders' ? 'active' : null }}" href="{{ route('transactions/orders') }}">Orders</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(2) === 'disputes' ? 'active' : null }}" href="{{ route('transactions/disputes') }}">Disputes</a>
        </div>
    </div>
    </li>


    <!-- Divider -->
    
    <li class="nav-item {{ in_array(Request::segment(1),array('settlements')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('settlements')}}">
        <i class="fas fa-fw fa-chart-area"></i> 
        <span style="color:{{ in_array(Request::segment(1),array('settlements')) ? '#FFFFFF;' : '' }}">Settlements</span>
    </a>
    </li>



    <!-- Divider -->
    
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(1),array('payment-links','payment-pages')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="{{ in_array(Request::segment(1),array('payment-links','payment-pages')) ? '' : 'collapsed' }}" aria-controls="collapseThree">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
          <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z"/>
        </svg> 
        <span style="color:{{ in_array(Request::segment(1),array('payment-links','payment-pages')) ? '#FFFFFF;' : '' }}">Payments</span>
    </a>
    <div id="collapseThree" class="collapse {{ in_array(Request::segment(1),array('payment-links','payment-pages')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'payment-links' ? 'active' : null }}" href="{{ route('payment-links') }}">Payment Links</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'payment-pages' ? 'active' : null }}" href="{{ route('payment-pages') }}">Payment Pages</a>
        </div>
    </div>
    </li>


    <!-- Divider -->
    
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(1),array('invoices','items')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="{{ in_array(Request::segment(1),array('invoices','items')) ? '' : 'collapsed' }}" aria-controls="collapseFour">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
          <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
          <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
        </svg> 
        <span style="color:{{ in_array(Request::segment(1),array('invoices','items')) ? '#FFFFFF;' : '' }}">Invoices</span>
    </a>
    <div id="collapseFour" class="collapse {{ in_array(Request::segment(1),array('invoices','items')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'invoices' ? 'active' : null }}" href="{{ route('invoices') }}">Invoices</a>
        <!--<a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'items' ? 'active' : null }}" href="{{ route('items') }}"><strong>Items</strong></a>-->
        </div>
    </div>
    </li>


    <!-- Divider -->
    
    <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="" aria-controls="collapseSeven">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-piggy-bank" viewBox="0 0 16 16">
          <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm1.138-1.496A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.602 7.602 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962z"/>
          <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zM2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.558 6.558 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.649 4.649 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393zm12.621-.857a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199z"/>
        </svg> 
        <span>Chargeback</span>
    </a>
    <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item" href="#"><strong>Open</strong></a>
        <a style="color:#00008B;" class="collapse-item" href="#"><strong>Close</strong></a>
        </div>
    </div>
    </li>



    <!-- Divider -->
    
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(1),array('reports')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="{{ in_array(Request::segment(1),array('transaction-report','settlement-report','refund-report','chargeback-dispute-report')) ? '' : 'collapsed' }}" aria-controls="collapseFive">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-display" viewBox="0 0 16 16">
          <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z"/>
        </svg> 
        <span style="color:{{ in_array(Request::segment(1),array('transaction-report')) ? '#FFFFFF;' : '' }}">Reports</span>
    </a>
    <div id="collapseFive" class="collapse {{ in_array(Request::segment(1),array('transaction-report','settlement-report','refund-report','chargeback-dispute-report')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'transaction-report' ? 'active' : null }}" href="{{route('transaction-report')}}">Transaction Report</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'settlement-report' ? 'active' : null }}" href="{{route('settlement-report')}}">Settlement Report</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'refund-report' ? 'active' : null }}" href="{{route('refund-report')}}">Refund Report</a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'chargeback-dispute-report' ? 'active' : null }}" href="{{route('chargeback-dispute-report')}}">Chargeback & <br>Dispute Report</a>
        </div>
    </div>
    </li>


    <!-- Divider -->
    
    <li class="nav-item {{ in_array(Request::segment(1),array('customer')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customer.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
          <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        </svg> 
        <span style="color:{{ in_array(Request::segment(1),array('customer')) ? '#FFFFFF;' : '' }}">Customers</span>
    </a>
    </li>



    <!-- Divider -->
    
    <li class="nav-item">
    <a class="nav-link {{ in_array(Request::segment(1),array('pages','general-settings')) ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="{{ in_array(Request::segment(1),array('pages','general-settings')) ? '' : 'collapsed' }}" aria-controls="collapseSix">
        <i class="fas fa-fw fa-cog"></i> 
        <span style="color:{{ in_array(Request::segment(1),array('invoices','items')) ? '#FFFFFF;' : '' }}">Settings</span>
    </a>
    <div id="collapseSix" class="collapse {{ in_array(Request::segment(1),array('pages','general-settings')) ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'payment-templates' ? 'active' : null }}" href="#"><strong>Payment Templates</strong></a>
        <a style="color:#00008B;" class="collapse-item {{ Request::segment(1) === 'general-settings' ? 'active' : null }}" href="{{ route('general-settings') }}"><strong>General Settings</strong></a>
        </div>
    </div>
    </li>
    @endif



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</div>
</ul>
