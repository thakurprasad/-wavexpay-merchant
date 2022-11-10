<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wavexpay - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('newdesign/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('newdesign/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
<style type="text/css">
    .auth-left-panel{
        background-image: url('images/login/auth-background.png');
       /* background-image: url('https://esellerhub.techjockey.com/assets/v4/images/auth-background.png'); */
    }
    ul.auth-left-panel-points {
      list-style-image: url('images/login/white_tick.svg');
      /*list-style-image: url('https://esellerhub.techjockey.com/assets/v4/images/white_tick.svg'); */
    }
</style>
</head>

<body>

    <div class="container-full">

        <!-- Outer Row -->
        <div class="row_">

            <div class="col-md-12">
                
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div >
                    <!--<div class="card border-0 shadow-lg my-5">-->
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="auth-left-panel col-lg-6 bg-gradient-primary" style="height:100vh;">
                                    <a href="https://wavexpay.com"><img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" class="logo-img"></a>
                                    
                                    <div style="color: white;width: 80%; margin-left:10%; margin-top: 3%;">
                                        <h2>
                                            UNIQUE SMART ROUTING PAYMENT GATEWAY                                             
                                        </h2>
                                        <h4>"The Future of Fintech Industries"</h4>
                                        <br>
                                        <ul class="auth-left-panel-points">
                                            <li>
                                                <strong>SMART ROUTING</strong><br>
                                                Route your payment with industries best PG for better growth.
                                            </li>
                                            <li>
                                                <strong>HIGH SUCCESS RATIO</strong><br>
                                                Choose your favorite mode at the time of payment done.
                                            </li>
                                            <li>
                                                <strong>120+ PAYMENT OPTIONS</strong><br>
                                                We offer almost payment option to merchant Inclusing UPI.
                                            </li>
                                            <li>
                                                <strong>Instant Activation</strong>
                                                Complete Your KYC Digitaly, No Physical Paper Required.
                                            </li>
                                            <!--<li>
                                                <strong>LOW PRICING</strong><br>
                                                We Offer industries best rate for all mode of Transaction.
                                            </li>
                                            <li>
                                                <strong>ACCOUNT MANAGER</strong><br>
                                               We are providing dedicated account manager for each merchant.
                                            </li> -->
                                        </ul>
                                    </div>

                                    <div class="row auth-left-panel-buttom-points">
                                        <div class="col-md-4">
                                           <h3>382</h3>Registered merchents
                                        </div>
                                        <div class="col-md-4 border-lr">
                                           <h3>25,874</h3>No Of Transactions
                                        </div>
                                        <div class="col-md-4">
                                             <h3>2,400</h3>TXN/SEC Handling Capability
                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-6" style="padding-top: 8.5%;">
                                    <div class="row">
                                    <div class="col-md-8 offset-2">
                                        @if (Session::has('message'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('message') }}
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sign In</h1>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email Id" required autocomplete="email" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" id="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required autocomplete="current-password">
                                            </div>

                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Select Mode</h1>
                                                <input type="radio" name="mode"  value="test">Test 
                                                &nbsp;&nbsp;                                         
                                                <input type="radio" name="mode" value="live">Live
                                            </div>



                                            <div class="form-group row col-md-12">
                                                <div class="col-md-6">
                                                    <label> 
                                                        <input type="checkbox" id="customCheck"> Remember Me </label>
                                                </div>
                                                <div class="col-md-6 text-right"> <a class="small" href="{{route('forget.password.get')}}">Forgot Password ?</a></div>
                                            </div>
                                            <button href="index.html" class="btn btn-lg btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                        <div class="text-center" style="padding-top: 20px;">
                                            Don’t have an account?
                                            <a class="small" href="{{url('register')}}">Create Account</a>
                                        </div>
                                    </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('newdesign/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('newdesign/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('newdesign/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('newdesign/js/sb-admin-2.min.js') }}"></script>

</body>

</html>