@extends('newlayout.app-advance')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Invoices Template
        </div>
        <div class="card-body"> 
            <x-invoice id="{{ $invoice_id }}" />                 
        </div>
    </div>
</div>
@endsection

@section('page-script')

@endsection