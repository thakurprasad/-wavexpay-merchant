<aside
  class="{{$configData['sidenavMain']}} @if(!empty($configData['activeMenuType'])) {{$configData['activeMenuType']}} @else {{$configData['activeMenuTypeClass']}}@endif @if(($configData['isMenuDark']) === true) {{'sidenav-dark'}} @elseif(($configData['isMenuDark']) === false){{'sidenav-light'}}  @else {{$configData['sidenavMainColor']}}@endif">
  <div class="brand-sidebar">
    <h1 class="logo-wrapper">
      <a class="brand-logo darken-1" href="{{asset('/')}}">
        @if(!empty($configData['mainLayoutType']) && isset($configData['mainLayoutType']))
          @if($configData['mainLayoutType']=== 'vertical-modern-menu')
          <img class="hide-on-med-and-down" src="{{asset($configData['largeScreenLogo'])}}" alt="materialize logo" />
          <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['smallScreenLogo'])}}"
            alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-menu-nav-dark')
          <img src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-gradient-menu')
          <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
            alt="materialize logo" />
          <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />

          @elseif($configData['mainLayoutType']=== 'vertical-dark-menu')
          <img class="show-on-medium-and-down hide-on-med-and-up" src="{{asset($configData['largeScreenLogo'])}}"
            alt="materialize logo" />
          <img class="hide-on-med-and-down" src="{{asset($configData['smallScreenLogo'])}}" alt="materialize logo" />
          @endif
        @endif
        <span class="logo-text hide-on-med-and-down">
          @if(!empty ($configData['templateTitle']) && isset($configData['templateTitle']))
          {{$configData['templateTitle']}}
          @else
          Materialize
          @endif
        </span>
      </a>
      <a class="navbar-toggler" href="javascript:void(0)"><i class="material-icons">radio_button_checked</i></a></h1>
  </div>
  <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
    data-menu="menu-navigation" data-collapsible="menu-accordion">


    <!-- New Menu Added By Subhasish On 03.03.2022 -->
    <li class="{{(request()->is('/')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('/')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('/') }}">
        <i class="material-icons">Home</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Home') }}</span>
      </a>
    </li>


    <li class="{{(request()->is('transactions/*')) ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">Transaction</i><span class="menu-title" data-i18n="Dashboard">{{ __('Transactions') }}</span><span class="badge badge pill orange float-right mr-10">4</span></a>
      <div class="collapsible-body">
        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
          <li class="{{(request()->is('transactions/payments')) ? 'active' : '' }} bold">
            <a class="{{(request()->is('transactions/payments')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('transactions/payments') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">{{ __('Payments') }}</span></a>
          </li>
          <li class="{{(request()->is('transactions/refunds')) ? 'active' : '' }}">
            <a class="{{(request()->is('transactions/refunds')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('transactions/refunds') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">{{ __('Refunds') }}</span></a>
          </li>  
          <li class="{{(request()->is('transactions/batch')) ? 'active' : '' }}">
            <a class="{{(request()->is('transactions/batch')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('transactions/batch') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">{{ __('Batch') }}</span></a>
          </li>
          <li class="{{(request()->is('transactions/orders')) ? 'active' : '' }}">
            <a class="{{(request()->is('transactions/orders')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('transactions/orders') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">{{ __('Orders') }}</span></a>
          </li>             
        </ul>
      </div>
    </li>

    <li class="{{(request()->is('settlements')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('settlements')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('settlements') }}">
        <i class="material-icons">Settlements</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Settlements') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('invoices')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('invoices')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('invoices') }}">
        <i class="material-icons">Invoices</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Invoices') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('items')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('items')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('items') }}">
        <i class="material-icons">Items</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Items') }}</span>
      </a>
    </li>


    <li class="{{(request()->is('payment-links')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('payment-links')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('payment-links') }}">
        <i class="material-icons">Payment</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Payment Links') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('payment-pages')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('payment-pages')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('payment-pages') }}">
        <i class="material-icons">Payment</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Payment Pages') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('chargeback')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('chargeback')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('chargeback') }}">
        <i class="material-icons">Chargeback</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Chargeback') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('reports')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('reports')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('reports') }}">
        <i class="material-icons">Reports</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Reports') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('customer')) ? 'active' : '' }} bold">
      <a class="{{(request()->is('customer')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('customer') }}">
        <i class="material-icons">Customer</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Customer') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('my-account')) ? 'active'.$configData['activeMenuColor'] : '' }} bold">
      <a class="{{(request()->is('my-account')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('my-account') }}">
        <i class="material-icons">Account</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('My Account') }}</span>
      </a>
    </li>

    <li class="{{(request()->is('settings')) ? 'active'.$configData['activeMenuColor'] : '' }} bold">
      <a class="{{(request()->is('settings')) ? 'active'.$configData['activeMenuColor'] : '' }}" href="{{ url('settings') }}">
        <i class="material-icons">Settings</i>
        <span class="menu-title" data-i18n="Dashboard">{{ __('Settings') }}</span>
      </a>
    </li>
    <!--  End Of Menu -->
  </ul>
  <div class="navigation-background"></div>
  <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
    href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>