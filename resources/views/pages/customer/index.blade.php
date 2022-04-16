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

	            <a class="btn btn-success" href="#"> Create New Customer</a>

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

                @if(!empty($all_customers->items))
                @foreach($all_customers->items as $value)
				<tr>
					<td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
					<td>{{ $value['email'] }}</td>
					<td>{{ $value['contact'] }} </td>
					<td class="text-center">
                        <a class="btn btn-primary btn-sm" href="#"  title="Edit"><i class="fas fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
                @endif
				</tbody>
			</table>
            <br/>


		</div>
	</div>



<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer" style="width:500px;">
    <div class="modal-content">
      <h4 id="modal_heading">Create Customer</h4>
        <form id="form-create-customer" method="post">
            <input type="hidden" id="edit_id">
            <div class="input-field col s12">
                <input placeholder="Company Name/Individual Name" name="name" id="name" type="text" class="validate" required>
                <label for="first_name">Company Name/Individual Name</label>
                <span class="text-danger" id="nameError"></span>
            </div>

            <div class="input-field col s12">
                <input placeholder="Email" name="email" id="email" type="text" class="validate" required>
                <label for="first_name">Email</label>
                <span class="text-danger" id="emailError"></span>
            </div>

            <div class="input-field col s12">
                <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="validate" required>
                <label for="first_name">Contact Number</label>
                <span class="text-danger" id="contactNumberError"></span>
            </div>

            <div class="input-field col s12">
                <input placeholder="GSTIN" name="gstin" id="gstin" type="text" class="validate" required>
                <label for="first_name">GSTIN</label>
            </div>
            <div class="input-field col s12">
                <span id="load_msg" style="display:none;">Please wait.....</span>
            </div>
            <div class="input-field col s3" id="customer_button">
                <button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="create_customer()">Create 123 Customer
                </button>
            </div>
        </form>
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
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
    $("#form-create-customer")[0].reset();
    $("#modal_heading").html('Create Customer');
    $("#customer_button").html('<button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="create_customer()">Create 234 Customer </button>');
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
    $("#customer_button").html('<button class="btn waves-effect waves-light" onclick="edit_customer_process()" type="button" name="action">Edit Customer</button>');
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


function create_customer() {
    alert('okk');
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
