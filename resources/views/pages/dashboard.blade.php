@extends('newlayout.app')
@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="{{ url('/') }}/dashboard-signup/css/style.css" rel="stylesheet" type="text/css"/>
<link href="{{ url('/css/my-card.css') }}" rel="stylesheet" type="text/css"/>
<style>
.modal {
    overflow-y: auto;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
  
    <x-notification/>
    <div class="row" style="margin:30px 0px;border: 1px solid #ccc;padding: 18px 0;box-shadow: 0px 0 22px -8px;margin-top: 40px;background-color: white;">
        <div class="col-md-4 col-lg-4 col-sm-12">
            <div id="reportrange" style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
        <div class="col-md-5"></div>

        <div class="col-md-3 col-lg-3 col-sm-12">
            <select class="form-control" id="status_filter">
              <option>-- Select Transaction --</option>
                <option value="authorized" selected>Successful</option>
                <option value="pending">Pending</option>
                <option value="all">All</option>
            </select>
        </div>


   <div class="col-12" > &nbsp;</div>

   
@php
$total_amount=0;
if(!empty($payments))
{
    foreach($payments as $payment)
    {
        $total_amount+=$payment->amount;
    }
}
@endphp 
        <x-my-card type="1" title="New Order" value="{{count($orders)}}" icon="calendar" />
        <x-my-card type="2" title="Total Payments Amount" value="{{number_format($total_amount,2)}}" icon="dollar-sign" />

        <x-my-card type="4" title="Total Transactions" value="1008" icon="chart-area" />
        <x-my-card type="3" title="Success Rate" value="{{$success_perc}}%" icon="clipboard-list" />
    </div>

    <!-- Content Row -->

    <div class="row" style="margin-top:20px;">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Overview</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
            <canvas id="myAreaChart1"></canvas>
            </div>
        </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Order Overview</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myBarChart1"></canvas>
            </div>
        </div>
        </div>
    </div>


    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #00008B;">Payment Overview</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="mymethodChart"></canvas>
            </div>
        </div>
        </div>
    </div>


    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold" style="color: #00008B;">Minimum and Maximum Transaction</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> Minimum Transaction
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Maximum Transaction
            </span>
          </div>
        </div>
      </div>
    </div>

  <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold" style="color: #00008B;">Resent Transaction</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body" style="padding:0px">
            

      <ul class="nav nav-tabs">
        <li id="generalli" style="background: transparent;">
          <a id="gsettingclick" data-toggle="tab" href="#menu1">Payment</a>
        </li>
        <li id="tbli">
          <a id="tbclick" data-toggle="tab" href="#menu2">Settlement</a>
        </li>
        <li id="cli">
          <a id="cclick" data-toggle="tab" href="#menu3">Refund</a>
        </li>
      </ul>
      <div class="tab-content sidebar-menu-scroll" style="height: 308px; overflow-y: scroll; overflow-x: hidden;padding: 6px;">
        <div id="menu1" class="tab-pane fade in active show">
          <table class="table table-bordered table-responsive_ table-striped">
              <tr>
                <th>Amount</th>
                <th>Payment id</th>
                <th>Created At</th>
                <th>Status</th>
              </tr>            
              @if(!empty($payments))
              @foreach($payments as $payment)
              <?php
              $date1=date_create("now");
              $date2=date_create($payment->payment_created_at);
              $diff=date_diff($date1,$date2); ?>
                <tr>
                  <td>₹{{$payment->amount}}</td>
                  <td>{{$payment->payment_id}}</td>
                  <td>{{ltrim($diff->format("%R%a days"),"-")}} ago</td>
                  <td>{!! Helper::badge($payment->status) !!}</td>
                </tr>
                @endforeach
                @else 
              <tr><td colspan="4">No Data Found</td></tr>
              @endif
          </table>
        </div>
        <div id="menu2" class="tab-pane fade in ">
          <table class="table table-bordered table-responsive_ table-striped">
             <tr>
                <th>Amount</th>
                <th>Payment id</th>
                <th>Created At</th>
                <th>Status</th>
              </tr> 
            <tbody>
              <tr>
                <td>1.</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="menu3" class="tab-pane fade in">
          <table class="table table-bordered table-responsive_ table-striped">
             <tr>
                <th>Amount</th>
                <th>Payment id</th>
                <th>Created At</th>
                <th>Status</th>
              </tr> 
            <tbody>
              @if(!empty($refunds))
              @foreach($refunds as $refund)
              <?php
              $date1=date_create("now");
              $date2=date_create($refund['created_at']);
              $diff=date_diff($date1,$date2);
              ?>
              <tr>
                <td>₹{{number_format($refund->amount,2)}}</td>
                <td>{{$refund->payment_id}}</td>
                <td>{{ltrim($diff->format("%R%a days"),"-")}} ago</td>
                <td>{{$refund->status}}</td>
              </tr>
              @endforeach
              @else 
              <tr><td colspan="4">No Data Found</td></tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

        </div>
      </div>
    </div>


    

    </div>

    <!-- Content Row -->
    <div class="row">

    </div>

</div>



<!--Open modal after signup-->
<!-- Trigger/Open The Modal -->
<button id="myBtn" style="display:none;">Open Modal</button>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->           
  <div class="modal-content popup-wavex-form">
      <div class="row">
        <div class="col-md-12">
            <!-- Sidebar --->
            <div class="col-md-3 sidebarwave">
              <div class="left-sidebarwave">
                  <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'Contact')" id="defaultOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        Contact Info
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'Business')" id="defaultOpenTwo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        Business Overview
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'Details')" id="defaultOpenThree">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        Business Details
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'Document')" id="defaultOpenFour">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16    16">
                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                        Document verification
                    </button>
                  </div>
              </div>
            </div>
            <!--Main element-->
            <form id="complete_sign_up_form" enctype="multipart/form-data" method="POST">
              @csrf
              <input type="hidden" value="<?php if(isset($action)) { echo $action; } ?>" name="action">
              <input type="hidden" id="merchant_id" name="merchant_id" value="{{$merchant_id}}">
              <div class="col-md-9 gray-wave tabcontent" id="Contact" >
                  <div class="form-data">
                    <h4>PERSONEL BANK ACCOUNT</h4>
                    
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Beneficiary Name*</label>
                          <div class="col-sm-6">
                              <input type="text" name="beneficiary_name" class="form-control name-text" id="beneficiary_name" value="" placeholder="Enter name">
                              <small id="nameHelp" class="form-text text-muted">We will deposit small amount of money in your account to verify the account.</small>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Branch IFSC code*</label>
                          <div class="col-sm-6">
                              <input type="text" name="ifsc_code" class="form-control name-text" id="ifsc_code"  value="" placeholder="Enter code">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Account Number*</label>
                          <div class="col-sm-6">
                              <input type="text" name="account_number" class="form-control name-text" id="account_number"  value="" placeholder="Enter number">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Re Enter Account Number*</label>
                          <div class="col-sm-6">
                              <input type="text" id="confirm_account_number" class="form-control name-text" id="exampleInputname1"  placeholder="Enter number">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                    
                  </div>
                  <div class="bottom-footer-kyc">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a class="btn btn-md btn-primary" onclick="openCity(event, 'Business')">Save & Next</a>
                    </div>
                  </div>
              </div>
              <div class="col-md-9 gray-wave tabcontent" id="Business">
                  <div class="form-data">
                    <h4>BUSINESS OVERVIEW</h4>
                    
                        <div class="form-group row">
                          <div class="col-sm-2"></div>
                          <label for="inputbusiness1" class="col-sm-2 col-form-label text-right">Business Type*</label>
                          <div class="col-sm-6">
                              <select class="form-control" id="business_type" name="business_type" id="exampleFormControlSelect1" required>
                                <option value="notregistered">Not yet Registerd</option>
                                <option value="registered">Registered</option>
                              </select>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Business Category*</label>
                          <div class="col-sm-6">
                              <select class="form-control" id="business_category" name="business_category" id="exampleFormControlSelect1" required>
                                <option value="">Select</option>
                                <option value="proprietorship">Proprietorship</option>
                                <option value="partnership">Partnership</option>
                                <option value="privatelimited">Private Limited</option>
                                <option value="publiclimited">Public Limited</option>
                                <option value="llp">LLP</option>
                                <option value="trust">Trust</option>
                              </select>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Business Description*</label>
                          <div class="col-sm-6">
                              <textarea class="form-control" id="business_description" name="business_description" id="textAreaExample1" rows="4" placeholder="Minimum 50 characters" required></textarea>
                              <small id="textareaHelp" class="form-text text-muted">Please give a brief description of the nature of your business. Please include examples of products you sell, the business category you operate under, your customers and the channels you primarily use to conduct your business(Website, offline retail etc).</small>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">How do you wish to accept payments*</label>
                          <div class="col-sm-6">
                              <div class="form-check form-check-inline wave-radio">
                                <input class="form-check-input" name="accept_payment_by" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" value="without_website_app">
                                <label class="form-check-label" for="inlineRadio1">Without website/app</label>
                              </div>
                              <div class="form-check form-check-inline wave-radio">
                                <input class="form-check-input" name="accept_payment_by" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" value="with_website_app">
                                <label class="form-check-label" for="inlineRadio2">On my website/app</label>
                              </div>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                          <div class="col-sm-6">
                              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" name="accept_web_permission" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label accept" for="customControlInline">Accept payments on Website</label>
                              </div>
                              <input type="text" class="form-control url-text" id="exampleInputurl1"  placeholder="Enter URL" name="payment_web_url">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row space-bottom-payment">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right"></label>
                          <div class="col-sm-6">
                              <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" name="accept_app_permission" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label accept" for="customControlInline">Accept payments on app</label>
                              </div>
                              <p id="acceptHelp" class="form-text text-muted">We need to verify your website/app to provide you the live API keys. It should contain:</p>
                              <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Pricing</a></li>
                                </ul>
                              </div>
                              <div class="col-sm-6">
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Cancellation/Refund Policy</a></li>
                                </ul>
                              </div>
                              <div class="col-sm-2"></div>
                          </div>
                        </div>
                    
                  </div>
                  <div class="bottom-footer">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                    <a class="btn btn-md btn-primary"  onclick="openCity(event, 'Details')">Save & Next</a>
                    </div>
                  </div>
              </div>
              <div class="col-md-9 gray-wave tabcontent" id="Details">
                  <div class="form-data">
                    <h4>BUSINESS DETAILS</h4>
                    
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Pan Holder's Name*</label>
                          <div class="col-sm-6">
                              <input type="text" id="pan_holder_name" name="pan_holder_name" class="form-control name-text" id="exampleInputname1" value="" placeholder="Enter name" required>
                              <small id="nameHelp" class="form-text text-muted">We verify the deatils with the central Pan database. Please ensure you enter the correct details</small>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Billing Label*</label>
                          <div class="col-sm-6">
                              <input type="text" id="billing_label" name="billing_label" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter" required>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Address*</label>
                          <div class="col-sm-6">
                              <textarea class="form-control" id="billing_address" name="billing_address" id="textAreaExample1" rows="4"  value="" placeholder="Minimum 50 characters" required></textarea>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Pincode*</label>
                          <div class="col-sm-6">
                              <input type="text" id="billing_pincode" name="billing_pincode" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter Pincode" required>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">City*</label>
                          <div class="col-sm-6">
                              <input type="text" id="billing_city" name="billing_city" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter city name" required>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">State*</label>
                          <div class="col-sm-6">
                              <input type="text" id="billing_state" name="billing_state" class="form-control name-text" id="exampleInputname1"  value="" placeholder="Enter State Name" required>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                    
                  </div>
                  <div class="bottom-footer-kyc">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <a class="btn btn-md btn-primary" onclick="openCity(event, 'Document')">Save & Next</a>
                    </div>
                  </div>
              </div>
              <div class="col-md-9 gray-wave tabcontent" id="Document">
                  <div class="form-data" id="loading_div">
                    <h4>DOCUMENTS VERIFICATION</h4>                             
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Address Proof*</label>
                          <div class="col-sm-6">
                              <select class="form-control" name="address_proof" id="exampleFormControlSelect1">
                                <option value="aadhar">Aadhar</option>
                                <option value="passport">Passport</option>
                                <option value="voter_id">Voter id</option>
                              </select>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Aadhar Front*</label>
                          <div class="col-sm-6">
                              <input type="file" name="aadhar_front" id="myFile" name="filename">
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-1"></div>
                          <label for="inputbusiness1" class="col-sm-3 col-form-label text-right">Aadhar Back*</label>
                          <div class="col-sm-6">
                              <input type="file" name="aadhar_back" id="myFile" name="filename">
                              <small id="nameHelp" class="form-text text-muted">JPG/PNG of max size 2mb or pdf of max size 4mb.</small>
                          </div>
                          <div class="col-sm-2"></div>
                        </div>
                    
                  </div>
                  <div class="bottom-footer-kyc">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <a class="btn btn-md btn-primary" onclick="submit_signup_form()">Submit Form</a>
                    </div>
                  </div>
              </div>
            </form>
        </div>
      </div>
  </div>           
