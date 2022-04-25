@extends('layouts.admin')
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