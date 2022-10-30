@extends('newlayout.app-advance')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Payment Pages</h6>
        </div>
        <div class="card-body"> 
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                    <a class="btn btn-sm btn-info" href="{{ url('/create-payment-pages') }}">Create Payment Page</a>
                    </div>
                </div>
            </div>
            <x-filter-component form_id="search_form" action="searchpaymentpage" method="POST" status="paymentpages"> 
            </x-filter-component>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Total Sales</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Units Sold</th>
                            <th scope="col">Page Url</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Payment Url</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($res))
                        @foreach($res as $page)
                        <tr>
                            <td><a style="cursor:pointer;" data-toggle="modal" data-target="#modal1" onclick="show_payment_page('{{ $page->id }}')">{{$page->page_title}}</a></th>
                            <td>{{ $page->amount }}</td>
                            <td>0</td>
                            <td>{!! $page->page_content !!}</td>
                            <td>0</td>
                            <td>{{ $page->custom_url }}</td>
                            <td>{{ date('Y-m-d',strtotime($page->created_at)) }}</td>
                            <td><button class="btn btn-sm btn-info" onclick="copy('{{$page->page_url}}')">Copy Url</button></td>
                            <td>
                                @if($page->status=='Inactive')
                                <span class="badge badge-danger">{{ $page->status }}</span>
                                @else
                                <span class="badge badge-success">{{ $page->status }}</span>
                                @endif
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



<div id="modal1" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_heading">page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form-payment-page" method="post">
            <input type="hidden" id="edit_id">
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">Page Url</label>
                    <input placeholder="Page Url" name="page_url" id="page_url" type="text" class="form-control" required>
                    <span class="text-danger" id="nameError"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">Page Status</label>
                    <input placeholder="Page Status" name="page_status" id="page_status" type="text" class="form-control" >
                    <span id="statusContainer"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">Payment Page Id</label>
                    <input placeholder="Page Id" name="payment_page_id" id="payment_page_id" type="text" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label id="con">Created On </label><br><span name="created_on" id="created_on"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="first_name">Expires On: &nbsp;&nbsp; &nbsp; <strong style="color:green;">No Expiry</strong></label>
                    <input name="expires_on" id="expires_on" type="date" class="form-control" required>
                </div>    
            </div>
            </div>
            <div class="col-sm-3" id="save_button">  
                <div class="form-group">                        
                    <button class="btn btn-sm btn-info" id="create_customer_btn" type="button" name="action" onclick="save_payment_page()">Save</button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="modal2" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose From The Below Templates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="template-container">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        url: '{{url("searchpaymentpage")}}',
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



function show_payment_page(id){
    $.ajax({
        url: '{{url("get-payment-page-details")}}',
        type: "POST",
        data: {'id' : id },
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $(".creatediv").show();
            $("#modal_heading").html(data.page_title);
            $("#page_status").val(data.status);
            $("#page_url").val(data.custom_url);
            $("#payment_page_id").val(id);
            $("#created_on").html('<strong>'+new Date(data.created_at)+'</strong>');
            /*if(data.status==="Active"){
                $("#statusContainer").html('<button class="btn waves-effect waves-light" id="change_status_btn" type="button" name="action" onclick="changestatus()">Change Status</button>');
            }else{*/
                $("#statusContainer").html('');
            /*}*/
            $("#save_button").hide();
        }
    });
    
}


function search_pages(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchpaymentpage")}}',
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


function copy(url) {
    var dummy = document.createElement('input'),
    text = url;
    document.body.appendChild(dummy);
    dummy.value = '{{ url("/") }}/pages.merchant.com/'+text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    alert('Url Copied');
}
</script>
@endsection