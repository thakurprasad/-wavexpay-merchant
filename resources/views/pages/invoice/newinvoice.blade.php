{{-- extend layout --}}
@extends('newlayout.app')

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
        <li class="breadcrumb-item active"><a href="{{ route('invoices')}}">Invoice</a></li>
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
<div class="container-fluid">    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create New Invoice</h6>
        </div>

    <div class="card" style="padding: 20px;">
        <div class="card-body">
            <div class="row">
                <form id="form-create-invoice" method="post">
                    <input type="hidden" id="edit_id">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Invoice #</label>
                                <input placeholder="Invoice #" name="invoice_no" id="invoice_no" type="text" class="form-control" required>
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Description</label>
                                <input placeholder="Enter Description" name="description" id="desscription" type="text" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>BILLING TO <a style="color:#ffffff; cursor:pointer;" class="btn btn-sm btn-primary modal-trigger" data-toggle="modal" data-target="#customeraddmodal">+ Add </a></h6>
                                <select class="form-control" name="customer" id="customer">
                                    <option value="" disabled selected>Select A Customer</option>
                                    @if(!empty($all_customers))
                                    @foreach($all_customers as $customer)
                                    <option value="{{$customer->customer_id}}"><strong>{{$customer->name}}</strong> ( {{$customer->email}} )</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Billing Address</h6>
                                <p id="billing_address"></p>
                                <div class="row" id="billing_address_container" style="display:none;">
                                    <input type="hidden" id="billing_address_id" />
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_add1" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_add2" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_state" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_city" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_zip" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_bil_country" readonly>
                                        </div>
                                    </div>
                                </div>
                                <br clear="all">
                                <h6>Shipping Address</h6>
                                <p id="shipping_address"></p>
                                <div class="row" id="shipping_address_container" style="display:none;">
                                    <input type="hidden" id="shipping_address_id" />
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_add1" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_add2" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_state" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_city" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_zip" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="c_shi_country" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Issue Date</label>
                                <input placeholder="Issue Date" name="issue_date" id="issue_date" type="date" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Expiry Date</label>
                                <input placeholder="Expiry Date" name="expiry_date" id="expiry_date" type="date" class="form-control" required> 
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Place Of Supply</label>
                                <input placeholder="Place Of Supply" name="place_of_supply" id="place_of_supply" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Customer Notes</label>
                                <input placeholder="Customer Notes" name="customer_notes" id="customer_notes" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Terms And Condition</label>
                                <input placeholder="Terms And Condition" name="terms_condition" id="terms_condition" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <table class="table table-bordered table-responsive-sm" id="item-table">
                                <tr>
                                    <th class="lineItem__item">DESCRIPTION</th>
                                    <th class="text-right lineItem__amount">RATE/ITEM</th>
                                    <th class="text-right lineItem__qty">QTY</th>
                                    <th class="text-right lineItem__total">TOTAL</th>
                                </tr>
                                <tbody>
                                    <?php 
                                    for($i=0;$i<=10;$i++)
                                    {
                                    ?>
                                    <tr id="item_row_id{{$i}}" <?php if($i>0) { echo 'style="display:none;"'; } ?>>
                                        <td>
                                            <select class="form-control" name="items[{{$i}}]['item_id']" id="tableitem{{$i}}" onchange="select_item('{{$i}}')">
                                                <option value="">Select An Item</option>
                                                @if(!empty($all_items))
                                                @foreach($all_items as $titem)
                                                <option value="{{$titem->item_id}}"><strong>{{$titem->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="itd{{$i}}">
                                            <input type="hidden" name="items[{{$i}}]['item_name']" id="itmnm{{$i}}">
                                            <input type="hidden" name="items[{{$i}}]['description']" id="itmdesc{{$i}}">
                                            </span>
                                            <a class="modal-trigger" data-toggle="modal" data-target="#createitemmodal" onclick="item_row('{{$i}}')">+ Create New Item</a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="items[{{$i}}]['rate']" id="item_rate{{$i}}" class="validate sum" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" min="1" name="items[{{$i}}]['qty']" id="item_qty{{$i}}" class="validate" onclick="change_sub_amount('{{$i}}')" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="item_total[]" id="item_total{{$i}}" class="validate" required>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-md btn-info" href="javascript:void(0)" onclick="add_line_item()">+ Add Line Item</a>
                        </div>
                        <table><tr style="background-color:#ffffff;"><td style="width: 350px;"></td><td style="width: 350px;"></td><td>Total Amount : <input type="text" clas="form-control" id="total_amt" disabled></td></tr></table>
                        <div class="col-sm-12" id="loading_div"></div>
                        <div class="col-sm-12">                       
                            <a class="btn btn-md btn-primary" style="float: middle;" href="javascript:void(0)" onclick="save_invoice()">Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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

<x-add-customer-modal/>

<x-billing-modal/>

<x-shipping-modal/>



<x-existing-shipping-modal/>





@endsection


@section('page-style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('page-script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>

$("#customer").on('change', function() {
    $("#billing_address").html('<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#billingmodal">+ Add Billing Address</a>');
    $("#shipping_address").html('<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#shippingmodal">+ Add Shipping Address</a>');
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

    var html = '<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#billingmodal">Change Billing Address</a><br>';
    $("#billing_address").html(html);
    $("#billingmodal").modal('hide');
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


    var html = '<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#shippingmodal">Change Shipping Address</a><br>';
    $("#shipping_address").html(html);
    $("#shippingmodal").modal('hide');
}



function item_row(rownum)
{
    $("#row_no").val(rownum);
}

function add_new_item(){
    var row_no = $("#row_no").val();
    $.ajax({
        url: '{{url("createitem")}}',
        data: $("#form-create-item").serialize()+"&action=invoice",
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#tableitem"+row_no).html(data.html);
            select_item(row_no);
            $("#createitemmodal").modal('hide');
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
            $("#itmnm"+rowno).val(data.name);
            $("#itmdesc"+rowno).val(data.description);
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

var count = 1;
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
    $("#loading_div").LoadingOverlay("show", {
        background  : "rgba(165, 190, 100, 0.5)"
    });
    var billing_address_id = $("#billing_address_id").val();
    var billing_address1 = $("#c_bil_add1").val();
    var billing_address2 = $("#c_bil_add2").val();
    var billing_state = $("#c_bil_state").val();
    var billing_city = $("#c_bil_city").val();
    var billing_country = $("#c_bil_country").val();
    var billing_zip = $("#c_bil_zip").val();

    var shipping_address_id = $("#shipping_address_id").val();
    var shipping_address1 = $("#c_shi_add1").val();
    var shipping_address2 = $("#c_shi_add2").val();
    var shipping_state = $("#c_shi_state").val();
    var shipping_city = $("#c_shi_city").val();
    var shipping_country = $("#c_shi_country").val();
    var shipping_zip = $("#c_shi_zip").val();
    $.ajax({
        url: '{{url("createinvoice")}}',
        data: $("#form-create-invoice").serialize()+"&billing_address_id="+billing_address_id+"&billing_address1="+billing_address1+"&billing_address2="+billing_address2+"&billing_state="+billing_state+"&billing_city="+billing_city+"&billing_country="+billing_country+"&billing_zip="+billing_zip+"&shipping_address_id="+shipping_address_id+"&shipping_address1="+shipping_address1+"&shipping_address2="+shipping_address2+"&shipping_state="+shipping_state+"&shipping_city="+shipping_city+"&shipping_country="+shipping_country+"&shipping_zip="+shipping_zip,
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                $("#loading_div").LoadingOverlay("hide");
                alert('Invoice Saved');
                window.location.href = "{{ url('invoices')}}";
            }else{
                alert(data.error);
            } 
        }
    });
}


function create_customer() {
    $("#load_msg").show();
    $.ajax({
        url: '{{url("customer")}}',
        data: $("#form-create-customer").serialize()+"&action=invoice",
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#customeraddmodal").modal('hide')
            $("#customer").html(data.customer_html);
            $("#billing_address").html('<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#billingmodal">+ Add Billing Address</a>');
            $("#shipping_address").html('<a style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#shippingmodal">+ Add Shipping Address</a>');
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



function get_existing_address(type)
{
    var selected_customer = $("#customer").val();
    $.ajax({
        url: '{{url("get-customer-existing-address")}}',
        data: {'type':type,'customer':selected_customer},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            $("#existing_"+type+"_address_container").html(data.html);
        }
    });
}


function set_address(type,id,line_1,line_2,state,city,country,zip)
{
    $("#"+type+"_address_id").val(id);
    $("#"+type+"_address1").val(line_1);
    $("#"+type+"_address2").val(line_2);
    $("#"+type+"_state").val(state);
    $("#"+type+"_city").val(city);
    $("#"+type+"_country").val(country);
    $("#"+type+"_zip").val(zip);
    $("#existing"+type+"modal").modal('hide');
}



</script>
@endsection