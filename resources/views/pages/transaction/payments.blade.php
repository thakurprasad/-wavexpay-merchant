{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payments')



{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/searchpayments">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <input placeholder="Payment ID" name="payment_id" id="payment_id" type="text" class="validate">
                                <label for="first_name">Payment Id</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Email" id="email" name="email" type="text" class="validate">
                                <label for="last_name">Email</label>
                            </div>
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="authorized">Authorized</option>
                                <option value="captured">Captured</option>
                                <option value="refunded">Refunded</option>
                                <option value="failed">Failed</option>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Notes" id="notes" name="notes" type="text" class="validate">
                                <label for="last_name">Notes</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="start_date" name="start_date" type="text" class="datepicker">
                                <label for="last_name">Start Date</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="end_date" name="end_date" type="text" class="datepicker">
                                <label for="last_name">End Date</label>
                            </div>

                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" onclick="search_payment()" type="button" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Payment Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_payments->items))
                        @foreach($all_payments->items as $payment)
                        <tr>
                            <th scope="row">{{$payment['id']}}</th>
                            <td>{{$payment['amount']}}</td>
                            <td>{{$payment['email']}}</td>
                            <td>{{$payment['contact']}}</td>
                            <td>{{date('Y-m-d',$payment->created_at)}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$payment['status']}}</a>
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
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
} );


function search_payment(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchpayment")}}',
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