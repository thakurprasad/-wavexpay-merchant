<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use DB;
use Helper;
use App\Models\Merchant;

class AffiliateController extends Controller
{
    public function affiliateAccounts(Request $request){
        $merchant_id =  session()->get('merchant');
        $merchant_details = DB::table('merchants')->where('id',$merchant_id)->first();
        $link_text = $merchant_details->referral_link_text;

        $referred_merchant = Merchant::select('merchants.*','merchant_users.*')->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->whereNotNull('merchants.referral_id')->where('referral_id',$link_text)->get();

        //print_r($referred_merchant);exit;

        return view('partner.affiliate-accounts',compact('referred_merchant'));
    }

    public function createReferralLink(Request $request)
    {
        $merchant_id =  session()->get('merchant');
        $merchant_details = DB::table('merchants')->where('id',$merchant_id)->first();
        if($merchant_details->referral_link_text=='')
        {
            $link_text = substr(Crypt::encryptString($merchant_id.'/'.date('Y-m-d H:i:s')),5,10);
            DB::table('merchants')->where('id',$merchant_id)->update(array('referral_link_text'=>$link_text));
        }
        else 
        {
            $link_text = $merchant_details->referral_link_text;
        }
        return response()->json(array('link_text'=>$link_text));
    }

    public function sendInvite(Request $request)
    {
        $email = $request->email;
        $affiliate_name = $request->affiliate_name;
        $contact_number = $request->contact_number;


        $merchant_id =  session()->get('merchant');
        $merchant_details = DB::table('merchants')->where('id',$merchant_id)->first();
        $link = $merchant_details->referral_link_text;

        /*$to = $email;
        $subject = "Wavexpay Invitation";
        $txt = "Hi,".$affiliate_name." You are invited to join in wavexpay following <a href='".$link."'>This Link</a>";
        $headers = "From: info@wavexpay.com" . "\r\n" .
        "CC: subhassahaniflancer@gmail.com";
        mail($to,$subject,$txt,$headers);*/




        /*require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true); 
 
        try {
 
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';            
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';   
            $mail->Password = '**********';       
            $mail->SMTPSecure = 'tls';                  
            $mail->Port = 587;                          
 
            $mail->setFrom('sender@example.com', 'SenderName');
            $mail->addAddress($request->emailRecipient);
            $mail->addCC($request->emailCc);
            $mail->addBCC($request->emailBcc);
 
            $mail->addReplyTo('sender@example.com', 'SenderReplyName');
 
            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }
 
 
            $mail->isHTML(true);                
 
            $mail->Subject = $request->emailSubject;
            $mail->Body    = $request->emailBody;
            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }
 
        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }*/





        return response()->json(array('msg'=>'Invitation Mail Sent Succesfully'));
    }


    public function rewards()
    {
        $merchant_id =  session()->get('merchant');
        $merchant_details = DB::table('merchants')->where('id',$merchant_id)->first();
        $link = $merchant_details->referral_link_text;
        $ids = Helper::getIdArray($link);
        $id_array = [];
        $count = 0;
        if(count($ids)>0)
        {
            foreach($ids as $key=>$val)
            {
                $id_array[$count] = $key;
                $count++;
            }
        }

        $all_merchants = DB::table('merchants')->wherein('id',$id_array)->get();

        //print_r($all_merchants);exit;
        return view('partner.reward',compact('all_merchants','merchant_details'));
    }


}
