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
      <link href="{{ url('/') }}/payment_link_section/css/style.css" rel="stylesheet" type="text/css"/>
   </head>
   <body>
      <div class="container">
         <div class="row">
            
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" style="display:none;">Open Modal</button>
            <!-- The Modal -->
            <div id="myModal" class="modal payment-all">
               <!-- Modal content -->
               <div class="modal-content payment-link-new-wavex">
                  <div class="row">
                     <a href="{{ route('payment-links')}}"><h6>< Back to dashboard </h6></a>
                     <div class="col-md-12 payment-short">
                        <h2>Pick a Payment Link Type</h2>
                        <div class="modal-header">
                           <span class="close congrts-close">&times;</span>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2 payment-link-para">
                           <img src="{{ url('/') }}/payment_link_section/img/congrts.jpg" class="img-responsive">
                           <h5>Standard Payment Link</h5>
                           <p>Create a classic payment link to <br>collect payment from your <br>customers in all payment<br> methods.</p>
                           <div class="payment-link-btn">
                              <hr class="border-top">
                              <a class="btn-linkk" href="#">Create now</a>
                           </div>
                        </div>
                        <div class="col-md-2 payment-link-para">
                           <img src="{{ url('/') }}/payment_link_section/img/congrts.jpg" class="img-responsive">
                           <h5>UPI Payment Link</h5>
                           <p>Collect UPI payments from your customers, using UPI payment links, without knowing their UPI/VPA addresses.</p>
                           <div class="payment-link-btn">
                              <hr class="border-top">
                              <a class="btn-linkk" href="#">Create now</a>
                           </div>
                        </div>
                        <div class="col-md-4">
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