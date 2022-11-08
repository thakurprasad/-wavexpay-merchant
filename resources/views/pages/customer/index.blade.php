{{-- extend layout --}}
@extends('newlayout.app')

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
<div class="container-fluid">    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
        </div>
        <div class="card-body"> 

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
            <div class="card_">
                <div class="col-md-12 row" style="margin-bottom: 30px;">
                        <a class="btn btn-primary " style="color:white;cursor:pointer;" data-toggle="modal" data-target="#customeraddmodal" onclick="crt_cust()"><i class="fas fa-plus"></i> Create New Customer</a>
                </div>

                <div class="card-body_">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                <a class="btn btn-primary btn-sm" style="cursor:pointer; color: #FFFFFF;background-color:#4e73df;" data-toggle="modal" data-target="#customeraddmodal" title="Edit" onclick="edit_cust('{{ $value->customer_id }}','{{ $value->name }}','{{ $value->email }}','{{ $value->contact }}','{{ $value->gstin }}')"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br/>
                </div>
            </div>
        </div> <!--/ container-fluid -->
    </div> <!--/ card -->
</div> <!--/ card-body -->


<x-add-customer-modal/>
@endsection


@section('page-style')
@endsection
@section('page-script')
<script>
$(document).ready( function () {
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
            if(data.success==1){
                $("#load_msg").html('<span style="color:green;">'+data.msg+'</span>');
                location.reload();
            }else{
                $("#load_msg").html('<span style="color:red;">'+data.msg+'</span>');
                return false;
            }
            
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
