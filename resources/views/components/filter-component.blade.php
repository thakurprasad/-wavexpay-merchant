<?php
/**
 * <x-filter-component form_id="search_form" action="transactions/searchpayments" method="POST" /> 
 * 
 * */
 ?>
 @yield('style')
 @yield('style')
  <form  method="{{ $method }}" action="{{$action}}" id="{{ $form_id }}">
  
        @csrf 
            <div class="row col-md-12">
                <div class="col-sm-5">
                    <div class="form-group">
                        <x-date-range-picker id="daterangepicker" label="Select Date Range" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <x-dropdown />
                </div>
                <div class="col-sm-2">
                    <div class="form-group pad-30" >
                        <button type="button" class="btn btn-primary btn-block"  onclick="search_payment()">Serach</button>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group pad-30">
                        <button type="button" class="btn btn-secondary btn-block"  onclick="reset_page()">Reset</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12"> 
                <input type="button" onclick="show_hide('show')" name="advance-filters" class="btn btn-link btn-sm show-advance-filters" value="Show Advance Filters">
                <input type="button" onclick="show_hide('hide')" name="advance-filters" class="btn btn-link btn-sm hide-advance-filters" value="Hide Advance Filters" style="display: none;">
            </div>
            <div class="advance-filters" style="display:none;">
                <div class="row col-md-12"> 
                   
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="payment_id">Payment Id</label>
                            <input type="text" name="payment_id" class="form-control" id="payment_id" placeholder="Payment Id">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    @yield('advance_filters')
                    @foreach($advance_filters as $input=>$label)
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="{{ $input }}">{{ $label }}</label>
                            <input type="text" name="{{ $input }}" class="form-control" id="{{ $input }}" placeholder="{{ $label }}">
                        </div>
                    </div>
                    @endforeach

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