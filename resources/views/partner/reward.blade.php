@extends('newlayout.app')
@section('title','Payment Links')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Rewards</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Rewards</li>
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
        <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
            @csrf
            <div class="card-body">
                <div class="row">                 
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="first_name" style="color:#00008B;"><strong>Date Range</strong><For></For></label>
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 66%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
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
                    <tr><label for="first_name" style="color:#00008B;"><strong>My Total Earning : </label><span style="color:#4e73df;"> ₹{{ count($all_merchants)*($merchant_details->reward_value) }}</span></strong></tr>
                    <tr>
                        <th scope="col">Account Name</th>
                        <th scope="col">Total Earning</th>
                        <th scope="col">Transaction Amount</th>
                        <th scope="col">No Of Active Account</th>
                        <th scope="col">No Of Transactions</th>
                    </tr>
                </thead>
                <tbody id="table_container">                    
                    @if(!empty($all_merchants))
                    @foreach($all_merchants as $merchant)

                    @php 
                    
                    @endphp

                    <tr>
                        <td scope="col">{{$merchant->merchant_name}}</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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
</script>
@endsection