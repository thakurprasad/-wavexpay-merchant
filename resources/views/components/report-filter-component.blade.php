<?php
/**
 * <x-filter-component form_id="search_form" action="transactions/searchpayments" method="POST" /> 
 * 
 * */
 ?>
 @yield('style')
 @yield('script')
  <form  method="{{ $method }}" action="{{$action}}" id="{{ $form_id }}">   
    @csrf 
    <div class="row col-md-12">
        <div class="col-sm-5">
            <div class="form-group">
                <x-date-range-picker id="daterangepicker" label="Select Date Range" />
            </div>
        </div>
        @if($type=='transaction')
        <div class="col-sm-3">
            <label>Filter Type</label>
            <select class="form-control" name="filter_on" id="filter_on">
                <option value="">Select</option>
                <option value="payment">Payment</option>
                <option value="dispute">dispute</option>
                <option value="dispute">order</option>
            </select>
        </div>
        @elseif($type=='settlement') 
        <div class="col-sm-3">
            <label>Filter Type</label>
            <select class="form-control" name="filter_on" id="filter_on">
                <option value="settlement">Settlement</option>
            </select>
        </div>
        @elseif($type=='refund') 
        <div class="col-sm-4">
            <label>Filter Type</label>
            <select class="form-control" name="filter_on" id="filter_on">
                <option value="refund">refund</option>
            </select>
        </div>
        @else
        <div class="col-sm-3">
            <label>Filter Type</label>
            <select class="form-control" name="filter_on" id="filter_on">
                <option value="">Select</option>
                <option value="chargeback">Chargeback</option>
                <option value="dispute">Dispute</option>
            </select>
        </div>
        @endif
        <div class="col-sm-3">
            <div class="form-group pad-30">
                <button type="submit" class="btn btn-primary btn-block" id="filter_data_btn">Download Report</button>
            </div>
        </div>
    </div>
    <div class="col-md-12"> 
        <input type="button" onclick="show_hide('show')" name="advance-filters" class="btn btn-link btn-sm show-advance-filters" value="Show Advance Filters">
        <input type="button" onclick="show_hide('hide')" name="advance-filters" class="btn btn-link btn-sm hide-advance-filters" value="Hide Advance Filters" style="display: none;">
    </div>
    <div class="advance-filters" style="display:none;">
        <div class="row col-md-12">                   
            @yield('advance_filters')
        </div>
    </div>
</form>

<script type="text/javascript">
    function show_hide(action){
        if(action == 'show'){
            $(".advance-filters").show(300);
            $(".show-advance-filters").hide(100);
            $(".hide-advance-filters").show(100);
        }else{
            $(".advance-filters").hide(300);
            $(".show-advance-filters").show(100);
            $(".hide-advance-filters").hide(100);
        }
    }
</script>

<style type="text/css">
.pad-30{
    padding-top: 30px;
}
 
#search_form{
    border: 1px solid #ccc;
    margin-bottom: 20px;
    padding: 10px 0px;
    background: #e3e6f0;

}
</style>