</div>
<!--End complete signup modal--> 



@endsection


@section('page-script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('newdesign/vendor/chart.js/Chart.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('newdesign/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('newdesign/js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
$(function() {
    /*var start = moment().subtract(29, 'days');
    var end = moment();
	  var start = moment().startOf('month');*/
	  var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
});


$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
    var start_date = picker.startDate.format('YYYY-MM-DD');
    var end_date = picker.endDate.format('YYYY-MM-DD');

	var status_filter = $("#status_filter").val();
	
	$.ajax({
        url: '{{url("getsuccesstransactiongraphdata")}}',
        data: {start_date : start_date, end_date: end_date, status_filter: status_filter},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){      
			console.log(data);    
			create_ajax_payment_chart(data.paymentxvalue1,data.paymentyvalue1);
			create_ajax_order_chart(data.orderxvalue1,data.orderyvalue1);
      create_ajax_method_chart(data.paymentmethodxvalue,data.paymentmethodyvalue);
			/*$("#order_count").html(data.total_order);
			$("#total_payment_amount").html('₹'+(data.total_payment_amount).toFixed(2));
			$("#success_rate_container").html(data.success_perc+'<sup style="font-size: 20px">%</sup>');
            */
            $("#card_value_1").html(data.total_order);
            $("#card_value_2").html('₹'+(data.total_payment_amount).toFixed(2));
            $("#card_value_3").html(data.success_perc+'<sup style="font-size: 20px">%</sup>');

        }
    });
});


