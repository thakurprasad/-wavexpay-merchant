<div class="invoice-contener">
    <table class="table-invoice-header-details">
        <thead>
            <tr>
                <th colspan="2" class="invoice-header">
                    <h1>WaveXpay Invoice</h1>
                </th>
            </tr>
            <tr>
               <th colspan="2" class="right px-10 invoice-no">
                   <h3><b>Invoice No :</b> #{{$invoice_details->invoice_id}}</h3>
                   <h5><b>Date:</b> {{date('j F,Y',strtotime($invoice_details->created_at))}}</h5>
               </th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="invoice-customer-content">
                        <h4>Bill To</h4>
                        <h5>{{$invoice_details->customer_billing_address1}}.</h5>
                        <p>{{$invoice_details->customer_billing_address2}}, {{$invoice_details->customer_billing_city}}, {{$invoice_details->customer_billing_zip}}, {{$invoice_details->customer_billing_country}} </p>
                    </div>
                </td>
                <td>
                    <div class="invoice-customer-content right">
                        <h4>From</h4>
                        <h5>Websoft Technologies Pvt. Ltd.</h5>
                        <p>A-84, F-6, 1st Floor, Noida Sector-4, UP-201301, India</p>
                    </div>
                </td>
            </tr>
        </tbody>
        
    </table>

    <table class="invoice-table table">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Rate/Item</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total_amount = 0; $count = 1; @endphp
            @if(!empty($invoice_item_details))
            @foreach($invoice_item_details as $item_details)
            @php 
            $total_amount+=$item_details->quantity*$item_details->amount;
            @endphp
            <tr>
                <th>{{$count}}</th>
                <td>{{$item_details->name}}</td>
                <td>{{$item_details->amount}}</td>
                <td>{{$item_details->quantity}}</td>
                <td>{{$item_details->quantity*$item_details->amount}}</td>
            </tr>
            @php $count++; @endphp
            @endforeach
            @endif
        </tbody>
        <thead>
            <tr>
                <th colspan="4" class="center">Total</th>
                <th>{{$total_amount}}</th>
            </tr>
        </thead>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>
        Note: ............................
                ............................
                ............................
    </p>
</div>

<style type="text/css">
    .invoice-contener{
        border: 1px solid #ccc;
        min-height: 1000px;
    }
    .invoice-header{
        height: 120px;
        background: #efefef;
        color: blue;
        font-weight: bold;
        text-align: center;
    }
    .table-invoice-header-details{
        width: 100%;

    }
    .invoice-customer-content {
        padding: 20px 10px;
    }
    .right {
        text-align: right;
    }
    .px-10{
        padding-right: 10px;
    }
    .invoice-no{
        padding: 10px;
    }
</style>