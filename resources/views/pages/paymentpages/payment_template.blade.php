{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Payment')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <p class="caption mb-0">
                <div class="row">
                    <form class="col s12" method="POST" id="payment-page-form">
                        @csrf
                        <div class="row">
                            <div class="col s6">
                                <div class="card" style="width:130px;">
                                    <div class="card-content">
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
                                        <div class="input-field col s12">
                                            <input placeholder="Page Title" name="page_title" id="page_title" type="text" class="validate" required>
                                            <label for="first_name">Page Title</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea placeholder="Page Description" name="page_description" id="page_description" class="validate" required></textarea>
                                            
                                        </div>
                                        <div class="input-field col s12">
                                            <textarea placeholder="Terms & Condition" name="terms_and_condition" id="terms_and_condition"  class="validate" required></textarea>
                                            <p>You agree to share information entered on this page with Earnoutlet (owner of this page) and Razorpay, adhering to applicable laws.</p>
                                        </div>
                                        <div class="input-field col s8">
                                            <input placeholder="Support Email" name="support_email" id="support_email" type="text" class="validate" required>
                                            <label for="first_name">Support Email</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input placeholder="Support Contact" name="support_contact" id="support_contact" type="text" class="validate" required>
                                            <label for="first_name">Support Contact</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input placeholder="Facebook Link" name="fb_link" id="fb_link" type="text" class="validate">
                                            <label for="first_name">Facebook Link</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input placeholder="Twitter Link" name="twitter_link" id="twitter_link" type="text" class="validate">
                                            <label for="first_name">Twitter Link</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input placeholder="Whatsapp" name="whatsapp" id="whatsapp" type="text" class="validate">
                                            <label for="first_name">Whatsapp</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s6">
                                <h6>Payment Details &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="cursor:pointer;" class="btn waves-effect waves-light" onclick="open_setting_modal()">Settings</a></h6>
                                <div class="input-field col s12">
                                    <label id="email_label" for="first_name">Email</label><br>
                                    <a class="modal-trigger"  href="#modal1" onclick="change_label_name('email')"><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" readonly class="validate"></a>
                                    <input type="hidden" name="label[]" value="email" id="email_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                </div>
                                <div class="input-field col s12">
                                    <label id="phone_label" for="first_name">Phone</label><br>
                                    <a class="modal-trigger"  href="#modal1" onclick="change_label_name('phone')"><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="validate" readonly></a>
                                    <input type="hidden" name="label[]" value="phone" id="phone_label_value">
                                    <input type="hidden" name="labeltype[]" value="text">
                                </div>

                                <div class="input-field col s3">
                                    <label id="phone_label" for="first_name">New Field</label>
                                </div>

                                <div class="col s5">
                                    <select name="input_field_type" id="input_field_type" onchange="create_new_field()">
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
                                <div class="col s4">
                                    <select name="input_field_price_type" id="input_field_price_type" onchange="create_new_field_price()">
                                        <option value="" disabled selected>Price Field</option>
                                        <option value="fixed">Fixed Amount</option>
                                        <option value="decide">Customer Decide Amount</option>
                                        <option value="itemwithquantity">Item with quantity</option>
                                    </select>
                                </div>

                                <span id="append_field"></span>
                                
                            </div>
                        </div>
                        <div class="input-field col s12" id="customer_button">                          
                            <button class="btn waves-effect waves-light" id="save_payment_page_btn" type="button" name="action" onclick="save_payment_page()">+ Save Payment Page
                            </button>
                        </div>
                    </form>
                </div>
            </p>
        </div>
    </div>
</div>



<div id="modal1" class="modal modal-fixed-footer" style="width:400px; height:230px;">
    <div class="modal-content">
        <h6 id="modal_heading">Change Label Text</h6>
        <input type="text" class="validate" id="label_to_be_given" required placeholder="Enter Label Text">
        <span id="btn-container"><a href="javascript:void(0)" class="btn waves-effect waves-light" onclick="change_label_process()">Change Label</a></span>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>

<div id="modal2" class="modal modal-fixed-footer" style="width:400px; height:300px;">
    <div class="modal-content">
        <h6 id="modal_heading">Add Field</h6>
        <input type="text" class="validate" id="label_new_to_be_given" required placeholder="Enter Label Text">
        <input type="text" class="validate" disabled placeholder="To be filled by customer">
        <span id="btn-container"><a href="javascript:void(0)" class="btn waves-effect waves-light" onclick="add_field_process()">Add</a></span>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>

<div id="modal3" class="modal modal-fixed-footer" style="width:400px; height:300px;">
    <div class="modal-content">
        <h6 id="modal_heading">Add Price Field</h6>
        <input type="text" class="validate" id="label_new_price_to_be_given" required placeholder="Enter Label Text">
        <input type="text" class="validate" id="modal_fixed_price" disabled placeholder="To be filled by customer">
        <span id="btn-container"><a href="javascript:void(0)" class="btn waves-effect waves-light" onclick="add_price_field_process()">Add</a></span>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>


<div id="modal4" class="modal modal-fixed-footer" style="width:400px; height:300px;">
    <div class="modal-content">
        <h6 id="modal_heading">Add Price Field</h6>
        <input type="text" class="validate" id="label_new_fix_price_to_be_given" required placeholder="Enter Label Text">
        <input type="text" class="validate" placeholder="Enter Price" id="fix_price_to_be_given">
        <span id="btn-container"><a href="javascript:void(0)" class="btn waves-effect waves-light" onclick="add_price_field_process2()">Add</a></span>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>


<div id="modal5" class="modal modal-fixed-footer" style="width:400px; height:350px;">
    <div class="modal-content">
        <h6 id="modal_heading">Add Price Field</h6>
        <input type="text" class="validate" id="label_new_fix_price_with_qty_to_be_given" required placeholder="Enter Label Text">
        <input type="text" class="validate" placeholder="Enter Price" id="fix_price_with_qty_to_be_given">
        <input type="number" class="validate" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given">
        <span id="btn-container"><a href="javascript:void(0)" class="btn waves-effect waves-light" onclick="add_price_field_process3()">Add</a></span>
    </div>
    <div class="modal-footer">
      <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>


<div id="setting_modal" class="modal modal-fixed-footer" style="width:900px; height:500px;">
    <div class="modal-content">
        <h6 id="modal_heading">Settings</h6>
        <div class="input-field col s12">
            <label for="first_name">Custom Url</label>
            <input type="text" class="validate" placeholder="Custom Url" id="custom_url" name="custom_url">
        </div>
        <div class="input-field col s12">
            <select name="theme" id="theme">
                <option value="" disabled selected>Select Theme</option>
                <option value="dark">Dark</option>
                <option value="light">Light</option>
            </select>
        </div>
        <div class="input-field col s12">
            <label for="first_name">Page Expiry</label><br>
            <select id="is_expiry" name="show_c_msg">
                <option value="" disabled selected>Is Expiry?</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <input type="date" class="validate" id="expiry" name="expiry">
        </div>
        <div class="input-field col s12">
            <label for="first_name">After A Successful Payment</label><br>
            <div class="input-field col s6">
                <select id="show_c_msg" name="show_c_msg">
                    <option value="" disabled selected>Show Custom Message</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <textarea id="custom_msg_area" style="display:none;" name="custome_message_area"></textarea>
            </div>
            <div class="input-field col s6">
                <select id="red_to_web" name="red_to_web">
                    <option value="" disabled selected>Redirect to a website</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <input type="text" id="redirect_to_website" placeholder="Redirect To Website" style="display:none;" name="redirect_to_website" />
            </div>
        </div>

        <div class="input-field col s12">
            <label for="first_name">Plugins and Ad-ons</label><br>
            <input type="text" class="validate" placeholder="Facebook Pixel" id="facebook_pixel" name="facebook_pixel">
            <input type="text" class="validate" placeholder="Google Analytics Id" id="google_analytics" name="google_analytics">
        </div>
        </div>
        <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-close waves-effect waves-green btn-flat">Close</a>
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
    $('.modal').modal();
} );


