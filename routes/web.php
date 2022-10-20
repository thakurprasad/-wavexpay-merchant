<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentLinkController;
use App\Http\Controllers\PaymentPageController;
use App\Http\Controllers\ChargeBackController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DisputeController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AffiliateController;


Route::get('testing', function(){ return view('pages.testing');}  );
Auth::routes(['verify' => true]);

Route::get('change-password', [ChangePasswordController::class, 'index']);
Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');

Route::get('complete-sign-up', [PageController::class, 'completeSignUp']);
Route::post('completesignupprocess', [PageController::class, 'completeSignUpProcess'])->name('completesignupprocess');
Route::get('welcome_to_wavexpay', [PageController::class, 'welcomeToWavexpay'])->name('welcome_to_wavexpay');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::post('sign-up-merchant-step-one',  [RegisterController::class, 'SignUpMerchantStepOne'])->name('sign-up-merchant-step-one');



Route::post('sign-up-merchant-step-two',  [RegisterController::class, 'SignUpMerchantStepTwo'])->name('sign-up-merchant-step-two');

Route::get('register-as-partner', [RegisterController::class, 'RegisterAsPartner'])->name('register-as-partner');



Route::get('partner-dashboard',  [PageController::class, 'partnerDashboard']);
Route::get('affiliate-accounts',  [AffiliateController::class, 'affiliateAccounts']);

Route::post('create-referral-link',  [AffiliateController::class, 'createReferralLink'])->name('create-referral-link');



