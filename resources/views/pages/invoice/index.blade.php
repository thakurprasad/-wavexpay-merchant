@extends('newlayout.app-advance')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Invoices</h6>
        </div>
        <div class="card-body"> 
            <x-filter-component form_id="search_form" action="searchinvoice" method="POST" status="invoices"> 
                @section('advance_filters')
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Invoice Id</label>
                            <input placeholder="Invoice ID" name="invoice_id" id="invoice_id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Reciept No</label>
                            <input placeholder="Reciept No" name="reciept_number" id="reciept_number" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="input-field col s3">
                        <label for="first_name">Customer Contact</label>
                        <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control">
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Customer Email</label>
                            <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="form-control">
                        </div>
                    </div>
                @endsection
            </x-filter-component>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <tbody id="table_container">
                        @if(!empty($all_invoices))
                        @foreach($all_invoices as $invoice)
                        @php 
                            $qty = explode(',',$invoice->item_qty);
                            $customer_details = Helper::get_customer_details($invoice->customer_id);  
                            $items = explode(',',$invoice->item_id);
                            $amount = 0;
                            $count = 0;
                            foreach($items as $iid){
                                $item_details = Helper::get_item_details($iid);
                                
                                
                                $amount+=($item_details->amount)*$qty[$count];
                                $count++;
                            } 

                            if(isset($invoice->receipt) && $invoice->receipt!=''){
                                $reciept = $invoice->receipt;
                            }else{
                                $reciept = '';
                            }
                        @endphp
                        <tr>
                            <td><a style="color: blue;" href="{{ url('/invoice',$invoice->invoice_id) }}">{{ $invoice->invoice_id }}</a></td>
                            <td>{{ number_format($amount,2) }}</td>
                            <td>{{ $reciept }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>{{ $customer_details->name}} ({{$customer_details->contact}} / {{$customer_details->email}})	</td>
                            <td>{{$invoice->short_url}}</td>
                            <td>{!! Helper::badge($invoice->status) !!}</td>
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
        url: '{{url("searchinvoice")}}',
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