{{-- extend layout --}}
@extends('newlayout.app')

{{-- page title --}}
@section('title','Home')

@section('content_header')

@endsection

{{-- page content --}}
@section('content')
	
<div class="container-fluid">
    <div class="card">
		<div class="card-header">
			<div class="pull-left">
				<label for="first_name"><strong>Partner Dashboard</strong><For></For></label>
				
	        </div>
        </div>
		@php 
		$merchant_id =  session()->get('merchant');
		$get_merchant_details = Helper::get_merchant_details($merchant_id);
		@endphp
		<div class="card-body">			
			<div class="row">
				<div class="col-md-6">
					<h6><strong>Good Job {{$get_merchant_details->merchant_name}}!! Keep Referring</strong></h6>
					<h6>You can use multiple ways to refer merchants for any of the Razorpay products</h6>
					<div class="card" style="background-color: #58666e;">
						<div class="card-header">
							<div class="card-body">
								<h6><strong>Start Referring </strong></h6>
								<h6>Start referring clients, while you submit KYC details to activate commissions</h6>
							</div>
						</div>
						<a class="btn btn-info" style="color: white; cursor: pointer;" data-toggle="modal" data-target="#modal2">+Refer New Client</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
					
						<div class="col-md-6">
							<div class="card" style="background-color: #58666e;">
								<div class="card-header">
									<div class="card-body" style="height: 225px;">
										<h6 style="color:#4e73df;"><strong>For Payment Product</strong></h6>
										<h6>Refer your clients to leading Razorpay's payment products</h6>
										<a style="color: #00008B;">+ Add New Client</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card" style="background-color: #58666e;">
								<div class="card-header">
									<div class="card-body" style="height: 225px;">
										<h6 style="color:#4e73df;"><strong>For Banking Products</strong></h6>
										<h6>Refer your clients to next generation neo-banking enabling faster payouts</h6>
										<a style="color: #00008B;">+ Add New Client</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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

<script>
$(function() {
    $(".firstclass").addClass('active');
    document.getElementById("London").style.display = "block";
});

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

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
<script type="text/javascript">

</script>
@endsection
