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



Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/my-account', [PageController::class, 'merchantProfile']);
    Route::get('/', [PageController::class, 'blankPage']);

    //transaction payment routes
    Route::get('transactions/payments',  [PaymentController::class, 'index'] );
    Route::post('transactions/searchpayments',  [PaymentController::class, 'searchPayment'])->name('searchpayments');

    //transaction refund routes
    Route::get('transactions/refunds',  [RefundController::class, 'index'] );
    Route::post('transactions/searchrefunds',  [RefundController::class, 'searchrefunds'])->name('searchrefunds');

    //transaction batch routes
    Route::get('transactions/batch',  [BatchController::class, 'index'] );
    Route::post('transactions/searchbatch',  [BatchController::class, 'searchBatch'])->name('searchbatch');


    //transaction order routes
    Route::get('transactions/orders',  [OrderController::class, 'index'] );
    Route::post('transactions/searchorder',  [OrderController::class, 'searchOrder'])->name('searchorder');

    //settlements routes
    Route::get('settlements',  [SettlementController::class, 'index'] );
    Route::post('searchsettlements',  [SettlementController::class, 'searchSettlement'])->name('searchsettlements');


    Route::get('invoices',  [InvoiceController::class, 'index'] );
    Route::get('payment-links',  [PaymentLinkController::class, 'index'] );
    Route::get('payment-pages',  [PaymentPageController::class, 'index'] );
    Route::get('chargeback',  [ChargeBackController::class, 'index'] );
    Route::get('reports',  [ReportController::class, 'index'] );
});

