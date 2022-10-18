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
</head>

<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="step_two_form" action="{{ url('/sign-up-merchant-step-two') }}">
                @csrf
                    <input type="hidden" value="<?php if(isset($action)) { echo $action; } ?>" name="action">
                    <div class="card border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 text-white-900 bg-gradient-primary" style="height:520px;">
                                    <img src="{{ asset('/images/logo/wave_x_pay.png') }}" title="{{ config('app.name', 'Laravel') }}" style="border:0;align:center;margin: 10px; width: 25%; ">
                                </div>
                                <div class="col-lg-6" style="margin-top:80px;">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sign Up With Wavexpay!</h1>
                                        </div>
                                        
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
                                            <button type="button" id="submit_button" onclick="submit_form()" class="btn-wavex btn btn-primary">Submit</button>      
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
        if(name==''){
          alert('Name is required');
          return false;
        }
        else if(email==''){
          alert('Email is required');
          return false;
        }
        else if(phone==''){
          alert('Phone is required');
          return false;
        }
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
    </script>
</body>

</html>