function create_ajax_payment_chart(xValues,yValues){
	console.log(xValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'chart-line');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
            var ctx = document.getElementById("myAreaChart1");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: (xValues.trim()).split(','),
                datasets: [{
                label: "Payment",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: (yValues.trim()).split(','),
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
                },
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false,
                    drawBorder: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    callback: function(value, index, values) {
                        return '₹' + number_format(value);
                    }
                    },
                    gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                    }
                }],
                },
                legend: {
                display: false
                },
                tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
                    }
                }
                }
            }
            });
		}
	}
}


function create_ajax_order_chart(oxValues,oyValues){
	console.log(oxValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'chart-line2');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
            var ctx2 = document.getElementById("myBarChart1");
            var myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: (oxValues.trim()).split(','),
                datasets: [{
                label: "Revenue",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: (oyValues.trim()).split(','),
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
                },
                scales: {
                xAxes: [{
                    time: {
                    unit: 'month'
                    },
                    gridLines: {
                    display: false,
                    drawBorder: false
                    },
                    ticks: {
                    maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 15000,
                    maxTicksLimit: 5,
                    padding: 10,
                    callback: function(value, index, values) {
                        return '₹' + number_format(value);
                    }
                    },
                    gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                    }
                }],
                },
                legend: {
                display: false
                },
                tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
                    }
                }
                },
            }
            });

		}
	}

}


