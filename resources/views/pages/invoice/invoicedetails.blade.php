@extends('newlayout.app-advance')
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
<?php print_r($invoice_details);exit; ?>
    <div class="card" style="padding:15px;">
        <div class="card-body">
            <div class="row">
                <form id="form-edit-invoice" method="post">
                    <input type="hidden" id="edit_id" value="{{$invoice_details->id}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Invoice #</label>
                                <input placeholder="Invoice #" name="invoice_no" id="invoice_no" type="text" class="form-control" required value="{{$invoice_details->invoice_id}}" readonly>
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="first_name">Description</label>
                                <input placeholder="Enter Description" name="description" id="desscription" type="text" class="form-control" required value="{{$invoice_details->description}}">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>BILLING TO</h6>
                                <select class="form-control" name="customer" id="customer" disabled>
                                    <option value="" disabled>Select A Customer</option>
                                    @if(!empty($all_customers))
                                    @foreach($all_customers as $customer)
                                    <option value="{{$customer->customer_id}}" 
                                    <?php 
                                    if($customer->customer_id==$invoice_details->customer_id) 
                                    {
                                        echo 'selected="selected"';
                                    }
                                    ?>><strong>{{$customer->name}}</strong> ( {{$customer->email}} )</option>
                                    @endforeach
                                    @endif
                                </select>
                                {{$invoice_details->customer_name}}<br>
                                {{$invoice_details->customer_email}}<br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!--<h6>Billing Address &nbsp;<a class="modal-trigger" href="#billingmodal">Change</a></h6>-->
                                <p id="billing_address"></p>

                                <div class="row" id="billing_address_container">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_bil_add1" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_address1))
                                        {
                                            echo $invoice_details->customer_billing_address1;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_bil_add2" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_address2))
                                        {
                                            echo $invoice_details->customer_billing_address2;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_state" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_state))
                                        {
                                            echo $invoice_details->customer_billing_state;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_city" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_city))
                                        {
                                            echo $invoice_details->customer_billing_city;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_zip" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_zip))
                                        {
                                            echo $invoice_details->customer_billing_zip;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_bil_country" readonly value="<?php 
                                        if(isset($invoice_details->customer_billing_country))
                                        {
                                            echo $invoice_details->customer_billing_country;
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <br clear="all">
                                <!--<h6>Shipping Address &nbsp;<a class="modal-trigger" href="#shippingmodal">Change</a></h6>-->
                                <p id="shipping_address"></p>
                                <div class="row" id="shipping_address_container">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_shi_add1" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_address1))
                                        {
                                            echo $invoice_details->customer_shipping_address1;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="c_shi_add2" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_address2))
                                        {
                                            echo $invoice_details->customer_shipping_address2;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_state" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_state))
                                        {
                                            echo $invoice_details->customer_shipping_state;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_city" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_city))
                                        {
                                            echo $invoice_details->customer_shipping_city;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_zip" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_zip))
                                        {
                                            echo $invoice_details->customer_shipping_zip;
                                        }
                                        ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="c_shi_country" readonly value="<?php 
                                        if(isset($invoice_details->customer_shipping_country))
                                        {
                                            echo $invoice_details->customer_shipping_country;
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12"></div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Issue Date : <strong><?php echo date('d-m-Y',strtotime($invoice_details->issue_date)); ?></strong></label>
                                <input placeholder="Issue Date" name="issue_date" id="issue_date" type="date" class="form-control" required value="<?php if(!empty($invoice_details->issue_date)){
                                    echo date('d-m-Y',strtotime($invoice_details->issue_date));
                                } ?>">
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Expiry Date : <strong><?php echo date('d-m-Y',strtotime($invoice_details->expiry_date)); ?></strong></label>
                                <input placeholder="Expiry Date" name="expiry_date" id="expiry_date" type="date"  class="form-control" required value="<?php if(!empty($invoice_details->expiry_date)){
                                    echo date('d-m-Y',strtotime($invoice_details->expiry_date));
                                } ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Place Of Supply</label>
                                <input placeholder="Place Of Supply" name="place_of_supply" id="place_of_supply" type="text"  class="form-control" required value="<?php if(!empty($invoice_details->place_of_supply)){
                                    echo $invoice_details->place_of_supply;
                                } ?>">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="first_name">Customer Notes</label>
                                <input placeholder="Customer Notes" name="customer_notes" id="customer_notes" type="text"  class="form-control" required value="<?php if(!empty($invoice_details->customer_notes)){
                                echo $invoice_details->customer_notes;
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
                                    @php 
                                    $count=0;
                                    $total_price=0;
                                    $qty = explode(",",$invoice_details->item_qty);
                                    @endphp
                                    @if(!empty($invoice_details->item_id))
                                    @foreach(explode(",",$invoice_details->item_id) as $singleitem)
                                    <?php 
                                     
                                    $item = DB::table('items')->where('item_id',$singleitem)->first();
                                    $total_price+=$item->amount*$qty[$count];
                                    ?>
                                    <tr>
                                        <td>
                                            <select name="tableitem[]" class="form-control" id="tableitem{{$item->id}}" onchange="select_item('{{$item->id}}')">
                                                <option value="" disabled selected>Select An Item</option>
                                                @if(!empty($all_items))
                                                @foreach($all_items as $titem)
                                                <option value="{{$titem->item_id}}" 
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
                                            <span id="itd{{$item->id}}">
                                            </span>
                                            
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="item_rate[]" id="item_rate{{$item->id}}" class="validate sum" required value="{{ $item->amount }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" min="1" name="item_qty[]" id="item_qty{{$item->id}}" class="validate" onclick="change_sub_amount('{{$item->id}}')" required value="{{$qty[$count]}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="item_total[]" id="item_total{{$item->id}}" class="validate" required value="{{ $item->amount*$qty[$count] }}">
                                        </td>
                                    </tr>
                                    <?php 
                                    $count++;
                                    ?>
                                    @endforeach
                                    @endif

                                    <?php 
                                    for($i=1;$i<=10;$i++)
                                    {
                                    ?>
                                    <tr id="item_row_id{{$i}}" style="display:none;">
                                        <td>
                                            
                                            <select name="tableitem[]" class="form-control" id="tableitem{{$i}}" onchange="select_item('{{$i}}')">
                                                <option value="" disabled selected>Select An Item</option>
                                                @if(!empty($all_items))
                                                @foreach($all_items as $titem)
                                                <option value="{{$titem->item_id}}"><strong>{{$titem->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span id="itd{{$i}}">
                                            </span>
                                            <!--<a class="modal-trigger" href="#createitemmodal" onclick="item_row('{{$i}}')">+ Create New Item</a>-->
                                        </td>
                                        <td>
                                            <input type="text" name="item_rate[]" id="item_rate{{$i}}" class="form-control sum" required>
                                        </td>
                                        <td>
                                            <input type="number" min="1" name="item_qty[]" id="item_qty{{$i}}" class="form-control" onclick="change_sub_amount('{{$i}}')" required>
                                        </td>
                                        <td>
                                            <input type="text" name="item_total[]" id="item_total{{$i}}" class="form-control" required>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="input-field col s12">
                            <a class="btn btn-md btn-info" href="javascript:void(0)" onclick="add_line_item()">+ Add Line Item</a>
                        </div>
                        <table class="table table-responsive-sm"><tr><td style="width: 195px;"></td><td style="width: 290px;"></td><td style="width: 290px; padding-left:230px;">Total : </td><td><input type="text" style="float:right;" class="form-control" id="total_amt" disabled value="{{$total_price}}"></td></tr></table>
                        <div class="col-sm-2">                          
                            <a class="btn btn-md btn-primary" href="javascript:void(0)" onclick="save_invoice()">Save</a>
                        </div>
                    </div>
                </form>
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