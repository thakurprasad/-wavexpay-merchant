<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 7, 2019</div>
                        $290.29 has been deposited into your account!
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        @php 
          $merchant_id =  session()->get('merchant');
          $get_merchant_details = Helper::get_merchant_details($merchant_id);
        @endphp
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">

                  <div class="row col-12">
                    <div class="col-3 rounded-circle" style="border:1px solid #ccc;">
                        <img src="{{ url('images/logo/wave_x_pay.png') }}" width="100%">
                    </div>
                    <div class="col-9">
                        <b>{{$get_merchant_details->merchant_name}}</b><br>
                        {{$get_merchant_details->display_name}}<br>
                        <br>
                        <div class="input-group">
                            <input id="profile_merchent_id" type="text" class="form-control bg-light border-0 small" value="{{$get_merchant_details->access_salt}}">
                            <div class="input-group-append">
                                <button onclick="copyText('profile_merchent_id')" class="btn btn-primary" type="button">
                                    <i class="fas fa-copy fa-sm"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                  </div>

                <div class="dropdown-divider"></div>


                  <div class="row col-md-12">
                    <div class="col-md-5 offset-md-1 m-b-5">
                        <a  href="{{url('set-gateway-mode/live') }}" style="width: 97%;cursor: pointer;" class="btn btn-success btn-sm" title="Active Live Merchant Dashboard">
                        <input type="radio" style="accent-color: green;" name="mode" onclick="setMode('live')" value="live" {{ session()->get('mode') =='live'? 'checked' : ''  }}> Live</a>
                    </div>
                    <div class="col-md-5 m-b-5">
                        <a href="{{url('set-gateway-mode/test') }}" style="width: 97%;cursor: pointer;" class="btn btn-info btn-sm" title="Active Test Merchant Dashboard"><input type="radio" style="accent-color: green;" name="mode" onclick="setMode('test')" value="test" {{ session()->get('mode') =='test'? 'checked' : ''  }}> Test</a>
                    </div>
                  </div>


                <div class="dropdown-divider"></div>


                  <div class="row col-md-12">
                    <div class="col-md-6">
                      <strong>Logged In As</strong><br clear="all">
                      {{$get_merchant_details->email}}<br clear="all">
                    </div>
                  </div>

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

