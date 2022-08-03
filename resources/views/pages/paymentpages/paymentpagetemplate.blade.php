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
                  <div class="page-action"><button type="button" class="Button--header Button--transparent Button" style="color: rgb(255, 255, 255);"><i class="i i-receipt"></i><span>Payment Receipts</span></button><button type="button"  onclick="open_setting_modal()" class="Button--header Button--transparent Button" style="color: rgb(255, 255, 255);"><i class="i i-settings-outline"></i><span>Page Settings</span></button><button disabled="" class="hidden-xs Button--primary Button">Create and Publish Page</button><span class="close-btn-temp"><a href="{{ route('payment-pages') }}">×</a></span></div>
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
                           <div class="form-group row">
                              <label for="inputbusiness1" class="col-sm-3 col-form-label">Amount</label>
                              <div class="col-sm-1"></div>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control name-text" id="exampleInputname1"  placeholder="Ruppes Field">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="inputbusiness1" id="email_label" class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-1"></div>
                              <div class="col-sm-8">                                
                                 <a data-toggle="modal" data-target="#modal1" onclick="change_label_name('email')"><input type="email" name="email" id="fb_link" class="form-control name-text"></a>
                                    <input type="hidden" name="label[]" value="email" id="email_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                    <input type="hidden" name="labelTypevalue[]" value="">
                              </div>
                           </div>
                              <div class="form-group row">
                                 <label for="inputbusiness1" id="phone_label" class="col-sm-3 col-form-label">Phone</label>
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-8">
                                    <a data-toggle="modal" data-target="#modal1" onclick="change_label_name('phone')"><input name="email" id="fb_link" type="text" class="form-control"></a>
                                    <input type="hidden" name="label[]" value="phone" id="phone_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                    <input type="hidden" name="labelTypevalue[]" value="">                                  
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputbusiness1" class="col-sm-3 col-form-label">Add new</label>
                                 <div class="col-sm-1"></div>
                                 <div class="col-sm-4">
                                    <select class="form-control" name="input_field_type" id="input_field_type" onchange="create_new_field()">
                                        <option value="" disabled selected>Input Field</option>
                                        <option value="single_line_text">Single Line Text</option>
                                        <option value="alphabet">Alphabet</option>
                                        <option value="alpha_numeric">Alpha Numeric</option>
                                        <option value="number">Number</option>
                                        <option value="email">Email</option>
                                        <option value="phno">Phone Number</option>
                                        <option value="link">Link/Url</option>
                                        <option value="textarea">Large Textarea</option>
                                        <option value="pincode">Pincode</option>
                                        <option value="dropdown">Dropdown</option>
                                        <option value="datepicker">Datepicker</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-4">
                                    <select class="form-control" name="input_field_price_type" id="input_field_price_type" onchange="create_new_field_price()">
                                        <option value="" disabled selected>Price Field</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="decide">Customer Decide Amount</option>
                                        <option value="itemwithquantity">Item with quantity</option>
                                    </select>
                                 </div>
                                 <br />
                                 <br />
                                 <br />
                                 <span id="append_field"></span>
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


      
      <div id="modal1" class="modal" tabindex="-1" role="dialog" style="z-index: 99999;">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 50px;">
                <h5 class="modal-title">Change Label Text</h5>              
            </div>
            <br />
            <div class="modal-body">
                <input type="text" class="form-control" id="label_to_be_given" required placeholder="Enter Label Text">
                <br />
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-warning" onclick="change_label_process()">Change Label</a></span>
            </div>
            <br />
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
         </div>        
      </div>

      <div id="modal2" class="modal" tabindex="-1" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 50px;">
                <h5 class="modal-title">Add Field</h5>               
            </div>
            <br />
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_to_be_given" required placeholder="Enter Label Text">
                <br />
                <input type="text" class="form-control" disabled placeholder="To be filled by customer">
                <br />
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_field_process()">Add</a></span>
            </div>
            <br />
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
      </div>


      <div id="modal3" class="modal" tabindex="-1" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 70px;">
                <h5 class="modal-title">Add Price Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br />
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_price_to_be_given" required placeholder="Enter Label Text">
                <br />
                <input type="text" class="form-control" id="modal_fixed_price" disabled placeholder="To be filled by customer">
                <br />
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_price_field_process()">Add</a></span>
            </div>
            <br />
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
      </div>

      <div id="modal4" class="modal" tabindex="-1" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 50px;">
                <h5 class="modal-title">Add Price Field</h5>               
            </div>
            <br />
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_fix_price_to_be_given" required placeholder="Enter Label Text">
                <br />
                <input type="text" class="form-control" placeholder="Enter Price" id="fix_price_to_be_given">
                <br />
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_price_field_process2()">Add</a></span>
            </div>
            <br />
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
      </div>


      <div id="modal5" class="modal" tabindex="-1" role="dialog" style="z-index: 99999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 50px;">
                <h5 class="modal-title">Add Price Field</h5>              
            </div>
            <br />
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_fix_price_with_qty_to_be_given" required placeholder="Enter Label Text">
                <br />
                <input type="text" class="form-control" placeholder="Enter Price" id="fix_price_with_qty_to_be_given">
                <br />
                <input type="number" class="form-control" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given">
                <br />
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-sm btn-info" onclick="add_price_field_process3()">Add</a></span>
            </div>
            <br />
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
      </div>


      <div id="setting_modal" class="modal" tabindex="-1" role="dialog" style="z-index: 9999;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #2f3445; height: 50px;">
                <h5 class="modal-title">Settings</h5>               
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Custom Url</label>
                            <input type="text" class="form-control" placeholder="Custom Url" id="custom_url" name="custom_url">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <select class="form-control" name="theme" id="theme">
                                <option value="" disabled selected>Select Theme</option>
                                <option value="dark">Dark</option>
                                <option value="light">Light</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Page Expiry</label><br>
                            <select class="form-control" id="is_expiry" name="show_c_msg">
                                <option value="" disabled selected>Is Expiry?</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <br>
                            <input type="date" class="form-control" id="expiry" name="expiry">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="first_name">After A Successful Payment</label><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" id="show_c_msg" name="show_c_msg">
                                        <option value="" disabled selected>Show Custom Message</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <textarea class="form-control" id="custom_msg_area" style="display:none;" name="custome_message_area"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" id="red_to_web" name="red_to_web">
                                        <option value="" disabled selected>Redirect to a website</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <input type="text" id="redirect_to_website" placeholder="Redirect To Website" style="display:none;" name="redirect_to_website" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Plugins and Ad-ons</label><br>
                            <input type="text" class="form-control" placeholder="Facebook Pixel" id="facebook_pixel" name="facebook_pixel">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Google Analytics Id" id="google_analytics" name="google_analytics">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #2f3445;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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


         function open_setting_modal(){
            $("#setting_modal").modal('show');
            var s_modal = document.getElementById("setting_modal");
            s_modal.style.display = "block";
         }


         function change_label_name(label){
            $("#label_to_be_given").val('');
            $("#btn-container").html('<a href="javascript:void(0)" class="btn btn-md btn-info" onclick="change_label_process(\''+label+'\')">Change Label</a>');
         }

         function change_label_process(label){
            var label_to_be_given = $("#label_to_be_given").val();
            $("#"+label+"_label").html(label_to_be_given);
            $("#"+label+"_label_value").val(label_to_be_given);
            $('#modal1').modal('hide');
         }

         function create_new_field(){
            $("#label_new_to_be_given").val('');
            $('#modal2').modal('show');
         }

         function add_field_process(){
            var input_field_type = $("#input_field_type").val();


            if(input_field_type=='textarea'){
               var label_val = 'textarea';
            }
            else if(input_field_type=='single_line_text'){
               var label_val = 'text';
            }
            else if(input_field_type=='alphabet'){
               var label_val = 'text';
            }
            else if(input_field_type=='alpha_numeric'){
               var label_val = 'text';
            }
            else if(input_field_type=='number'){
               var label_val = 'number';
            }
            else if(input_field_type=='email'){
               var label_val = 'email';
            }
            else if(input_field_type=='phno'){
               var label_val = 'number';
            }
            else if(input_field_type=='link'){
               var label_val = 'text';
            }
            else if(input_field_type=='pincode'){
               var label_val = 'number';
            }
            else if(input_field_type=='dropdown'){
               var label_val = 'select';
            }
            else if(input_field_type=='datepicker'){
               var label_val = 'date';
            }



            var label_to_be_given = $("#label_new_to_be_given").val();
            var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="col-sm-12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="'+label_val+'"><input type="hidden" name="labelTypevalue[]" value=""></div></span>';
            $("#append_field").append(html);
            $('#modal2').modal('hide');
         }

         function delete_field(label){
            $("#new_label_id"+label).hide();
         }

         function create_new_field_price(){
            var input_field_price_type = $("#input_field_price_type").val();
            if(input_field_price_type=='decide'){
               $('#modal3').modal('show');
            }
            else if(input_field_price_type=='fixed'){
               $('#modal4').modal('show');
            }
            else{
               $('#modal5').modal('show');
            }
         }


         function add_price_field_process2(){
            var label_to_be_given = $("#label_new_fix_price_to_be_given").val();
            var modal_fixed_price = $("#fix_price_to_be_given").val();
            var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="col-sm-12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value="'+modal_fixed_price+'"></div></span>';
            $("#append_field").append(html);
            $('#modal4').modal('hide');
         }

         function add_price_field_process(){
            var label_to_be_given = $("#label_new_price_to_be_given").val();
            var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="col-sm-12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value=""></div></span>';
            $("#append_field").append(html);
            $('#modal3').modal('hide');
         }


         function add_price_field_process3(){
            var label_to_be_given = $("#label_new_fix_price_with_qty_to_be_given").val();
            var modal_fixed_price = $("#fix_price_with_qty_to_be_given").val();
            var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="col-sm-12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="number" class="validate" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given"><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value="'+modal_fixed_price+'"><input type="hidden" name="labelpricetypeqty[]" value="number"></div></span>';
            $("#append_field").append(html);
            $('#modal5').modal('hide');
         }


         function open_setting_modal(){
            $("#setting_modal").modal('show');
         }


         $("#show_c_msg").change(function(){
         if(this.value=='yes'){
            $("#custom_msg_area").show();
         }
         else{
            $("#custom_msg_area").hide();
         }
         }); 


         $("#red_to_web").change(function(){
         if(this.value=='yes'){
            $("#redirect_to_website").show();
         }
         else{
            $("#redirect_to_website").hide();
         }
         }); 


         function save_payment_page(){
            var template_id = $("#template_id").val();
            var custom_url = $("#custom_url").val();
            var theme = $("#theme").val();
            var expiry = $("#expiry").val();
            var is_expiry = $("#is_expiry").val();
            var show_c_msg = $("#show_c_msg").val();
            var custom_msg_area = '';
            var redirect_to_website = '';
            if(show_c_msg=='yes'){
               var custom_msg_area = $("#custom_msg_area").val();
            }
            var red_to_web = $("#red_to_web").val();
            if(red_to_web=='yes'){
               var redirect_to_website = $("#redirect_to_website").val();
            }
            var facebook_pixel = $("#facebook_pixel").val();
            var google_analytics = $("#google_analytics").val();
            $.ajax({
               url: '{{url("savepaymentpage")}}',
               data: $("#payment-page-form").serialize()+"&template_id="+template_id+"&custom_url="+custom_url+"&theme="+theme+"&expiry="+expiry+"&custom_msg_area="+custom_msg_area+"&redirect_to_website="+redirect_to_website+"&facebook_pixel="+facebook_pixel+"&google_analytics="+google_analytics,
               type: "POST",
               headers: {
                     'X-CSRF-Token': '{{ csrf_token() }}',
               },
               success: function(data){
                     if(data.success==1){
                        alert('Payment Page Saved');
                        window.location.href = "{{ url('payment-pages')}}";
                     }else{
                        alert('Oops!something error happened');
                     }
               }
            });
         }

      </script>
   </body>
</html>