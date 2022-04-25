{{-- extend layout --}}
@extends('layouts.admin')

{{-- page title --}}
@section('title','Invoice')

@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Invoice Management</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
		<li class="breadcrumb-item active">Invoice</li>
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
        <div class="card-body">
            <div class="row">
                <form id="form-edit-invoice" method="post">
                    <input type="hidden" id="edit_id" value="{{$invoice_details->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Invoice #</label>
                                <input placeholder="Invoice #" name="invoice_no" id="invoice_no" type="text" class="form-control" required value="{{$invoice_details->id}}" readonly>
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Description</label>
                                <input placeholder="Enter Description" name="desscription" id="desscription" type="text" class="form-control" required value="{{$invoice_details->description}}">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>BILLING TO</h6>
                                <select class="form-control" name="customer" id="customer">
                                    <option value="" disabled>Select A Customer</option>
                                    @if(!empty($all_customers->items))
                                    @foreach($all_customers->items as $customer)
                                    <option value="{{$customer->id}}" 
                                    <?php 
                                    if($customer->id==$invoice_details->customer_details->id) 
                                    {
                                        echo 'selected="selected"';
                                    }
                                    ?>><strong>{{$customer->name}}</strong> ( {{$customer->email}} )</option>
                                    @endforeach
                                    @endif
                                </select>
                                {{$invoice_details->customer_details->contact}}<br>
                                {{$invoice_details->customer_details->email}}<br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Billing Address &nbsp;<a class="modal-trigger" href="#billingmodal">Change</a></h6>
                                <p id="billing_address"></p>

                                <div class="row" id="billing_address_container">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_bil_add1" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->line1))
                                        {
                                            echo $invoice_details->customer_details->billing_address->line1;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_bil_add2" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->line2))
                                        {
                                            echo $invoice_details->customer_details->billing_address->line2;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_state" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->state))
                                        {
                                            echo $invoice_details->customer_details->billing_address->state;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_city" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->city))
                                        {
                                            echo $invoice_details->customer_details->billing_address->city;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_zip" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->zipcode))
                                        {
                                            echo $invoice_details->customer_details->billing_address->zipcode;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_country" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->billing_address->country))
                                        {
                                            echo $invoice_details->customer_details->billing_address->country;
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <br clear="all">
                                <h6>Shipping Address &nbsp;<a class="modal-trigger" href="#shippingmodal">Change</a></h6>
                                <p id="shipping_address"></p>
                                <div class="row" id="shipping_address_container">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_shi_add1" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->line1))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->line1;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_shi_add2" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->line2))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->line2;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_state" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->state))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->state;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_city" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->city))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->city;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_zip" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->zipcode))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->zipcode;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_country" readonly value="<?php 
                                        if(isset($invoice_details->customer_details->shipping_address->country))
                                        {
                                            echo $invoice_details->customer_details->shipping_address->country;
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12"></div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Issue Date</label>
                                <input placeholder="Issue Date" name="issue_date" id="issue_date" type="date" class="form-control" required value="<?php if(!empty($invoice_details->created_at)){
                                echo date('Y-m-d',$invoice_details->created_at);
                                } ?>">
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Expiry Date</label>
                                <input placeholder="Expiry Date" name="expiry_date" id="expiry_date" type="date"  class="form-control" required value="<?php if(!empty($invoice_details->expire_by)){
                                    echo date('Y-m-d',$invoice_details->expire_by);
                                } ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Place Of Supply</label>
                                <input placeholder="Place Of Supply" name="place_of_supply" id="place_of_supply" type="text"  class="form-control" required value="<?php if(!empty($invoice_details->supply_state_code)){
                                    echo $invoice_details->supply_state_code;
                                } ?>">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Customer Notes</label>
                                <input placeholder="Customer Notes" name="customer_notes" id="customer_notes" type="text"  class="form-control" required value="<?php if(!empty($invoice_details->comment)){
                                echo $invoice_details->comment;
                                } ?>">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Terms And Condition</label>
                                <input placeholder="Terms And Condition" name="terms_condition" id="terms_condition" type="text"  class="form-control" required value="<?php if(!empty($invoice_details->terms)){
                                echo $invoice_details->terms;
                                } ?>">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <table  class="table table-bordered table-responsive-sm" id="item-table">
                                <tr>
                                    <th class="lineItem__item">DESCRIPTION</th>
                                    <th class="text-right lineItem__amount">RATE/ITEM</th>
                                    <th class="text-right lineItem__qty">QTY</th>
                                    <th class="text-right lineItem__total">TOTAL</th>
                                </tr>
                                <tbody>
                                    @if(!empty($invoice_details->line_items))
                                    @foreach($invoice_details->line_items as $item)
                                    <tr>
                                        <td>
                                            <select name="tableitem[]" id="tableitem{{$item->id}}" onchange="select_item('{{$item->id}}')">
                                                <option value="" disabled selected>Select An Item</option>
                                                @if(!empty($all_items->items))
                                                @foreach($all_items->items as $titem)
                                                <option value="{{$titem->id}}" 
                                                <?php 
                                                if($titem->name==$item->name)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>
                                                ><strong>{{$titem->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="itd{{$titem->id}}">
                                            </span>
                                            
                                        </td>
                                        <td>
                                            <input type="text" name="item_rate[]" id="item_rate{{$item->id}}" class="validate sum" required value="{{ $item->amount/100 }}">
                                        </td>
                                        <td>
                                            <input type="number" min="1" name="item_qty[]" id="item_qty{{$item->id}}" class="validate" onclick="change_sub_amount('{{$item->id}}')" required value="{{ $item->quantity }}">
                                        </td>
                                        <td>
                                            <input type="text" name="item_total[]" id="item_total{{$item->id}}" class="validate" required value="{{ $item->gross_amount/100 }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    <?php 
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                    <tr id="item_row_id{{$i}}" style="display:none;">
                                        <td>
                                            
                                            <select name="tableitem[]" id="tableitem{{$i}}" onchange="select_item('{{$i}}')">
                                                <option value="" disabled selected>Select An Item</option>
                                                @if(!empty($all_items->items))
                                                @foreach($all_items->items as $titem)
                                                <option value="{{$titem->id}}"><strong>{{$titem->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="itd{{$i}}">
                                            </span>
                                            <!--<a class="modal-trigger" href="#createitemmodal" onclick="item_row('{{$i}}')">+ Create New Item</a>-->
                                        </td>
                                        <td>
                                            <input type="text" name="item_rate[]" id="item_rate{{$i}}" class="validate sum" required>
                                        </td>
                                        <td>
                                            <input type="number" min="1" name="item_qty[]" id="item_qty{{$i}}" class="validate" onclick="change_sub_amount('{{$i}}')" required>
                                        </td>
                                        <td>
                                            <input type="text" name="item_total[]" id="item_total{{$i}}" class="validate" required>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="input-field col s12">
                            <a class="waves-effect waves-light" href="javascript:void(0)" onclick="add_line_item()">+ Add Line Item</a>
                        </div>
                        <table class="table table-responsive-sm"><tr><td style="width: 195px;"></td><td style="width: 290px;"></td><td style="width: 290px; padding-left:230px;">Total : </td><td><input type="text" style="float:right;" class="form-control" id="total_amt" disabled value="{{ $invoice_details->amount/100 }}"></td></tr></table>
                        <div class="col-sm-2">                          
                            <a class="btn btn-md btn-info" href="javascript:void(0)" onclick="save_invoice()">Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Modal Structure -->
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

    $("#c_bil_add1").val(billing_address1);
    $("#c_bil_add2").val(billing_address2);
    $("#c_bil_state").val(billing_state);
    $("#c_bil_city").val(billing_city);
    $("#c_bil_country").val(billing_country);
    $("#c_bil_zip").val(billing_zip);

    $("#billing_address_container").show();

    var html = '<a class="modal-trigger" href="#billingmodal">Change Billing Address</a><br>';
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

    $("#c_shi_add1").val(shipping_address1);
    $("#c_shi_add2").val(shipping_address2);
    $("#c_shi_state").val(shipping_state);
    $("#c_shi_city").val(shipping_city);
    $("#c_shi_country").val(shippingcountry);
    $("#c_shi_zip").val(shipping_zip);

    $("#shipping_address_container").show();


    var html = '<a class="modal-trigger" href="#shippingmodal">Change Shipping Address</a><br>';
    $("#shipping_address").html(html);
    $("#shippingmodal").modal('close');
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

var count = 2;
/*function add_line_item(){
    $.ajax({
        url: '{{url("addnewitemrow")}}',
        data: {'count':count},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            jQuery("#item-table tr:last").after(data.html);
        }
    });
    count++;
}*/
function add_line_item(){
    $("#item_row_id"+count).show();
    count++;
}


function reload_page(){
    location.reload();
}

function save_invoice()
{
    var edit_id = $("#edit_id").val();
    var billing_address1 = $("#c_bil_add1").val();
    var billing_address2 = $("#c_bil_add2").val();
    var billing_state = $("#c_bil_state").val();
    var billing_city = $("#c_bil_city").val();
    var billing_country = $("#c_bil_country").val();
    var billing_zip = $("#c_bil_zip").val();

    var shipping_address1 = $("#c_shi_add1").val();
    var shipping_address2 = $("#c_shi_add2").val();
    var shipping_state = $("#c_shi_state").val();
    var shipping_city = $("#c_shi_city").val();
    var shipping_country = $("#c_shi_country").val();
    var shipping_zip = $("#c_shi_zip").val();
    $.ajax({
        url: '{{url("editinvoice")}}',
        data: $("#form-edit-invoice").serialize()+"&billing_address1="+billing_address1+"&billing_address2="+billing_address2+"&billing_state="+billing_state+"&billing_city="+billing_city+"&billing_country="+billing_country+"&billing_zip="+billing_zip+"&shipping_address1="+shipping_address1+"&shipping_address2="+shipping_address2+"&shipping_state="+shipping_state+"&shipping_city="+shipping_city+"&shipping_country="+shipping_country+"&shipping_zip="+shipping_zip+"&edit_id="+edit_id,
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                alert('Invoice Saved');
                window.location.href = "{{ url('invoices')}}";
            }else{
                alert('Oops!something error happened');
            } 
        }
    });
}
</script>
@endsection