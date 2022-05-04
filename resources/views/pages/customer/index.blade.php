{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Customers')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Customer Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Customers</li>
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

	            <a class="btn btn-success" data-toggle="modal" data-target="#customerModal" onclick="crt_cust()"><i class="fas fa-plus"></i> Create New Customer</a>

	        </div>
        </div>

		<div class="card-body">
			<table class="table table-bordered table-responsive-sm"  id="myTable">
				<thead>
					<tr class="text-center">
                        <th>Customer Id</th>
						<th>Customer Name</th>
                        <th>Email</th>
						<th>Contact</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

                @if(!empty($all_customers))
                @foreach($all_customers as $value)
				<tr>
					<td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
					<td>{{ $value->email }}</td>
					<td>{{ $value->contact }} </td>
					<td class="text-center">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customerModal" title="Edit" onclick="edit_cust('{{ $value->customer_id }}','{{ $value->name }}','{{ $value->email }}','{{ $value->contact }}','{{ $value->gstin }}')"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
                @endif
				</tbody>
			</table>
            <br/>
		</div>
	</div>



<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-create-customer" method="post">
            <input type="hidden" id="edit_id">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Company Name/Individual Name</label>
                    <input placeholder="Company Name/Individual Name" name="name" id="name" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="nameError"></span>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Email</label>
                    <input placeholder="Email" name="email" id="email" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="emailError"></span>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Contact Number</label>
                    <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="contactNumberError"></span>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">GSTIN</label>
                    <input placeholder="GSTIN" name="gstin" id="gstin" type="text" class="form-control" required>
                </div>
            </div>


            <div class="col-sm-12">
                <span id="load_msg" style="display:none;">Please wait.....</span>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <span id="customer_button"><button type="button" id="create_customer_btn" onclick="create_customer()" class="btn btn-primary">Save changes</button></span>
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
    $("#form-create-customer")[0].reset();
    $("#modal_heading").html('Create Customer');
    $("#customer_button").html('<button class="btn btn-primary" id="create_customer_btn" type="button" name="action" onclick="create_customer()">Create Customer </button>');
    //$('.modal').modal();
} );


function edit_cust(id,name,email,contact,gst) {
    $("#modal_heading").html('Edit Customer');
    $("#edit_id").val(id);
    $("#name").val(name);
    $("#email").val(email);
    $("#customer_contact").val(contact);
    $("#customer_contact").val(contact);
    $("#gstin").val(gst);
    $('#nameError').html('');
    $('#emailError').html('');
    $('#contactNumberError').html('');
    $("#exampleModalLabel").html('Edit Customer');
    $("#customer_button").html('<button class="btn btn-primary" id="create_customer_btn" type="button" name="action" onclick="edit_customer_process()">Edit Customer </button>');
}

function edit_customer_process() {
    var id = $("#edit_id").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var contact = $("#customer_contact").val();
    var gst = $("#gstin").val();
    $("#load_msg").show();
    $.ajax({
        url: '{{url("customer/'+id+'")}}',
        data: { 'id': id, 'name': name, 'email': email, 'contact': contact, 'gst': gst },
        type: "PUT",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#load_msg").html('<span style="color:green;">'+data.msg+'</span>');
            location.reload();
        },
        error: function(response){
            $("#load_msg").hide();

            if(response.responseJSON.errors.name=== undefined){
                $('#nameError').html('');
            }else{
                $('#nameError').html('<span style="color:red;">'+response.responseJSON.errors.name+'</span>');
            }

            if(response.responseJSON.errors.email===undefined){
                $('#emailError').html('');
            }else{
                $('#emailError').html('<span style="color:red;">'+response.responseJSON.errors.email+'</span>');
            }

            if(response.responseJSON.errors.contact===undefined){
                $('#contactNumberError').html('');
            }else{
                $('#contactNumberError').html('<span style="color:red;">'+response.responseJSON.errors.contact+'</span>');
            }
        }
    });
}


function crt_cust(){
    $("#edit_id").val('');
    $("#form-create-customer")[0].reset();
    $("#exampleModalLabel").html('Create Customer');
    $("#customer_button").html('<button class="btn btn-primary" id="create_customer_btn" type="button" name="action" onclick="create_customer()">Create Customer </button>');
}


function create_customer() {
    $("#load_msg").show();
    $.ajax({
        url: '{{url("customer")}}',
        data: $("#form-create-customer").serialize(),
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#load_msg").html('<span style="color:green;">'+data.msg+'</span>');
            location.reload();
        },
        error: function(response){
            $("#load_msg").hide();

            if(response.responseJSON.errors.name=== undefined){
                $('#nameError').html('');
            }else{
                $('#nameError').html('<span style="color:red;">'+response.responseJSON.errors.name+'</span>');
            }

            if(response.responseJSON.errors.email===undefined){
                $('#emailError').html('');
            }else{
                $('#emailError').html('<span style="color:red;">'+response.responseJSON.errors.email+'</span>');
            }

            if(response.responseJSON.errors.customer_contact===undefined){
                $('#contactNumberError').html('');
            }else{
                $('#contactNumberError').html('<span style="color:red;">'+response.responseJSON.errors.customer_contact+'</span>');
            }
        }
    });
}
</script>
@endsection
