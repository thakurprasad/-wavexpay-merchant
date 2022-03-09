{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Invoices')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" action="<?php url('/') ?>/searchinvoice">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="all">All</option>
                                <option value="draft">Draft</option>
                                <option value="issued">Issued</option>
                                <option value="parially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                                </select>
                                <label>Invoice Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Invoice ID" name="invoice_id" id="invoice_id" type="text" class="validate">
                                <label for="first_name">Invoice Id</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Reciept No" name="reciept_number" id="reciept_number" type="text" class="validate">
                                <label for="first_name">Reciept No</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="validate">
                                <label for="first_name">Customer Contact</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="validate">
                                <label for="first_name">Customer Email</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Notes" name="notes" id="notes" type="text" class="validate">
                                <label for="first_name">Notes</label>
                            </div>
                            
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
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
                    <tbody>
                        @if(!empty($all_invoices->items))
                        @foreach($all_invoices->items as $invoice)
                        <tr>
                            <th scope="row">{{$invoice->id}}</th>
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
            </p>
        </div>
    </div>
</div>
@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
} );
</script>
@endsection