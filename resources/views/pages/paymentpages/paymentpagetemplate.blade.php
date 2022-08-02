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
      <link href="{{ url('/') }}/payment_page/css/style.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
      <header class="temp-wave1">
         <div class="navebar-temp container-fluid">
            <div class="row page-size">
               <div class="col-md-6 nave-wave">
                  <h4>Create New Payment Page</h4>
               </div>
               <div class="col-md-6">
                  <div class="page-action"><button type="button" class="Button--header Button--transparent Button" style="color: rgb(255, 255, 255);"><i class="i i-receipt"></i><span>Payment Receipts</span></button><button type="button" class="Button--header Button--transparent Button" style="color: rgb(255, 255, 255);"><i class="i i-settings-outline"></i><span>Page Settings</span></button><button disabled="" class="hidden-xs Button--primary Button">Create and Publish Page</button><span class="close-btn-temp">×</span></div>
               </div>
            </div>
         </div>
      </header>
      <div id="root-wave" class="wavexpay-all">
      <div id="desktop-container-wave">
         <div class="content-container-wave container">
            <div class="content-wave row">
               <section class="stage-11">
                  <div class="col-md-12 top-bar-temp">
                     <div class="col-md-6 logo-wave">
                        <div id="header-details-wave">
                           <div id="header-logo-wave">
                              <div class="no-merchant-logo">Add your logo here</div>
                           </div>
                           <div id="merchant-name">WAVEXPAY</div>
                        </div>
                     </div>
                     <div class="col-md-6">
                     </div>
                  </div>
                  <div class="col-md-12 stage-22">
                     <div class="col-md-5">
                        <div class="form-wave">
                           <div class="form-group">
                              <textarea class="temp-wave-name" id="textAreaExample1" rows="4" placeholder="Enter Page title here"></textarea>
                           </div>
                           <div class="goal-tracker-wave tooltip">
                              <a href="#">+ Add a Goal Tracker</a> <i class="fa fa-info-circle"></i> <span class="badge bg-success">NEW</span>
                              <span class="tooltiptext">
                                 <div class="rzp-popover-body">
                                    <div class="rzp-tooltip-title">Whats a Goal Tracker?</div>
                                    Setup and show progress of tangible goals on your Payment Page and help your audience visualise how their contributions are going.<br><br>This can also help convert potential customers and supporters by viewing progess of your goals and existing supporters.
                                 </div>
                              </span>
                           </div>
                           <div class="goal-tracker-wave"><a href="#">+ Add social media share icons</a> </div>
                           <div class="form-group price stage-4 temp-4">
                              <label for="inputEmail4">Customer Details</label>
                              <div class="col-auto">
                                 <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                 <div class="input-group mb-6">
                                    <div class="input-group-prepend">
                                       <div class="input-group-text"><i class="fa fa-envelope icon"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                 </div>
                              </div>
                              <div class="col-auto">
                                 <label class="sr-only" for="inlineFormInputGroup"></label>
                                 <div class="input-group mb-6">
                                    <div class="input-group-prepend">
                                       <div class="input-group-text"><i class="fa fa-phone icon"></i></div>
                                    </div>
                                    <input type="text" class="form-control name-text" id="exampleInputname1"  placeholder="Enter number">
                                 </div>
                              </div>
                           </div>
                           <div class="goal-tracker-wave"><a href="#">+ Add Your Terms and Conditions</a> </div>
                           <p class="teemp-legel">You agree to share information entered on this page with WAVEXPAY (owner of this page) and Razorpay, adhering to applicable laws.</p>
                           <hr>
                           <div class="teemp-legel2">
                              <h4>WAVEXPAY</h4>
                              <p >Want to create page like this for your Business? Visit Razorpay Payment Pages  to get started!</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-1">
                     </div>
                     <div class="col-md-6 stage-3-temp-3">
                        <div  id="main-view" class="slider-view">
                           <h4>Payment Details</h4>
                           <div class="title-underline"></div>
                           <div class="form-group row space-temp2-bottom">
                              <label for="inputbusiness1" class="col-sm-3 col-form-label">Amount</label>
                              <div class="col-sm-1"></div>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control name-text" id="exampleInputname1"  placeholder="Ruppes Field">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="inputbusiness1" class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-1"></div>
                              <div class="col-sm-8">
                                 <input type="email"  class="form-control name-text" id="myBtn">
                                 <div id="myModal" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content temp-email-form">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <!--Main element-->
                                             <div class="col-md-12">
                                                <div class="form-data">
                                                   <span class="close congrts-close">&times;</span>
                                                   <form>
                                                      <div class="form-group row border-in">
                                                         <div class="col-sm-1"></div>
                                                         <label for="inputbusiness1" class="col-sm-3 col-form-label"><input type="text" class="form-control phone-temp-pop" id="exampleInputNumber1"  placeholder="email"></label>
                                                         <div class="col-sm-6">
                                                            <input type="email" class="form-control name-text" id="exampleInputname1"  placeholder="Enter number">
                                                         </div>
                                                         <div class="col-sm-2"></div>
                                                      </div>
                                                      <small>Mandatory email field to be filled by customers. This field cannot be deleted.</small>
                                                   </form>
                                                </div>
                                                <div class="bottom-footer-temp">
                                                   <div class="col-md-9"></div>
                                                   <div class="col-md-3">
                                                      <a class="save-btn-temp" href="#"><span>X</span>Cancel</a> <a class="next-btn-temp" href="#"><span><i class="fa fa-check" aria-hidden="true"></i>
                                                      </span>Save</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                              <div class="form-group row">
                                 <label for="inputbusiness1" class="col-sm-3 col-form-label">Phone</label>
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-8">
                                    <input type="phone" class="form-control name-text" id="myBtn2">
                                    <div id="myModal2" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content temp-email-form">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <!--Main element-->
                                             <div class="col-md-12">
                                                <div class="form-data">
                                                   <span class="close congrts-close">&times;</span>
                                                   <form>
                                                      <div class="form-group row border-in">
                                                         <div class="col-sm-1"></div>
                                                         <label for="inputbusiness1" class="col-sm-3 col-form-label"><input type="text" class="form-control phone-temp-pop" id="exampleInputNumber1"  placeholder="email"></label>
                                                         <div class="col-sm-6">
                                                            <input type="email" class="form-control name-text" id="exampleInputname1"  placeholder="Enter number">
                                                         </div>
                                                         <div class="col-sm-2"></div>
                                                      </div>
                                                      <small>Mandatory email field to be filled by customers. This field cannot be deleted.</small>
                                                   </form>
                                                </div>
                                                <div class="bottom-footer-temp">
                                                   <div class="col-md-9"></div>
                                                   <div class="col-md-3">
                                                      <a class="save-btn-temp" href="#"><span>X</span>Cancel</a> <a class="next-btn-temp" href="#"><span><i class="fa fa-check" aria-hidden="true"></i>
                                                      </span>Save</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 </div>
                              </div>
                              <div class="form-group row space-temp2-bottom">
                                 <label for="inputbusiness1" class="col-sm-3 col-form-label">Add new</label>
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-4">
                                    <input type="phone" class="form-control name-text" id="exampleInputphone1" placeholder="Input Field">
                                 </div>
                                 <div class="col-sm-4">
                                    <input type="phone" class="form-control name-text" id="exampleInputphone1" placeholder="Price Field">
                                 </div>
                              </div>
                           </div>
                           <div class="form-footer-payment">
                              <div class="col-md-6">
                                 <img id="fin-logo" src="{{ url('/') }}/payment_page/img/pay_methods_branding.png" class="img-responsive">
                              </div>
                              <div class="col-md-6 pay-left">
                                 <button class="btn btn-gradient ruppes-btn">Pay <span style="margin-left: 4px;"><b class="currency-symbol">₹</b> 000.00</span></button>
                              </div>
                           </div>
                        </div>
                     </div>
               </section>
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
      </script>
      <script>
         // Get the modal
         var modal = document.getElementById("myModal2");
         
         // Get the button that opens the modal
         var btn = document.getElementById("myBtn2");
         
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
      </script>
   </body>
</html>