Route::group(['middleware' => ['token.check']], function() {
    Route::resource('customer', CustomerController::class);
    Route::get('/my-account', [PageController::class, 'merchantProfile']);
    Route::get('/home', [PageController::class, 'dashboard'])->name('home');
    Route::get('/', [PageController::class, 'dashboard']);
    Route::post('merchant_details_update/{id}',  [PageController::class, 'merchantDetailsUpdate']);
    Route::post('merchant_general_update/{id}',  [PageController::class, 'merchantGeneralUpdate']);

    Route::get('/pages.merchant.com/{url}', [PaymentPageController::class, 'paymentPageFront'])->name('pages.merchant.com/{url}');

    //transaction payment routes
    Route::get('transactions/payments',  [PaymentController::class, 'index'] )->name('transactions/payments');
    Route::post('searchpayment',  [PaymentController::class, 'searchPayment'])->name('searchpayment');
    Route::get('transactions/payments/status',  [PaymentController::class, 'statusWisePayment'] );

    //transaction refund routes
    Route::get('transactions/refunds',  [RefundController::class, 'index'] )->name('transactions/refunds');
    Route::post('searchrefund',  [RefundController::class, 'searchRefund'])->name('searchrefund');

    //transaction batch routes
    Route::get('transactions/batch',  [BatchController::class, 'index'] )->name('transactions/batch');
    Route::post('transactions/searchbatch',  [BatchController::class, 'searchBatch'])->name('searchbatch');


    //transaction order routes
    Route::get('transactions/orders',  [OrderController::class, 'index'] )->name('transactions/orders');
    Route::post('searchorder',  [OrderController::class, 'searchOrder'])->name('searchorder');

    //transaction dispute routes
    Route::get('transactions/disputes',  [DisputeController::class, 'index'] )->name('transactions/disputes');
    Route::post('searchdispute',  [DisputeController::class, 'searchDispute'])->name('searchdispute');

    //settlements routes
    Route::get('settlements',  [SettlementController::class, 'index'] )->name('settlements');
    Route::post('searchsettlement',  [SettlementController::class, 'searchSettlement'])->name('searchsettlement');

    //invoice routes
    Route::get('invoices',  [InvoiceController::class, 'index'] )->name('invoices');
    Route::get('invoice/{id}',  [InvoiceController::class, 'showInvoice'] );
    Route::get('newinvoice',  [InvoiceController::class, 'newInvoice']);
    Route::post('searchinvoice',  [InvoiceController::class, 'searchInvoice'])->name('searchinvoice');
    Route::post('createitem',  [InvoiceController::class, 'createItem'])->name('createitem');
    Route::post('getitem',  [InvoiceController::class, 'getItem'])->name('getitem');
    Route::post('addnewitemrow',  [InvoiceController::class, 'addNewItemRow'])->name('addnewitemrow');
    Route::post('createinvoice',  [InvoiceController::class, 'createInvoice'])->name('createinvoice');
    Route::post('editinvoice',  [InvoiceController::class, 'editInvoice'])->name('editinvoice');

    //Settings routes
    Route::get('settings',  [SettingsController::class, 'index'] );

    //Items routes
    Route::get('items',  [ItemController::class, 'index'] )->name('items');
    Route::post('deleteitem',  [ItemController::class, 'deleteItem'])->name('deleteitem');

    //Payment Link routes
    Route::get('payment-links',  [PaymentLinkController::class, 'index'] )->name('payment-links');
    Route::post('searchpaymentlink',  [PaymentLinkController::class, 'searchPaymentLink'])->name('searchpaymentlink');
    Route::post('createpaymentlink',  [PaymentLinkController::class, 'createPaymentLink'])->name('createpaymentlink');
    Route::post('getpaymentlink',  [PaymentLinkController::class, 'getPaymentLink'])->name('getpaymentlink');
    Route::post('changerefidprocess',  [PaymentLinkController::class, 'changeRefIdProcess'])->name('changerefidprocess');
    Route::post('changenoteprocess',  [PaymentLinkController::class, 'changeNoteProcess'])->name('changenoteprocess');
    Route::post('changepaystatus',  [PaymentLinkController::class, 'changePayStatus'])->name('changepaystatus');
    Route::post('changeexpdate',  [PaymentLinkController::class, 'changeExpDate'])->name('changeexpdate');
    Route::post('deletenote',  [PaymentLinkController::class, 'deleteNote'])->name('deletenote');


    Route::get('create-payment-links',  [PaymentLinkController::class, 'openPaymentLink'] );
    Route::get('create-standard-payment-links',  [PaymentLinkController::class, 'openStandardPaymentLink'] );
    Route::get('/i/pl/{link}', [PaymentLinkController::class, 'openPaymentLinkPage']);


    Route::get('general-settings',  [GeneralSettingController::class, 'index'] )->name('general-settings');
    Route::get('general-settings/{id}',  [GeneralSettingController::class, 'getGeneralSetting'] );
    Route::post('updategeneralsetting/{id}',  [GeneralSettingController::class, 'updateGeneralSetting']);

    //Payment Pages routes
    Route::get('payment-pages',  [PaymentPageController::class, 'index'] )->name('payment-pages');
    Route::post('get-payment-templates',  [PaymentPageController::class, 'getPaymentTemplates'] );
    Route::get('payment-template/{id}',  [PaymentPageController::class, 'showPaymentTemplates'] );
    Route::post('savepaymentpage',  [PaymentPageController::class, 'savePaymentPage'] );
    Route::post('get-payment-page-details',  [PaymentPageController::class, 'getPaymentPageDetails'] );


    Route::get('create-payment-pages',  [PaymentPageController::class, 'openPaymentTemplateType'] );
    Route::get('payment-page/{id}',  [PaymentPageController::class, 'showPaymentPageTemplates'] );



    Route::get('chargeback',  [ChargeBackController::class, 'index'] );
    Route::get('reports',  [ReportController::class, 'index'] );


    Route::post('getsuccesstransactiongraphdata',[PageController::class, 'getSuccessTransactionGraphData'] );
    Route::post('getsuccessrategraphdata',[PageController::class, 'getSuccessRateGraphData'] );

    Route::post('changedisplayname',  [UserController::class, 'changeDisplayName'])->name('changedisplayname');
    Route::post('changecontactnumber',  [UserController::class, 'changeContactNumber'])->name('changecontactnumber');

    Route::post('changethemecolor',  [UserController::class, 'changeThemeColor'])->name('changethemecolor');
    Route::post('changethemelogo',  [UserController::class, 'changeThemeLogo'])->name('changethemelogo');
    Route::post('changethemelanguage',  [UserController::class, 'changeThemeLanguage'])->name('changethemelanguage');

    Route::post('send-invite',  [AffiliateController::class, 'sendInvite'])->name('send-invite');

    Route::get('rewards',  [AffiliateController::class, 'rewards'] );

    Route::get('paylink-checkout',  [PaymentLinkController::class, 'paylinkCheckout'] );



    Route::post('/orderid-generate', [App\Http\Controllers\RazorpayPaymentController::class, 'orderIdGenerate']);
    Route::post('/razorpaypayment', [App\Http\Controllers\RazorpayPaymentController::class, 'storePayment']);


    Route::post('cashfreeorder', [App\Http\Controllers\CashfreeOrderController::class, 'create']);
    Route::post('cashfreepayments/thankyou', [App\Http\Controllers\CashfreePaymentController::class, 'success']);
});

