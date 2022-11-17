@extends('newlayout.app-advance')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction Report</h6>
        </div>
        @include('alerts.message')
        <div class="card-body"> 
            <x-report-filter-component form_id="search_form" action="download-report" method="POST" type={{$type}}> 
                @section('advance_filters')
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Select Format</label>
                            <select class="form-control" name="report_format" id="report_format">
                                <option value="csv">CSV</option>
                                <option value="xlsx">xlsx</option>
                            </select>
                        </div>
                    </div>
                @endsection
            </x-filter-component>
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
    /*
    var start_date1 = $('#_daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
    alert(start_date1);

    if($("#_daterangepicker").val() == ''){
        start_date = '';
        end_date = '';
    } */


    $.ajax({
        url: '{{url("searchpayment")}}',
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