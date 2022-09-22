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
            <div class="col-md-4 borderwv-checkout">
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
                  <div class="col-md-12">
                    <div class="boxwv"> <p><i class="fa fa-pencil-square-o" aria-hidden="true"></i> +91{{$phone}} <span class="seperater">|</span> <span class="email">{{$email}}</span></p></div>
                  </div>
                  <div class="col-md-12 space-wv2">
                    <span class="wv-check2"> CARDS,UPI & MORE</span>
                    <div class="boxwv-2">
                     <div class="boxwv-2inner">
                     <div class="img-wv2">
                        <img src="{{url('/')}}/payments/images/upi.jpg" class="whatsapp img-responsive">
                     </div>
                     <div class="wv2-text">
                        <p>UPI</p>
                        <span>Pay with installed app, or use others</span>

                     </div>
                  </div>
                     <div class="upiwv">
                           <div class="upiwv-inner1">
                              <img src="{{url('/')}}/payments/images/gpay.jpg" class="whatsapp img-responsive">
                              <span>Google Pay</span>
                           </div>
                           <div class="upiwv-inner1">
                              <img src="{{url('/')}}/payments/images/phone.jpg" class="whatsapp img-responsive">
                              <span>PhonePe</span>
                           </div>
                           <div class="upiwv-inner1">
                              <img src="{{url('/')}}/payments/images/paytm.jpg" class="whatsapp img-responsive">
                              <span>PayTM</span>
                           </div>
                           <div class="upiwv-inner1">
                              <img src="{{url('/')}}/payments/images/other.jpg" class="whatsapp img-responsive">
                              <span>Others</span>
                           </div>
                        </div>
                    </div>

                  </div>


                  <div class="col-md-12">
                   
                    <div class="boxwv-3">
                     <div class="img-wv2">
                        <img src="{{url('/')}}/payments/images/net.jpg" class="whatsapp img-responsive">
                     </div>
                     <div class="wv2-text">
                        <p>Netbanking</p>
                        <span>All Indian Banks</span>
                     </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                   
                    <div class="boxwv-4">
                     <div class="img-wv2">
                        <img src="{{url('/')}}/payments/images/wallet.jpg" class="whatsapp img-responsive">
                     </div>
                     <div class="wv2-text">
                        <p>Wallet</p>
                        <span>Mobikwik & More</span>
                     </div>
                    </div>
                  </div>
               

               </div>
            </div>
            <div class="col-md-4"></div>
         </div>
      </div>
   </body>
</html>