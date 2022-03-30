{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payment Pages')

{{-- page content --}}
@section('content')
<div class="section">
    <a class="waves-effect waves-light btn modal-trigger"  href="#modal2" onclick="create_payment_page()">Create Payment Page</a>
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" id="search-form">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <select name="status">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Title" name="title" id="title" type="text" class="validate">
                                <label for="first_name">Title</label>
                            </div>

                            <div class="input-field col s3">                          
                                <!--<button class="btn waves-effect waves-light" type="button" name="action" onclick="search_pages()">Submit
                                    <i class="material-icons right">send</i>
                                </button>-->
                            </div>

                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="button" name="action" onclick="reload_page()">Reset
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Total Sales</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Units Sold</th>
                        <th scope="col">Page Url</th>
                        <th scope="col">Created On</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($res))
                        @foreach($res as $page)
                        <tr>
                            <th scope="row"><a class="waves-effect waves-light modal-trigger"  href="#modal1" onclick="show_payment_page('{{ json_encode($page) }}')">{{$page['page_title']}}</a></th>
                            <td>0</td>
                            <td>{!! $page['page_content'] !!}</td>
                            <td>0</td>
                            <td>{{$page['custom_url']}}</td>
                            <td>{{date('Y-m-d',strtotime($page['created_at']))}}</td>
                            <td>
                                @if($page['status']=='Inactive')
                                <span class="badge red">{{$page['status']}}</span>
                                @else
                                <span class="badge blue">{{$page['status']}}</span>
                                @endif
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




<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer" style="width:800px;">
    <div class="modal-content">
      <h4 id="modal_heading">page</h4>
        <form id="form-payment-page" method="post">
            <input type="hidden" id="edit_id">
            <div class="input-field col s6">
                <input placeholder="Page Url" name="page_url" id="page_url" type="text" class="validate" required>
                <label for="first_name">Page Url</label>
                <span class="text-danger" id="nameError"></span>
            </div>
            <div class="input-field col s6">
                <input placeholder="Page Status" name="page_status" id="page_status" type="text" class="validate" >
                <label for="first_name">Page Status</label>
                <span id="statusContainer"></span>
            </div>
            <div class="input-field col s6">
                <input placeholder="Page Id" name="payment_page_id" id="payment_page_id" type="text" class="validate" required>
                <label for="first_name">Payment Page Id</label>
            </div>
            <div class="input-field col s6 creatediv">
                <label id="con">Created On </label><br><br><span name="created_on" id="created_on"></span>
            </div>
            <div class="input-field col s6">
                <input name="expires_on" id="expires_on" type="date" class="validate" required>
                <label for="first_name">Expires On: &nbsp;&nbsp; &nbsp; <strong style="color:green;">No Expiry</strong></label>
            </div>
            
            <div class="input-field col s3" id="save_button">                          
                <button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="save_payment_page()">Save
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>



<!-- Modal Structure -->
<div id="modal2" class="modal modal-fixed-footer" style="width:800px;">
    <div class="modal-content">
      <h5 id="modal_heading">Choose From The Below Templates</h4>
        <div id="template-container"></div>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
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


function create_payment_page(){
    $('.modal').modal();
    $("#modal2").LoadingOverlay("show");
    $.ajax({
        url: '{{url("get-payment-templates")}}',
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#modal2").LoadingOverlay("hide", true);
            $("#template-container").html(data.html);
        }
    });
}


function show_payment_page(page_details){
    var details = JSON.parse(page_details);
    console.log(details);
    $('.modal').modal();
    $(".creatediv").show();
    $("#modal_heading").html(details.page_title);
    $("#page_status").val(details.status);
    $("#page_url").val(details.custom_url);
    $("#payment_page_id").val(details.id);
    $("#created_on").html('<strong>'+new Date(details.created_at)+'</strong>');
    if(details.status==="Active"){
        $("#statusContainer").html('<button class="btn waves-effect waves-light" id="change_status_btn" type="button" name="action" onclick="changestatus()">Change Status</button>');
    }else{
        $("#statusContainer").html('');
    }
    $("#save_button").hide();
}


function search_pages(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchinvoice")}}',
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