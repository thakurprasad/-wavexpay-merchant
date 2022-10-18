<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
use App\Models\Merchant;
use App\Models\MerchantUser;
use DB;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
    public function blankPage()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blank Page"],
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('pages.page-blank', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function dashboard(Request $request)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Blank Page"],
        ];

        $action = $request->action;
        $merchant_id =  session()->get('merchant');
        $merchant_details = Merchant::where('id',$merchant_id)->first();
        $is_kyc_completed = $merchant_details->is_kyc_completed;
        $dashboard_header = DB::table('dashboardheader')->first();

        $payments = DB::table('payments')->where('merchant_id',$merchant_id)->get();
        $orders = DB::table('orders')->where('merchant_id',$merchant_id)->get();
        $api = new Api('rzp_test_YRAqXZOYgy9uyf', 'uSaaMQw3jHK0MPtOnXCSSg51');
        $settlements = $api->settlement->all();
        $disputes = DB::table('disputes')->get();
        $refunds = DB::table('refunds')->get();
        $users = DB::table('users')->get();




        /*****************payment value calculation for payment method graph***********************/
        $payment_by_method_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
            DB::raw("(SUM(amount)) as total_amount"),
            DB::raw("payment_method as method")
        )
        ->whereYear('payment_created_at', date('Y'))
        ->groupBy('method')
        ->get();
        
        $paymentmethodxvalue='[';
        $paymentmethodyvalue='[';
        foreach($payment_by_method_data as $methoddata)
        {
            $paymentmethodxvalue.="'".$methoddata->method."'".",";
            $paymentmethodyvalue.=$methoddata->total_amount.',';
        }
        $paymentmethodxvalue=rtrim($paymentmethodxvalue,",");
        $paymentmethodxvalue.=']';

        $paymentmethodyvalue=rtrim($paymentmethodyvalue,",");
        $paymentmethodyvalue.=']';
        /*****************End of payment value calculation for payment method graph***********************/





        /*****************payment value calculation for payment line graph***********************/
        $payment_current_month_data = DB::table('payments')->where('merchant_id',$merchant_id)->whereMonth('payment_created_at', date('m'))
        ->whereYear('payment_created_at', date('Y'))
        ->get(['amount','payment_created_at']);

        //print_r($payment_current_month_data);exit;

        $paymentmaxValue = DB::table('payments')->where('merchant_id',$merchant_id)->orderBy('amount', 'desc')->value('amount');
        $paymentminValue = DB::table('payments')->where('merchant_id',$merchant_id)->orderBy('amount', 'asc')->value('amount');

        $paymentxvalue1='[';
        $paymentyvalue1='[';
        foreach($payment_current_month_data as $data)
        {
            $paymentxvalue1.="'".date('M',strtotime($data->payment_created_at)).date('d',strtotime($data->payment_created_at))."'".",";

            $paymentyvalue1.=$data->amount.',';
        }
        $paymentxvalue1=rtrim($paymentxvalue1,",");
        $paymentxvalue1.=']';

        $paymentyvalue1=rtrim($paymentyvalue1,",");
        $paymentyvalue1.=']';


        /*echo $paymentxvalue1;
        echo $paymentyvalue1;exit;*/
        
        /*****************payment value end calculation for payment line graph***********************/


        /*****************order value calculation for total line graph***********************/
        $order_current_month_data = DB::table('orders')->where('merchant_id',$merchant_id)->whereMonth('order_created_at', date('m'))
        ->whereYear('order_created_at', date('Y'))
        ->get(['amount','order_created_at']);


        $ordermaxValue = DB::table('orders')->where('merchant_id',$merchant_id)->whereMonth('order_created_at', date('m'))->whereYear('order_created_at', date('Y'))->orderBy('amount', 'desc')->value('amount');
        $orderminValue = DB::table('orders')->where('merchant_id',$merchant_id)->whereMonth('order_created_at', date('m'))->whereYear('order_created_at', date('Y'))->orderBy('amount', 'asc')->value('amount');

        $orderxvalue1='[';
        $orderyvalue1='[';
        foreach($order_current_month_data as $data)
        {
            $orderxvalue1.="'".date('M',strtotime($data->order_created_at)).date('d',strtotime($data->order_created_at))."'".",";

            $orderyvalue1.=$data->amount.',';
        }
        $orderxvalue1=rtrim($orderxvalue1,",");
        $orderxvalue1.=']';

        $orderyvalue1=rtrim($orderyvalue1,",");
        $orderyvalue1.=']';
        /*****************order value end calculation for payment line graph***********************/


        /*************************** pie chart data for volume in each section *********************/
        $new_pie_chart_volume_data = "['Payment', ".count($payments)."],
        ['Refund', ".count($refunds)."],
        ['Orders', ".count($orders)."],
        ['Disputes', ".count($disputes)."]";
        /*************************** end of pie chart data for volume in each section **************/


        /*************************** Bar Chart Data For Payment ************************************/
        $xValue='[';
        $yValue='[';
        $payment_month_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
            DB::raw("(SUM(amount)) as total_amount"),
            DB::raw("MONTHNAME(payment_created_at) as month_name")
        )
        ->whereYear('payment_created_at', date('Y'))
        ->groupBy('month_name')
        ->get();
        
        foreach($payment_month_data as $pd)
        {
            $xValue.='"'.$pd->month_name.'",';
            $yValue.=$pd->total_amount.',';
        }
        $xValue=rtrim($xValue,",");
        $xValue.=']';

        $yValue=rtrim($yValue,",");
        $yValue.=']';

        

        //var yValues = [200, 58, 125, 110, 175, 148, 221, 315, 112];
        //var barColors = ["red", "green","blue","orange","brown", "black", "beige", "yellow"];
        /*************************** End Bar Chart Data For Payment ********************************/

        if(count($payments)>0)
        {
            $success_perc = number_format(((count($payments)*100)/(count($payments)+count($orders)+count($disputes)+count($refunds))),2);
        }
        else 
        {
            $success_perc = 0;
        }
        


        $payment_min_max_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
            DB::raw("(MIN(amount)) as min_amount"),
            DB::raw("MAX(amount) as max_amount")
        )
        ->whereYear('payment_created_at', date('Y'))
        ->get();
        if(!empty($payment_min_max_data))
        {
            $min_max_transacion='['.$payment_min_max_data[0]->min_amount.','.$payment_min_max_data[0]->max_amount.']';
        }
        else 
        {
            $min_max_transacion='[0,0]';
        }



        
        return view('pages.dashboard', compact('payments','orders','disputes','refunds','users','success_perc','paymentxvalue1','paymentyvalue1','paymentmaxValue','paymentminValue','ordermaxValue','orderminValue','orderxvalue1','orderyvalue1','new_pie_chart_volume_data','xValue','yValue','dashboard_header','action','min_max_transacion','settlements','paymentmethodxvalue','paymentmethodyvalue','is_kyc_completed','merchant_id'));
    }


    public function collapsePage()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "Page Collapse"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'bodyCustomClass' => 'menu-collapse'];

        return view('pages.page-collapse', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }


    public function invoiceList()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.list', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceView()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.view', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceEdit()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.edit', ['pageConfigs' => $pageConfigs]);
    }
    public function invoiceAdd()
    {
        // custom body class
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('invoices.add', ['pageConfigs' => $pageConfigs]);
    }


    public function merchantProfile()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Pages"], ['name' => "User Profile"],
        ];
        $merchant_id =  session()->get('merchant');
        
        $merchant_details = Merchant::select('merchants.*','merchant_users.*')->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->where('merchants.id',$merchant_id)->get();

        $merchant_details = $merchant_details[0];

        $pageConfigs = ['pageHeader' => true];
        return view('pages.merchant-profile', compact('merchant_details'));
    }

    public function getSuccessTransactionGraphData(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status_filter = $request->status_filter;

        $paymentxvalue1='';
        $paymentyvalue1='';

        $orderxvalue1='';
        $orderyvalue1='';

        $merchant_id =  session()->get('merchant');


        /*****************payment value calculation for payment method graph***********************/
        $payment_by_method_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
            DB::raw("(SUM(amount)) as total_amount"),
            DB::raw("payment_method as method")
        )
        ->whereYear('payment_created_at', date('Y'))
        ->groupBy('method')
        ->get();
        
        $paymentmethodxvalue='';
        $paymentmethodyvalue='';
        foreach($payment_by_method_data as $methoddata)
        {
            $paymentmethodxvalue.=$methoddata->method.",";
            $paymentmethodyvalue.=$methoddata->total_amount.',';
        }
        $paymentmethodxvalue=rtrim($paymentmethodxvalue,",");
        $paymentmethodyvalue=rtrim($paymentmethodyvalue,",");
        /*****************End of payment value calculation for payment method graph***********************/


        if($status_filter=='' || $status_filter=='all'){
            $payment_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
                DB::raw("(SUM(amount)) as total_amount"),
                DB::raw("DATE(payment_created_at) as date")
            )
            ->whereYear('payment_created_at', date('Y'))
            ->whereBetween('payment_created_at', [$start_date, $end_date])
            ->orderBy('date', 'DESC')
            ->groupBy('date')
            ->get();
        }else{
            $payment_data = DB::table('payments')->where('merchant_id',$merchant_id)->select(
                DB::raw("(SUM(amount)) as total_amount"),
                DB::raw("DATE(payment_created_at) as date")
            )
            ->whereYear('payment_created_at', date('Y'))
            ->whereBetween('payment_created_at', [$start_date, $end_date])
            ->orderBy('date', 'DESC')
            ->groupBy('date')
            ->where('status',$status_filter)
            ->get();
        }



        $order_data = DB::table('orders')->where('merchant_id',$merchant_id)->select(
            DB::raw("(SUM(amount)) as total_amount"),
            DB::raw("DATE(order_created_at) as date")
        )
        ->whereYear('order_created_at', date('Y'))
        ->whereBetween('order_created_at', [$start_date, $end_date])
        ->orderBy('date', 'DESC')
        ->groupBy('date')
        ->get();


        $total_order = count($order_data);
        $total_payment_amount = 0;

        foreach($payment_data as $data)
        {
            $paymentxvalue1.=date('F d',strtotime($data->date)).',';
            $paymentyvalue1.=$data->total_amount.',';
            $total_payment_amount+=$data->total_amount;
        }
        $paymentxvalue1=rtrim($paymentxvalue1,",");
        $paymentyvalue1=rtrim($paymentyvalue1,",");

        foreach($order_data as $odata)
        {
            $orderxvalue1.=date('F d',strtotime($odata->date)).',';
            $orderyvalue1.=$odata->total_amount.',';
        }
        $orderxvalue1=rtrim($orderxvalue1,",");
        $orderyvalue1=rtrim($orderyvalue1,",");

        //success percentage calculation
        $payments = DB::table('payments')->where('merchant_id',$merchant_id)->whereBetween('payment_created_at', [$start_date, $end_date])->get();
        $orders = DB::table('orders')->where('merchant_id',$merchant_id)->whereBetween('order_created_at', [$start_date, $end_date])->get();
        $disputes = DB::table('disputes')->whereBetween('created_at', [$start_date, $end_date])->get();
        $refunds = DB::table('refunds')->whereBetween('created_at', [$start_date, $end_date])->get();

        if(count($payments)>0)
        {
            $success_perc = number_format(((count($payments)*100)/(count($payments)+count($orders)+count($disputes)+count($refunds))),2);
        }
        else
        {
            $success_perc = 0;
        }
        
        //end success percentage calculation
        

        return response()->json(array('paymentxvalue1'=>$paymentxvalue1,'paymentyvalue1'=>$paymentyvalue1,'orderxvalue1'=>$orderxvalue1,'orderyvalue1'=>$orderyvalue1,'total_order'=>$total_order,'total_payment_amount'=>$total_payment_amount,'success_perc'=>$success_perc,'paymentmethodxvalue'=>$paymentmethodxvalue,'paymentmethodyvalue'=>$paymentmethodyvalue));
    }


    public function getSuccessRateGraphData(Request $request){
        $data_format = $request->data_format;
        $paymentxvalue1='';
        $paymentyvalue1='';

        $merchant_id =  session()->get('merchant');

        if($data_format=='monthly')
        {
            $payment_month_data = DB::table('orders')->where('merchant_id',$merchant_id)->select(
                DB::raw("(SUM(amount)) as total_amount"),
                DB::raw("MONTHNAME(order_created_at) as month_name")
            )
            ->whereYear('order_created_at', date('Y'))
            ->groupBy('month_name')
            ->get();
        }
        else if($data_format=='yearly')
        {
            $payment_month_data = DB::table('orders')->where('merchant_id',$merchant_id)->select(
                DB::raw("(SUM(amount)) as total_amount"),
                DB::raw("YEAR(order_created_at) as year")
            )
            ->orderBy('order_created_at', 'DESC')
            ->groupBy('year')
            ->get();
        }

        foreach($payment_month_data as $data)
        {
            if($data_format=='monthly')
            {
                $paymentxvalue1.=$data->month_name.',';
            }
            else if($data_format=='yearly')
            {
                $paymentxvalue1.=$data->year.',';
            }
            $paymentyvalue1.=$data->total_amount.',';
        }
        $paymentxvalue1=rtrim($paymentxvalue1,",");

        $paymentyvalue1=rtrim($paymentyvalue1,",");

        $paymentmaxValue = DB::table('orders')->where('merchant_id',$merchant_id)->select(
            DB::raw("(SUM(amount)) as total_amount"),
            DB::raw("YEAR(order_created_at) as year"))->groupBy('year')->value('total_amount');
        /*$paymentminValue = DB::table('payments')->whereMonth('payment_created_at', date('m'))->whereYear('payment_created_at', date('Y'))->orderBy('amount', 'asc')->value('amount');*/

        return response()->json(array('paymentxvalue1'=>$paymentxvalue1,'paymentyvalue1'=>$paymentyvalue1,'paymentmaxValue'=>$paymentmaxValue,'paymentminValue'=>0));
    }

    public function completeSignUp(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        return view('auth.complete_sign_up',compact('merchant_id'));
    }

    public function completeSignUpProcess(Request $request)
    {
        $input = $request->all();
        $input['aadhar_front_image']= '';
        $input['aadhar_back_image']= '';
        if($request->file('aadhar_front')){
            $file= $request->file('aadhar_front');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('DocumentationImage'), $filename);
            $input['aadhar_front_image']= $filename;
        }
        if($request->file('aadhar_back')){
            $file2= $request->file('aadhar_back');
            $filename2= date('YmdHi').$file2->getClientOriginalName();
            $file2-> move(public_path('DocumentationImage'), $filename2);
            $input['aadhar_back_image']= $filename2;
        }

        unset($input['aadhar_front']);
        unset($input['aadhar_back']);
        unset($input['_token']);
        unset($input['action']);

        $input['is_kyc_completed'] = 'yes';

        DB::table('merchant_users')->where('merchant_id',$input['merchant_id'])->update($input);

        return response()->json(array('success'=>1));
    }

    public function welcomeToWavexpay()
    {
        return view('pages.welcome_to_wavexpay');
    }


    public function partnerDashboard(Request $request)
    {
        return view('pages.partner_dashboard');
    }

    public function merchantDetailsUpdate(Request $request,$merchant_id)
    {
        $input = $request->all();
        $merchant_id = Crypt::decryptString($merchant_id);
        unset($input['_token']);
        foreach($input as $key=>$val)
        {
            if($val!='')
            {
                if($key=='aadhar_front_image')
                {
                    if ($request->hasFile('aadhar_front_image')){
                        $file2 = $request->file('aadhar_front_image');
                        $filename2 = date('YmdHi').$file2->getClientOriginalName();
                        $image_path2 = public_path().'/uploads/aadharimage/';
                        $file2->move($image_path2, $filename2);
                        MerchantUser::where('merchant_id',$merchant_id)->update(array('aadhar_front_image'=>$filename2));
                    }
                }

                else if($key=='aadhar_back_image')
                {
                    if ($request->hasFile('aadhar_back_image')){
                        $file3 = $request->file('aadhar_back_image');
                        $filename3 = date('YmdHi').$file3->getClientOriginalName();
                        $image_path3 = public_path().'/uploads/aadharimage/';
                        $file3->move($image_path3, $filename3);
                        MerchantUser::where('merchant_id',$merchant_id)->update(array('aadhar_back_image'=>$filename3));
                    } 
                }
                else 
                {
                    MerchantUser::where('merchant_id',$merchant_id)->update(array($key=>$val));
                }
            }
        }
        return redirect()->back() ->with('success','Updated successfully');
    }

    public function merchantGeneralUpdate(Request $request,$merchant_id)
    {
        $input = $request->all();
        $merchant_id = Crypt::decryptString($merchant_id);
        unset($input['_token']);
        foreach($input as $key=>$val)
        {
            if($val!='')
            {
                if($key=='display_name')       
                {
                    MerchantUser::where('id',$merchant_id)->update(array($key=>$val)); 
                }                        
                else 
                {
                    Merchant::where('id',$merchant_id)->update(array($key=>$val)); 
                }              
            }
        }
        return redirect()->back() ->with('success','Updated successfully');
    }

}