function create_ajax_method_chart(pxValues,pyValues){
  console.log(pxValues);
	var canv = document.createElement("canvas");
	canv.width = 200;
	canv.height = 200;
	canv.setAttribute('id', 'chart-line2');
	document.body.appendChild(canv);
	var C = document.getElementById(canv.getAttribute('id'));
	if (C.getContext) 
	{              
    	if (C.getContext) 
		{
      var ctxmethod3 = document.getElementById("mymethodChart");
      var myBarChart3 = new Chart(ctxmethod3, {
        type: 'bar',
        data: {
          labels: (pxValues.trim()).split(','),
          datasets: [{
            label: "Revenue",
            backgroundColor: "#6f42c1",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: (pyValues.trim()).split(','),
          }],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'Method'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 25,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 500,
                maxTicksLimit: 5,
                padding: 10,
                callback: function(value, index, values) {
                  return '₹' + number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: false
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#00008B',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
              }
            }
          },
        }
      });

		}
	}
}
</script>



<script>
    $(function(){
      $('#status_filter').on('change', function () {
          var url = $(this).val(); 
          if (url) { 
              window.location = '{{ url("/") }}/transactions/payments/status?status='+url; // redirect
			        //window.open('{{ url("/") }}/transactions/payments/status?status='+url, '_blank');
          }
          return false;
      });
    });
