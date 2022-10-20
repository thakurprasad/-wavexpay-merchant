@extends('newlayout.app')

{{-- page title --}}
@section('title','User Profile')

{{-- page content --}}
@section('content')
<div class="section">
  <div class="card">
    <div class="card-content">
      @include('alerts.message')
      <ul class="nav nav-tabs">
        <li id="generalli"><a id="gsettingclick" data-toggle="tab" href="#home">Profile</a></li>
        <li id="tbli"><a id="tbclick" data-toggle="tab" href="#menu2">Trusted Badge</a></li>
        <li id="cli"><a id="cclick" data-toggle="tab" href="#menu3">Credits</a></li>
        <li id="bli"><a id="bliclick" data-toggle="tab" href="#menu4">Balances</a></li>
        <li id="bli"><a id="bliclick" data-toggle="tab" href="#menu5">Manage Team</a></li>
        <li id="mtli"><a id="mtclick" data-toggle="tab" href="#menu6">Support Tickets</a></li>
      </ul>
      <div class="tab-content">

        <div id="home" class="tab-pane active">
          <div class="row">                         
            <div class="col-md-12">
              <table class="table table-striped"> 
                <tbody>
                  {!! Form::model($merchant_details, ['id' => 'merchant_edit_form1', 'method' => 'POST','url' => ['merchant_general_update', Crypt::encryptString($merchant_details->id) ]]) !!}
                  <tr><td colspan="2" class="headingRow">Merchant ID : {{$merchant_details->access_salt}}</td></tr>
                  <tr>
                    <td>Contact Name</td>
                    <td>{{ $merchant_details->contact_name }}</td>
                  </tr>
                  <tr>
                    <td>Display Name</td>
                    <td><span id="display_name_container">{{$merchant_details->display_name}}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('display_name')">edit</i>
                    {!! Form::text('display_name', null, array('id' => 'display_name', 'placeholder' => 'Display Name','class' => 'form-control', 'style' => 'display:none;')) !!}
                    <button style="display: none;" id="update_button_display_name" type="button" onclick="form_submit_general()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_display_name" onclick="hide_input('display_name')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Contact Email</td>
                    <td>{{ $merchant_details->email }}</td>
                  </tr>
                  <tr>
                    <td>Contact Number</td>
                    <td><span id="contact_number_container">{{ $merchant_details->contact_phone }}</span> &nbsp;&nbsp; <i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('contact_phone')">edit</i>
                    {!! Form::text('contact_phone', null, array('id' => 'contact_phone', 'placeholder' => 'Contact Phone','class' => 'form-control', 'style' => 'display:none;')) !!}
                    <button style="display: none;" id="update_button_contact_phone" type="button" onclick="form_submit_general()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_contact_phone" onclick="hide_input('contact_phone')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Business Type</td>
                    <td>Proprietorship</td>
                  </tr>
                  <tr>
                    <td>Registration Date</td>
                    <td>{{ $merchant_details->created_at }}</td>
                  </tr>
                  <tr>
                    <td><strong>Account Activation</strong></td>
                    <td><a href="#">View Activation Form</a></td>
                  </tr>
                  <tr>
                    <td>Account Activated On</td>
                    <td>{{ $merchant_details->updated_at }}</td>
                  </tr>
                  <tr>
                    <td>Account Access</td>
                    <td>Complete</td>
                  </tr>
                  <tr>
                    <td>Business Website/App details</td>
                    <td><a href="www.example.com">https://www.example.com</a></td>
                  </tr>
                  <tr>
                    <td>Additional Business Website/App</td>
                    <td>--</td>
                  </tr>
                  <tr>
                    <td>Limit per transaction</td>
                    <td>₹ 5,00,000.00 &nbsp;&nbsp;<i class="fas fa-edit">edit</i></td>
                  </tr>
                  {!! Form::close() !!}

                  {!! Form::model($merchant_details, ['id' => 'merchant_edit_form', 'method' => 'POST','url' => ['merchant_details_update', Crypt::encryptString($merchant_details->id) ]]) !!}
                  <tr><td colspan="2" class="headingRow">Business Details</td></tr>
                  <tr>
                    <td>PAN Holder Name</td>
                    <td>{{ $merchant_details->pan_holder_name }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('pan_holder_name')">edit</i>{!! Form::text('pan_holder_name', null, array('id' => 'pan_holder_name', 'placeholder' => 'Pan Holder Name','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_pan_holder_name" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_pan_holder_name" onclick="hide_input('pan_holder_name')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Billing Label</td>
                    <td>{{ $merchant_details->billing_label }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_label')">edit</i>{!! Form::text('billing_label', null, array('id' => 'billing_label', 'placeholder' => 'Billing Label','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_billing_label" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_billing_label" onclick="hide_input('billing_label')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Billing Address</td>
                    <td>{{ $merchant_details->billing_address }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_address')">edit</i>{!! Form::text('billing_address', null, array('id' => 'billing_address', 'placeholder' => 'Billing Address','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_billing_address" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_billing_address" onclick="hide_input('billing_address')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Billing City</td>
                    <td>{{ $merchant_details->billing_city }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_city')">edit</i>{!! Form::text('billing_city', null, array('id' => 'billing_city', 'placeholder' => 'Billing City','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_billing_city" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_billing_city" onclick="hide_input('billing_city')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Billing State</td>
                    <td>{{ $merchant_details->billing_state }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_state')">edit</i>{!! Form::text('billing_state', null, array('id' => 'billing_state', 'placeholder' => 'Billing State','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_billing_state" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_billing_state" onclick="hide_input('billing_state')">cancel</a></td>
                  </tr>
                  <tr><td colspan="2" class="headingRow">GST Details</td></tr>
                  <tr>
                    <td>GST No.</td>
                    <td>{{ $merchant_details->gst_no }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('gst_no')">edit</i>{!! Form::text('gst_no', null, array('id' => 'gst_no', 'placeholder' => 'GST NO','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_gst_no" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_gst_no" onclick="hide_input('gst_no')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Razorpay GST No</td>
                    <td>{{ $merchant_details->razorpay_gst_no }}</td>
                  </tr>
                  <tr><td colspan="2" class="headingRow">Bank Account</td></tr>
                  <tr>
                    <td>Bneficiary Name</td>
                    <td>{{ $merchant_details->beneficiary_name }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('beneficiary_name')">edit</i>{!! Form::text('beneficiary_name', null, array('id' => 'beneficiary_name', 'placeholder' => 'Beneficiary Name','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_beneficiary_name" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_beneficiary_name" onclick="hide_input('beneficiary_name')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Account Number</td>
                    <td>{{ $merchant_details->account_number }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('account_number')">edit</i>{!! Form::text('account_number', null, array('id' => 'account_number', 'placeholder' => 'Account Number','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_account_number" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_account_number" onclick="hide_input('account_number')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>Ifsc Code</td>
                    <td>{{ $merchant_details->ifsc_code }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('ifsc_code')">edit</i>{!! Form::text('ifsc_code', null, array('id' => 'ifsc_code', 'placeholder' => 'Ifsc Code','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_ifsc_code" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_ifsc_code" onclick="hide_input('ifsc_code')">cancel</a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>User Name</td>
                    <td>{{ $merchant_details->name }}</td>
                  </tr>
                  <tr>
                    <td>Login Email</td>
                    <td>{{ $merchant_details->email }}</td>
                  </tr>
                  <tr>
                    <td>Role</td>
                    <td>Owner</td>
                  </tr>
                  {!! Form::close() !!}
                </tbody>
              </table>
            </div>    
          </div>
        </div>

        <div id="menu2" class="tab-pane">
          <div class="row">                         
            <div class="col-md-6" style="font-weight: 900;font-size: 28px;line-height: 36px;color: #0d2462;font-family: Lato; margin-top:20px;padding-left: 40px;">
              <h5 >Join the Waitlist And Be A Wavexpay <br clear="all">Trusted Business Soon!!</h5>
              <p style="font-weight: 600;font-size: 18px;margin-top: 8px;line-height: 23px;color: #777b89;padding-left: 20px;">What Does The Batch Stand For</p>
              <ul>
                <li style="display: flex;position: relative;align-items: flex-start;font-size: 16px;line-height: 140%;margin-bottom: 18px;padding-left: 20px;color: rgba(81,89,120,0.9);">It is a sign of quality and trust</li>
                <li style="display: flex;position: relative;align-items: flex-start;font-size: 16px;line-height: 140%;margin-bottom: 18px;padding-left: 20px;color: rgba(81,89,120,0.9);">It shows your commitment to serving your customers</li>
                <li style="display: flex;position: relative;align-items: flex-start;font-size: 16px;line-height: 140%;margin-bottom: 18px;padding-left: 20px;color: rgba(81,89,120,0.9);">It will be 100% free of cost on checkout once live</li>
              </ul>
              <button class="Button--primary Button">Join the waitlist</button>
            </div>    
            <div class="col-md-6">
              <img src="https://cdn.razorpay.com/dashboard/dist/css/assets/trustedbadge/not_eligible_waitlisted_delisted.svg" class="intro-image">
            </div> 
          </div>
        </div>

        <div id="menu3" class="tab-pane">
          <div class="row">  
            <div class="col-md-2"></div>                       
            <div class="col-md-8" style="padding-top:20px;">

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title">Amount Credits  <button style="float:right;" class="btn btn-sm btn-primary">Apply Coupon Code</button></h5>
                  <h6 class="card-subtitle mb-2 text-muted">₹ 0.00 </h6>
                  <p class="card-text">Transactions worth amount credits will be free of any transaction fee..</p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title">Fee Credits  <button style="float:right;" class="btn btn-sm btn-primary">Add Free Credits</button></h5>
                  <h6 class="card-subtitle mb-2 text-muted">₹ 0.00 </h6>
                  <p class="card-text">Get your transactions settled in full. Transaction charges will be deducted from fee credits..</p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title">Refund Credits  <button style="float:right;" class="btn btn-sm btn-primary">Add Refund Credits</button></h5>
                  <h6 class="card-subtitle mb-2 text-muted">₹ 0.00 </h6>
                  <p class="card-text">Do not want to refund from your settled amounts? Use refund credits.</p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>

            </div>    
            <div class="col-md-2"></div>
          </div>
        </div>

        <div id="menu4" class="tab-pane">
          <div class="row">                         
            <div class="col-md-2"></div>                       
            <div class="col-md-8" style="padding-top:20px;">

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title">Credit Balance <button style="float:right;" class="btn btn-sm btn-primary">Add Funds</button></h5>
                  <h6 class="card-subtitle mb-2 text-muted">₹ 0.00 </h6>
                  <p class="card-text">Add funds to your reserve balance to increase the negative balance limit. Thinking of withdrawing your reserve balance? <a href="#">contact us</a></p>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title">Reserve Balance  <button style="float:right;" class="btn btn-sm btn-primary">Add Funds</button></h5>
                  <h6 class="card-subtitle mb-2 text-muted">₹ 0.00 </h6>
                  <p class="card-text">Add funds to your account to process refunds/transfers when the account balance goes low. Adding large funds to your account? <a href="#">contact us</a></p>
                </div>
              </div>

              

            </div>    
            <div class="col-md-2"></div>    
          </div>
        </div>

        <div id="menu5" class="tab-pane">
          <div class="row">                         
            <div class="col-md-2"></div>                       
            <div class="col-md-8" style="padding-top:20px;">

              <div class="card shadow mb-4">
                <div class="card-body">
                  <h5 class="card-title"><strong>2-Step verification to the team</strong>  <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-height="25" data-width="80"></h5>
                  <p class="card-text">2-step verification will be enforced to all the team members who have access to this Dashboard.
                  <strong>Note:</strong> This setting requires 2-step verification set up on your account.</p>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Email</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody id="table_container">
                      <tr>
                        <td colspan="2">No Data Found</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card shadow mb-4">
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Member</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody id="table_container">
                      <tr>
                        <td>{{$merchant_details->merchant_name}}</td>
                        <td>{{$merchant_details->contact_phone}}</td>
                        <td>Owner</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>    
            <div class="col-md-2"></div>    
          </div>
        </div>

        <div id="menu6" class="tab-pane">
          <div class="row">                         
            <div class="col-md-12">
              Support Tickets
            </div>    
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<!--<div class="modal" id="modal1" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 20px;">
      <div class="modal-header">
        <h5 class="modal-title">Aadhar front image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row text-center">
          <img id="aadhar_front_image_container" src="#" alt="your image"  style="height:300px; width:300px;" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal2" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 20px;">
      <div class="modal-header">
        <h5 class="modal-title">Aadhar Back image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row text-center">
          <img id="aadhar_back_image_container" src="#" alt="your image"  style="height:300px; width:300px;" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->
@endsection


@section('page-style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
$(document).ready(function() {
    $("#gsettingclick").click();

    
    $('#toggle-one').bootstrapToggle();
});


$('#ksettingclick').click(function() {
  $("#generalli").css("background-color", "#00008B");
});

$('#ksettingclick').click(function() {
  $("#kycli").css("background-color", "#00008B");
});



$(function(){
    $('#display_name_change_button').click(function() {
      var merchant_id = $("#merchant_id").val();
      var display_name = $("#display_name").val();
      if(confirm('Are You Sure To Change Display name?')){
        $.ajax({
            url: '{{url("changedisplayname")}}',
            data: {'merchant_id':merchant_id,'display_name':display_name},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
              if(data.success==1){
                  $('#displayNameModal').modal('hide');
                  $("#display_name_container").html(display_name);
                  $("#hidden_display_name").val(display_name);
              }
            }
        });
      }
    });

    $('#contact_number_change_button').click(function() {
      var merchant_id = $("#merchant_id").val();
      var contact_number = $("#contact_number").val();
      if(confirm('Are You Sure To Change Contact Number?')){
        $.ajax({
            url: '{{url("changecontactnumber")}}',
            data: {'merchant_id':merchant_id,'contact_number':contact_number},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
              if(data.success==1){
                  $('#contactNumberModal').modal('hide');
                  $("#contact_number_container").html(contact_number);
                  $("#hidden_contact_number").val(contact_number);
              }
            }
        });
      }
    });
});

function setDisplayName()
{
  var display_name = $("#hidden_display_name").val();
  $("#display_name").val(display_name);
}

function setContactNumber()
{
  var contact_number = $("#hidden_contact_number").val();
  $("#contact_number").val(contact_number);
}



$("#aadhar_front_image").change(function(){
    readURL(this);
});

$("#aadhar_back_image").change(function(){
    readURL2(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e1) {
            $('#blah').attr('src', e1.target.result);
            $("#modal1").modal('show');
            $('#aadhar_front_image_container').attr('src', e1.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    $('#update_button_aadhar_front').show();
}

function readURL2(input) {
    if (input.files && input.files[0]) {
      var reader2 = new FileReader();

      reader2.onload = function (e2) {
          $('#blah2').attr('src', e2.target.result);
          $("#modal2").modal('show');
          $('#aadhar_back_image_container').attr('src', e2.target.result);
      }
      reader2.readAsDataURL(input.files[0]);
    }
    $('#update_button_aadhar_back').show();
}

function show_input(input_id)
{
  $("#"+input_id).show();
  $("#cancel_"+input_id).show();
  $("#update_button_"+input_id).show();
}


function hide_input(input_id)
{
  $("#"+input_id).hide();
  $("#cancel_"+input_id).hide();
  $("#update_button_"+input_id).hide();
}




function form_submit()
{
  $("#merchant_edit_form").submit();
}

function form_submit_general()
{
  $("#merchant_edit_form1").submit();
}

</script>
@endsection