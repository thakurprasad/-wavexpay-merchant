{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payment Links')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <div class="input-field col s2">                          
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Create Payment Link</a>
                    </div>
                    <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
                        @csrf
                        <div class="row">
                            <div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="partially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="input-field col s3">
                                <input placeholder="Payment Link ID" name="payment_link_id" id="payment_link_id" type="text" class="validate">
                                <label for="first_name">Payment Link Id</label>
                            </div>

                            
                            <div class="input-field col s3">
                                <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="validate">
                                <label for="first_name">Reference Id</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="validate">
                                <label for="first_name">Customer Contact</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="validate">
                                <label for="first_name">Customer Email</label>
                            </div>

                            
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="button" name="action" onclick="search_payment_link()">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
        
                        </div>
                    </form>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Payment Link Id</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Reference Id</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Payment Links</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_links->payment_links))
                        @foreach($all_links->payment_links as $link)
                        <tr>
                            <th><a  class="waves-effect waves-light" onclick="show_notes('{{$link->id}}')">{{$link->id}}</a></th>
                            <td>{{date('Y-m-d H:i:s',$link->created_at)}}</td>
                            <td>{{number_format($link->amount/100,2)}}</td>
                            <td>{{$link->reference_id}}</td>
                            <td>{{$link->customer->contact}}({{$link->customer->email}})</td>
                            <td>{{$link->short_url}}</td>
                            <td>{{$link->status}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>



<div id="modal1" class="modal modal-fixed-footer" style="width:750px; height:800px;">
    <div class="modal-content">
      <h5 id="modal_heading"><strong>New Payment Link</strong></h5>
        <form id="form-create-payment-link" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Amount" name="amount" id="amount" type="text" class="validate" required>
                    <label for="first_name">Amount*</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Payment Description" name="payment_description" id="payment_description" type="text" class="validate" required>
                    <label for="first_name">Payment For <For></For></label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="validate" required>
                    <label for="first_name">Reference Id <For></For></label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="validate" required>
                    <label for="first_name">Customer Email <For></For></label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="validate" required>
                    <label for="first_name">Customer Contact <For></For></label>
                </div>
                <div class="col s6">
                    <label for="first_name">Notify Via Email</label>
                    <select name="notify_via_email" id="notify_via_email">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col s6">
                    <label for="first_name">Notify Via SMS</label>
                    <select name="notify_via_sms" id="notify_via_sms">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col s12">
                    <label for="first_name">Expiry?</label>
                    <select name="isexpiry" id="isexpiry" onchange="setexpirydate()">
                        <option value="">Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="input-field col s12" id="expiry_div" style="display:none;">
                    <input name="expiry_date" id="expiry_date" type="date" class="validate" required>
                    <label for="first_name">Expiry <For></For></label>
                </div>
                <div class="col s12">
                    <label for="first_name">Partial Payments?</label>
                    <select name="partial_paymet" id="partial_paymet">
                        <option value="">Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="input-field col s12">                          
                    <a class="waves-effect waves-light" onclick="add_notes()">+ Add Notes</a>
                    <span id="add_note_container">
                    </span>
                </div>
                <div class="input-field col s3">                          
                    <button class="btn waves-effect waves-light" type="button" name="action" onclick="create_payment_link()">create</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>





<div id="modal2" class="modal modal-fixed-footer" style="width:750px; height:800px;">
    <div class="modal-content">
      <h5 id="modal_heading"><strong>Payment Link</strong></h5>
            <div class="row" id="link_details_container">
                
            </div>
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
    $('.modal').modal();
} );


function search_payment_link(){
    $("#table_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("searchpaymentlink")}}',
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


function setexpirydate(){
    var isexpiry = $("#isexpiry").val();
    if(isexpiry=='yes'){
        $("#expiry_div").show();
    }else{
        $("#expiry_div").hide();
    }
}

var count=1;
function add_notes(){
    var html = '<div class="input-field col s12" id="note_div'+count+'"><div class="col s4"><input placeholder="Note Title" name="note_title[]" id="note_title" type="text" class="validate" required></div><div class="col s6"><textarea name="note_desc[]" placeholder="Note Description"></textarea></div><div class="col s2"><a style="cursor:pointer;" onclick="cancel_div(\''+count+'\')">Cancel</a></div></div>';
    $("#add_note_container").append(html);
    count++;
}

function cancel_div(count){
    $("#note_div"+count).remove();
}

function create_payment_link(){
    /*$("#form-create-payment-link").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });*/
    $.ajax({
        url: '{{url("createpaymentlink")}}',
        data: $("#form-create-payment-link").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                alert('Payment Link Created');
                $("#form-create-payment-link").LoadingOverlay("hide", true);
                $("#form-create-payment-link")[0].reset();
                $('#modal1').modal('close');
                location.reload();
            }
            
        }
    });
}

function show_notes(link_id){
    $('#modal2').modal('open');
    $("#link_details_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("getpaymentlink")}}',
        data: {'link_id' : link_id },
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#link_details_container").LoadingOverlay("hide", true);
            $("#link_details_container").html(data.html);
        }
    });
}


function ch_r_id(id){
    $("#c_r_c").html('<input type="text" id="new_ref_id" /><strong><a onclick="save_new_ref(\''+id+'\')">Save</a></strong>')
}
</script>
@endsection