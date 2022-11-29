<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wavexpay - Register</title>

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
                <form method="POST" id="step_one_form" action="{{ url('/sign-up-merchant-step-one') }}">
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
                                        <input type="hidden" name="action" value="{{$action}}">
                                        <input type="hidden" name="ref_no" value="{{$ref_no}}">
                                    <div class="col-md-8 offset-2">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sign Up</h1>
                                        </div>
                                        
                                            <div class="form-group">
                                                <label for="exampleInputbusiness1">Business Type</label>
                                                <select class="form-control" name="business_type" id="exampleInputBusiness1" required>
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="registered">Registered</option>
                                                    <option value="notregistered">Not Yet Registered</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Registerd business</label>
                                                <select class="form-control" name="business_category" id="exampleFormControlSelect1" required>
                                                    <option value="proprietorship">Proprietorship</option>
                                                    <option value="partnership">Partnership</option>
                                                    <option value="privatelimited">Private Limited</option>
                                                    <option value="publiclimited">Public Limited</option>
                                                    <option value="llp">LLP</option>
                                                    <option value="trust">Trust</option>
                                                </select>
                                            </div>
                                            
                                            <button type="button" id="submit_button" onclick="submit_form()" class="btn btn-lg btn-primary btn-user btn-block">
                                                Register
                                            </button>
                                        
                                        <div class="text-center" style="padding-top: 20px;">
                                            I have an account?
                                            <a class="small" href="{{url('login')}}">Login</a>
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
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script>
      function submit_form() {
        var exampleInputBusiness1 = $("#exampleInputBusiness1").val();
        var exampleFormControlSelect1 = $("#exampleFormControlSelect1").val();
        if(exampleInputBusiness1==null){
          alert('business type is required');
          return false;
        }
        setTimeout(
          function() {
            $("#submit_button").LoadingOverlay("show");
            setTimeout(
              function() {
                $("#step_one_form").submit();
              }
            , 1000);
          }
        , 1000);
      }
      </script>

</body>

</html>