<!DOCTYPE html>
<html>
   <head>
      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>wavexpay</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Styles -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <link href="{{url('/')}}/payments/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
      <div class="container">
         <div class="space-height"></div>
         <div class="row ">
            <div class="col-md-4"></div>
            <div class="col-md-4 borderwv">
               <div class="row ">
                  <div class="col-md-4 mob-logo blue-box-checkout-page">
                     <div class="logo"><img src="{{url('/')}}/payments/images/logo.png" class="whatsapp img-responsive"></div>
                  </div>
                  <div class="col-md-8 mob-text blue-box-checkout-page">
                     <div class="blue-box-checkout">
                        <h3>{{$display_name}}</h3>
                        <span>#{{$get_payment_link_details_by_text->link_text}}</span>
                        <h4><span class="original-amount">₹ {{$get_payment_link_details_by_text->amount}}</span></h4>
                     </div>
                  </div>
                  <div class="col-md-12 darkwv"></div>
                  <div class="col-md-3 wv2-lb mob-logo-num">
                     <div class="form-group">
                        <label for="exampleFormControlInput1">Country</label>
                        <select class="wv2-frm form-control" id="exampleFormControlSelect1">
                           <option>+91</option>
                           <option>2</option>
                           <option>3</option>
                           <option>4</option>
                           <option>5</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-9 wv-frm mob-text-text">
                     <div class="input-group space-form">
                        <input type="text" class="phone-ch form-control" placeholder="Phone Number">
                        <div class="input-group-append">
                           <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 wv-frm">
                     <div class="input-group">
                        <input type="text" class="phone-ch form-control" placeholder="Email">
                        <div class="input-group-append">
                           <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="wv4-height allwv"></div>
                  <div class="col-md-12 wv3-txt">
                     <p ><i class="fa fa-lock" aria-hidden="true"></i>  This payment is secured by WaveXpay.</p>
                     <div class="wv3-btn">
                        <p>
                           <a class="blue-btn" href="#">Proceed</a>
                        </p>
                     </div>
                  </div>

               </div>
            </div>
            <div class="col-md-4"></div>
         </div>
      </div>
   </body>
</html>