</script>



<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


// Area Chart Example
var ctx = document.getElementById("myAreaChart1");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: {!! $paymentxvalue1 !!},
    datasets: [{
      label: "Payment",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "#00008B",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "#00008B",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: {{$paymentyvalue1}},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});



// Bar Chart Example
var ctx2 = document.getElementById("myBarChart1");
var myBarChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: {!! $orderxvalue1 !!},
    datasets: [{
      label: "Revenue",
      backgroundColor: "#00008B",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: {{$orderyvalue1}},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#00008B',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});



// Bar Chart Example
var ctxmethod = document.getElementById("mymethodChart");
var myBarChart2 = new Chart(ctxmethod, {
  type: 'bar',
  data: {
    labels: {!! $paymentmethodxvalue !!},
    datasets: [{
      label: "Revenue",
      backgroundColor: "#6f42c1",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: {{$paymentmethodyvalue}},
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'Method'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 5000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#00008B',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});



// Pie Chart Example
var ctx3 = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx3, {
  type: 'doughnut',
  data: {
    labels: ["Minimum Transaction", "Maximum Transaction"],
    datasets: [{
      data: {{$min_max_transacion}},
      backgroundColor: ['#4e73df', '#1cc88a'],
      hoverBackgroundColor: ['#2e59d9', '#17a673'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
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
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    $("#defaultOpen").addClass('active');
    

    $( document ).ready(function() {
      $("#gsettingclick").click();
      $("#generalli").addClass('active');
      $("#menu1").show();
      var btn = document.getElementById("myBtn");
      @if($is_kyc_completed=='no')
      btn.click();
      @endif
      
  });



  function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        if(tabcontent[i].id=='Contact'){
          tabcontent[i].style.display = "block";
        }else{
          tabcontent[i].style.display = "none";
        }
        
      }

      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      
      if(cityName=='Business')
      {
          var beneficiary_name = $("#beneficiary_name").val();
          var ifsc_code = $("#ifsc_code").val();
          var account_number = $("#account_number").val();
          var confirm_account_number = $("#confirm_account_number").val();

          /*if(typeof beneficiary_name === 'undefined' || typeof ifsc_code ==='undefined' || typeof account_number ==='undefined')*/
          if(beneficiary_name == '' || ifsc_code == '' || account_number == '')
          {
              swal("Oops!", "Please fill up all the field", "error");
              $("#defaultOpen").addClass('active');
              return false;
          }
          else
          {
              if(confirm_account_number!=account_number)
              {
                  swal("Oops!", "Account Number and Confirm Account Number Not Same!!", "error");
                  $("#defaultOpen").addClass('active');
                  return false;
              }
              document.getElementById("Contact").style.display = "none";
              document.getElementById(cityName).style.display = "block";
              $("#defaultOpenTwo").addClass('active');
              evt.currentTarget.className += " active";
          }
      }

      if(cityName=='Details')
      {
          var business_type = $("#business_type").val();
          var business_category = $("#business_category").val();
          var business_description = $("#business_description").val();

          /*if(typeof beneficiary_name === 'undefined' || typeof ifsc_code ==='undefined' || typeof account_number ==='undefined')*/
          if(business_type == '' || business_category == '' || business_description == '')
          {
              swal("Oops!", "Please Fill Up All The Field", "error");
              $("#defaultOpenTwo").addClass('active');
              document.getElementById("Business").style.display = "block";
              document.getElementById("Details").style.display = "none";
              document.getElementById("Contact").style.display = "none";
              return false;
          }
          else
          {
              document.getElementById("Business").style.display = "none";
              document.getElementById("Contact").style.display = "none";
              document.getElementById(cityName).style.display = "block";
              $("#defaultOpenThree").addClass('active');
              evt.currentTarget.className += " active";
          }
      }

      if(cityName=='Document')
      {
          var pan_holder_name = $("#pan_holder_name").val();
          var billing_label = $("#billing_label").val();
          var billing_address = $("#billing_address").val();
          var billing_pincode = $("#billing_pincode").val();
          var billing_city = $("#billing_city").val();
          var billing_state = $("#billing_state").val();

          if(pan_holder_name == '' || billing_label == '' || billing_address == '' || billing_pincode == '' || billing_city == '' || billing_state == '')
          {
            swal("Oops!", "Please Fill Up All The Field", "error");
            $("#defaultOpenThree").addClass('active');
            document.getElementById("Details").style.display = "block";
            document.getElementById("Business").style.display = "none";
            document.getElementById("Contact").style.display = "none";
            return false;
          }
          else
          {
            document.getElementById("Business").style.display = "none";
            document.getElementById("Contact").style.display = "none";
            document.getElementById("Details").style.display = "none";
            document.getElementById(cityName).style.display = "block";
            $("#defaultOpenFour").addClass('active');
            evt.currentTarget.className += " active";
          }

      }
      
  }


  function submit_signup_form()
  {
      $("#loading_div").LoadingOverlay("show", {
          background  : "rgba(165, 190, 100, 0.5)"
      });

      // Get form
      var form = $('#complete_sign_up_form')[0];
      // Create an FormData object 
      var data = new FormData(form);

      $.ajax({
          url: '{{url("completesignupprocess")}}',
          data: data,
          type: "POST",
          processData: false,
          contentType: false,
          cache: false,
          headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(data){
            if(data.success==1){
                swal("Successful", "Sign Up sucessfully completed", "success");
                $("#loading_div").LoadingOverlay("hide", true);
                $("#complete_sign_up_form")[0].reset();
                setTimeout(function () {
                  window.location.href = "{{ route('welcome_to_wavexpay')}}";
                }, 2500); 
            }
          }
      });
  }
</script>
@endsection
