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
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DisputeController;



Auth::routes(['verify' => true]);


Route::group(['middleware' => ['token.check']], function() {
    Route::resource('customer', CustomerController::class);
    Route::get('/my-account', [PageController::class, 'merchantProfile']);
    Route::get('/', [PageController::class, 'blankPage']);

    //transaction payment routes
    Route::get('transactions/payments',  [PaymentController::class, 'index'] );
    Route::post('searchpayment',  [PaymentController::class, 'searchPayment'])->name('searchpayment');

    //transaction refund routes
    Route::get('transactions/refunds',  [RefundController::class, 'index'] );
    Route::post('searchrefund',  [RefundController::class, 'searchRefund'])->name('searchrefund');

    //transaction batch routes
    Route::get('transactions/batch',  [BatchController::class, 'index'] );
    Route::post('transactions/searchbatch',  [BatchController::class, 'searchBatch'])->name('searchbatch');


    //transaction order routes
    Route::get('transactions/orders',  [OrderController::class, 'index'] );
    Route::post('searchorder',  [OrderController::class, 'searchOrder'])->name('searchorder');

    //transaction dispute routes
    Route::get('transactions/disputes',  [DisputeController::class, 'index'] );
    Route::post('searchdispute',  [DisputeController::class, 'searchDispute'])->name('searchdispute');

    //settlements routes
    Route::get('settlements',  [SettlementController::class, 'index'] );
    Route::post('searchsettlement',  [SettlementController::class, 'searchSettlement'])->name('searchsettlement');

    //invoice routes
    Route::get('invoices',  [InvoiceController::class, 'index'] );
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
    Route::get('items',  [ItemController::class, 'index'] );
    Route::post('deleteitem',  [ItemController::class, 'deleteItem'])->name('deleteitem');

    //Payment Link routes
    Route::get('payment-links',  [PaymentLinkController::class, 'index'] );
    Route::post('searchpaymentlink',  [PaymentLinkController::class, 'searchPaymentLink'])->name('searchpaymentlink');
    Route::post('createpaymentlink',  [PaymentLinkController::class, 'createPaymentLink'])->name('createpaymentlink');
    Route::post('getpaymentlink',  [PaymentLinkController::class, 'getPaymentLink'])->name('getpaymentlink');
    Route::post('changerefidprocess',  [PaymentLinkController::class, 'changeRefIdProcess'])->name('changerefidprocess');
    Route::post('changenoteprocess',  [PaymentLinkController::class, 'changeNoteProcess'])->name('changenoteprocess');
    Route::post('changepaystatus',  [PaymentLinkController::class, 'changePayStatus'])->name('changepaystatus');
    Route::post('changeexpdate',  [PaymentLinkController::class, 'changeExpDate'])->name('changeexpdate');
    Route::post('deletenote',  [PaymentLinkController::class, 'deleteNote'])->name('deletenote');

    
    //Payment Pages routes
    Route::get('payment-pages',  [PaymentPageController::class, 'index'] );
    Route::post('get-payment-templates',  [PaymentPageController::class, 'getPaymentTemplates'] );
    Route::get('payment-template/{id}',  [PaymentPageController::class, 'showPaymentTemplates'] );
    Route::post('savepaymentpage',  [PaymentPageController::class, 'savePaymentPage'] );



    Route::get('chargeback',  [ChargeBackController::class, 'index'] );
    Route::get('reports',  [ReportController::class, 'index'] );
});

