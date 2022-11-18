<div class="invoice-contener">
    <?php print_r($invoice_details); exit; ?>
    <table class="table-invoice-header-details">
        <thead>
            <tr>
                <th colspan="2" class="invoice-header">
                    <h1>WaveXpay Invoice</h1>
                </th>
            </tr>
            <tr>
               <th colspan="2" class="right px-10 invoice-no">
                   <h3><b>Invoice No.:</b> #{{$invoice_details->invoice_id}}</h3>
                   <h5><b>Date:</b> 25 Nav 2022</h5>
               </th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="invoice-customer-content">
                        <h4>Bill To</h4>
                        <h5>WaveXpay Payment Gateway Pvt. LTD.</h5>
                        <p>153, New Ashok Nagar, Delhi, 201201, India </p>
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

            <tr>
                <th>1</th>
                <td>Mobile</td>
                <td>2,000</td>
                <td>2</td>
                <td>4,000</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Mobile</td>
                <td>2,000</td>
                <td>2</td>
                <td>4,000</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Mobile</td>
                <td>2,000</td>
                <td>2</td>
                <td>4,000</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="4" class="center">Total</th>
                <th>12,000</th>
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