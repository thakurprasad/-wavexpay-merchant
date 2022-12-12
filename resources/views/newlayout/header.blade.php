<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

<?php $m = (session('mode') ? session('mode') : 'test');
$alert_centers = [];
//SELECT * FROM `wxp_payments` WHERE status = 'captured' AND merchant_id = 89;
$payments = App\Models\Payment::where('status' , 'captured')->orderBy('payment_created_at', 'DESC')->take(10)->get();
foreach ($payments as $key => $row) {
    
    $data['alert_date'] =  \Carbon\Carbon::parse($row->payment_created_at)->format('d F Y H:i A');
    
    $alert_message = "Payment receved <b>Rs. ". $row->amount ."</b> 
                        from ".$row->email . " to payment_id=".$row->payment_id;
    
    $data['alert_message'] =  $alert_message;

    $data['url'] =  url('transactions/payments');

    $alert_centers[] = $data;
}


?>
 
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="{{ $m }}-mode-dashboard">You're In 
 <select id="change_mode" class="btn btn-sm btn-<?= ($m == 'test' ? 'danger' : 'success') ?>" style="font-weight: bold;">    
    <option value="test" <?= ($m == 'test' ? 'selected' : '') ?>>Test</option>
    <option value="live" <?= ($m == 'live' ? 'selected' : '') ?>>Live</option>
  </select>

         Mode</div>
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
                <span class="badge badge-danger badge-counter">{{ count($alert_centers) }}+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
            @if(count($alert_centers)>0)
                @foreach($alert_centers as $key => $val)
                <a class="dropdown-item d-flex align-items-center" href="{{ ($val['url'] ? $val['url'] : '') }}">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>                        
                        {!! $val['alert_message'] !!}
                        <div class="small text-gray-500" style="text-align: right;">{!! $val['alert_date'] !!}</div>
                    </div>
                </a>
                @endforeach
            @endif    
          <!--       <a class="dropdown-item d-flex align-items-center" href="#">
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
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>  --> 
                <a class="dropdown-item text-center small text-gray-500" href="{{ url('transactions/payments') }}">Show All Alerts</a>
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
                        <img src="{{ asset('images/logo/wave_x_pay.png') }}" width="100%">
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
<div class="container-fluid">
<?php 

    $mode = session()->get('mode');
    $row = App\Models\MerchantKey::where(['merchant_id'=> session()->get('merchant')])
    ->whereNull( $mode . '_api_secret')->WhereNull($mode . '_api_key')
    ->first();

    // if find row then not approved or assigned razorpay account form admin side 
    $merchant_no_approved = App\Models\Merchant::where(['id'=> session()->get('merchant')])
    ->whereNull('wavexpay_api_key_id')->first();

    $link = "<a href='".url('/general-settings')."'>Generate api key</a>";
?>
    @if($row && $mode == 'live')        
        <x-notification title="API Key" description="You can only use WaveXpay in test mode until your account is not activated for live. Please generate live api key to access live mode. {!! $link !!} "/>
    @endif

     @if($merchant_no_approved)
     
<!-- You can only use Razorpay in test mode until your account is activated.
Please fill and submit the Activation Form to access live mode. -->

        <x-notification title="Account Status" description="your account is currently not approved from Admin side. Please wait approveal"/>
    @endif
    <x-notification title="test" description="test,...."/>
</div>

<!-- You are in Test Mode, so only test data is shown. Activate your account to start making live transactions. -->