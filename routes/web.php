<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Page Route
Route::middleware(['auth'])->group(function () {
Route::get('/', [PageController::class, 'blankPage']);



Route::get('/page-blank', [PageController::class, 'blankPage']);
Route::get('/page-collapse', [PageController::class, 'collapsePage']);

Route::get('/page-blank', [PageController::class, 'blankPage']);
Route::get('/page-collapse', [PageController::class, 'collapsePage']);
Route::get('/merchant-profile', [PageController::class, 'merchantProfile']);

    Route::get('/', [PageController::class, 'blankPage']);
    Route::get('/page-blank', [PageController::class, 'blankPage']);
    Route::get('/page-collapse', [PageController::class, 'collapsePage']);

// locale route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
});
Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth']], function() {
    /**
     * Role 
     * GET: roles, roles/create, roles/{id}/edit
     * */
    Route::resource('roles', RoleController::class);
    /*Route::group(['prefix'=>'/roles'], function() {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/create', [RoleController::class, 'create']);
        Route::post('/add', [RoleController::class, 'add']);
        Route::get('/edit/{id}', [RoleController::class, 'edit']);
        Route::post('/update/{id}', [RoleController::class, 'update']);
    });*/

    /**
     * Users
     * 
     * */
    Route::resource('users', UserController::class);
    Route::get('users/list',  [UserController::class, 'index'] );
    /* Route::group(['prefix'=>'/users'], function() {
        Route::get('/index', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/add', [UserController::class, 'add']);
        Route::get('/edit/{id}', [UserController::class, 'edit']);
        Route::post('/update/{id}', [UserController::class, 'update']);
    }); */


    /**
     * testing 
     * */
    // User Route
        Route::get('/page-users-list', [UserController::class, 'usersList']);
        Route::get('/page-users-view', [UserController::class, 'usersView']);
        Route::get('/page-users-edit', [UserController::class, 'usersEdit']);

     /**
      * Invoice 
      * */   
         
    Route::get('/invoices/list', [PageController::class, 'invoiceList']);
    Route::get('/invoices/view/{id}', [PageController::class, 'invoiceView']);
    Route::get('/invoices/edit/{id}', [PageController::class, 'invoiceEdit']);
    Route::get('/invoices/add', [PageController::class, 'invoiceAdd']);

});

