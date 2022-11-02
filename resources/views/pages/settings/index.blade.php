@extends('newlayout.app')

{{-- page title --}}
@section('title','User Profile')

{{-- page content --}}
@section('content')
<div class="container-fluid">    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
        </div>
        <div class="card-body"> 


<div class="section_">
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

        <div id="config" style="padding-top: 20px;" class="tab-pane active">
          <div class="row">                         
            <div class="col-md-9 offset-md-1">
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="row">
					<div class="col-md-6">
						<h6>Account Setting</h6>
						<br clear="all">
						<div class="row">
							<div class="card shadow mb-4" style="padding-bottom: 8px;">
								<div class="card-body">									
									<div class="col-sm-12">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label for="end_date">Theme Colour</label>
													<input type="color" value="@php 
													if(isset($general_settings->theme_color) && $general_settings->theme_color!='') { echo $general_settings->theme_color; } @endphp" name="theme_color" class="form-control" id="theme_color">
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
														<option value="ben" @if(isset($general_settings->language) && $general_settings->language=='ben') selected @endif>Bengali</option>
														<option value="hi" @if(isset($general_settings->language) && $general_settings->language=='hi') selected @endif>Hindi</option>
														<option value="mar" @if(isset($general_settings->language) && $general_settings->language=='mar') selected @endif>Marathi</option>
														<option value="guj" @if(isset($general_settings->language) && $general_settings->language=='guj') selected @endif>Gujarati</option>
														<option value="tam" @if(isset($general_settings->language) && $general_settings->language=='tam') selected @endif>Tamil</option>
														<option value="tel" @if(isset($general_settings->language) && $general_settings->language=='tel') selected @endif>Telugu</option>
														<option value="en" @if(isset($general_settings->language) && $general_settings->language=='en') selected @endif>English</option>												
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
							<div class="card-body" style="padding: 8px; padding-top: 0;padding-bottom: 0;">
								<div class="row" id="headingrow" style="background-color:@php 
													if(isset($general_settings->theme_color) && $general_settings->theme_color!='') { echo $general_settings->theme_color; } else { echo 'background-color: rgb(82, 143, 240)'; } @endphp; padding: 10px;">
									<div class="col-md-6" style="padding-top:10px;">
										@if(isset($general_settings->logo) && $general_settings->logo!='')
										<img id="blah" src="<?php echo url('/') ?>/images/logo/{{$general_settings->logo}}" width="99%">
										@else 
										<img id="blah" src="<?php echo url('/') ?>/images/logo/wave_x_pay.png" width="99%">
										@endif
									</div>
									<div class="col-md-6" style="text-align: center;margin: auto;padding: 10px;color: #ffffff;">Manoj Verma<br>Order Id<br>₹1</div>
								</div>
								<div class="row" style="border: 1px solid #cccccc78;">
										<img src="{{ url('newdesign/img/payment-style.png') }}" style="width: 100%;">
								</div>
								<?php /*
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
								</div> */ ?>									
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
					<h5 class="card-title"><strong>Flash Checkout</strong>  <input type="checkbox" @if(isset($general_settings->falsh_checkout) && $general_settings->falsh_checkout=='yes') checked @endif data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger" id="flash_checkout" data-style="android"></h5>
					<p class="card-text">Securely save the card details of your customers, with Razorpay's Flash Checkout.</p>
				</div>
			  </div>


			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title"><strong>Payment Capture</strong>  <a href="#">Know more</a></h5>
					<div class="card shadow mb-4">
						<div class="card-body">
							<h5 class="card-title"><strong>Automatic Capture</strong>  <input type="checkbox" @if(isset($general_settings->auto_capture) && $general_settings->auto_capture=='yes') checked @endif data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger" id="auto_capture" data-style="android"></h5>
							<p class="card-text">Payments will be captured automatically if authorised by bank within 5 days</p>
						</div>
					</div>
					<p class="card-text">What is Capturing Payments? <a href="#">Show Details.</a></p>
					<hr />
					<p><strong>Note :</strong>Capture settings are applicable only if Orders API is used to create the payment. Capture values passed in the Orders API will override these settings if there is any conflict.</p>
				</div>
			  </div>


			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title"><strong>Default Refund Speed</strong>  &nbsp;&nbsp;<a href="#">Know more</a>  &nbsp;&nbsp;<a href="#">API Referrence Guide</a></h5>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow mb-4">
								<div class="card-body">
									<h5 class="card-title"><strong>Normal Refund</strong>  <input type="radio" name="refund" id="normal_refund" value="normal" @if(isset($general_settings->refund_type) && $general_settings->refund_type=='normal') checked @endif style="margin-left:150px;"></h5>
									<p class="card-text">Your customer will get refunds in 5-7 days.</p><br>
									<button>Normal Speed</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card shadow mb-4">
								<div class="card-body">
									<h5 class="card-title"><strong>Instant Refund</strong>  <input type="radio" name="refund" id="instant_refund" value="instant" @if(isset($general_settings->refund_type) && $general_settings->refund_type=='instant') checked @endif style="margin-left:150px;"></h5>
									<p class="card-text">At a minimal fee, your customer will get refunds instantly.</p>
									<button>Optimum Speed</button>
								</div>
							</div>
						</div>
					</div>					
				</div>
			  </div>


			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title">Email Notification</h5>
					<p class="card-text">Enter email addresses that will receive email notifications regarding payments, settlements, daily payment reports, webhooks, etc. (You can enter multiple email addresses separated by a comma.)</p><br>
					<div class="row"><div class="col-md-10"><input type="text" class="form-control" name="email_notification" id="emailnotofication" value="@php if(isset($general_settings->notification_email) && $general_settings->notification_email!='') { echo $general_settings->notification_email; } @endphp"></div><div class="col-md-2"><button type="button" id="email_notification" class="btn btn-sm btn-primary">Save Change</button></div></div>
				</div>
			  </div>

			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title"><strong>SMS Notification</strong>  <input type="checkbox" @if(isset($general_settings->sms_notification) && $general_settings->sms_notification=='yes') checked @endif data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger" id="smsnotification" data-style="android"></h5>
					<p class="card-text">Receive notifications from Razorpay via SMS on your +91 - @php if(isset($general_settings->contact_phone) && $general_settings->contact_phone!='') { echo $general_settings->contact_phone; } @endphp.</p>
				</div>
			  </div>

			  <div class="card shadow mb-4">
				<div class="card-body">
					<h5 class="card-title"><strong>Skip Mandate Summary Page for Cards</strong>  <input type="checkbox" @if(isset($general_settings->skip_mandate) && $general_settings->skip_mandate=='yes') checked @endif data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" id="shipmandate" data-offstyle="outline-danger"  data-style="android"></h5>
					<p class="card-text">Skip showing mandate summary page for credit and debit card payments to your users.</p>
				</div>
			  </div>


            </div>    
          </div>
        </div>

        <div id="webhook" class="tab-pane">
          <div class="row">     
		  	<div class="col-md-9 offset-md-1" style="padding-top:20px;">
				<x-notification title="Your Feedback Matters" description="Hello, Developer! Would you like to take a few seconds to help us improve your experience with Razorpay?" />
				<table class="table table-striped"> 
					<thead>
						<tr>
							<th>URL</th>
							<th>Status</th>
							<th>Events</th>
							<th>Last Updated</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="4">No Data Found</td>
						</tr>
					</tbody>
				</table>
			</div>
          </div>
        </div>

        <div id="apikeys" class="tab-pane">
          <div class="row">  
            <div class="col-md-9 offset-md-1" style="padding-top:20px;">
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
								<td>{{ date('d F,Y',strtotime($key_details->created_at)) }}</td>
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
            <div class="col-md-9 offset-md-1" style="padding-top:20px;">
				<div class="card shadow mb-4">
					<div class="card-body">
						<h5 class="card-title"><strong>Payment Links reminders</strong>  <input type="checkbox" @if(isset($general_settings->payment_link_reminder) && $general_settings->payment_link_reminder=='yes') checked @endif data-toggle="toggle" data-size="xs" data-height="25" data-width="80" data-onstyle="outline-success" data-offstyle="outline-danger" id="payment_link_reminder" data-style="android"></h5>
						<p class="card-text">Send collection reminders to customers automatically if a payment link hasnt been paid.</p>
					</div>
				</div>
			</div>    
          </div>
        </div>

        <div id="pm" class="tab-pane">
          <div class="row">                         
            <div class="col-md-9 offset-md-1" style="padding-top:20px;">

				<div class="row">
					<div class="col-3" style="padding: 0px;">
						<div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a onclick="set_background_color('home','profile','messages','settings','wallet','paylater','ip')" style="border: 1px solid #e6e7e8; width: 100%; background-color: #dddddd;" class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Cards</a>

						<a onclick="set_background_color('profile','home','messages','settings','wallet','paylater','ip')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">UPI/QR</a>

						<!--<a onclick="set_background_color('messages','home','profile','settings','wallet','paylater','ip')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">NetBanking</a>-->

						<a onclick="set_background_color('settings','home','profile','messages','wallet','paylater','ip')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">EMI</a>
						<a onclick="set_background_color('wallet','home','profile','messages','settings','paylater','ip')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-wallet-tab" data-toggle="pill" href="#v-pills-wallet" role="tab" aria-controls="v-pills-wallet" aria-selected="false">WALLET</a>

						<a onclick="set_background_color('paylater','home','profile','messages','settings','wallet','ip')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-paylater-tab" data-toggle="pill" href="#v-pills-paylater" role="tab" aria-controls="v-pills-paylater" aria-selected="false">Pay Later</a>

						<a onclick="set_background_color('ip','home','profile','messages','settings','wallet','paylater')" style="border: 1px solid #e6e7e8; width: 100%;" class="nav-link" id="v-pills-ip-tab" data-toggle="pill" href="#v-pills-ip" role="tab" aria-controls="v-pills-ip" aria-selected="false">International Payments</a>

						</div>
					</div>
					<div class="col-9">
						<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="card shadow mb-4">
								<div class="card-body">
									Domestic Cards<br clear="all"><br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/visa.jpg" width="50px;"></td><td><strong>Visa Cards</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/mastercard.png" width="50px;"></td><td><strong>Mastercards</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/rupay.jpg" width="50px;"></td><td><strong>Rupaycards</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/maestro.jpg" width="50px;"></td><td><strong>Maestro</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/AmexCard.png" width="50px;"></td><td><strong>Amexcards</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
									</table>
								</div>
							</div>
						</div>


						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div class="card shadow mb-4">
								<div class="card-body">
									UPI<br clear="all"><br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/upi.png" width="50px;"></td><td><strong>UPI</strong><br>Gpay,Phonepay,Paytm&more..</td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
									</table>
								</div>
							</div>
						</div>


						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">NetBanking</div>


						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
							<div class="card shadow mb-4">								
								<div class="card-body">
									Debit Card EMI<br clear="all"><br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/hdfc.png" width="50px;"></td><td><strong>HDFC BANK</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
									</table>

									Credit Card EMI<br clear="all">
									<table class="table table-striped">
										<tr><td><strong>Credit Cards</strong></td><td>Credit Cards</td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
									</table>

									Cardless EMI<br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/zest.jpg" width="50px;"></td><td><strong>Zestmoney</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/es.png" width="50px;"></td><td><strong>Early Salary</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/InstaCred.png" width="50px;"></td><td><strong>Instacred</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/axio.png" width="50px;"></td><td><strong>Axio</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
									</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-wallet" role="tabpanel" aria-labelledby="v-pills-wallet-tab">
							<div class="card shadow mb-4">								
								<div class="card-body">
									Wallet<br clear="all"><br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/amazonpay.png" width="50px;"></td><td><strong>Amazon Pay</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/paytm.png" width="50px;"></td><td><strong>Paytm</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/phonepe.png" width="50px;"></td><td><strong>Phonepe</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/airtelmoney.png" width="50px;"></td><td><strong>Airtel Money</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/freecharge.png" width="50px;"></td><td><strong>Freecharge</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/jiomoney.png" width="50px;"></td><td><strong>Jiomoney</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/olamoney.png" width="50px;"></td><td><strong>Olamoney</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/payzapp.png" width="50px;"></td><td><strong>Payzapp</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/mobikwik.png" width="50px;"></td><td><strong>Mobikwik</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
									</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-paylater" role="tabpanel" aria-labelledby="v-pills-paylater-tab">
							<div class="card shadow mb-4">								
								<div class="card-body">
									Paylater<br clear="all"><br clear="all">
									<table class="table table-striped">
										<tr><td><img src="<?php echo url('/') ?>/images/icon/flexipay.png" width="50px;"></td><td><strong>Flexi Pay</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/icici.jpg" width="50px;"></td><td><strong>Icici</strong></td><td><button class="btn btn-sm btn-success">Activated</button></td></tr>
										<tr><td><img src="<?php echo url('/') ?>/images/icon/simpl.png" width="50px;"></td><td><strong>Simpl</strong></td><td><button class="btn btn-sm btn-info">REQUEST</button></td></tr>
									</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="v-pills-ip" role="tabpanel" aria-labelledby="v-pills-ip-tab">
							<div class="card shadow mb-4">								
								<div class="card-body">
									International Payments<br clear="all"><br clear="all">
									<div class="card shadow mb-4">
										<div class="card-body">
											<h5 class="card-title"><strong>International Cards</strong>  <button class="btn btn-sm btn-info">REQUEST</button></h5>
											<p class="card-text">On Payment Gateways Links and Invoices.</p>
										</div>
									</div>

									Apps<br clear="all">
									<div class="card shadow mb-4">
										<div class="card-body">
											<h5 class="card-title"><strong>Paypal</strong>  <button class="btn btn-sm btn-info">Link Account</button></h5>
											<p class="card-text">Accept International Payments using PayPal on Razorpay Checkout</p>
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


      </div>
    </div>
  </div>
