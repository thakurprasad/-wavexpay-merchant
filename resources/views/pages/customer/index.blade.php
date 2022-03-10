{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Customers')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <div class="row">
                        <div class="input-field col s2">                          
                            <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Create Customer</a>
                        </div>
                    </div>
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                        <th scope="col">Customer Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($all_customers->items))
                        @foreach($all_customers->items as $customer)
                        <tr>
                            <th scope="row">{{$customer->id}}</th>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->contact}}</td>
                            <td>
                                <a class="waves-effect waves-light btn modal-trigger" onclick="edit_cust('{{$customer->id}}','{{$customer->name}}','{{$customer->email}}','{{$customer->contact}}','{{$customer->gstin}}')" href="#modal1">Edit Customer</a>
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
    $('.modal').modal();
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