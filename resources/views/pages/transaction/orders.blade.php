@extends('newlayout.app-advance')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
        </div>
        <div class="card-body">
            <x-filter-component form_id="search_form" action="transactions/searchorder" method="POST" status="orders"> 
                @section('advance_filters')
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="first_name">Order Id</label>
                        <input placeholder="Order Id" name="order_id" id="order_id" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="first_name">Reciept</label>
                        <input placeholder="Reciept" name="reciept" id="reciept" type="text" class="form-control">
                    </div>
                </div>
                @endsection
            </x-filter-component>
            <!--<form style="display:none;" class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/searchorder">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Order Id</label>
                                <input placeholder="Order Id" name="order_id" id="order_id" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Reciept</label>
                                <input placeholder="Reciept" name="reciept" id="reciept" type="text" class="form-control">
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
                                <br clear="all">
                                <button type="button" class="btn btn-primary" onclick="search_order()">Submit</button>
                                <button type="button" class="btn btn-info"  onclick="reset_page()">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>-->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        @if(!empty($all_orders))
                        @foreach($all_orders as $order)
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>{{number_format($order->amount,2)}}</td>
                            <td>{{$order->attempts}}</td>
                            <td>{{$order->receipt}}</td>
                            <td>{{date('Y-m-d',strtotime($order->created_at))}}</td>
                            <td>{!! Helper::badge($order->status) !!}</td>
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
function search_data(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    var start_date = $('#daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#daterangepicker').data('daterangepicker').endDate.format('YYYY-MM-DD');
    $.ajax({
        url: '{{url("searchorder")}}',
        data: $("#search_form").serialize()+'&start_date='+start_date+'&end_date='+end_date,
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