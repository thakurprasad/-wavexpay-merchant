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
              <form method="post" id="step_two_form" action="{{ url('/sign-up-merchant-step-two') }}">
                @csrf
                    <input type="hidden" value="<?php if(isset($action)) { echo $action; } ?>" name="action">
                    <div >
                    <!--<div class="card border-0 shadow-lg my-5">-->
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="auth-left-panel col-lg-6 bg-gradient-primary" style="height:100vh;">
                                    <img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" class="logo-img">
                                    
                                    <div style="color: white;width: 80%; margin-left:10%; margin-top: 3%;">
                                        <h2>
                                            UNIQUE SMART ROUTING PAYMENT GATEWAY                                             
                                        </h2>
                                        <h4>"The Future of Fintech Industries"</h4>
                                        <br>
                                        <ul class="auth-left-panel-points">
                                            <li>
                                                <strong>HIGH SUCCESS RATIO</strong><br>
                                                Choose your favorite mode at the time of payment done.
                                            </li>
                                            
                                            <li>
                                                <strong>SMART ROUTING</strong><br>
                                                Route your payment with industries best PG for better growth.
                                            </li>
                                               <li>
                                                <strong>120+ PAYMENT OPTION</strong><br>
                                                We offer almost payment option to merchant Inclusing UPI.
                                            </li>
                                               <li>
                                                <strong>24/7 SUPPORT CENTER</strong><br>
                                                We have Hudge Soft-Tech Resourcess for merchant Support.
                                            </li>
                                            <li>
                                                <strong>LOW PRICING</strong><br>
                                                We Offer industries best rate for all mode of Transaction.
                                            </li>
                                            <li>
                                                <strong>ACCOUNT MANAGER</strong><br>
                                               We are providing dedicated account manager for each merchant.
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
                                <div class="col-lg-6" style="padding-top: 12%;">
                                    <div class="row">
                                    <div class="col-md-8 offset-2">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sign Up (Step 2)</h1>
                                        </div>
                                        <span id="existerror" style="color: red; dislay:none;"></span>
                                            <div class="form-group">
                                              <label for="exampleInputName1">Your name</label>
                                              <input type="text" class="form-control name-wave" name="name" id="name"  placeholder="Enter Name" required>
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputNumber1">Email</label>
                                              <input type="email" class="form-control phone-wave" id="email"  placeholder="Enter email address" name="email" required>
                                            </div>
                                            <div class="form-group">
                                              <label for="exampleInputNumber1">Phone</label>
                                              <input type="email" class="form-control phone-wave" id="phone"  placeholder="Enter Mobile number" name="phone" required>
                                            </div>
                                            <button type="button" id="submit_button" onclick="submit_form()" class="btn btn-lg btn-primary btn-user btn-block">
                                                Complete Sign Up
                                            </button>
                                        
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
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        if(name==''){
          alert('Name is required');
          return false;
        }
        if(email==''){
          alert('Email is required');
          return false;
        }
        if(phone==''){
          alert('Phone Number is required');
          return false;
        }

        $.ajax({
          url: '{{url("checkemailexistence")}}',
          data: {'email':email},
          type: "POST",
          headers: {
              'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(data){
              if(data.success==1)
              {
                $("#existerror").show();
                $("#existerror").html('Email Already Exist, Please Continue With Other Email!');
                return false;
              }
              else 
              {
                $("#existerror").html('');
                $("#existerror").hide();
                setTimeout(
                  function() {
                    $("#submit_button").LoadingOverlay("show");
                    setTimeout(
                      function() {
                        $("#step_two_form").submit();
                      }
                    , 1000);
                  }
                , 1000);
              }
          }
        });
      }
    </script>
</body>

</html>