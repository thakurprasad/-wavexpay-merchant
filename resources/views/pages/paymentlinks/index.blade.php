@extends('layouts.admin')
@section('title','Payment Links')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Payment Link Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Payment Link</li>
	</ol>
	</div>
</div>
@endsection
@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <ul class="margin-bottom-none padding-left-lg">
            <li>{{ $message }}</li>
        </ul>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <ul class="margin-bottom-none padding-left-lg">
            <li>{{ $message }} </li>
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">    
                <a class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal1">Create Payment Link</a>
            </div>
        </div>
        <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="created">Created</option>
                                <option value="partially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Payment Link Id</label>
                            <input placeholder="Payment Link ID" name="payment_link_id" id="payment_link_id" type="text" class="form-control">
                        </div>
                    </div>

                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Reference Id</label>
                            <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Customer Contact</label>
                            <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control">
                        </div> 
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">Customer Email</label>
                            <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="form-control">
                        </div>   
                    </div>

                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="first_name">&nbsp;</label><br>
                            <button class="btn btn-md btn-info" type="button" name="action" onclick="search_payment_link()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm" id="myTable">
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
                    @php 
                    $contact = 'N/A';
                    $email = 'N/A';
                    if(isset($link->customer->contact) && $link->customer->contact!='')
                    {
                        $contact = $link->customer->contact;
                    }
                    if(isset($link->customer->email) && $link->customer->email!='')
                    {
                        $email = $link->customer->email;
                    }
                    @endphp
                    <tr>
                        <td><a style="cursor:pointer;" class="waves-effect waves-light" onclick="show_notes('{{$link->id}}')">{{$link->id}}</a></td>
                        <td>{{date('Y-m-d H:i:s',$link->created_at)}}</td>
                        <td>{{number_format($link->amount/100,2)}}</td>
                        <td>{{$link->reference_id}}</td>
                        <td>{{$contact}}({{$email}})</td>
                        <td>{{$link->short_url}}</td>
                        <td>{{$link->status}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

<div id="modal1" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Payment Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-create-payment-link" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Amount*</label>
                        <input placeholder="Amount" name="amount" id="amount" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Payment For <For></For></label>
                        <input placeholder="Payment Description" name="payment_description" id="payment_description" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Reference Id <For></For></label>
                        <input placeholder="Reference Id" name="reference_id" id="reference_id" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Customer Email <For></For></label>
                        <input placeholder="Customer Email" name="customer_email" id="customer_email" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Customer Contact <For></For></label>
                        <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Notify Via Email</label>
                        <select class="form-control" name="notify_via_email" id="notify_via_email">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Notify Via SMS</label>
                        <select class="form-control" name="notify_via_sms" id="notify_via_sms">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Expiry?</label>
                        <select class="form-control" name="isexpiry" id="isexpiry" onchange="setexpirydate()">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Expiry <For></For></label>
                        <input name="expiry_date" id="expiry_date" type="date" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Partial Payments?</label>
                        <select class="form-control" name="partial_paymet" id="partial_paymet">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <a class="waves-effect waves-light" style="cursor:pointer;" onclick="add_notes()">+ Add Notes</a>
                        <span id="add_note_container">
                        </span>
                        <span id="afetr_edit_note_container"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="button" onclick="create_payment_link()">create</button>
                    </div>
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


<div class="modal" id="modal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="link_details_container">
                
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="modal3" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Reference Id</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ref_id_change_form">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                    <input type="hidden" id="plid" name="plid">
                    <label for="first_name">Reference Id</label>
                    <input placeholder="Reference Id" name="update_reference_id" id="update_reference_id" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-3">                          
                    <button class="btn btn-primary" type="button" name="action" onclick="change_ref_id_process()">Change</button>
                </div>
            </div>
            <span id="msg"></span>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="modal4" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal4_heading">Add Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_note_form">
            <input type="hidden" id="editplid" name="editplid">
            <div class="row" id="edit_note_container">
                
            </div>
            <br clear="all">
            <div class="row">
                <div class="col-sm-3">                          
                    <button class="btn bt-sm btn-info" type="button" name="action" onclick="edit_note_process()">Edit Note</button>
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





<div id="modal4" class="modal modal-fixed-footer" style="width:800px; height:400px;">
    <div class="modal-content">
        <h5 id="modal4_heading"><strong>Add Notes </strong></h5>
        <form id="edit_note_form">
            <input type="hidden" id="editplid" name="editplid">
            <div class="row" id="edit_note_container">
                
            </div>
            <div class="row">
                <div class="input-field col s3">                          
                    <button class="btn bt-sm btn-info" type="button" name="action" onclick="edit_note_process()">Edit Note</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>



<div id="modal5" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Expiry Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="">
            <form id="exp_date_change_form">
                <div class="col-sm-12">
                    <input type="hidden" id="paylinkid" name="plid">
                    <label for="first_name">Expiry Date</label><br>
                    <input name="expiry_dt" id="expiry_dt" type="date" class="form-control" required>
                </div>
                <br clear="all">
                <div class="col-sm-3">    
                    <div class="form-group">                    
                        <button class="btn btn-sm btn-info" type="button" name="action" onclick="change_exp_date_process()">Change</button>
                    </div>
                </div>
                <span id="msg"></span>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
    var html = '<div class="row" id="note_div'+count+'"><div class="col-sm-4"><div class="form-group"><input placeholder="Note Title" name="note_title[]" id="note_title" type="text" class="form-control" required></div></div><div class="col-sm-6"><div class="form-group"><textarea name="note_desc[]" class="form-control" placeholder="Note Description"></textarea></div></div><div class="col-sm-2"><div class="form-group"><a style="cursor:pointer;" onclick="cancel_div(\''+count+'\')">Cancel</a></div></div></div>';
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
    $('#modal2').modal('show');
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
    $("#plid").val(id);
}

