@extends('newlayout.app-advance')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Refunds</h6>
        </div>
        <div class="card-body">

        <x-filter-component form_id="search_form" action="transactions/searchpayments" method="POST"> 

            @section('advance_filters')
             
               <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Refund Id</label>
                                <input placeholder="Refund Id" name="refund_id" id="refund_id" type="text" class="form-control">
                            </div>
                        </div>

            @endsection

          
        </x-filter-component>


            <form class="col s12" id="search_form" method="POST" action="<?php url('/') ?>/transactions/search_refund">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Refund Id</label>
                                <input placeholder="Refund Id" name="refund_id" id="refund_id" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="first_name">Payment Id</label>
                                <input placeholder="Payment Id" name="payment_id" id="payment_id" type="text" class="form-control">
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
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Choose your option</option>
                                    <option value="created">Created</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br clear="all">
                                <button type="button" class="btn btn-primary"  onclick="search_refund()">Submit</button>
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
                            <th scope="col">Refund Id</th>
                            <th scope="col">Payment Id</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_refunds->items))
                        @foreach($all_refunds->items as $refund)
                        <tr>
                            <th scope="row">{{$refund->id}}</th>
                            <th scope="row">{{$refund->payment_id}}</th>
                            <td>{{number_format($refund->amount/100,2)}}</td>
                            <td>{{date("jS F, Y", $refund->created_at)}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{{$refund->status}}</a>
                            </td>
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
function search_refund(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchrefund")}}',
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