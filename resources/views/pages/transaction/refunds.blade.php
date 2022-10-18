@extends('newlayout.app')

{{-- page title --}}
@section('title','Refunds')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Refund Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Refunds</li>
	</ol>
	</div>
</div>
@endsection

{{-- page content --}}
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
                            <label for="first_name">Refund Id</label>
                            <input placeholder="Refund Id" name="refund_id" id="refund_id" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Payment Id</label>
                            <input placeholder="Payment Id" name="payment_id" id="payment_id" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="last_name">Notes</label>
                            <input placeholder="Notes" id="notes" name="notes" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">Choose your option</option>
                                <option value="created">Created</option>
                                <option value="accepted">Accepted</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary"  onclick="search_refund()">Submit</button>
            </div>
        </form>
    </div>
    <div class="card">
		<div class="card-header">
			<div class="pull-left">

	        </div>
	        <div class="pull-right">


	        </div>
        </div>

		<div class="card-body">
			<table class="table table-bordered table-striped table-responsive-sm"  id="myTable">
				<thead>
                    <tr>
                    <th scope="col">Refund Id</th>
                    <th scope="col">Payment Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="table_container">
                    @if(!empty($all_refunds->items))
                    @foreach($all_refunds->items as $refund)
                    <tr>
                        <th scope="row">{{$refund->id}}</th>
                        <th scope="row">{{$refund->payment_id}}</th>
                        <td>{{number_format($refund->amount/100,2)}}</td>
                        <td>{{date("jS F, Y", $refund->created_at)}}</td>
                        <td>
                            <a class="waves-effect waves-light btn-small">{{$refund->status}}</a>
                        </td>
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


function search_refund(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchrefund")}}',
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
