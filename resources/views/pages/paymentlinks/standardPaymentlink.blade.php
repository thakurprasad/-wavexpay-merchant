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
      <link href="{{ url('/') }}/payment_link_popup/css/style.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
      <div class="container">
         <div class="row">
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" style="display:none;">Open Modal</button>
            <!-- The Modal -->
            <div id="myModal" class="modal">
               <!-- Modal content -->
               <div class="modal-dialog" role="document">
                  <div class="modal-content" style="width: 600px;">
                     <div class="modal-header" style="background-color: #337ab7;height: 50px;">
                        <h5 class="modal-title">New Payment Link</h5>                   
                     </div>
                     <div class="modal-body">
                     <form id="form-create-payment-link" method="post">
                           <div class="row" id="clid">
                              <input type="hidden" id="show_hide_status" name="show_hide_status" value="hide">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Payment For <For></For></label>
                                       <input placeholder="Payment Description" name="payment_description" id="payment_description" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Amount*</label>
                                       <input placeholder="Amount" name="amount" id="amount" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <input placeholder="Reference Id" name="reference_id" id="reference_id" type="hidden" class="form-control" value="{{ rand(10000,20000) }}">

                              <div class="col-sm-12">
                                 <div class="form-group">
                                       <span id="show_hide_advanced_info">
                                          <button class="btn btn-info btn-sm" type="button" onclick="show_advanced_info()">
                                             + Show Advanced Information
                                          </button>
                                       </span>
                                 </div>
                              </div>

                              <div class="row" id="details_span" style="margin-left: 10px; margin-right: 10px; display:none;">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Reference Id <For></For></label>
                                       <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Customer Name <For></For></label>
                                       <input placeholder="Customer Name" name="customer_name" id="customer_name" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Customer Email <For></For></label>
                                       <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Customer Contact <For></For></label>
                                       <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Notify Via Email</label>
                                       <select class="form-control" name="notify_via_email" id="notify_via_email">
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Notify Via SMS</label>
                                       <select class="form-control" name="notify_via_sms" id="notify_via_sms">
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Expiry?</label>
                                       <select class="form-control" name="isexpiry" id="isexpiry" onchange="setexpirydate()">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Expiry <For></For></label>
                                       <input name="expiry_date" id="expiry_date" type="date" class="form-control" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                       <label for="first_name">Partial Payments?</label>
                                       <select class="form-control" name="partial_paymet" id="partial_paymet">
                                          <option value="">Select</option>
                                          <option value="yes">Yes</option>
                                          <option value="no">No</option>
                                       </select>
                                 </div>
                              </div>
                              </div>

                              <div class="col-sm-12">
                                 <div class="form-group">
                                       <a class="waves-effect waves-light" style="cursor:pointer;" onclick="add_notes()"><strong>+ Add Notes</strong></a>
                                       <span id="add_note_container">
                                       </span>
                                       <span id="afetr_edit_note_container"></span>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="form-group">
                                       <button class="btn btn-primary" type="button" onclick="create_payment_link()">create</button>
                                 </div>
                              </div>
                           </div>
                     </form>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
      <script type="text/javascript">
         function addTextArea(){
             var div = document.getElementById('div_quotes');
             div.innerHTML += "<textarea name='new_quote[]' />";
             div.innerHTML += "\n<br />";
         }

         $( document ).ready(function() {
            var btn = document.getElementById("myBtn");
            btn.click();
        });


      function show_advanced_info(){
         $("#details_span").show();
         $("#show_hide_status").val('show');
         $("#show_hide_advanced_info").html('<button class="btn btn-info btn-sm" type="button" onclick="hide_advanced_info()"> - Hide Advanced Information</button>');
      }

      function hide_advanced_info(){
         $("#details_span").hide();
         $("#show_hide_status").val('hide');
         $("#show_hide_advanced_info").html('<button class="btn btn-info btn-sm" type="button" onclick="show_advanced_info()"> + Show Advanced Information</button>');
      }

      var count=1;
      function add_notes(){
         var html = '<div class="row" id="note_div'+count+'"><div class="col-sm-4"><div class="form-group"><input placeholder="Note Title" name="note_title[]" id="note_title" type="text" class="form-control" required></div></div><div class="col-sm-6"><div class="form-group"><textarea name="note_desc[]" class="form-control" placeholder="Note Description"></textarea></div></div><div class="col-sm-2"><div class="form-group"><a style="cursor:pointer;" onclick="cancel_div(\''+count+'\')">Cancel</a></div></div></div>';
         $("#add_note_container").append(html);
         count++;
      }

      function cancel_div(count){
         $("#note_div"+count).remove();
      }


      function create_payment_link(){
         $("#clid").LoadingOverlay("show", {
            background  : "rgba(165, 190, 100, 0.5)"
         });
         $.ajax({
            url: '{{url("createpaymentlink")}}',
            data: $("#form-create-payment-link").serialize(),
            type: "POST",
            headers: {
                  'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
               if(data.success==1){
                  swal("Successful!", "Payment Link Created!", "success");
                  $("#clid").LoadingOverlay("hide", true);
                  $("#form-create-payment-link")[0].reset();
                  setTimeout(function () {
                     window.location.href = "{{ route('payment-links')}}";
                  }, 2500); 
               }
            }
         });
      }
      </script>
   </body>
</html>