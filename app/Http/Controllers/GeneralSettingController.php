<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Models\GeneralSetting;
use App\Models\MerchantKey;
use App\Models\MerchantUser;
use App\Models\Merchant;


class GeneralSettingController extends Controller
{
    public function index(Request $request){
        $merchant_id =  session()->get('merchant');
        $general_settings = GeneralSetting::where('merchant_id',$merchant_id)->first();
        $key_details = MerchantKey::where('merchnat_id',$merchant_id)->first();
        $merchant_details = Merchant::select('merchants.*','merchant_users.*')->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->where('merchants.id',$merchant_id)->get();
        $merchant_details=$merchant_details[0];
        return view('pages.settings.index', compact('general_settings','key_details','merchant_details'));
    }

    public function getGeneralSetting(Request $request)
    {
        $id = $request->id;
        $general_settings = DB::table('general_settings')->where('id',$id)->first();
        return view('pages.settings.edit', compact('general_settings'));
    }

    public function updateGeneralSetting(Request $request, $id)
    {
        $this->validate($request, [
            'theme_color' => 'required|max:200',
        ]);
        $input = $request->all();
        unset($input['_token']);
        if ($files = $request->file('logo')) {
            // Define upload path
            $destinationPath = public_path('/images/logo/'); // upload path
            // Upload Orginal Image
            $uploadedImage = 'logo_'.date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $uploadedImage);
            $input['logo'] = $uploadedImage;
        }
        DB::table('general_settings')->where('id',$id)->update($input);
        return redirect()->route('general-settings')
                        ->with('success','Updated successfully');
    }

    public function changeFlashCheckout(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $flash_checkout = $request->status;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('falsh_checkout'=>$flash_checkout));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'falsh_checkout'=>$flash_checkout));
        }
        return response()->json(array('flash_checkout'=>$flash_checkout));
    }

    public function changeAutoCapture(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $auto_capture = $request->status;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('auto_capture'=>$auto_capture));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'auto_capture'=>$auto_capture));
        }
        return response()->json(array('auto_capture'=>$auto_capture));
    }

    public function changeRefundType(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $refund_type = $request->refund_type;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('refund_type'=>$refund_type));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'refund_type'=>$refund_type));
        }
        return response()->json(array('refund_type'=>$refund_type));
    }

    public function changeEmailNotification(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $emailnotofication = $request->emailnotofication;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('notification_email'=>$emailnotofication));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'notification_email'=>$emailnotofication));
        }
        return response()->json(array('success'=>1));
    }


    public function changeSmsNotification(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $sms_notification = $request->status;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('sms_notification'=>$sms_notification));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'sms_notification'=>$sms_notification));
        }
        return response()->json(array('sms_notification'=>$sms_notification));
    }


    public function changeSkipMandate(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $skip_mandate = $request->status;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('skip_mandate'=>$skip_mandate));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'skip_mandate'=>$skip_mandate));
        }
        return response()->json(array('skip_mandate'=>$skip_mandate));
    }

    public function changeReminder(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $payment_link_reminder = $request->status;
        $get_data=GeneralSetting::where('merchant_id',$merchant_id)->first();
        if(!empty($get_data)){
            GeneralSetting::where('merchant_id',$merchant_id)->update(array('payment_link_reminder'=>$payment_link_reminder));
        }else{
            GeneralSetting::insert(array('merchant_id'=>$merchant_id,'payment_link_reminder'=>$payment_link_reminder));
        }
        return response()->json(array('success'=>1));
    }

}
