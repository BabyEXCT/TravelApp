<?php

// Controllers
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\InvoiceController;
// Packages
use App\Http\Controllers\PackageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Routes are loaded by the RouteServiceProvider within a group
| that contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

// UI Pages Routes
Route::get('/', [HomeController::class, 'uisheet'])->name('uisheet');


// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Permission Module
    Route::get('/role-permission', [RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Users Module
    Route::resource('users', UserController::class);
});



use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
// routes/web.php
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});




Route::get('/', [HomeController::class, 'Homeindex'])->name('home');

// App Details Page => 'Dashboard'
Route::group(['prefix' => 'menu-style'], function() {
    // MenuStyle Page Routes
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

// App Details Page => 'special-pages'
Route::group(['prefix' => 'special-pages'], function() {
    // Example Page Routes
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

// Widget Routes
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

// Maps Routes
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

// Auth Pages Routes
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

// Error Page Routes
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});

// Forms Pages Routes
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});

// Table Pages Routes
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

// Icons Pages Routes
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});

// Extra Pages Routes
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');

Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('Admin.users.create');

// routes/web.php

use App\Http\Controllers\PostingController;

Route::resource('packages', PackageController::class);
// Or if you ar manually defining routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
Route::get('/packages/{id}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/packages/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::patch('/packages/{id}', [PackageController::class, 'update'])->name('packages.update');
Route::delete('/packages/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');





Route::resource('payments', PaymentController::class);
// Or if you are manually defining routes
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::patch('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');


use App\Http\Controllers\UserPackageController;
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/packages', [UserPackageController::class, 'index'])->name('packages.index');
    Route::get('packages/{id}', [UserPackageController::class, 'show'])->name('packages.show');

    // Route to display the payment form
    Route::get('packages/{package}/payment', [UserPackageController::class, 'showPaymentForm'])->name('packages.payment.form');

    // Route to process the payment
    Route::post('packages/{package}/payment', [UserPackageController::class, 'processPayment'])->name('packages.payment.store');

    // Route to show payment success
    Route::get('packages/{package}/payment-success', [UserPackageController::class, 'paymentSuccess'])->name('packages.payment-success');

    Route::get('payments/{id}', [PaymentController::class, 'Invoiceshow'])->name('payments.show');



});

// In routes/web.php


Route::prefix('user')->group(function () {
    Route::get('invoices', [InvoiceController::class, 'index'])->name('user.invoices.index');
    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('user.invoices.show');
});



// web.php

use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\PermissionController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/postings/create', [PostingController::class, 'create'])->name('postings.create');
Route::post('/postings', [PostingController::class, 'store'])->name('postings.store');
Route::get('/postings', [PostingController::class, 'index'])->name('postings.index');
Route::get('/postings/{id}', [PostingController::class, 'show'])->name('postings.show');
Route::get('/postings/{id}/edit', [PostingController::class, 'edit'])->name('postings.edit');
Route::put('/postings/{id}', [PostingController::class, 'update'])->name('postings.update');
Route::delete('/postings/{id}', [PostingController::class, 'destroy'])->name('postings.destroy');


// In routes/web.php
Route::get('refunds', [RefundController::class, 'index'])->name('refunds.index');


