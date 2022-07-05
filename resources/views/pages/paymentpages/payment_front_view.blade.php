@extends('layouts.admin')
@section('title','Payment Pages')
@section('content_header')

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
                                        <label for="first_name"><strong>Payment For</strong></label><br>
                                        {{ $get_payment_page_details->page_title }}
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name"><strong>Contact Us</strong></label><br>
                                        <i class="fa fa-envelope" style="font-size:15px"></i>{{ $get_payment_page_details->support_email }}<br>
                                        <i class="fa fa-phone" style="font-size:15px"></i>{{ $get_payment_page_details->support_phone }}
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="first_name"><strong>Terms & Conditions</strong></label><br>
                                        {{ $get_payment_page_details->term_conditions }}
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <?php print_r($get_payment_page_details->payment_form_json); ?>
                            <h6>Payment Details</h6>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label id="email_label" for="first_name">Email</label><br>
                                    <input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label id="phone_label" for="first_name">Phone</label><br>
                                    <input placeholder="To be Filled By Customer" name="email" id="fb_link" type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </form>
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