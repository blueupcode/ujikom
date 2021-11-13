<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ReportController::class, 'viewReport'])
    ->middleware('auth')
    ->middleware('can:role,"admin","kasir","owner"')
    ->name('report');

Route::get('/login', [UserController::class, 'viewLogin'])
    ->middleware('guest')
    ->name('login');

Route::prefix('create-outlet')
    ->middleware('guest')
    ->group(function() {
        Route::get('/', [OutletController::class, 'viewCreate'])
            ->name('createOutlet');

        Route::post('/', [OutletController::class, 'handleCreate'])
            ->name('handleCreateOutlet');
    });
    
Route::prefix('report')
    ->middleware('auth')
    ->middleware('can:role,"admin","kasir","owner"')
    ->group(function() {
        Route::get('/transaction/{start}/{end}', [ReportController::class, 'printReportTransaction'])
            ->name('printReportTransaction');

        Route::get('/member/{start}/{end}', [ReportController::class, 'printReportMember'])
            ->name('printReportMember');
    });
    
Route::prefix('user')
    ->group(function () {
        Route::middleware('auth')
            ->middleware('can:role,"admin"')
            ->group(function() {
                Route::post('/create', [UserController::class, 'handleCreate'])
                    ->middleware('auth')
                    ->name('handleCreateUser');
        
                Route::post('/update/{user}', [UserController::class, 'handleUpdate'])
                    ->middleware('auth')
                    ->name('handleUpdateUser');
        
                Route::get('/delete/{user}', [UserController::class, 'handleDelete'])
                    ->middleware('auth')
                    ->name('handleDeleteUser');
            });

        Route::post('/login', [UserController::class, 'handleLogin'])
            ->middleware('guest')
            ->name('handleLogin');

        Route::get('/logout', [UserController::class, 'handleLogout'])
            ->middleware('auth')
            ->name('handleLogout');
    });

Route::prefix('member')
    ->middleware('auth')
    ->middleware('can:role,"admin","kasir"')
    ->group(function () {
        Route::post('/create', [MemberController::class, 'handleCreate'])
            ->name('handleCreateMember');
    });

Route::prefix('transaction')
    ->middleware('auth')
    ->middleware('can:role,"admin","kasir","owner"')
    ->group(function () {
        Route::get('/', [TransactionController::class, 'viewTransaction'])
            ->name('transaction');
        
        Route::get('/detail/{invoiceCode}', [TransactionController::class, 'viewTransactionDetail'])
            ->name('transactionDetail');

        Route::get('/create/{member}', [TransactionController::class, 'handleCreate'])
            ->name('handleCreateTransaction');
       
        Route::post('/edit-invoice/{transaction}', [TransactionController::class, 'handleUpdateInvoice'])
            ->name('handleUpdateInvoiceTransaction');

        Route::get('/payment/{transaction}', [TransactionController::class, 'handlePayment'])
            ->name('handlePaymentTransaction');

        Route::get('/process/{transaction}', [TransactionController::class, 'handleProcess'])
            ->name('handleProcessTransaction');

        Route::get('/delete/{transaction}', [TransactionController::class, 'handleDelete'])
            ->name('handleDeleteTransaction');
    });

Route::prefix('transaction-detail')
    ->middleware('auth')
    ->middleware('can:role,"admin","kasir"')
    ->group(function () {
        Route::post('/create/{transaction}', [TransactionDetailController::class, 'handleCreate'])
            ->name('handleCreateTransactionDetail');

        Route::post('/update/{transactionDetail}', [TransactionDetailController::class, 'handleUpdate'])
            ->name('handleUpdateTransactionDetail');

        Route::get('/delete/{transactionDetail}', [TransactionDetailController::class, 'handleDelete'])
            ->name('handleDeleteTransactionDetail');
    });


Route::prefix('outlet')
    ->middleware('auth')
    ->middleware('can:role,"admin"')
    ->group(function () {
        Route::get('/', [OutletController::class, 'viewOutlet'])
            ->name('outlet');

        Route::post('/edit', [OutletController::class, 'handleUpdate'])
            ->name('handleUpdateOutlet');
    });

Route::prefix('package')
    ->middleware('auth')
    ->middleware('can:role,"admin"')
    ->group(function () {
        Route::post('/create', [PackageController::class, 'handleCreate'])
            ->name('handleCreatePackage');

        Route::post('/update/{package}', [PackageController::class, 'handleUpdate'])
            ->name('handleUpdatePackage');

        Route::get('/delete/{package}', [PackageController::class, 'handleDelete'])
            ->name('handleDeletePackage');
    });
