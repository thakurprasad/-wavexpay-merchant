@extends('newlayout.app-advance')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Settlements</h6>
        </div>
        <div class="card-body"> 
            <x-filter-component form_id="search_form"  action="searchsettlements" method="POST" status="settlements"> 
                @section('advance_filters')
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="payment_id">Settlement Id</label>
                            <input type="text" name="settlement_id" class="form-control" id="settlement_id" placeholder="Settleement Id">
                        </div>
                    </div>
                @endsection
            </x-filter-component>

            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Settlement Id</th>
                            <th scope="col">Fees</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_settlements))
                        @foreach($all_settlements as $settlement)
                        <tr>
                            <th scope="row">{{$settlement->settlement_id}}</th>
                            <td>{{number_format($settlement->fees,2)}}</td>
                            <td>{{number_format($settlement->tax,2)}}</td></td>
                            <td>{{date('Y-m-d',$settlement->created_at)}}</td>
                            <td>
                                <a class="waves-effect waves-light btn-small">{!! Helper::badge($settlement['status']) !!}</a>
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
function search_data(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });

    var start_date = $('#daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#daterangepicker').data('daterangepicker').endDate.format('YYYY-MM-DD');
    $.ajax({
        url: '{{url("searchsettlement")}}',
        data: $("#search_form").serialize()+'&start_date='+start_date+'&end_date='+end_date,
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#table_container").LoadingOverlay("hide", true);
            $("#table_container").html(data.html);
        }
    });
}

function reset_page(){
    location.reload();
}
</script>
@endsection