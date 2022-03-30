{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Items')

{{-- page content --}}
@section('content')
<div class="section">
        <div class="input-field col s2">                          
            <a class="btn modal-trigger" href="#createitemmodal">Create Item</a>
        </div>
        <div class="card-content">
            <p class="caption mb-0">
                <table id="myTable">
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
                        @if(!empty($all_items->items))
                        @foreach($all_items->items as $titem)
                        <tr id="item{{$titem['id']}}">
                            <th scope="row">{{$titem['id']}}</th>
                            <td>{{$titem['name']}}</td>
                            <td>{{$titem['description']}}</td>
                            <td>{{number_format(($titem['amount']/100),2)}}</td>
                            <td><span class="badge red" onclick="delete_item('{{$titem['id']}}')">Delete</span></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </p>
        </div>
    </div>
</div>


<div id="createitemmodal" class="modal modal-fixed-footer" style="width:600px;">
    <div class="modal-content">
      <h4 id="modal_heading">New Item</h4>
        <form id="form-create-item" method="post">
            <input type="hidden" id="row_no">
            <div class="row">
                <div class="col s6">
                    <label for="first_name">Name</label>
                    <input placeholder="Name" name="modal_item_name" id="modal_item_name" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <label for="first_name">Rate</label>
                    <input placeholder="Rate" name="modal_item_rate" id="modal_item_rate" type="text" class="validate" required>   
                </div>
                <div class="col s6">
                    <label for="first_name">Tax Rate</label>
                    <select name="modal_item_tax_rate" id="tableitemtaxrate">
                        <option value="" disabled selected>Select Tax Rate</option>
                        <option value=".1"><strong>0.1%</option>
                        <option value=".25"><strong>0.25%</option>
                        <option value="3"><strong>3%</option>
                        <option value="5"><strong>5%</option>
                        <option value="12"><strong>12%</option>
                        <option value="18"><strong>18%</option>
                        <option value="25"><strong>25%</option>
                    </select>
                </div>
                <div class="col s6">
                    <label for="first_name">HSN/SAC Code</label>
                    <input placeholder="HSN/SAC Code" name="modal_code" id="modal_code" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <span id="tax_type_container" style="display:none;">
                        <label for="first_name">Tax Type</label>
                        <select name="tax_type" id="tax_type">
                            <option value="tax_inclusive"><strong>Tax Inclusive</option>
                            <option value="tax_exclusive"><strong>Tax Exclusive</option>
                        </select>
                    </span>
                </div>
                <div class="col s6">
                    <label for="first_name">Add Cess</label>
                    <input placeholder="Cess" type="number" name="cess" id="cess"  class="validate">
                </div>
                <div class="input-field col s12">
                    <span class="text-danger" id="emailError"></span>
                    <textarea placeholder="Enter Description" row="10" name="modal_item_description" id="modal_item_description" class="validate" required></textarea>
                </div>
            </div>

            <div class="input-field col s12" id="customer_button">                          
                <button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="add_new_item()">+ Add
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
    $('.modal').modal();
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
            location.reload();
        }
    });
}

</script>
@endsection