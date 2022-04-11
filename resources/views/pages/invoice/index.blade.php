{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Invoices')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <div class="input-field col s2">                          
                        <!--<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Create Invoice</a>-->
                        <a class="waves-effect waves-light btn" href="{{ url('newinvoice') }}">Create Invoice</a>
                    </div>
                    
                    <form class="col s12" method="POST" id="search-form" action="<?php url('/') ?>/searchinvoice">
                        @csrf
                        <div class="row">
                            <!--<div class="input-field col s3">
                                <select name="status">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="all">All</option>
                                <option value="draft">Draft</option>
                                <option value="issued">Issued</option>
                                <option value="parially_paid">Partially Paid</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                                </select>
                                <label>Invoice Status</label>
                            </div>-->
                            <div class="input-field col s3">
                                <input placeholder="Invoice ID" name="invoice_id" id="invoice_id" type="text" class="validate">
                                <label for="first_name">Invoice Id</label>
                            </div>

                            <div class="input-field col s3">
                                <input placeholder="Reciept No" name="reciept_number" id="reciept_number" type="text" class="validate">
                                <label for="first_name">Reciept No</label>
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
                                <input placeholder="Notes" name="notes" id="notes" type="text" class="validate">
                                <label for="first_name">Notes</label>
                            </div>
                            
                            <div class="input-field col s3">                          
                                <button class="btn waves-effect waves-light" type="button" name="action" onclick="search_invoice()">Submit
                                    <i class="material-icons right">send</i>
                                </button>
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
                        <th scope="col">Invoice Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Reciept No</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Payment Links</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_container">
                        @if(!empty($all_invoices->items))
                        @foreach($all_invoices->items as $invoice)
                        <tr>
                            <th scope="row"><a href="{{ url('/invoice',$invoice->id) }}">{{$invoice->id}}</a></th>
                            <td>{{number_format(($invoice->line_items[0]->net_amount)/100,2)}}</td>
                            <td>{{$invoice->receipt}}</td>
                            <td>{{date('Y-m-d',$invoice->created_at)}}</td>
                            <td>{{$invoice->customer_details->name}} ({{$invoice->customer_details->contact}} / {{$invoice->customer_details->email}})	</td>
                            <td>{{$invoice->short_url}}</td>
                            <td>
                                @if($invoice->status=='cancelled')
                                <span class="new badge red">{{$invoice->status}}</span>
                                @else
                                <span class="new badge blue">{{$invoice->status}}</span>
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
<div id="modal1" class="modal modal-fixed-footer" style="width:1000px; height:800px;">
    <div class="modal-content">
      <h5 id="modal_heading"><strong>New Invoice</strong></h5>
        <form id="form-create-customer" method="post">
            <input type="hidden" id="edit_id">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Invoice #" name="invoice_no" id="invoice_no" type="text" class="validate" required>
                    <label for="first_name">Invoice #</label>
                    <span class="text-danger" id="nameError"></span>
                </div>

                <div class="input-field col s12">
                    <input placeholder="Enter Description" name="desscription" id="desscription" type="text" class="validate" required>
                    <label for="first_name">Description</label>
                </div>
                <div class="col s6">
                    <h6>BILLING TO</h6>
                    <select name="customer" id="customer">
                        <option value="" disabled selected>Select A Customer</option>
                        @if(!empty($all_customers->items))
                        @foreach($all_customers->items as $customer)
                        <option value="{{$customer->id}}"><strong>{{$customer->name}}</strong> ( {{$customer->email}} )</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col s6">
                    <h6>Billing Address</h6>
                    <p id="billing_address"></p>
                    <br clear="all">
                    <h6>Shipping Address</h6>
                    <p id="shipping_address"></p>
                </div>
                <div class="col s4">
                    <label for="first_name">Issue Date</label>
                    <input placeholder="Issue Date" name="issue_date" id="issue_date" type="date" class="validate" required>
                    
                </div>
                <div class="col s4">
                    <label for="first_name">Expiry Date</label>
                    <input placeholder="Expiry Date" name="expiry_date" id="expiry_date" type="date" class="validate" required> 
                </div>
                <div class="col s4">
                    <label for="first_name">Place Of Supply</label>
                    <input placeholder="Place Of Supply" name="place_of_supply" id="place_of_supply" type="text" class="validate" required>
                </div>

                <div class="input-field col s12">
                    <input placeholder="Customer Notes" name="customer_notes" id="customer_notes" type="text" class="validate" required>
                    <label for="first_name">Customer Notes</label>
                </div>

                <div class="input-field col s12">
                    <input placeholder="Terms And Condition" name="terms_condition" id="terms_condition" type="text" class="validate" required>
                    <label for="first_name">Terms And Condition</label>
                </div>

                <div class="input-field col s12">
                    <table id="item-table">
                        <tr>
                            <th class="lineItem__item">DESCRIPTION</th>
                            <th class="text-right lineItem__amount">RATE/ITEM</th>
                            <th class="text-right lineItem__qty">QTY</th>
                            <th class="text-right lineItem__total">TOTAL</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>
                                    <span id="itd1">
                                    <select name="tableitem" id="tableitem1" onchange="select_item('1')">
                                        <option value="" disabled selected>Select An Item</option>
                                        @if(!empty($all_items->items))
                                        @foreach($all_items->items as $titem)
                                        <option value="{{$titem->id}}"><strong>{{$titem->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    </span>
                                    <a class="modal-trigger" href="#createitemmodal" onclick="item_row('1')">+ Create New Item</a>
                                </td>
                                <td>
                                    <input type="text" name="item_rate[]" id="item_rate1" class="validate sum" required>
                                </td>
                                <td>
                                    <input type="number" min="1" name="item_qty[]" id="item_qty1" class="validate" onclick="change_sub_amount('1')" required>
                                </td>
                                <td>
                                    <input type="text" name="item_total[]" id="item_total1" class="validate" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span id="itd2">
                                    <select name="tableitem" id="tableitem2" onchange="select_item('2')">
                                        <option value="" disabled selected>Select An Item</option>
                                        @if(!empty($all_items->items))
                                        @foreach($all_items->items as $titem)
                                        <option value="{{$titem->id}}"><strong>{{$titem->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    </span>
                                    <a class="modal-trigger" href="#createitemmodal" onclick="item_row('2')">+ Create New Item</a>
                                </td>
                                <td>
                                    <input type="text" name="item_rate[]" id="item_rate2" class="validate sum" required>
                                </td>
                                <td>
                                    <input type="number" min="1" name="item_qty[]" id="item_qty2" class="validate" onclick="change_sub_amount('2')" required>
                                </td>
                                <td>
                                    <input type="text" name="item_total[]" id="item_total2" value="0" class="validate" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="input-field col s12">
                    <a class="waves-effect waves-light" href="javascript:void(0)" onclick="add_line_item()">+ Add Line Item</a>
                </div>
                <table><tr><td></td><td></td><td>Total Amount : </td><td><input type="text" id="total_amt" disabled></td></tr></table>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>


<div id="billingmodal" class="modal modal-fixed-footer" style="width:500px;">
    <div class="modal-content">
      <h4 id="modal_heading">Billing Address&nbsp;</h4>
        <span id="change_b_address"></span>
        <form id="form-create-billing-address" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder="Enter Billing Address 1" name="billing_address1" id="billing_address1" class="validate" required></textarea>
                    <span class="text-danger" id="emailError"></span>
                </div>
                <div class="input-field col s12">
                    <textarea placeholder="Enter Billing Address 2" name="billing_address2" id="billing_address2" class="validate" required></textarea>
                    <span class="text-danger" id="emailError"></span>
                </div>
                <div class="col s6">
                    <input placeholder="State" name="billing_state" id="billing_state" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="City" name="billing_city" id="billing_city" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="Country" name="billing_country" id="billing_country" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="Zip" name="billing_zip" id="billing_zip" type="text" class="validate" required>
                </div>
            </div>

            <div class="input-field col s3" id="customer_button">                          
                <button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="add_billing_address()">+ Add Billing Address
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>


<div id="shippingmodal" class="modal modal-fixed-footer" style="width:500px;">
    <div class="modal-content">
      <h4 id="modal_heading">Shipping Address&nbsp;<span id="change_s_address"></span></h4>
        <form id="form-create-shipping-address" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder="Enter Shipping Address 1" name="shipping_address1" id="shipping_address1" class="validate" required></textarea>
                    <span class="text-danger" id="emailError"></span>
                </div>
                <div class="input-field col s12">
                    <textarea placeholder="Enter Shipping Address 2" name="shipping_address2" id="shipping_address2" class="validate" required></textarea>
                    <span class="text-danger" id="emailError"></span>
                </div>
                <div class="col s6">
                    <input placeholder="State" name="shipping_state" id="shipping_state" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="City" name="shipping_city" id="shipping_city" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="Country" name="shipping_country" id="shipping_country" type="text" class="validate" required>
                </div>
                <div class="col s6">
                    <input placeholder="Zip" name="shipping_zip" id="shipping_zip" type="text" class="validate" required>
                </div>
            </div>

            <div class="input-field col s3" id="customer_button">                          
                <button class="btn waves-effect waves-light" id="create_customer_btn" type="button" name="action" onclick="add_shipping_address()">+ Add Shipping Address
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
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
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "searching": false
    });
    $('.modal').modal();
} );


$("#customer").on('change', function() {
    $("#billing_address").html('<a class="modal-trigger" href="#billingmodal">+ Add Billing Address</a>');
    $("#shipping_address").html('<a class="modal-trigger" href="#shippingmodal">+ Add Shipping Address</a>');
});

$("#tableitemtaxrate").on('change', function() {
    $("#tax_type_container").show();
});


function add_billing_address(){
    var billing_address1 = $("#billing_address1").val();
    var billing_address2 = $("#billing_address2").val();
    var billing_state = $("#billing_state").val();
    var billing_city = $("#billing_city").val();
    var billing_country = $("#billing_country").val();
    var billing_zip = $("#billing_zip").val();
    var html = '<a class="modal-trigger" href="#billingmodal">Change Billing Address</a><br><br><strong>'+billing_address1+', '+billing_address2+'<br>'+billing_country+', '+billing_state+', '+billing_city+'<br>'+billing_zip+'</strong>';
    $("#billing_address").html(html);
    $("#billingmodal").modal('close');
}


function add_shipping_address(){
    var shipping_address1 = $("#shipping_address1").val();
    var shipping_address2 = $("#shipping_address2").val();
    var shipping_state = $("#shipping_state").val();
    var shipping_city = $("#shipping_city").val();
    var shippingcountry = $("#shipping_country").val();
    var shipping_zip = $("#shipping_zip").val();
    var html = '<a class="modal-trigger" href="#shippingmodal">Change Shipping Address</a><br><br><strong>'+shipping_address1+', '+shipping_address2+'<br>'+shipping_country+', '+shipping_state+', '+shipping_city+'<br>'+shipping_zip+'</strong>';
    $("#shipping_address").html(html);
    $("#shippingmodal").modal('close');
}



function search_invoice(){
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


function item_row(rownum)
{
    $("#row_no").val(rownum);
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
            $("#itd"+row_no).html(data.name+'<br>');
            $("#item_rate"+row_no).val(data.amount);
            $("#item_qty"+row_no).val(1);
            $("#item_total"+row_no).val(data.amount);
            $("#createitemmodal").modal('close');
            $("#form-create-item")[0].reset();
            get_total_amount();
        }
    });
}


function select_item(rowno){
    var item_id = $("#tableitem"+rowno).val();
    $.ajax({
        url: '{{url("getitem")}}',
        data: {'item_id':item_id},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#item_rate"+rowno).val(data.amount);
            $("#item_qty"+rowno).val(1);
            $("#item_total"+rowno).val(data.amount);
            get_total_amount();
        }
    });
}

function change_sub_amount(rowno){
    var qty = $("#item_qty"+rowno).val();
    var rate =  $("#item_rate"+rowno).val();
    $("#item_total"+rowno).val(qty*rate);
    get_total_amount();
}

function get_total_amount(){
    var total = 0;
    $('input[name="item_total[]"]').each(function() {
        total+=parseFloat(Number(this.value));
    });
    $('#total_amt').val(total);
}

function reload_page(){
    location.reload();
}
</script>
@endsection