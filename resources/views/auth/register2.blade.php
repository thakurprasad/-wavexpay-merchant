<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>wavexpay</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Styles -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link href="{{ url('/') }}/register_section/css/style.css" rel="stylesheet" type="text/css"/>
      <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
      <script>
      function submit_form() {
        var exampleInputName1 = $("#exampleInputName1").val();
        var exampleInputNumber1 = $("#exampleInputNumber1").val();
        if(exampleInputName1==''){
          alert('Name is required');
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
   </head>
   <body>
      <div class="wavexpay-all">
         <div class="wavexpay-root">
            <div class="container">
               <div class="row">
                  <section class="stage-1">
                     <div class="col-md-12 top-bar">
                        <div class="col-md-2 logo-wave">
                           <h4>WAVEXPAY</h4>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-4 login-right">
                           <p class="user-a">Already a user?</p>
                           <a class="btn-login" href="#">Login</a>
                        </div>
                     </div>
                     <div class="col-md-12 stage-2">
                        <div class="col-md-5">
                           <div class="form">
                              <h3> Welcome to Razorpay</h3>
                              <p>Sign up to create an account with us</p>
                              <form method="post" id="step_two_form" action="{{ url('/sign-up-merchant-step-two') }}">
                                 <div class="form-group">
                                    <label for="exampleInputName1">Your name</label>
                                    <input type="text" class="form-control name-wave" name="name" id="exampleInputName1"  placeholder="Enter Name">
                                    <label for="exampleInputNumber1">Email or Mobile number</label>
                                    <input type="text" class="form-control phone-wave" id="exampleInputNumber1"  placeholder="Enter email address or Mobile number" name="email">
                                    <div class="form-check mb-2 mr-sm-2 account-wave">
                                        <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                        <label class="form-check-label" for="inlineFormCheck">
                                          Get account updates on whatsapp<img src="{{ url('/') }}/register_section/img/whatsapp.png" class="whatsapp img-responsive">
                                        </label>
                                    </div>
                                    <a class="coupon" href="#"><small id="couponHelp" class="form-text text-muted">Get a coupon code</small></a>
                                 </div>
                                 <button type="button" id="submit_button" onclick="submit_form()" class="btn-wavex btn btn-primary">Submit</button>
                              </form>
                           </div>
                        </div>
                        <div class="col-md-6 stage-2-choose">
                           <h5>Why choose Razorpay?</h5>
                           <p>50,00,000+ businesses trust their payments with Razorpay</p>
                           <img src="{{ url('/') }}/register_section/img/client-logos.png" class="img-responsive">
                           <p class="need">Need help? We are just a click away. Contact Us</p>
                        </div>
                        <div class="col-md-1">
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>