@extends('newlayout.app')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Payments</h6>
        </div>
        <div class="card-body">
            <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/searchpayments">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="payment_id">Payment Id</label>
                                <input type="text" name="payment_id" class="form-control" id="payment_id" placeholder="Payment Id">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <x-dropdown />
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" class="form-control" id="notes" placeholder="Notes">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" placeholder="End Date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br clear="all">
                                <button type="button" class="btn btn-primary"  onclick="search_payment()">Submit</button>
                                <button type="button" class="btn btn-info"  onclick="reset_page()">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Payment Id</th>
                            <th>Amount</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_payments))
                        @foreach($all_payments as $payment)
                        <tr>
                            <td>{{$payment->payment_id}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->email}}</td>
                            <td>{{$payment->contact}}</td>
                            <td>{{$payment->created_at}}</td>
                            <td>{!! Helper::badge($payment->status) !!}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
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

function reset_page(){
    location.reload();
}
</script>
@endsection