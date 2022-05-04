{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Items')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Items Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Items</li>
	</ol>
	</div>
</div>
@endsection

{{-- page content --}}
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
    <div class="card-header">
        <div class="pull-left">

        </div>
        <div class="pull-right">

            <a class="btn btn-success" data-toggle="modal" data-target="#createitemmodal"><i class="fas fa-plus"></i> Create Item</a>

        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-responsive-sm" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="table_container">
                @if(!empty($all_items))
                @foreach($all_items as $titem)
                <tr id="item{{$titem->item_id}}">
                    <td>{{$titem->item_id}}</td>
                    <td>{{$titem->name}}</td>
                    <td>{{$titem->description}}</td>
                    <td>{{number_format($titem->amount,2)}}</td>
                    <td><a class="btn btn-sm btn-danger" onclick="delete_item('{{$titem->item_id}}')">Delete</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="createitemmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-create-item" method="post">
            <input type="hidden" id="row_no">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Name</label>
                        <input placeholder="Name" name="modal_item_name" id="modal_item_name" type="text" class="form-control" required>
                        <span id="name_error_container"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Rate</label>
                        <input placeholder="Rate" name="modal_item_rate" id="modal_item_rate" type="text" class="form-control" required>   
                        <span id="rate_error_container"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Tax Rate</label>
                        <select class="form-control" name="modal_item_tax_rate" id="tableitemtaxrate">
                            <option value="" disabled selected>Select Tax Rate</option>
                            <option value=".1"><strong>0.1%</option>
                            <option value=".25"><strong>0.25%</option>
                            <option value="3"><strong>3%</option>
                            <option value="5"><strong>5%</option>
                            <option value="12"><strong>12%</option>
                            <option value="18"><strong>18%</option>
                            <option value="25"><strong>25%</option>
                        </select>
                        <span id="tax_error_container"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">HSN/SAC Code</label>
                        <input placeholder="HSN/SAC Code" name="modal_code" id="modal_code" type="text" class="form-control" required>
                        <span id="code_error_container"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <span id="tax_type_container">
                            <label for="first_name">Tax Type</label>
                            <select class="form-control" name="tax_type" id="tax_type">
                                <option value="tax_inclusive"><strong>Tax Inclusive</option>
                                <option value="tax_exclusive"><strong>Tax Exclusive</option>
                            </select>
                            <span id="tax_type_error_container"></span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">Add Cess</label>
                        <input placeholder="Cess" type="number" name="cess" id="cess"  class="form-control">
                        <span id="cess_error_container"></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea placeholder="Enter Description" row="10" name="modal_item_description" id="modal_item_description" class="form-control" required></textarea>
                        <span class="text-danger" id="descError"></span>
                    </div>
                </div>
                <div class="col-sm-12"><span id="ajax_msg"></span></div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <span id="customer_button"><button type="button" id="create_item_btn" onclick="add_new_item()" class="btn btn-primary">Save changes</button></span>
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
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

function delete_item(item_id){
    if(confirm('Are you sure to delete item?')){
        $.ajax({
            url: '{{url("deleteitem")}}',
            data: {"item_id":item_id},
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(data){
                if(data.success==1){
                    $("#item"+item_id).hide();
                    $('#myTable').DataTable();
                }else{
                    alert('Oops some error happened!!');
                }
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            }
        });
    }
}


function add_new_item(){
    var row_no = $("#row_no").val();
    $.ajax({
        url: '{{url("createitem")}}',
        data: $("#form-create-item").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                $("#ajax_msg").html('<div style="color:green;">'+data.msg+'</div>');
                location.reload();
            }
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            $('#ajax_msg').html(msg);
        }
    });
}

</script>
@endsection