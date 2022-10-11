@extends('newlayout.app')

{{-- page title --}}
@section('title','User Profile')

{{-- page content --}}
@section('content')
<div class="section">
  <div class="card">
    <div class="card-content">



      <ul class="nav nav-tabs">
        <li class="active"><a id="gsettingclick" data-toggle="tab" href="#home">General Info</a></li>
        <li><a data-toggle="tab" href="#menu1">Kyc Info</a></li>
      </ul>

      <div class="tab-content" style="padding-left:20px;">
        <div id="home" class="tab-pane fade in active">
          <div class="row">            
            <div class="col-md-12" style="padding-left:40px;">
              <input type="hidden" name="merchant_id" id="merchant_id" value="{{$merchant_details->id}}">
              <input type="hidden" name="hidden_display_name" id="hidden_display_name" value="{{$merchant_users_details->display_name}}">
              <input type="hidden" name="hidden_contact_number" id="hidden_contact_number" value="{{$merchant_details->contact_phone}}">
              <table class="table table-striped">
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
                    <td><span id="display_name_container">{{$merchant_users_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" data-toggle="modal" data-target="#displayNameModal" onclick="setDisplayName()"><i class="fas fa-edit">edit</i></a></td>
                  </tr>
                  <tr>
                    <td>Display Logo</td>
                    <td><span id="display_logo_container">{{$merchant_users_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#diaplayLogoModal" onclick="setDisplayLogo()">Change Display Logo</a></td>
                  </tr>
                  <tr>
                    <td>Contact Email</td>
                    <td>{{ $merchant_users_details->email }}</td>
                  </tr>
                  <tr>
                    <td>Contact Number</td>
                    <td><span id="contact_number_container">{{ $merchant_details->contact_phone }}</span> &nbsp;&nbsp; <a style="cursor:pointer;" data-toggle="modal" data-target="#contactNumberModal" onclick="setContactNumber()"><i class="fas fa-edit">edit</i></td>
                  </tr>
                  <tr>
                    <td>Business Name</td>
                    <td>{{ $merchant_users_details->business_category }}</td>
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
          </div>
        </div>
        <div id="menu1" class="tab-pane fade">
        <div class="row">            
            <div class="col-md-12" style="padding-left:40px;">
              <input type="hidden" name="merchant_id" id="merchant_id" value="{{$merchant_details->id}}">
              <input type="hidden" name="hidden_display_name" id="hidden_display_name" value="{{$merchant_users_details->display_name}}">
              <input type="hidden" name="hidden_contact_number" id="hidden_contact_number" value="{{$merchant_details->contact_phone}}">
              <table class="table table-striped">
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
                    <td><span id="display_name_container">{{$merchant_users_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" data-toggle="modal" data-target="#displayNameModal" onclick="setDisplayName()"><i class="fas fa-edit">edit</i></a></td>
                  </tr>
                  <tr>
                    <td>Display Logo</td>
                    <td><span id="display_logo_container">{{$merchant_users_details->display_name}}</span> &nbsp;&nbsp;<a style="cursor:pointer;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#diaplayLogoModal" onclick="setDisplayLogo()">Change Display Logo</a></td>
                  </tr>
                  <tr>
                    <td>Contact Email</td>
                    <td>{{ $merchant_users_details->email }}</td>
                  </tr>
                  <tr>
                    <td>Contact Number</td>
                    <td><span id="contact_number_container">{{ $merchant_details->contact_phone }}</span> &nbsp;&nbsp; <a style="cursor:pointer;" data-toggle="modal" data-target="#contactNumberModal" onclick="setContactNumber()"><i class="fas fa-edit">edit</i></td>
                  </tr>
                  <tr>
                    <td>Business Name</td>
                    <td>{{ $merchant_users_details->business_category }}</td>
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
          </div>
        </div>
      </div>



      
    </div>
  </div>
</div>

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
</script>
@endsection