</div>



        </div> <!--/ container-fluid -->
    </div> <!--/ card -->
</div> <!--/ card-body -->
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

<style>
a:hover {
  background-color: #dddddd;
}

a:active {
  background-color: #dddddd;
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

function set_background_color(aid1,aid2,aid3,aid4,aid5,aid6,aid7)
{
	$("#v-pills-"+aid1+"-tab").css("background-color", "#dddddd");
	$( "#v-pills-"+aid2+"-tab,#v-pills-"+aid3+"-tab,#v-pills-"+aid4+"-tab,#v-pills-"+aid5+"-tab,#v-pills-"+aid6+"-tab,#v-pills-"+aid7+"-tab" ).css("background-color", "#ffffff");
}


$(function() {
    $('#flash_checkout').change(function() {
        var status = $(this).prop('checked') == true ? 'yes' : 'no';
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changeflashcheckout') }}",
				data: {'status': status},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
				if(data.flash_checkout=='yes'){
					alert('Flash Checkout Activated Successfully!!');
				}else{
					alert('Flash Checkout Deactivated Successfully!!');
				}
				}
			});
		}
    });


	$('#auto_capture').change(function() {
        var status = $(this).prop('checked') == true ? 'yes' : 'no';
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changeautocapture') }}",
				data: {'status': status},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
				if(data.auto_capture=='yes'){
					alert('Auto Capture Activated Successfully!!');
				}else{
					alert('Auto Capture Deactivated Successfully!!');
				}
				}
			});
		}
    });


	$('#normal_refund , #instant_refund').click(function () {
		var refund_type = $(this).val();
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changerefundtype') }}",
				data: {'refund_type': refund_type},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
					alert('Refund Type Changed Successfully!!');
				}
			});
		}
		
	});

	$('#smsnotification').change(function() {
        var status = $(this).prop('checked') == true ? 'yes' : 'no';
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changesmsnotification') }}",
				data: {'status': status},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
				if(data.sms_notification=='yes'){
					alert('SMS Notification Activated Successfully!!');
				}else{
					alert('SMS Notification Deactivated Successfully!!');
				}
				}
			});
		}
    });


	$('#email_notification').click(function () {
		var emailnotofication = $('#emailnotofication').val();
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changeemailnotification') }}",
				data: {'emailnotofication': emailnotofication},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
					if(data.success==1)
					{
						alert('Notification Email Changed Successfully!!');
					}				
				}
			});
		}
		
	});


	$('#shipmandate').change(function() {
        var status = $(this).prop('checked') == true ? 'yes' : 'no';
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changeskipmandate') }}",
				data: {'status': status},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
				if(data.skip_mandate=='yes'){
					alert('Skip Mandate Activated Successfully!!');
				}else{
					alert('Skip Mandate Deactivated Successfully!!');
				}
				}
        	});
		}
    });


	$('#payment_link_reminder').change(function () {
		var status = $(this).prop('checked') == true ? 'yes' : 'no';
		if(confirm('Are You Sure?'))
		{
			$.ajax({
				type: "post",
				dataType: "json",
				url: "{{ url('changereminder') }}",
				data: {'status': status},
				headers: {
					'X-CSRF-Token': '{{ csrf_token() }}',
				},
				success: function(data){
					if(data.success==1)
					{
						alert('Payment Link Reminder Changed Successfully!!');
					}				
				}
			});
		}
	});


});
</script>
@endsection