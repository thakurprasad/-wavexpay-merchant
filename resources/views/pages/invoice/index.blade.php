{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Invoice')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Invoice Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Invoice</li>
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
        <div class="card-body">
            <a href="{{ url('/newinvoice') }}" class="btn btn-md btn-warning">Create Invoice</a>
        </div>
        <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Invoice Id</label>
                            <input placeholder="Invoice ID" name="invoice_id" id="invoice_id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Reciept No</label>
                            <input placeholder="Reciept No" name="reciept_number" id="reciept_number" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="input-field col s3">
                        <label for="first_name">Customer Contact</label>
                        <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Customer Email</label>
                            <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Notes</label>
                            <input placeholder="Notes" name="notes" id="notes" type="text" class="form-control">
                        </div>
                    </div>  
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary"  onclick="search_invoice()">Submit</button>
                <button type="button" class="btn btn-info"  onclick="reload_page()">Reset</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">

        </div>
		<div class="card-body">
            <table class="table table-bordered table-responsive-sm" id="datatable">
                <thead>
                    <tr>
                    <th scope="col">Invoice Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Reciept No</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Payment Links</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="table_container">
                    @if(!empty($all_invoices->items))
                    @foreach($all_invoices->items as $invoice)
                    <tr>
                        <td><a href="{{ url('/invoice',$invoice->id) }}">{{$invoice->id}}</a></td>
                        <td>{{number_format(($invoice->line_items[0]->net_amount)/100,2)}}</td>
                        <td>{{$invoice->receipt}}</td>
                        <td>{{date('Y-m-d',$invoice->created_at)}}</td>
                        <td>{{$invoice->customer_details->name}} ({{$invoice->customer_details->contact}} / {{$invoice->customer_details->email}})	</td>
                        <td>{{$invoice->short_url}}</td>
                        <td>
                            @if($invoice->status=='cancelled')
                            <span class="new badge red">{{$invoice->status}}</span>
                            @else
                            <span class="new badge blue">{{$invoice->status}}</span>
                            @endif
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


function search_invoice(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchinvoice")}}',
        data: $("#search-form").serialize(),
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

function reload_page(){
    location.reload();
}
</script>
@endsection