<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Models\UserType;
use App\Models\Merchant;
use Config;
use DB;
use Razorpay\Api\Api;
use App\Models\MerchantKey;
use App\Models\WavexpayApiKey;

class Helper
{
    public static function applClasses()
    {
        // default data value
        $dataDefault = [
            'mainLayoutType' => 'vertical-modern-menu',
            'pageHeader' => false,
            'bodyCustomClass' => '',
            'navbarLarge' => true,
            'navbarBgColor' => '',
            'isNavbarDark' => null,
            'isNavbarFixed' => true,
            'activeMenuColor' => '',
            'isMenuDark' => null,
            'isMenuCollapsed' => false,
            'activeMenuType' => '',
            'isFooterDark' => null,
            'isFooterFixed' => false,
            'templateTitle' => '',
            'defaultLanguage'=>'en',
            'largeScreenLogo' => 'images/logo/materialize-logo-color.png',
            'smallScreenLogo' => 'images/logo/materialize-logo.png',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($dataDefault, config('custom.custom'));

        // all available option of materialize template
        $allOptions = [
            'mainLayoutType' => array('vertical-modern-menu', 'vertical-menu-nav-dark', 'vertical-gradient-menu', 'vertical-dark-menu', 'horizontal-menu'),
            'pageHeader' => array(true, false),
            'navbarLarge' => array(true, false),
            'isNavbarDark' => array(null, true, false),
            'isNavbarFixed' => array(true, false),
            'isMenuDark' => array(null, true, false),
            'isMenuCollapsed' => array(true, false),
            'activeMenuType' => array('sidenav-active-rounded'=>'sidenav-active-rounded','sidenav-active-square'=>'sidenav-active-square', 'sidenav-active-fullwidth'=>'sidenav-active-fullwidth'),
            'isFooterDark' => array(null, true, false),
            'isFooterFixed' => array(false, true),
            'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
            'direction' => array('ltr', 'rtl'),
        ];

        //if any options value empty or wrong in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (gettype($data[$key]) === gettype($dataDefault[$key])) {
                if (is_string($data[$key])) {
                    $result = array_search($data[$key], $value);
                    if (empty($result)) {
                        $data[$key] = $dataDefault[$key];
                    }
                }
            } else {
                if (is_string($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_bool($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_null($dataDefault[$key])) {
                    is_string($data[$key]) ? $data[$key] = $dataDefault[$key] : '';
                }
            }
        }

        // if any of template logo is not set or empty is set to default logo
        if (empty($data['largeScreenLogo'])) {
            $data['largeScreenLogo'] = $dataDefault['largeScreenLogo'];
        }
        if (empty($data['smallScreenLogo'])) {
            $data['smallScreenLogo'] = $dataDefault['smallScreenLogo'];
        }
        //mainLayoutTypeClass array contain default class of body element

        $mainLayoutTypeClass = [
            'vertical-modern-menu' => 'vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns',
            'vertical-menu-nav-dark' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark 2-columns',
            'vertical-gradient-menu' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu 2-columns',
            'vertical-dark-menu' => 'vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns',
            'horizontal-menu' => 'horizontal-layout page-header-light horizontal-menu 2-columns',
        ];
        //sidenavMain array contain default class of sidenav
        $sidenavMain = [
            'vertical-modern-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible',
            'vertical-menu-nav-dark' => 'sidenav-main nav-expanded nav-lock nav-collapsible navbar-full',
            'vertical-gradient-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible gradient-45deg-deep-purple-blue sidenav-gradient ',
            'vertical-dark-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible',
            'horizontal-menu' => 'sidenav-main nav-expanded nav-lock nav-collapsible sidenav-fixed hide-on-large-only',
        ];
        //sidenavMainColor array contain sidenav menu's color class according to layout types
        $sidenavMainColor = [
            'vertical-modern-menu' => 'sidenav-light',
            'vertical-menu-nav-dark' => 'sidenav-light',
            'vertical-gradient-menu' => 'sidenav-dark',
            'vertical-dark-menu' => 'sidenav-dark',
            'horizontal-menu' => '',
        ];

        //activeMenuTypeClass array contain active menu class of sidenav according to layout types
        $activeMenuTypeClass = [
            'vertical-modern-menu' => 'sidenav-active-square',
            'vertical-menu-nav-dark' => 'sidenav-active-rounded',
            'vertical-gradient-menu' => 'sidenav-active-rounded',
            'vertical-dark-menu' => 'sidenav-active-rounded',
            'horizontal-menu' => '',
        ];

        //navbarMainClass array contain navbar's default classes
        $navbarMainClass = [
            'vertical-modern-menu' => 'navbar-main navbar-color nav-collapsible no-shadow nav-expanded sideNav-lock',
            'vertical-menu-nav-dark' => 'navbar-main navbar-color nav-collapsible sideNav-lock gradient-shadow',
            'vertical-gradient-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
            'vertical-dark-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
            'horizontal-menu' => 'navbar-main navbar-color nav-collapsible sideNav-lock',
        ];
        //navbarMainColor array contain navabar's color classes according to layout types
        $navbarMainColor = [
            'vertical-modern-menu' => 'navbar-dark gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'navbar-dark gradient-45deg-purple-deep-orange',
            'vertical-gradient-menu' => 'navbar-light',
            'vertical-dark-menu' => 'navbar-light',
            'horizontal-menu' => 'navbar-dark gradient-45deg-light-blue-cyan',
        ];

        //navbarLargeColor array contain navbarlarge's default color classes
        $navbarLargeColor = [
            'vertical-modern-menu' => 'gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'blue-grey lighten-5',
            'vertical-gradient-menu' => 'blue-grey lighten-5',
            'vertical-dark-menu' => 'blue-grey lighten-5',
            'horizontal-menu' => 'blue-grey lighten-5',
        ];

        //mainFooterClass array contain Footer's default classes
        $mainFooterClass = [
            'vertical-modern-menu' => 'page-footer footer gradient-shadow',
            'vertical-menu-nav-dark' => 'page-footer footer gradient-shadow',
            'vertical-gradient-menu' => 'page-footer footer',
            'vertical-dark-menu' => 'page-footer footer',
            'horizontal-menu' => 'page-footer footer gradient-shadow',
        ];

        //mainFooterColor array contain footer's color classes
        $mainFooterColor = [
            'vertical-modern-menu' => 'footer-dark gradient-45deg-indigo-purple',
            'vertical-menu-nav-dark' => 'footer-dark gradient-45deg-purple-deep-orange',
            'vertical-gradient-menu' => 'footer-light',
            'vertical-dark-menu' => 'footer-light',
            'horizontal-menu' => 'footer-dark gradient-45deg-light-blue-cyan',
        ];

        //  above arrary override through dynamic data
        $layoutClasses = [
            'mainLayoutType' => $data['mainLayoutType'],
            'mainLayoutTypeClass' => $mainLayoutTypeClass[$data['mainLayoutType']],
            'sidenavMain' => $sidenavMain[$data['mainLayoutType']],
            'navbarMainClass' => $navbarMainClass[$data['mainLayoutType']],
            'navbarMainColor' => $navbarMainColor[$data['mainLayoutType']],
            'pageHeader' => $data['pageHeader'],
            'bodyCustomClass' => $data['bodyCustomClass'],
            'navbarLarge' => $data['navbarLarge'],
            'navbarLargeColor' => $navbarLargeColor[$data['mainLayoutType']],
            'navbarBgColor' => $data['navbarBgColor'],
            'isNavbarDark' => $data['isNavbarDark'],
            'isNavbarFixed' => $data['isNavbarFixed'],
            'activeMenuColor' => $data['activeMenuColor'],
            'isMenuDark' => $data['isMenuDark'],
            'sidenavMainColor' => $sidenavMainColor[$data['mainLayoutType']],
            'isMenuCollapsed' => $data['isMenuCollapsed'],
            'activeMenuType' => $data['activeMenuType'],
            'activeMenuTypeClass' => $activeMenuTypeClass[$data['mainLayoutType']],
            'isFooterDark' => $data['isFooterDark'],
            'isFooterFixed' => $data['isFooterFixed'],
            'templateTitle' => $data['templateTitle'],
            'largeScreenLogo' => $data['largeScreenLogo'],
            'smallScreenLogo' => $data['smallScreenLogo'],
            'defaultLanguage'=>$allOptions['defaultLanguage'][$data['defaultLanguage']],
            'mainFooterClass' => $mainFooterClass[$data['mainLayoutType']],
            'mainFooterColor' => $mainFooterColor[$data['mainLayoutType']],
            'direction' => $data['direction'],
        ];
         // set default language if session hasn't locale value the set default language
         if(!session()->has('locale')){
            app()->setLocale($layoutClasses['defaultLanguage']);
        }
        return $layoutClasses;
    }
    // updatesPageConfig function override all configuration of custom.php file as page requirements.
    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.' . $demo . '.' . $config, $val);
                }
            }
        }
    }

    public static function getUserTypes(){
        $rows = UserType::select('id','name')->where('status', 1)->get();
        $DATA[''] = '--Select--';
        if(!empty($rows)){
            foreach ($rows as $key => $row) {
                $DATA[ $row->id ] = $row->name;
            }
        }
        return $DATA;
    }

    public static function getStatus(){
        return [
            '' => '-- select --',
            '1' => 'Active',
            '0' => 'Inactive'
        ]; 
    }

    public static function get_customer_details($customer_id){
        $customer_details = DB::table('customers')->where('customer_id',$customer_id)->first();
        return $customer_details;
    } 

    public static function get_item_details($item_id){
        $item_details = DB::table('items')->where('item_id',$item_id)->first();
        return $item_details;
    } 

    public static function get_merchant_details($merchant_id){
        //$item_details = DB::table('merchants')->where('id',$merchant_id)->first();
        $data = Merchant::select('merchants.*','merchant_users.*')->join('merchant_users', 'merchant_users.merchant_id', '=', 'merchants.id')->where('merchants.id',$merchant_id)->get();
        $data = $data[0];
        return $data;
    }

    

    public static function get_payment_details_by_merchant($merchant_id){
        $data = DB::table("payments")
	    ->select(DB::raw("SUM(amount) as transactionamount"),DB::raw("COUNT(amount) as total_count"))
	    ->where('merchant_id',$merchant_id)
	    ->get();

        return $data;
    }


    public static function getIdArray($link){
		$child_details = DB::table('merchants')->where('referral_id', $link)->get();  
		$children = array();
	
		if(count($child_details)>0) {
			# It has children, let's get them.
			$i=0;
			foreach($child_details as $details) {
				# Add the child to the list of children, and get its subchildren
				$children[$details->id] = Helper::getIdArray($details->id);
				$i++;
			}
		}
		return $children;
	}

    /**
     * Custom decrypt method
     * */
    public static function _decrypt($data){
        return decrypt($data);
    }
    
    
    /**
     * Custom encrypt method
     * */
    public static function _encrypt($data){
        return encrypt($data);
    }

    /**
     * Switch payment getway
     * $get_key = api_key|api_secret
     * 
     * $razorpay_api_key = 'rzp_test_YRAqXZOYgy9uyf'; 
     $razorpay_api_secret = 'uSaaMQw3jHK0MPtOnXCSSg51';

     * */
    public static function weveXpay($get_key){

        $api_key = session('merchant_key');
        $api_secret = session('merchant_secret');
       

        $merchant = MerchantKey::select('merchants.wavexpay_api_key_id')
        ->join('merchants', 'merchants.id', '=', 'merchant_keys.merchnat_id')
        ->where([
                'merchant_keys.api_key'=> $api_key,
                'merchant_keys.api_secret' => $api_secret
            ])->first();
        
        

        if($merchant){
            $wavexpay_api_key_id = $merchant->wavexpay_api_key_id;
            $api_mode = session('mode'); # live | test
            
            $row = WavexpayApiKey::find($wavexpay_api_key_id);

            if(!empty($row)){
                $API_KEY = '';
                $API_SECRET = '';
                if($api_mode == 'test'){
                    
                    $API_KEY = $row->test_api_key;
                    $API_SECRET = $row->test_api_secret;

                }else if($api_mode == 'live'){                
                    
                    $API_KEY = $row->live_api_key;
                    $API_SECRET = $row->live_api_secret;

                }else{

                    die('Invalid api mode only can use test or live');
                }

                if($get_key == 'api_key'){
                    return $API_KEY;

                }else if($get_key == 'api_secret'){
                    return $API_SECRET;
                }else{
                    die('Error: invalid key type $get_key accept only - api_key|api_secret ');; 
                }
            }else{
                die('Invalid API mode or getway');
            }

        }else{
            die("Invalid api key or api secret");
        }
    } // end function of wavexpay

    /**
     * return Helper::api_key();
        return Helper::api_secret();
     * */
    public static function api_key(){
        return Helper::weveXpay('api_key');
    }
    public static function api_secret(){
        return Helper::weveXpay('api_secret');
    }

    /**
     * use paramters to Call Function 
     * 'authorized', 'wait', 'coming soon' 
     * 'failed', 'error', 'pending'
     * 'captured', 'success', 'completed'
     * 
     * <span class="badge badge-primary">Primary</span>
        <span class="badge badge-secondary">Secondary</span>
        <span class="badge badge-success">Success</span>
        <span class="badge badge-danger">Danger</span>
        <span class="badge badge-warning">Warning</span>
        <span class="badge badge-info">Info</span>
        <span class="badge badge-light">Light</span>
        <span class="badge badge-dark">Dark</span>

     * */
    public static function badge($string){
        $class = 'dark';
        if(in_array($string, ['authorized', 'wait', 'coming soon', 'created','partially_paid','issued'])){
             $class = 'warning';
        }
        if(in_array($string, ['draft'])){
            $class = 'info';
        }
        if(in_array($string, ['failed', 'error', 'pending','expired','cancelled','deleted'])){
             $class = 'danger';
        }
        if(in_array($string, ['captured', 'success', 'completed', 'paid','processed'])){
            $class = 'success';
        }

          return "<span class='badge badge-".$class."'>$string</span>";
    }



}
