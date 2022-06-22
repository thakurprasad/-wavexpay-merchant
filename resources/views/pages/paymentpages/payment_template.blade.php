@extends('layouts.admin')
@section('title','Payment Pages')
@section('content_header')
<div class="row mb-2">
	<div class="col-sm-6">
	<h1>Payment Pages</h1>
	</div>
	<div class="col-sm-6">
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Payment Pages</li>
	</ol>
	</div>
</div>
@endsection
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
        <form class="col s12" method="POST" id="payment-page-form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="width:130px;">
                            <div class="card-body">
                                <a class="brand-logo darken-1" href="http://localhost/laravel/wavexpay-merchant/public/">
                                    <img src="http://localhost/laravel/wavexpay-merchant/public/images/logo/materialize-logo.png" alt="materialize logo">
                                    <span class="logo-text hide-on-med-and-down">
                                        WaveXpay
                                    </span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="first_name">Page Title</label>
                                        <input placeholder="Page Title" name="page_title" id="page_title" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea placeholder="Page Description" name="page_description" id="page_description" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea placeholder="Terms & Condition" name="terms_and_condition" id="terms_and_condition"  class="form-control" required></textarea>
                                        <p>You agree to share information entered on this page with Earnoutlet (owner of this page) and Razorpay, adhering to applicable laws.</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">Support Email</label>
                                        <input placeholder="Support Email" name="support_email" id="support_email" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">Support Contact</label>
                                        <input placeholder="Support Contact" name="support_contact" id="support_contact" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="first_name">Facebook Link</label>
                                        <input placeholder="Facebook Link" name="fb_link" id="fb_link" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="first_name">Twitter Link</label>
                                        <input placeholder="Twitter Link" name="twitter_link" id="twitter_link" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="first_name">Whatsapp</label>
                                        <input placeholder="Whatsapp" name="whatsapp" id="whatsapp" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <h6>Payment Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor:pointer;" class="btn btn-sm btn-info" onclick="open_setting_modal()">Settings</a></h6>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label id="email_label" for="first_name">Email</label><br>
                                    <a data-toggle="modal" data-target="#modal1" onclick="change_label_name('email')"><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" readonly class="form-control"></a>
                                    <input type="hidden" name="label[]" value="email" id="email_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                    <input type="hidden" name="labelTypevalue[]" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label id="phone_label" for="first_name">Phone</label><br>
                                    <a data-toggle="modal" data-target="#modal1" onclick="change_label_name('phone')"><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="form-control" readonly></a>
                                    <input type="hidden" name="label[]" value="phone" id="phone_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                    <input type="hidden" name="labelTypevalue[]" value="">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label id="phone_label" for="first_name">New Field</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control" name="input_field_type" id="input_field_type" onchange="create_new_field()">
                                        <option value="" disabled selected>Input Field</option>
                                        <option value="single_line_text">Single Line Text</option>
                                        <option value="alphabet">Alphabet</option>
                                        <option value="alpha_numeric">Alpha Numeric</option>
                                        <option value="number">Number</option>
                                        <option value="email">Email</option>
                                        <option value="phno">Phone Number</option>
                                        <option value="link">Link/Url</option>
                                        <option value="textarea">Large Textarea</option>
                                        <option value="pincode">Pincode</option>
                                        <option value="dropdown">Dropdown</option>
                                        <option value="datepicker">Datepicker</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control" name="input_field_price_type" id="input_field_price_type" onchange="create_new_field_price()">
                                        <option value="" disabled selected>Price Field</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="decide">Customer Decide Amount</option>
                                        <option value="itemwithquantity">Item with quantity</option>
                                    </select>
                                </div>
                            </div>

                            <span id="append_field"></span>
                        </div>
                    </div>
                </div>
                <div class="input-field col s12" id="customer_button">                          
                    <button class="btn btn-md btn-info" id="save_payment_page_btn" type="button" name="action" onclick="save_payment_page()">+ Save Payment Page</button>
                </div>
            </div>
        </form>
    </div>



    <div id="modal1" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Label Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="label_to_be_given" required placeholder="Enter Label Text">
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-warning" onclick="change_label_process()">Change Label</a></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>



    <div id="modal2" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_to_be_given" required placeholder="Enter Label Text">
                <input type="text" class="form-control" disabled placeholder="To be filled by customer">
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_field_process()">Add</a></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>



    <div id="modal3" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Price Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_price_to_be_given" required placeholder="Enter Label Text">
                <input type="text" class="form-control" id="modal_fixed_price" disabled placeholder="To be filled by customer">
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_price_field_process()">Add</a></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <div id="modal4" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Price Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_fix_price_to_be_given" required placeholder="Enter Label Text">
                <input type="text" class="form-control" placeholder="Enter Price" id="fix_price_to_be_given">
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-md btn-info" onclick="add_price_field_process2()">Add</a></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <div id="modal5" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Price Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="label_new_fix_price_with_qty_to_be_given" required placeholder="Enter Label Text">
                <input type="text" class="form-control" placeholder="Enter Price" id="fix_price_with_qty_to_be_given">
                <input type="number" class="form-control" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given">
                <span id="btn-container"><a href="javascript:void(0)" class="btn btn-sm btn-info" onclick="add_price_field_process3()">Add</a></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    
    <div id="setting_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Custom Url</label>
                            <input type="text" class="form-control" placeholder="Custom Url" id="custom_url" name="custom_url">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <select class="form-control" name="theme" id="theme">
                                <option value="" disabled selected>Select Theme</option>
                                <option value="dark">Dark</option>
                                <option value="light">Light</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Page Expiry</label><br>
                            <select class="form-control" id="is_expiry" name="show_c_msg">
                                <option value="" disabled selected>Is Expiry?</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <br>
                            <input type="date" class="form-control" id="expiry" name="expiry">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="first_name">After A Successful Payment</label><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" id="show_c_msg" name="show_c_msg">
                                        <option value="" disabled selected>Show Custom Message</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <textarea class="form-control" id="custom_msg_area" style="display:none;" name="custome_message_area"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" id="red_to_web" name="red_to_web">
                                        <option value="" disabled selected>Redirect to a website</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                    <input type="text" id="redirect_to_website" placeholder="Redirect To Website" style="display:none;" name="redirect_to_website" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="first_name">Plugins and Ad-ons</label><br>
                            <input type="text" class="form-control" placeholder="Facebook Pixel" id="facebook_pixel" name="facebook_pixel">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Google Analytics Id" id="google_analytics" name="google_analytics">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        
    </div>
