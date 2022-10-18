<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <!--<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Topbar Navbar -->
    @php 
      $merchant_id =  session()->get('merchant');
      $get_merchant_details = Helper::get_merchant_details($merchant_id);
    @endphp
    <ul class="navbar-nav ml-auto">

      <div class="topbar-divider d-none d-sm-block"></div>
      

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
          <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
          </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown2" style="width:350px; height: 550px; right: 0; left: auto; overflow:scroll;">

          <a class="dropdown-item" href="{{url('my-account')}}">
            <div class="row">
              <div class="col-md-3">
                Announcement
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>


          <a class="dropdown-item" href="#">
            <div class="card">
              <div class="card-body">
                <h4>Title</h4>
                <img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" style="border:0;align:center;margin: 10px; width: 100%; ">
                <p>Description</p>
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>


          <a class="dropdown-item" href="{{url('my-account')}}">
            <div class="card">
              <div class="card-body">
                <h1>Description</h1>
                <img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" style="border:0;align:center;margin: 10px; width: 100%; ">
                <p>Description</p>
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{url('my-account')}}">
            <div class="card">
              <div class="card-body">
                <h1>Description</h1>
                <img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" style="border:0;align:center;margin: 10px; width: 100%; ">
                <p>Description</p>
              </div>
            </div>
          </a>


        </div>
      </li>

      
      
      <div class="topbar-divider d-none d-sm-block"></div>
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$get_merchant_details->merchant_name}}</span>
          <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="width:350px;">

          <a class="dropdown-item" href="{{url('my-account')}}">
            <div class="row">
              <div class="col-md-3"><img src="http://localhost/laravel/wavexpay-merchant/public/images/logo/wave_x_pay.png" width="70px;" height="70px;"></div>
              <div class="col-md-1"></div>
              <div class="col-md-3">
                {{$get_merchant_details->display_name}}<br clear="all">
                {{$get_merchant_details->access_salt}}<br clear="all">
                <span class="badge badge-warning">Copy Merchant Id</span>
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>


          <a class="dropdown-item" href="#">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-3"><input type="radio" style="accent-color: green;" name="mode" id="mode" value="live">Live</div>
              <div class="col-md-1"></div>
              <div class="col-md-3"><input type="radio" style="accent-color: yellow;" name="mode" id="mode" value="test">Test</div>
              <div class="col-md-2"></div>
            </div>
          </a>

          <div class="dropdown-divider"></div>


          <a class="dropdown-item" href="{{url('my-account')}}">
            <div class="row">
              <div class="col-md-6">
                <strong>Logged In As</strong><br clear="all">
                {{$get_merchant_details->email}}<br clear="all">
              </div>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{url('my-account')}}">
            <button class="btn btn-info btn-md" style="width:300px;">Profile</button>
          </a>

          <div class="dropdown-divider"></div>
          
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();    document.getElementById('logout-form').submit();">
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            <button class="btn btn-primary btn-md" style="width:300px;">Logout</button>
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{url('my-account')}}">
            <p style="font-size:13px;">Partner with us and start earning with every referral<br clear="all">
            <span style="font-size:15px; font-weight:bold; color:#528ff0;">Explore Partner Program</span>
          </a>


        </div>
      </li>

    </ul>

  </nav>
