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
      <script
			  src="https://code.jquery.com/jquery-3.6.1.min.js"
			  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
			  crossorigin="anonymous"></script>
      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <script>

      function make_payment()
      {
         var amount = $('#payment').val();
         var amount = $('#payment').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "orderid-generate",
            data: $("#addPaymentForm").serialize(),
            success: function (data) {
                var order_id = '';
                if (data.order_id) {
                    order_id = data.order_id;
                }

                var options = {
                    "key": "rzp_test_YRAqXZOYgy9uyf",
                    "amount": amount,
                    "currency": "INR",
                    "name": "{{ config('app.account_name') }}",
                    "description": "Test",
                    "image": "{{ asset('images/logo-black.svg') }}",
                    "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response) {
                        $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        $('#razorpay_order_id').val(response.razorpay_order_id);
                        $('#razorpay_signature').val(response.razorpay_signature);
                        $('#addPaymentForm').submit();
                    },
                    "prefill": {
                        "name": "{{ $display_name }}",
                        "email": "{{ $email }}",
                        "contact": "{{ $phone }}"
                    },
                     "notes": {
                        "address": "Razorpay Corporate Office"
                     },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response) {

                });
                $("#form-div").hide();
                rzp1.open();
            },
         });
         /*$.ajax({
             type:'POST',
             url:'/cashfreeorder',
             data:{
               '_token = ',
               price:amount,
               amount:amount,
               currency:'INR'
             }
             success:function(data) {
                $(".payment").appent(data);
                ('.redirectForm').submit();
             }
          });*/
      }
         
      </script>
      <link href="{{url('/')}}/payments/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
      <div class="container">
         <div class="space-height"></div>
         <form action="{{ url('razorpaypayment') }}" method="post" id="addPaymentForm">
            @csrf
            <input type="hidden" name="price" id="payment" value="{{$get_payment_link_details_by_text->amount}}">
            <input type="hidden" name="razorpay_payment_id" value="" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" value="" id="razorpay_order_id">
            <input type="hidden" name="razorpay_signature" value="" id="razorpay_signature">
            <input type="hidden" name="generated_signature" value="" id="generated_signature">

            <div class="row" id="form-div">
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
                     
                     <div class="col-md-12 text-center" style="margin-top:10px;">                                 
                        <button class="btn btn-primary" type="button" id="addPaymentButton" onclick="make_payment()">Make Payment</button>
                     </div>

                  

                  </div>
               </div>
               <div class="col-md-4"></div>
            </div>
         </form>
      </div>
   </body>
</html>