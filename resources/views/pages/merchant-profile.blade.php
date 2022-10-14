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
            <form method="post" id="merchant_edit_form1">
              @csrf
              @method('PATCH')        
              <div class="col-md-12" style="padding-left:40px;">
                <input type="hidden" name="merchant_id" id="merchant_id" value="{{$merchant_details->id}}">
                <input type="hidden" name="hidden_display_name" id="hidden_display_name" value="{{$merchant_details->display_name}}">
                <input type="hidden" name="hidden_contact_number" id="hidden_contact_number" value="{{$merchant_details->contact_phone}}">
                <table class="table table-striped" style="width:180%;">
                  <thead>
                    <tr>
                      <th data-field="id">Merchant Id: {{$merchant_details->id}}</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Contact Name</td>
                      <td>{{ $merchant_details->contact_name }}</td>
                    </tr>
                    <tr>
                      <td>Display Name</td>
                      <td><span id="display_name_container">{{$merchant_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" data-toggle="modal" data-target="#displayNameModal" onclick="setDisplayName()"><i class="fas fa-edit">edit</i></a></td>
                    </tr>
                    <tr>
                      <td>Display Logo</td>
                      <td><span id="display_logo_container">{{$merchant_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#diaplayLogoModal" onclick="setDisplayLogo()">Change Display Logo</a></td>
                    </tr>
                    <tr>
                      <td>Contact Email</td>
                      <td>{{ $merchant_details->email }}</td>
                    </tr>
                    <tr>
                      <td>Contact Number</td>
                      <td><span id="contact_number_container">{{ $merchant_details->contact_phone }}</span> &nbsp;&nbsp; <a style="cursor:pointer;" data-toggle="modal" data-target="#contactNumberModal" onclick="setContactNumber()"><i class="fas fa-edit">edit</i></td>
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
            </form>        
          </div>
        </div>
        <div id="menu1" class="tab-pane fade">
        <div class="row">  
            <form method="post" id="merchant_edit_form" action="{{ url('merchant_details_update') }}" enctype="multipart/form-data">
              @csrf
                   
              <div class="col-md-12" style="padding-left:40px;">
                <input type="hidden" name="merchant_id" id="merchant_id" value="{{$merchant_details->id}}">
                <table class="table table-striped" style="width:210%;">
                  <thead>
                    <tr>
                      <th data-field="id">Merchant Id: {{$merchant_details->id}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Business Name</td>
                      <td>{{ $merchant_details->business_category }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_category')">edit</i><input type="text" style="display:none;" class="form-control" name="business_category" id="business_category"><a style="display:none; cursor:pointer;" id="cancel_business_category" onclick="hide_input('business_category')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Business Type</td>
                      <td>{{ $merchant_details->business_type }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_type')">edit</i><input type="text" style="display:none;" class="form-control" name="business_type" id="business_type"><a style="display:none; cursor:pointer;" id="cancel_business_type" onclick="hide_input('business_type')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Business Description</td>
                      <td>{{ $merchant_details->business_description }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('business_description')">edit</i><textarea style="display:none;" class="form-control" name="business_description" id="business_description"></textarea><a style="display:none; cursor:pointer;" id="cancel_business_description" onclick="hide_input('business_description')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>PAN Holder Name</td>
                      <td>{{ $merchant_details->pan_holder_name }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('pan_holder_name')">edit</i><input type="text" style="display:none;" class="form-control" name="pan_holder_name" id="pan_holder_name"><a style="display:none; cursor:pointer;" id="cancel_pan_holder_name" onclick="hide_input('pan_holder_name')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Billing Label</td>
                      <td>{{ $merchant_details->billing_label }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_label')">edit</i><input type="text" style="display:none;" class="form-control" name="billing_label" id="billing_label"><a style="display:none; cursor:pointer;" id="cancel_billing_label" onclick="hide_input('billing_label')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Billing Address</td>
                      <td>{{ $merchant_details->billing_address }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_address')">edit</i><input type="text" style="display:none;" class="form-control" name="billing_address" id="billing_address"><a style="display:none; cursor:pointer;" id="cancel_billing_address" onclick="hide_input('billing_address')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Billing City</td>
                      <td>{{ $merchant_details->billing_city }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_city')">edit</i><input type="text" style="display:none;" class="form-control" name="billing_city" id="billing_city"><a style="display:none; cursor:pointer;" id="cancel_billing_city" onclick="hide_input('billing_city')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Billing State</td>
                      <td>{{ $merchant_details->billing_state }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('billing_state')">edit</i><input type="text" style="display:none;" class="form-control" name="billing_state" id="billing_state"><a style="display:none; cursor:pointer;" id="cancel_billing_state" onclick="hide_input('billing_state')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Bneficiary Name</td>
                      <td>{{ $merchant_details->beneficiary_name }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('beneficiary_name')">edit</i><input type="text" style="display:none;" class="form-control" name="beneficiary_name" id="beneficiary_name"><a style="display:none; cursor:pointer;" id="cancel_beneficiary_name" onclick="hide_input('beneficiary_name')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Account Number</td>
                      <td>{{ $merchant_details->account_number }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('account_number')">edit</i><input type="text" style="display:none;" class="form-control" name="account_number" id="account_number"><a style="display:none; cursor:pointer;" id="cancel_account_number" onclick="hide_input('account_number')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Ifsc Code</td>
                      <td>{{ $merchant_details->ifsc_code }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('ifsc_code')">edit</i><input type="text" style="display:none;" class="form-control" name="ifsc_code" id="ifsc_code"><a style="display:none; cursor:pointer;" id="cancel_ifsc_code" onclick="hide_input('ifsc_code')">cancel</a></td>
                    </tr>
                    <tr>
                      <td>Aadhar Number</td>
                      <td>{{ $merchant_details->aadhar_no }}&nbsp;&nbsp;<i class="fas fa-edit"  style="cursor:pointer;" onclick="show_input('aadhar_no')">edit</i><input type="text" style="display:none;" class="form-control" name="aadhar_no" id="aadhar_no"><a style="display:none; cursor:pointer;" id="cancel_aadhar_no" onclick="hide_input('aadhar_no')">cancel</a></td>
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
                      </td>
                    </tr>
                    <tr id="update_row()">
                      <td style="background-color:white;">&nbsp;&nbsp;</td>
                      <td style="background-color:white;"><button style="display: none;" id="update_button" type="button" onclick="form_submit()" class="btn btn-primary">Update</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>        
            </form>    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="edit_count" value="0">
<!-- Modal -->
<div class="modal fade" id="displayNameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Display Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" placeholder="Display Name" class="form-control" id="display_name" name="display_name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="display_name_change_button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="contactNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Contact Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" placeholder="Contact Number" class="form-control" id="contact_number" name="contact_number">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="contact_number_change_button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="diaplayLogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Change Display Logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="file" id="display_logo" accept="image/*" name="display_logo">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="contact_number_change_button" class="btn btn-sm btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('page-style')
<style>
.nav-tabs {
  list-style-type: none;
  margin: 0;
  padding: 10;
  overflow: hidden;
  background-color: #00008B;
}

.nav-tabs li {
  float: left;
}

.nav-tabs li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.nav-tabs li a:hover:not(.active) {
  background-color: #111;
}

.nav-tabs .active {
  background-color: #4e73df;
}


</style>
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
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader2 = new FileReader();

        reader2.onload = function (e2) {
            $('#blah2').attr('src', e2.target.result);
        }

        reader2.readAsDataURL(input.files[0]);
    }
}

var count = 0;
function show_input(input_id)
{
  $("#"+input_id).show();
  $("#cancel_"+input_id).show();
  count++;
  $("#edit_count").val(count);
  show_update_button();
}


function hide_input(input_id)
{
  $("#"+input_id).hide();
  $("#cancel_"+input_id).hide();
  count--;
  $("#edit_count").val(count);
  show_update_button();
}


function show_update_button()
{
  var edit_count = $("#edit_count").val();
  if(edit_count>0)
  {
    $("#update_button").show();
  }
  else 
  {
    $("#update_button").hide();
  }
}


function form_submit()
{
  $("#merchant_edit_form").submit();
}

</script>
@endsection