</div>

<input type="hidden" id="template_id" value="{{ $template_id }}">
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
    
} );


function change_label_name(label){
    $("#label_to_be_given").val('');
    $("#btn-container").html('<a href="javascript:void(0)" class="btn btn-md btn-info" onclick="change_label_process(\''+label+'\')">Change Label</a>')
}

function change_label_process(label){
    var label_to_be_given = $("#label_to_be_given").val();
    $("#"+label+"_label").html(label_to_be_given);
    $("#"+label+"_label_value").val(label_to_be_given);
}


function create_new_field(){
    $("#label_new_to_be_given").val('');
    $('#modal2').modal('show');
}

function add_field_process(){
    var input_field_type = $("#input_field_type").val();


    if(input_field_type=='textarea'){
        var label_val = 'textarea';
    }
    else if(input_field_type=='single_line_text'){
        var label_val = 'text';
    }
    else if(input_field_type=='alphabet'){
        var label_val = 'text';
    }
    else if(input_field_type=='alpha_numeric'){
        var label_val = 'text';
    }
    else if(input_field_type=='number'){
        var label_val = 'number';
    }
    else if(input_field_type=='email'){
        var label_val = 'email';
    }
    else if(input_field_type=='phno'){
        var label_val = 'number';
    }
    else if(input_field_type=='link'){
        var label_val = 'text';
    }
    else if(input_field_type=='pincode'){
        var label_val = 'number';
    }
    else if(input_field_type=='dropdown'){
        var label_val = 'select';
    }
    else if(input_field_type=='datepicker'){
        var label_val = 'date';
    }



    var label_to_be_given = $("#label_new_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="col-sm-12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="'+label_val+'"><input type="hidden" name="labelTypevalue[]" value=""></div></span>';
    $("#append_field").append(html);
    $('#modal2').modal('hide');
}

function delete_field(label){
    $("#new_label_id"+label).hide();
}

function create_new_field_price(){
    var input_field_price_type = $("#input_field_price_type").val();
    if(input_field_price_type=='decide'){
        $('#modal3').modal('show');
    }
    else if(input_field_price_type=='fixed'){
        $('#modal4').modal('show');
    }
    else{
        $('#modal5').modal('show');
    }
}


function add_price_field_process2(){
    var label_to_be_given = $("#label_new_fix_price_to_be_given").val();
    var modal_fixed_price = $("#fix_price_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value="'+modal_fixed_price+'"></div></span>';
    $("#append_field").append(html);
    $('#modal4').modal('hide');
}

function add_price_field_process(){
    var label_to_be_given = $("#label_new_price_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value=""></div></span>';
    $("#append_field").append(html);
    $('#modal3').modal('hide');
}


function add_price_field_process3(){
    var label_to_be_given = $("#label_new_fix_price_with_qty_to_be_given").val();
    var modal_fixed_price = $("#fix_price_with_qty_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="form-control" readonly></a><input type="number" class="validate" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given"><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelTypevalue[]" value="'+modal_fixed_price+'"><input type="hidden" name="labelpricetypeqty[]" value="number"></div></span>';
    $("#append_field").append(html);
    $('#modal5').modal('hide');
}


function open_setting_modal(){
    $("#setting_modal").modal('show');
}


$("#show_c_msg").change(function(){
  if(this.value=='yes'){
    $("#custom_msg_area").show();
  }
  else{
    $("#custom_msg_area").hide();
  }
}); 


$("#red_to_web").change(function(){
  if(this.value=='yes'){
    $("#redirect_to_website").show();
  }
  else{
    $("#redirect_to_website").hide();
  }
}); 


function save_payment_page(){
    var template_id = $("#template_id").val();
    var custom_url = $("#custom_url").val();
    var theme = $("#theme").val();
    var expiry = $("#expiry").val();
    var is_expiry = $("#is_expiry").val();
    var show_c_msg = $("#show_c_msg").val();
    var custom_msg_area = '';
    var redirect_to_website = '';
    if(show_c_msg=='yes'){
        var custom_msg_area = $("#custom_msg_area").val();
    }
    var red_to_web = $("#red_to_web").val();
    if(red_to_web=='yes'){
        var redirect_to_website = $("#redirect_to_website").val();
    }
    var facebook_pixel = $("#facebook_pixel").val();
    var google_analytics = $("#google_analytics").val();
    $.ajax({
        url: '{{url("savepaymentpage")}}',
        data: $("#payment-page-form").serialize()+"&template_id="+template_id+"&custom_url="+custom_url+"&theme="+theme+"&expiry="+expiry+"&custom_msg_area="+custom_msg_area+"&redirect_to_website="+redirect_to_website+"&facebook_pixel="+facebook_pixel+"&google_analytics="+google_analytics,
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
            if(data.success==1){
                alert('Payment Page Saved');
                window.location.href = "{{ url('payment-pages')}}";
            }else{
                alert('Oops!something error happened');
            }
        }
    });
}


</script>
@endsection