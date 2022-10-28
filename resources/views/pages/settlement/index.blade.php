@extends('newlayout.app')
@section('title','Settlements')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Orders Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Orders</li>
	</ol>
	</div>
</div>
@endsection
@section('content')
  <div class="container-fluid">    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Disputes</h6>
        </div>
        <div class="card-body"> 
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
            <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/searchsettlements">
                @csrf
                <div class="card-body">
                    <div class="row">                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="first_name"><strong>Payment Date Range</strong><For></For></label>
                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Settlement Id</label>
                                <input placeholder="Settlement ID" name="settlement_id" id="settlement_id" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary"  onclick="search_settlement()">Submit</button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm" id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Settlement Id</th>
                        <th scope="col">Fees</th>
                        <th scope="col">Tax</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_settlements->items))
                        @foreach($all_settlements->items as $settlement)
                        <tr>
                            <th scope="row">{{$settlement['id']}}</th>
                            <td>{{number_format($settlement['fees']/100,2)}}</td>
                            <td>{{number_format($settlement['tax']/100,2)}}</td></td>
                            <td>{{date('Y-m-d',$settlement['created_at'])}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$settlement['status']}}</a>
                                <a class="waves-effect waves-light btn-flat">Breakup</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('page-script')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(function() {

    /*var start = moment().subtract(29, 'days');
    var end = moment();*/
	var start = moment().startOf('month');
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

<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
} );


function search_settlement(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchsettlement")}}',
        data: $("#search_form").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#table_container").LoadingOverlay("hide", true);
            $("#table_container").html(data.html);
            $('#myTable').DataTable();
        }
    });
}
</script>
@endsection