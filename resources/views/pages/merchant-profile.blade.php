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
        <li id="generalli"><a id="gsettingclick" data-toggle="tab" href="#home">General Info</a></li>
        <li id="kycli"><a id="ksettingclick" data-toggle="tab" href="#menu1">Kyc Info</a></li>
      </ul>
      <div class="tab-content" style="padding-left:20px;">
        <div id="home" class="tab-pane fade in active">
          <div class="row">      
            {!! Form::model($merchant_details, ['id' => 'merchant_edit_form1', 'method' => 'POST','url' => ['merchant_general_update', Crypt::encryptString($merchant_details->id) ]]) !!}       
              <div class="col-md-12 merchant-kyc">
                <table class="table table-striped merchant-kyc-table"> 
                  <thead>
                    
                  </thead>
                  <tbody>
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
                  </tbody>
                </table>
              </div>    
            {!! Form::close() !!}
          </div>
        </div>
        <div id="menu1" class="tab-pane fade">
        <div class="row">  
            <!--<form method="post" id="merchant_edit_form" action="{{ url('merchant_details_update') }}" enctype="multipart/form-data">-->
            {!! Form::model($merchant_details, ['id' => 'merchant_edit_form', 'method' => 'POST','url' => ['merchant_details_update', Crypt::encryptString($merchant_details->id) ]]) !!}
              
              <div class="col-md-12 merchant-kyc">
                <table class="table table-striped merchant-kyc-table">                 
                  <tbody>
                    <tr><td colspan="2" class="headingRow">Business Overview</td></tr>
                    <tr>
                      <td>Business Name</td>
                      <td>{{ $merchant_details->business_category }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_category')">edit</i>
                      {!! Form::text('business_category', null, array('id' => 'business_category', 'placeholder' => 'Business Category','class' => 'form-control', 'style' => 'display:none;')) !!}
                      <button style="display: none;" id="update_button_business_category" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_business_category" onclick="hide_input('business_category')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Business Type</td>
                      <td>{{ $merchant_details->business_type }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_type')">edit</i>{!! Form::text('business_type', null, array('id' => 'business_type', 'placeholder' => 'Business Type','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_business_type" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_business_type" onclick="hide_input('business_type')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Business Description</td>
                      <td>{{ $merchant_details->business_description }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_description')">edit</i><textarea style="display:none;" class="form-control" name="business_description" id="business_description"></textarea><button style="display: none;" id="update_button_business_description" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_business_description" onclick="hide_input('business_description')">cancel</a></td>
                    </tr>
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
                    <tr><td colspan="2" class="headingRow">Personal Bank Account</td></tr>
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
                    <tr><td colspan="2" class="headingRow">Documents</td></tr>
                    <tr>
                      <td>Aadhar Number</td>
                      <td>{{ $merchant_details->aadhar_no }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('aadhar_no')">edit</i>{!! Form::text('aadhar_no', null, array('id' => 'aadhar_no', 'placeholder' => 'Aadhar No','class' => 'form-control', 'style' => 'display:none;')) !!}<button style="display: none;" id="update_button_aadhar_no" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button><a style="display:none; cursor:pointer;" id="cancel_aadhar_no" onclick="hide_input('aadhar_no')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Aadhar Front Image</td>
                      <td>
                        <input type="file" name="aadhar_front_image" accept="image/*" class="form-control" id="aadhar_front_image">
                        @if(isset($merchant_details->aadhar_front_image) && $merchant_details->aadhar_front_image!='')
                        <img id="blah" src="{{url('/')}}/uploads/aadharimage/{{$merchant_details->aadhar_front_image}}" alt="your image"  style="height:100px; width:100px;" />
                        @else 
                        <img id="blah" src="#" alt="your image"  style="height:100px; width:100px;" />
                        @endif
                        <button style="display: none;" id="update_button_aadhar_front" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Aadhar Back Image</td>
                      <td>
                        <input type="file" name="aadhar_back_image" accept="image/*" class="form-control" id="aadhar_back_image">
                        @if(isset($merchant_details->aadhar_back_image) && $merchant_details->aadhar_back_image!='')
                        <img id="blah2" src="{{url('/')}}/uploads/aadharimage/{{$merchant_details->aadhar_back_image}}" alt="your image"  style="height:100px; width:100px;" />
                        @else 
                        <img id="blah2" src="#" alt="your image"  style="height:100px; width:100px;" />
                        @endif
                        <button style="display: none;" id="update_button_aadhar_back" type="button" onclick="form_submit()" class="btn btn-sm btn-primary">Update</button>
                      </td>
                    </tr>
                    <tr id="update_row()">
                      <td style="background-color:white;">&nbsp;&nbsp;</td>
                      <td style="background-color:white;"><button style="display: none;" id="update_button" type="button" onclick="form_submit()" class="btn btn-primary">Update</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>        
            <!--</form>-->    
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal1" tabindex="-1" role="dialog">
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
</div>
@endsection


@section('page-style')

@endsection



@section('page-script')
<script>

$(document).ready(function() {
    $("#gsettingclick").click();
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
