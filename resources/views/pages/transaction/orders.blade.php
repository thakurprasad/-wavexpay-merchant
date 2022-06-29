@extends('layouts.admin')
@section('title','Orders')
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
        <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/searchorder">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Order Id</label>
                            <input placeholder="Order Id" name="order_id" id="order_id" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Reciept</label>
                            <input placeholder="Reciept" name="reciept" id="reciept" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="last_name">Notes</label>
                            <input placeholder="Notes" id="notes" name="notes" type="text" class="form-control">
                        </div>
                    </div>
                    <!--<div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="accepted">Accepted</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary"  onclick="search_order()">Submit</button>
                <button type="button" class="btn btn-info"  onclick="reset_page()">Reset</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">

        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Attempts</th>
                    <th scope="col">Receipt</th>
                    <th scope="col">Created At</th>
                    <!--<th scope="col">Status</th>-->
                    </tr>
                </thead>
                <tbody id="table_container">
                    @if(!empty($all_orders))
                    @foreach($all_orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{number_format($order->amount,2)}}</td>
                        <td>{{$order->attempts}}</td>
                        <td>{{$order->receipt}}</td>
                        <td>{{$order->created_at}}</td>
                        <!--<td>
                            <a class="waves-effect waves-light btn-small">{{$order->status}}</a>
                        </td>-->
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
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
} );


function search_order(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchorder")}}',
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

function reset_page(){
    location.reload();
}
</script>
@endsection