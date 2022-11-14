<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;
use App\Models\GeneralSetting;
use App\Models\MerchantKey;
use App\Models\MerchantUser;
use App\Models\Merchant;
use App\Models\WavexpayApiKey;
use Helper;


class GeneralSettingController extends Controller
{
    public function index(Request $request){
        $merchant_id =  session()->get('merchant');
        $general_settings = GeneralSetting::where('merchant_id',$merchant_id)->first();
        $key_details = MerchantKey::where('merchnat_id',$merchant_id)->first();
        $merchant_details = Merchant::select('merchants.*','merchant_users.*')->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->where('merchants.id',$merchant_id)->get();
        $merchant_details=$merchant_details[0];
        $mode = session('mode');
        return view('pages.settings.index', compact('general_settings','key_details','merchant_details','mode'));
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

    public function generateApiKey(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $key = $request->key;

        if(session('mode')=='test'){
            MerchantKey::where('merchnat_id',$merchant_id)
            ->update(array(
                'test_api_key'=>'wxp_test_'.Helper::rand_string(14),
                'test_api_secret'=>Helper::rand_string(24)
            ));
        }else if(session('mode') == 'live'){
           // $new_key = 'wxp_live_'.Helper::rand_string(14);
            MerchantKey::where('merchnat_id',$merchant_id)
            ->update(array(
                'live_api_key'=>'wxp_live_'.Helper::rand_string(14),
                'live_api_secret'=>Helper::rand_string(24)
            ));
        }else{
            // 
        }

        $html = '';
        $key_details = MerchantKey::where('merchnat_id',$merchant_id)->first();
        if(session('mode')=='test') 
        { 
            $key = $key_details->test_api_key; 
        } 
        else 
        { 
            $key = $key_details->live_api_key; 
        } 
        $download_link = url('general-settings/download/api-key');
        $download = '<a href="'.$download_link.'" class="btn btn-sm btn-default" title="Download api_key and api_secret"><i class="fas fa-fw fa-download"></i></a>';

        $html.='<td>'.$key.'</td>
        <td>'.date("d F,Y",strtotime($key_details->created_at)).'</td>
        <td>Never</td>
        <td>';if($key!='') { 
            $html.='<button type="button" onclick="generate_api_key(\''.$key.'\')" class="btn btn-xs btn-info">Regenerate API key</button>' . $download;
             }else { 
                $html.='<button type="button"  onclick="generate_api_key(\''.$key.'\')" class="btn btn-xs btn-info">Generate API key</button>'; 
            } 
            $html.='</td>';

        return response()->json(array('success'=>1,'html'=>$html));
    }

    public function downlaodApiKeys(){
       $row = MerchantKey::where('merchnat_id', session('merchant'))->first();
      
       $text = "/* ------- ". ucfirst(session('mode')) . " Credentials Details ------- */ \n";
       if(session('mode') == 'live'){
        $text .= "\n Api Key : " . $row->live_api_key.
                "\n Api Secret : " . $row->live_api_secret;
       }else if(session('mode') == 'test'){
        $text .= "\nApi Key : ". $row->test_api_key.
                "\n Api Secret : " . $row->test_api_secret;
       }else{

       }

        $file = "waveXpay-api-credentials-".date('d-m-y-h-i-s').".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, $text);
        fclose($txt);

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);

        //return redirect()->back();

    }

}
