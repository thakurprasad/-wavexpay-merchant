{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payment Links')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="partially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Payment Link ID" name="payment_link_id" id="payment_link_id" type="text" class="validate">
                                <label for="first_name">Payment Link Id</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Batch Id" name="batch_id" id="batch_id" type="text" class="validate">
                                <label for="first_name">Batch Id</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="validate">
                                <label for="first_name">Reference Id</label>
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
                                <button class="btn waves-effect waves-light" type="button" name="action" onclick="search_payment_link()">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Payment Link Id</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Reference Id</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Payment Links</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                       
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


function search_payment_link(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchpaymentlink")}}',
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