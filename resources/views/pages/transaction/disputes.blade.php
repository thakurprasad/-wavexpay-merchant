{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Disputes')

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
                                <input placeholder="Order Id" name="dispute_id" id="dispute_id" type="text" class="validate">
                                <label for="first_name">Dispute Id</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Reciept" name="payment_id" id="payment_id" type="text" class="validate">
                                <label for="first_name">Payment Id</label>
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
                                <select name="status">
                                    <option value="">All</option>
                                    <option value="open">Open</option>
                                    <option value="under_review">Under Review</option>
                                    <option value="lost">Lost</option>
                                    <option value="won">Won</option>
                                    <option value="closed">Closed</option>
                                </select>
                                <label>Dispute Status</label>
                            </div>
                            <div class="input-field col s3">
                                <select name="phase">
                                    <option value="">All</option>
                                    <option value="retrieval">Retrieval</option>
                                    <option value="chargeback">Chargeback</option>
                                    <option value="pre_arbitration">Pre Arbitration</option>
                                    <option value="arbitration">Arbitration</option>
                                    <option value="fraud">Fraud</option>
                                </select>
                                <label>Dispute Type</label>
                            </div>
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="button" onclick="search_dispute()" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Dispute Id</th>
                        <th scope="col">Payment Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                        <th scope="col">Respond By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_disputes['items']))
                        @foreach($all_disputes['items'] as $dispute)
                        <tr>
                            <th scope="row">{{$dispute['id']}}</th>
                            <th scope="row">{{$dispute['payment_id']}}</th>
                            <td>{{number_format($dispute['amount'],2)}}</td>
                            <td>{{$dispute['reason_code']}}</td>
                            <td>{{date("jS F, Y", $dispute['respond_by'])}}</td>
                            <td>{{date("jS F, Y", $dispute['created_at'])}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$dispute['status']}}</a>
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


function search_dispute(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchdispute")}}',
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