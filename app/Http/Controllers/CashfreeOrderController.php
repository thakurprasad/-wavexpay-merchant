<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Route;
use Carbon;
use DateTime;
use App\Models\CashfreeOrder;

class CashfreeOrderController extends Controller {

    public function create(Request $request)
	{
        $order = new CashfreeOrder;
        $order->user_id=1;
        $order->product_id=1;
        $order->price=$request->price;
        $order->amount=$request->amount;
        $order->status=0;
        $order->save();

        $cashfree = config()->get('cashfree');
        $action = 'https://test.cashfree.com/billpay/checkout/post/submit';

        $appID = $cashfree['appID'];
        $secretKey = $cashfree['secretKey'];
        $orderCurrency = $cashfree['orderCurrency'];

        $returnUrl = url('payments/thankyou');
        $notifyUrl = url('payments/notify');

        $customerName = 'Test';
        $customerEmail = 'test@test.test';
        $customerPhone = '1234567890';
        $orderId = $cashfree['orderPrefix'] . $order->id;
	    $orderCurrency='INR';

        $postData = array(
            "appId" => $appID,
            "orderId" => $orderId,
            "orderAmount" => $order->amount,
            "orderCurrency" => $orderCurrency,
            "orderNote" => $order->id,
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => $returnUrl,
            "notifyUrl" => $notifyUrl,
        );

        ksort($postData);

        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }
        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);

        $form = <<<HERE
            <form class="redirectForm" method="post" action="$action">
            <input type="hidden" name="appId" value="$appID"/>
            <input type="hidden" name="orderId" value="$orderId"/>
            <input type="hidden" name="orderAmount" value="$order->amount"/>
            <input type="hidden" name="orderCurrency" value="$orderCurrency"/>
            <input type="hidden" name="orderNote" value="$order->id"/>
            <input type="hidden" name="customerName" value="$customerName"/>
            <input type="hidden" name="customerEmail" value="$customerEmail"/>
            <input type="hidden" name="customerPhone" value="$customerPhone"/>
            <input type="hidden" name="returnUrl" value="$returnUrl"/>
            <input type="hidden" name="notifyUrl" value="$notifyUrl"/>
            <input type="hidden" name="signature" value="$signature"/>

            <button type="button" id="paymentbutton" class="btn btn-block btn-lg bg-ore continue-payment">Continue to Payment</button>

        </form>
        HERE;
        return response($form);
    }
}