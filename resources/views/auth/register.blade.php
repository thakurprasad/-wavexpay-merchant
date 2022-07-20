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
                              <h3 class="bottom-space"> What's your business type?</h3>
                              <form method="post" action="{{ url('/sign-up-merchant-step-one') }}">
                                @csrf
                                <div class="form-group">
                                  <label for="exampleInputbusiness1">Unregistered business</label>
                                  <input type="text" name="business_type" class="form-control business-text" id="exampleInputBusiness1"  placeholder="Not yet registerd">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Registerd business</label>
                                  <select class="form-control" name="business_category" id="exampleFormControlSelect1">
                                    <option value="proprietorship">Proprietorship</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="privatelimited">Private Limited</option>
                                    <option value="publiclimited">Public Limited</option>
                                    <option value="llp">LLP</option>
                                    <option value="trust">Trust</option>
                                  </select>
                                </div>
                                <button type="submit" class="btn-wavex btn btn-primary">Next</button>
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