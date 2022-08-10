<!DOCTYPE html>
<html>
   <head>
      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>wavexpay</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Styles -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link href="{{url('/')}}/welcome/css/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <h2>Welcome to wavexpay</h2>
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" style="display:none;">Open Modal</button>
            <!-- The Modal -->
            <div id="myModal" class="modal">
               <!-- Modal content -->
               <div class="modal-content popup-wavex">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="modal-header">
                           <span class="close">&times;</span>
                        </div>
                        <div class="col-md-6 wavexpay-para">
                           <p>Welcome to wavexpay</p>
                           <h4>You are just one step away from <br>accepting payment</h4>
                           <p>Activate your account and find the right product for<br> your business needs</p>
                           <div class="payment-wave">
                              <img src="{{url('/')}}/welcome/img/payment.png" class="img-responsive"> 
                              <div class="payment-wave-text">
                                 <p>Payment Button</p>
                                 <p>Add payment button on your website directly</p>
                              </div>
                           </div>
                           <div class="payment-wave-btn">
                              <p><a class="btn btn-sm" style="background-color: #3c63dc; color:#ffffff;" href="#">Activate your account</a></p>
                              <p><a style="margin-left:20px;" class="btn-try" href="{{route('home')}}">Try out the dashboard</a></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
         // Get the modal
         var modal = document.getElementById("myModal");
         
         // Get the button that opens the modal
         var btn = document.getElementById("myBtn");
         
         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close")[0];
         
         // When the user clicks the button, open the modal 
         btn.onclick = function() {
           modal.style.display = "block";
         }
         
         // When the user clicks on <span> (x), close the modal
         span.onclick = function() {
           modal.style.display = "none";
         }
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
           if (event.target == modal) {
             modal.style.display = "none";
           }
         }


         $( document ).ready(function() {
            var btn = document.getElementById("myBtn");
            btn.click();
        });
      </script>
   </body>
</html>