function change_label_name(label){
    $("#label_to_be_given").val('');
    $("#btn-container").html('<a href="javascript:void(0)" class="modal-close btn waves-effect waves-light" onclick="change_label_process(\''+label+'\')">Change Label</a>')
}

function change_label_process(label){
    var label_to_be_given = $("#label_to_be_given").val();
    $("#"+label+"_label").html(label_to_be_given);
    $("#"+label+"_label_value").val(label_to_be_given);
}


function create_new_field(){
    $("#label_new_to_be_given").val('');
    $('#modal2').modal('open');
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
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="validate" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="'+label_val+'"></div></span>';
    $("#append_field").append(html);
    $('#modal2').modal('close');
}

function delete_field(label){
    $("#new_label_id"+label).hide();
}

function create_new_field_price(){
    var input_field_price_type = $("#input_field_price_type").val();
    if(input_field_price_type=='decide'){
        $('#modal3').modal('open');
    }
    else if(input_field_price_type=='fixed'){
        $('#modal4').modal('open');
    }
    else{
        $('#modal5').modal('open');
    }
}


function add_price_field_process2(){
    var label_to_be_given = $("#label_new_fix_price_to_be_given").val();
    var modal_fixed_price = $("#fix_price_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="validate" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelpricetypevalue[]" value="'+modal_fixed_price+'"></div></span>';
    $("#append_field").append(html);
    $('#modal4').modal('close');
}

function add_price_field_process(){
    var label_to_be_given = $("#label_new_price_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input name="email" id="fb_link" type="text" class="validate" readonly></a><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelpricetypevalue[]" value=""></div></span>';
    $("#append_field").append(html);
    $('#modal3').modal('close');
}


function add_price_field_process3(){
    var label_to_be_given = $("#label_new_fix_price_with_qty_to_be_given").val();
    var modal_fixed_price = $("#fix_price_with_qty_to_be_given").val();
    var html = '<span id="new_label_id'+label_to_be_given.replace(/\s+/g, "")+'"><div class="input-field col s12"><label id="phone_label" for="first_name">'+label_to_be_given+'&nbsp;&nbsp;<a href="javascript:void(0);" onclick="delete_field(\''+label_to_be_given.replace(/\s+/g, "")+'\')">Delete</a></label><br><input value="'+modal_fixed_price+'" name="email" id="fb_link" type="text" class="validate" readonly></a><input type="number" class="validate" value="0" disabled placeholder="Enter Price" id="fix_qty_to_be_given"><input type="hidden" name="label[]" value="'+label_to_be_given+'"><input type="hidden" name="labeltype[]" value="text"><input type="hidden" name="labelpricetypevalue[]" value="'+modal_fixed_price+'"><input type="hidden" name="labelpricetypeqty[]" value="number"></div></span>';
    $("#append_field").append(html);
    $('#modal5').modal('close');
}


function open_setting_modal(){
    $("#setting_modal").modal('open');
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