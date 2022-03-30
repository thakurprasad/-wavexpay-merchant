{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Orders')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/searchorder">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <input placeholder="Order Id" name="order_id" id="order_id" type="text" class="validate">
                                <label for="first_name">Order Id</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Reciept" name="reciept" id="reciept" type="text" class="validate">
                                <label for="first_name">Reciept</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Notes" id="notes" name="notes" type="text" class="validate">
                                <label for="last_name">Notes</label>
                            </div>
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="accepted">Accepted</option>
                                <option value="paid">Paid</option>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="button" onclick="search_order()" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Attempts</th>
                        <th scope="col">Receipt</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_orders->items))
                        @foreach($all_orders->items as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{number_format($order->amount/100,2)}}</td>
                            <td>{{$order->attempts}}</td>
                            <td>{{$order->receipt}}</td>
                            <td>{{date("jS F, Y", $order->created_at)}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$order->status}}</a>
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
</script>
@endsection