function change_ref_id_process(){
    $("#ref_id_change_form").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("changerefidprocess")}}',
        data: $("#ref_id_change_form").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#ref_id_change_form").LoadingOverlay("hide", true);
            if(data.success==1){
                alert('Reference Id Changed Successfully');
                $('#modal3').modal('hide');
                $("#c_r_c").html(data.update_reference_id);
            }else{
                $("#msg").html(data.msg);
            }
        }
    });
}

var ecount=1;
function edit_notes(id){
    $("#editplid").val(id);
    $('#modal4_heading').html('<strong>Add Notes <a style="margin-left:20px;" class="waves-effect waves-light     modal-trigger" href="#modal4" onclick="edit_notes_append(\''+id+'\')">+</a></strong>');
    var html = '<div class="row" id="edit_note_div'+ecount+'"><div class="col-sm-4"><input placeholder="Note Title" name="edit_note_title[]" id="note_title" type="text" class="form-control" required></div><div class="col-sm-6"><textarea class="form-control" name="edit_note_desc[]" placeholder="Note Description"></textarea></div><div class="col-sm-2"><a style="cursor:pointer;" onclick="cancel_edit_div(\''+ecount+'\')">Cancel</a></div></div></div>';
    $("#edit_note_container").append(html);
    ecount++;
}


function edit_notes_append(id){
    var html = '<div class="row" id="edit_note_div'+ecount+'"><div class="col-sm-4"><input placeholder="Note Title" name="edit_note_title[]" id="note_title" type="text" class="form-control" required></div><div class="col-sm-6"><textarea class="form-control" name="edit_note_desc[]" placeholder="Note Description"></textarea></div><div class="col-sm-2"><a style="cursor:pointer;" onclick="cancel_edit_div(\''+ecount+'\')">Cancel</a></div></div></div>';
    $("#edit_note_container").append(html);
    ecount++;
}


function cancel_edit_div(count){
    $("#edit_note_div"+count).remove();
}


function edit_note_process(){
    var lid = $("#editplid").val();
    $("#edit_note_container").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    $.ajax({
        url: '{{url("changenoteprocess")}}',
        data: $("#edit_note_form").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#edit_note_container").LoadingOverlay("hide", true);
            if(data.success==1){
                alert('Notes Updated Successfully');
                $('#modal4').modal('close');
                $('#modal2').modal('close');
                $("#edit_note_form")[0].reset();
                show_notes(lid);
            }else{
                $("#msg").html(data.msg);
            }
        }
    });
}


function part_pay(lid,status){
    if(confirm('Are You Sure To Change Part Payment Status?')){
        $.ajax({
            url: '{{url("changepaystatus")}}',
            data: {'lid':lid,'status':status},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
                if(data.success==1){
                    $('#modal2').modal('hide');
                    show_notes(lid);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
}


function edit_expiry_date(id){
    $("#paylinkid").val(id);
}


function change_exp_date_process(){
    var paylinkid = $("#paylinkid").val();
    var expiry_dt = $("#expiry_dt").val();
    $.ajax({
        url: '{{url("changeexpdate")}}',
        data: {'paylinkid':paylinkid,'expiry_dt':expiry_dt},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                $('#modal5').modal('hide');
                $('#modal2').modal('hide');
                alert('Expiry Date Changed Successfully!!');
                show_notes(paylinkid);
            }else{
                alert(data.msg);
            }
        }
    });
}


function delete_note(key,linkid){
    if(confirm('Are You Sure To Change Part Payment Status?')){
        $.ajax({
            url: '{{url("deletenote")}}',
            data: {'key':key,'linkid':linkid},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
                if(data.success==1){
                    alert('Note Deleted Successfully!!');
                    show_notes(linkid);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
}

</script>
@endsection