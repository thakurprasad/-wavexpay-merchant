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
        <li id="generalli"><a id="gsettingclick" data-toggle="tab" href="#config">Configuration</a></li>
        <li id="tbli"><a id="tbclick" data-toggle="tab" href="#webhook">Webhooks</a></li>
        <li id="cli"><a id="cclick" data-toggle="tab" href="#apikeys">API Keys</a></li>
        <li id="bli"><a id="bliclick" data-toggle="tab" href="#reminder">Reminders</a></li>
        <li id="bli"><a id="bliclick" data-toggle="tab" href="#pm">Payment Methods</a></li>
      </ul>
      <div class="tab-content">

        <div id="config" style="padding: 40px;" class="tab-pane active">
          <div class="row">                         
            <div class="col-md-10 offset-md-1">
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="row">
					<div class="col-md-6">
						<h6>Account Setting</h6>
						<br clear="all">
						<div class="row">
							<div class="card shadow mb-4">
								<div class="card-body">									
									<div class="col-sm-12">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label for="end_date">Theme Colour</label>
													<input type="color" name="theme_color" class="form-control" id="theme_color">
													<p>
													Choose a theme color for your brand.
													The default theme color will be used if none is specified.
													</p>
												</div>
												<div class="col-sm-6">
													<br clear="all">
													<button type="button" onclick="save_theme_color()" class="btn btn-sm btn-info">Save</button>											
												</div>
											</div>
										</div>
										<div class="form-group">
											<form id="theme_logo_form" enctype="multipart/form-data">
											@csrf
												<div class="row">
													<div class="col-sm-6">
														<label for="end_date">Theme Logo</label>
														<input type="file" name="theme_logo" class="form-control" id="theme_logo" accept="image/*">
														<p>
														Choose a square image of minimum dimensions 256x256 px.
														</p>
													</div>
													<div class="col-sm-6">
														<br clear="all">
														<button type="button" onclick="save_theme_logo()" class="btn btn-sm btn-info">Save</button>											
													</div>
												</div>
											</form>											
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label for="end_date">Default Language</label>
													<select class="form-control" name="theme_language" id="theme_language">
														<option value="ben">Bengali</option>
														<option value="hi">Hindi</option>
														<option value="mar">Marathi</option>
														<option value="guj">Gujarati</option>
														<option value="tam">Tamil</option>
														<option value="tel">Telugu</option>
														<option value="en" selected="">English</option>												
													</select>
												</div>
												<div class="col-sm-6">
													<br clear="all">
													<button type="button" onclick="save_theme_language()" class="btn btn-sm btn-info">Save</button>											
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>							
                    	</div>
					</div>
					<div class="col-md-6" style="text-align-last: center;">
						<button style="float:middle;">Image Preview</button>
						<br clear="all">
						<br clear="all">
						<div class="card shadow mb-4" style="padding: 10px;">
							<div class="card-body">
								<div class="row" id="headingrow" style="background-color: rgb(82, 143, 240); padding: 20px;">
									<div class="col-md-6">
										<img id="blah" src="<?php echo url('/') ?>/images/logo/wave_x_pay.png" height="70px;" width="70px;">
									</div>
									<div class="col-md-6" style="text-align: center;margin: auto;padding: 10px;color: #ffffff;">Manoj Verma<br>Order Id<br>₹1</div>
								</div>
								<div class="row">
									<input type="text" name="phone" class="form-control" id="phone" readonly placeholder="Phone">											
								</div>
								<div class="row">
									<input type="text" name="email" class="form-control" id="email" readonly placeholder="Email">											
								</div>
								<div class="row" style="margin-top: 115px;">
									<h6>Select a paument method</h6>
									<div class="grid-container">
										<div class="grid-item">Card</div>
										<div class="grid-item">Net Banking</div>
										<div class="grid-item">Wallet</div>  
										<div class="grid-item">UPI</div>
										<div class="grid-item">EMI</div>
										<div class="grid-item">QR</div>  
									</div>
								</div>									
							</div>
						</div>
					</div>
				  </div>
				  <hr />
				  <p>Changes will reflect on Checkout page, Payment Links, Invoices & Payment pages.</p>
                </div>
              </div>

			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title"><strong>Flash Checkout</strong>  <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger"  data-style="android"></h5>
					<p class="card-text">Securely save the card details of your customers, with Razorpay's Flash Checkout.</p>
				</div>
			  </div>


            </div>    
          </div>
        </div>

        <div id="webhook" class="tab-pane">
          <div class="row">     
            Webhook
          </div>
        </div>

        <div id="apikeys" class="tab-pane">
          <div class="row">  
            <div class="col-md-8 offset-md-2" style="padding-top:20px;">
              <div class="card shadow mb-4">
                <div class="card-body">
					<table class="table table-striped"> 
						<thead>
							<tr>
								<th>Key Id</th>
								<th>Created At</th>
								<th>Expiry</th>
								<th>Action</th>
                        	</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $key_details->api_key }}</td>
								<td>{{ date('J f,Y',strtotime($key_details->created_at)) }}</td>
								<td>Never</td>
								<td><button type="button" class="btn btn-xs btn-info">Regenerate API key</button></td>
							</tr>
						</tbody>
					</table>
                </div>
              </div>
            </div>    
          </div>
        </div>

        <div id="reminder" class="tab-pane">
          <div class="row">                         
            <div class="col-md-8 offset-md-2" style="padding-top:20px;">
				<div class="card shadow mb-4">
					<div class="card-body">
						<h5 class="card-title"><strong>Payment Links reminders</strong>  <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger"  data-style="android"></h5>
						<p class="card-text">Send collection reminders to customers automatically if a payment link hasnt been paid.</p>
					</div>
				</div>
			</div>    
          </div>
        </div>

        <div id="pm" class="tab-pane">
          <div class="row">                         
            <div class="col-md-8 offset-md-2" style="padding-top:20px;">

              Payment Methods

            </div>    
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
@endsection


@section('page-style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto;
  width:100%;
  padding: 10px;
}
.grid-item {
  background-color: #dddddd;
  padding: 20px;
  font-size: 10px;
  text-align: center;
}
</style>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
$(document).ready(function() {
    $("#gsettingclick").click();
    $('#toggle-one').bootstrapToggle();
});


$('#theme_color').on('input',
    function() {
		$('#headingrow').css('background-color', $(this).val());
    }
);

$("#theme_logo").change(function(){
    readURL(this);
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


function save_theme_color()
{
	var theme_color = $("#theme_color").val();
	if(confirm('Are You Sure To Change Theme Colour?')){
        $.ajax({
            url: '{{url("changethemecolor")}}',
            data: {'theme_color':theme_color},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
              if(data.success==1){
                alert('Theme Colour Changed');
              }
            }
        });
    }
}


function save_theme_logo()
{
	var formData = new FormData($('#theme_logo_form')[0]);
	$.ajax({
		url: '{{url("changethemelogo")}}',
		data: formData,
		type: "POST",
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success: function(data){
			if(data.success==1){
			alert('Theme Logo Changed');
			}
		}
	});
	console.log(formData);
}


function save_theme_language()
{
	var theme_language = $('#theme_language').val();
	$.ajax({
		url: '{{url("changethemelanguage")}}',
		data: {'theme_language':theme_language},
		type: "POST",
		headers: {
			'X-CSRF-Token': '{{ csrf_token() }}',
		},
		success: function(data){
			if(data.success==1){
			alert('Theme Language Changed');
			}
		}
	});
	console.log(formData);
}


</script>
@endsection