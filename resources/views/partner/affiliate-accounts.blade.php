@extends('newlayout.app')
@section('title','Payment Links')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Affiliate Accounts</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Affiliate Accounts</li>
	</ol>
	</div>
</div>
@endsection
@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <ul class="margin-bottom-none padding-left-lg">
            <li>{{ $message }}</li>
        </ul>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <ul class="margin-bottom-none padding-left-lg">
            <li>{{ $message }} </li>
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <a href="#" data-toggle="modal" data-target="#modal1" onclick="create_referral_link()">Share Referral Link</a>
            &nbsp;&nbsp;
            <a class="btn btn-sm btn-primary" style="color: white; cursor: pointer;" data-toggle="modal" data-target="#modal2">+Create Affiliate Accounts</a>
        </div>
        <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
            @csrf
            <div class="card-body">
                <div class="row">                 
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Account Name</label>
                            <input placeholder="Account Name" name="payment_link_id" id="payment_link_id" type="text" class="form-control">
                        </div>
                    </div>

                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Account Id</label>
                            <input placeholder="Account Id" name="account_id" id="account_id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Email Id</label>
                            <input placeholder="Email Id" name="email_id" id="email_id" type="text" class="form-control">
                        </div> 
                    </div>
                   
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="first_name">&nbsp;</label><br>
                            <button class="btn btn-sm btn-primary" type="button" name="action" onclick="reset_page()">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">Account Name</th>
                    <th scope="col">Account Id</th>
                    <th scope="col">Registered Email</th>
                    <th scope="col">Activation Status</th>
                    <th scope="col">Actions </th>
                    <th scope="col">Added On</th>
                    </tr>
                </thead>
                <tbody id="table_container">                    
                    @if(!empty($referred_merchant))
                    @foreach($referred_merchant as $merchant)
                    <tr>
                        <td scope="col">{{$merchant->merchant_name}}</td>
                        <td scope="col">{{$merchant->merchant_id}}</td>
                        <td scope="col">{{$merchant->email}}</td>
                        <td scope="col"><span class="badge badge-warning">Activation Required</span></td>
                        <td scope="col"><button type="button" class="btn btn-sm btn-info">Resened Kyc Request</button></td>
                        <td scope="col">{{date('j F,Y',strtotime($merchant->created_at))}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

<div id="modal1" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">
        <h5 class="modal-title">Share Referral Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">
                Wavexpay Payments
            </div>
            <div class="card-body">
                <h5 class="card-title">Referral Link</h5>
                <p class="card-text">Invites Affiliates to use Wavexpay Payments products to collect payment from their customer</p>
                <input type="text" readonly class="form-control" name="referral_link" id="referral_link">
                <br />
                <span id="copy_button"><a href="#" class="btn btn-primary btn-sm">Copy</a></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="modal2" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 700px;">
        <div class="modal-body">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="tab">
                    <div class="row">
                        <div class="col-lg-4"><button class="tablinks firstclass" onclick="openCity(event, 'London')">Invite Using Mail</button></div>
                        <div class="col-lg-4"><button class="tablinks" onclick="openCity(event, 'Paris')">Invite Multiple Clients</button></div>
                        <div class="col-lg-4"><button class="tablinks" onclick="openCity(event, 'Tokyo')">Invite Using Links</button></div>
                    </div>
                    </div>

                    <div id="London" style="height: 300px;" class="tabcontent active">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Account Name</label>
                                <input type="text" class="form-control" name="affiliate_name" placeholder="Affiliate name" id="affiliate_name" />
                            </div>
                            <div class="col-md-12" style="margin-top: 15px;">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" />
                            </div>
                            <div class="col-md-12" style="margin-top: 15px;">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" />
                            </div>
                            <div class="col-md-12" style="margin-top: 10px;">
                                <a href="#" class="btn btn-primary btn-sm" onclick="send_invite()">Send Invite</a>
                            </div>
                        </div>
                    </div>

                    <div id="Paris" class="tabcontent">
                    gbrnbtehmnytjjm
                    </div>

                    <div id="Tokyo" class="tabcontent">
                    ehtntentt
                    </div>
                </div>
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
.modal {
    overflow-y: auto;
}
</style>


<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
  width: 100%;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #00008B;
  width: 100%;
  color: #FFFFFF;
}

/* Style the tab content */
.tabcontent {
  display: none;
  height: 354px;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}
</style>
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
$(function() {
    $(".firstclass").addClass('active');
    document.getElementById("London").style.display = "block";
});


function create_referral_link()
{
    $.ajax({
        url: '{{route("create-referral-link")}}',
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            var link = '{{ url('/') }}'+'/register-as-partner?ref='+data.link_text;
            $("#referral_link").val(link);
            $("#copy_button").html('<a class="btn btn-primary btn-sm" style="color:#FFFFFF;" onclick="copy(\''+data.link_text+'\')">Copy</a>');
        }
    });
}

function copy(url) {
    // Get the text field
    var copyText = document.getElementById("referral_link");
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    // Alert the copied text
    alert("Copied the text: " + copyText.value);
}


function send_invite()
{
    var affiliate_name = $("#affiliate_name").val();
    if(affiliate_name=='')
    {
        alert('Please Enter Affiliate Name');
        return false;
    }
    var email = $("#email").val();
    if(email=='')
    {
        alert('Please Enter Email');
        return false;
    }
    var contact_number = $("#contact_number").val();
    if(contact_number=='')
    {
        alert('Please Enter Contact Number');
        return false;
    }
    $.ajax({
        url: '{{route("send-invite")}}',
        type: "POST",
        data: {'affiliate_name': affiliate_name, 'email': email, 'contact_number': contact_number},
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            alert(data.msg);
        }
    });
}
</script>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection