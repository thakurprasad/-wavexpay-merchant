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
      <link href="{{ url('/') }}/dashboard-signup/css/style.css" rel="stylesheet" type="text/css"/>
      <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </head>
   <body>
      <div class="container">
      <div class="row">
        
         <!-- Trigger/Open The Modal -->
         <button id="myBtn" style="display:none;">Open Modal</button>
         <!-- The Modal -->
         <div id="myModal" class="modal">
            <!-- Modal content -->           
            <div class="modal-content popup-wavex-form">
               <div class="row">
                  <div class="col-md-12">
                     <span class="close white">&times;</span>
                     <!-- Sidebar --->
                     <div class="col-md-3 sidebarwave">
                        <div class="left-sidebarwave">
                           <h4>KYC Form</h4>
                           <p>Complete and submit the form to accept payment</p>
                           <div class="tab">
                              <button class="tablinks" onclick="openCity(event, 'Contact')" id="defaultOpen">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                 </svg>
                                 Contact Info
                              </button>
                              <button class="tablinks" onclick="openCity(event, 'Business')" id="defaultOpenTwo">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                 </svg>
                                 Business Overview
                              </button>
                              <button class="tablinks" onclick="openCity(event, 'Details')" id="defaultOpenThree">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                 </svg>
                                 Business Details
                              </button>
                              <button class="tablinks" onclick="openCity(event, 'Document')" id="defaultOpenFour">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                 </svg>
                                 Document verification
                              </button>
                           </div>
                        </div>
                     </div>
                     <!--Main element-->
                     <form id="complete_sign_up_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="merchant_id" name="merchant_id" value="{{$merchant_id}}">
                        <div class="col-md-9 gray-wave tabcontent" id="Contact" >
                           <div class="form-data">
                              <h4>PERSONEL BANK ACCOUNT</h4>
                              
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Beneficiary Name*</label>
                                    <div class="col-sm-6">
                                       <input type="text" name="beneficiary_name" class="form-control name-text" id="beneficiary_name" value="" placeholder="Enter name">
                                       <small id="nameHelp" class="form-text text-muted">We will deposit small amount of money in your account to verify the account.</small>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Branch IFSC code*</label>
                                    <div class="col-sm-6">
                                       <input type="text" name="ifsc_code" class="form-control name-text" id="ifsc_code"  value="" placeholder="Enter code">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Account Number*</label>
                                    <div class="col-sm-6">
                                       <input type="text" name="account_number" class="form-control name-text" id="account_number"  value="" placeholder="Enter number">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Re Enter Account Number*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="confirm_account_number" class="form-control name-text" id="exampleInputname1"  placeholder="Enter number">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                              
                           </div>
                           <div class="bottom-footer-kyc">
                              <div class="col-md-8"></div>
                              <div class="col-md-4">
                                 <!--<a class="btn btn-md btn-info" href="#">Save</a>--> <a class="btn btn-md btn-primary" onclick="openCity(event, 'Business')">Save & Next</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-9 gray-wave tabcontent" id="Business">
                           <div class="form-data">
                              <h4>BUSINESS OVERVIEW</h4>
                              
                                 <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <label for="inputbusiness1" class="col-sm-2 col-form-label text-right">Business Type*</label>
                                    <div class="col-sm-6">
                                       <select class="form-control" id="business_type" name="business_type" id="exampleFormControlSelect1" required>
                                          <option value="notregistered">Not yet Registerd</option>
                                          <option value="registered">Registered</option>
                                       </select>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Business Category*</label>
                                    <div class="col-sm-6">
                                       <select class="form-control" id="business_category" name="business_category" id="exampleFormControlSelect1" required>
                                          <option value="">Select</option>
                                          <option value="proprietorship">Proprietorship</option>
                                          <option value="partnership">Partnership</option>
                                          <option value="privatelimited">Private Limited</option>
                                          <option value="publiclimited">Public Limited</option>
                                          <option value="llp">LLP</option>
                                          <option value="trust">Trust</option>
                                       </select>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Business Description*</label>
                                    <div class="col-sm-6">
                                       <textarea class="form-control" id="business_description" name="business_description" id="textAreaExample1" rows="4" placeholder="Minimum 50 characters" required></textarea>
                                       <small id="textareaHelp" class="form-text text-muted">Please give a brief description of the nature of your business. Please include examples of products you sell, the business category you operate under, your customers and the channels you primarily use to conduct your business(Website, offline retail etc).</small>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">How do you wish to accept payments*</label>
                                    <div class="col-sm-6">
                                       <div class="form-check form-check-inline wave-radio">
                                          <input class="form-check-input" name="accept_payment_by" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" value="without_website_app">
                                          <label class="form-check-label" for="inlineRadio1">Without website/app</label>
                                       </div>
                                       <div class="form-check form-check-inline wave-radio">
                                          <input class="form-check-input" name="accept_payment_by" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" value="with_website_app">
                                          <label class="form-check-label" for="inlineRadio2">On my website/app</label>
                                       </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                                    <div class="col-sm-6">
                                       <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                          <input type="checkbox" name="accept_web_permission" class="custom-control-input" id="customControlInline">
                                          <label class="custom-control-label accept" for="customControlInline">Accept payments on Website</label>
                                       </div>
                                       <input type="text" class="form-control url-text" id="exampleInputurl1"  placeholder="Enter URL" name="payment_web_url">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row space-bottom-payment">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                                    <div class="col-sm-6">
                                       <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                          <input type="checkbox" name="accept_app_permission" class="custom-control-input" id="customControlInline">
                                          <label class="custom-control-label accept" for="customControlInline">Accept payments on app</label>
                                       </div>
                                       <p id="acceptHelp" class="form-text text-muted">We need to verify your website/app to provide you the live API keys. It should contain:</p>
                                       <div class="col-sm-6">
                                          <ul>
                                             <li><a href="#">About Us</a></li>
                                             <li><a href="#">Contact Us</a></li>
                                             <li><a href="#">Pricing</a></li>
                                          </ul>
                                       </div>
                                       <div class="col-sm-6">
                                          <ul>
                                             <li><a href="#">Privacy Policy</a></li>
                                             <li><a href="#">Terms & Conditions</a></li>
                                             <li><a href="#">Cancellation/Refund Policy</a></li>
                                          </ul>
                                       </div>
                                       <div class="col-sm-2"></div>
                                    </div>
                                 </div>
                              
                           </div>
                           <div class="bottom-footer">
                              <div class="col-md-8"></div>
                              <div class="col-md-4">
                              <!--<a class="btn btn-md btn-info" href="#">Save</a>--> <a class="btn btn-md btn-primary"  onclick="openCity(event, 'Details')">Save & Next</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-9 gray-wave tabcontent" id="Details">
                           <div class="form-data">
                              <h4>BUSINESS DETAILS</h4>
                              
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Pan Holder's Name*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="pan_holder_name" name="pan_holder_name" class="form-control name-text" id="exampleInputname1" value="" placeholder="Enter name" required>
                                       <small id="nameHelp" class="form-text text-muted">We verify the deatils with the central Pan database. Please ensure you enter the correct details</small>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Billing Label*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="billing_label" name="billing_label" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter" required>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Address*</label>
                                    <div class="col-sm-6">
                                       <textarea class="form-control" id="billing_address" name="billing_address" id="textAreaExample1" rows="4"  value="" placeholder="Minimum 50 characters" required></textarea>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Pincode*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="billing_pincode" name="billing_pincode" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter Pincode" required>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">City*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="billing_city" name="billing_city" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter city name" required>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">State*</label>
                                    <div class="col-sm-6">
                                       <input type="text" id="billing_state" name="billing_state" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter State Name" required>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                              
                           </div>
                           <div class="bottom-footer-kyc">
                              <div class="col-md-8"></div>
                              <div class="col-md-4">
                                 <!--<div class="custom-control custom-checkbox wave-checkbox-space">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label accept" for="customControlInline">I agree to wavexpay <a hrf="#">Terms & Conditions</a></label>
                                 </div>
                                 <a class="btn btn-md btn-info" href="#">Save</a>--> <a class="btn btn-md btn-primary" onclick="openCity(event, 'Document')">Save & Next</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-9 gray-wave tabcontent" id="Document">
                           <div class="form-data" id="loading_div">
                              <h4>DOCUMENTS VERIFICATION</h4>
                              
                                 <!--<div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Aadhar verification via otp*</label>
                                    <div class="col-sm-6">
                                       <input type="text" name="aadhar_no" class="form-control name-text" id="exampleInputname1"  placeholder="Enter name">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                                    <div class="col-sm-6">
                                       <img src="{{ url('/') }}/dashboard-signup/img/CAPTCHA.jpg" class="captcha img-responsive">
                                       <input type="text" class="form-control name-text" id="exampleInputname1"  placeholder="Enter the captcha code above">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                                    <div class="col-sm-6 otp">
                                       <a class="captcha-btn" href="#">Submit & get OTP</a>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                                    <div class="col-sm-6">
                                       <small id="nameHelp" class="form-text text-muted">OTP will be sent to the number linked to your Aadhar. Enter it on next step to verify.</small>
                                       <div class="custom-control custom-checkbox wave-checkbox-space">
                                          <input type="checkbox" name="link_status" class="custom-control-input" id="customControlInline">
                                          <label class="custom-control-label accept" for="customControlInline">My Aadhar is not link to my number</a></label>
                                       </div>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>-->
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Address Proof*</label>
                                    <div class="col-sm-6">
                                       <select class="form-control" name="address_proof" id="exampleFormControlSelect1">
                                          <option value="aadhar">Aadhar</option>
                                          <option value="passport">Passport</option>
                                          <option value="voter_id">Voter id</option>
                                       </select>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Aadhar Front*</label>
                                    <div class="col-sm-6">
                                       <input type="file" name="aadhar_front" id="myFile" name="filename">
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Aadhar Back*</label>
                                    <div class="col-sm-6">
                                       <input type="file" name="aadhar_back" id="myFile" name="filename">
                                       <small id="nameHelp" class="form-text text-muted">JPG/PNG of max size 2mb or pdf of max size 4mb.</small>
                                    </div>
                                    <div class="col-sm-2"></div>
                                 </div>
                              
                           </div>
                           <div class="bottom-footer-kyc">
                              <div class="col-md-9"></div>
                              <div class="col-md-3">
                                 <a class="btn btn-md btn-primary" onclick="submit_signup_form()">Submit Form</a>
                              </div>
                           </div>
                        </div>
                     </form>
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
      </script>
      <script>
         function openCity(evt, cityName) {
           var i, tabcontent, tablinks;
           tabcontent = document.getElementsByClassName("tabcontent");
           for (i = 0; i < tabcontent.length; i++) {
             if(tabcontent[i].id=='Contact'){
                tabcontent[i].style.display = "block";
             }else{
                tabcontent[i].style.display = "none";
             }
             
           }

           tablinks = document.getElementsByClassName("tablinks");
           for (i = 0; i < tablinks.length; i++) {
             tablinks[i].className = tablinks[i].className.replace(" active", "");
           }

           
           if(cityName=='Business')
           {
                var beneficiary_name = $("#beneficiary_name").val();
                var ifsc_code = $("#ifsc_code").val();
                var account_number = $("#account_number").val();
                var confirm_account_number = $("#confirm_account_number").val();

                /*if(typeof beneficiary_name === 'undefined' || typeof ifsc_code ==='undefined' || typeof account_number ==='undefined')*/
                if(beneficiary_name == '' || ifsc_code == '' || account_number == '')
                {
                    swal("Oops!", "Please fill up all the field", "error");
                    $("#defaultOpen").addClass('active');
                    return false;
                }
                else
                {
                    if(confirm_account_number!=account_number)
                    {
                        swal("Oops!", "Account Number and Confirm Account Number Not Same!!", "error");
                        $("#defaultOpen").addClass('active');
                        return false;
                    }
                    document.getElementById("Contact").style.display = "none";
                    document.getElementById(cityName).style.display = "block";
                    $("#defaultOpenTwo").addClass('active');
                    evt.currentTarget.className += " active";
                }
           }

           if(cityName=='Details')
           {
                var business_type = $("#business_type").val();
                var business_category = $("#business_category").val();
                var business_description = $("#business_description").val();

                /*if(typeof beneficiary_name === 'undefined' || typeof ifsc_code ==='undefined' || typeof account_number ==='undefined')*/
                if(business_type == '' || business_category == '' || business_description == '')
                {
                    swal("Oops!", "Please Fill Up All The Field", "error");
                    $("#defaultOpenTwo").addClass('active');
                    document.getElementById("Business").style.display = "block";
                    document.getElementById("Details").style.display = "none";
                    document.getElementById("Contact").style.display = "none";
                    return false;
                }
                else
                {
                    document.getElementById("Business").style.display = "none";
                    document.getElementById("Contact").style.display = "none";
                    document.getElementById(cityName).style.display = "block";
                    $("#defaultOpenThree").addClass('active');
                    evt.currentTarget.className += " active";
                }
           }

           if(cityName=='Document')
           {
               var pan_holder_name = $("#pan_holder_name").val();
               var billing_label = $("#billing_label").val();
               var billing_address = $("#billing_address").val();
               var billing_pincode = $("#billing_pincode").val();
               var billing_city = $("#billing_city").val();
               var billing_state = $("#billing_state").val();

               if(pan_holder_name == '' || billing_label == '' || billing_address == '' || billing_pincode == '' || billing_city == '' || billing_state == '')
               {
                  swal("Oops!", "Please Fill Up All The Field", "error");
                  $("#defaultOpenThree").addClass('active');
                  document.getElementById("Details").style.display = "block";
                  document.getElementById("Business").style.display = "none";
                  document.getElementById("Contact").style.display = "none";
                  return false;
               }
               else
               {
                  document.getElementById("Business").style.display = "none";
                  document.getElementById("Contact").style.display = "none";
                  document.getElementById("Details").style.display = "none";
                  document.getElementById(cityName).style.display = "block";
                  $("#defaultOpenFour").addClass('active');
                  evt.currentTarget.className += " active";
               }

           }
           
        }
         
         // Get the element with id="defaultOpen" and click on it
         document.getElementById("defaultOpen").click();
         $("#defaultOpen").addClass('active');
         

         $( document ).ready(function() {
            var btn = document.getElementById("myBtn");
            btn.click();
        });


        function submit_signup_form()
        {
            $("#loading_div").LoadingOverlay("show", {
               background  : "rgba(165, 190, 100, 0.5)"
            });

            // Get form
            var form = $('#complete_sign_up_form')[0];
            // Create an FormData object 
            var data = new FormData(form);

            $.ajax({
               url: '{{url("completesignupprocess")}}',
               data: data,
               type: "POST",
               processData: false,
               contentType: false,
               cache: false,
               headers: {
                     'X-CSRF-Token': '{{ csrf_token() }}',
               },
               success: function(data){
                  if(data.success==1){
                     swal("Successful", "Sign Up sucessfully completed", "success");
                     $("#loading_div").LoadingOverlay("hide", true);
                     $("#complete_sign_up_form")[0].reset();
                     setTimeout(function () {
                        window.location.href = "{{ route('welcome_to_wavexpay')}}";
                     }, 2500); 
                  }
               }
            });
        }
      </script>
   </body>
</html>