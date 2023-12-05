<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SettingController;
//use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function (){

    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('contact',ContactController::class);
    Route::resource('support',SupportController::class);
    Route::resource('note',NoteController::class);

    // Reply Route
    Route::get('reply/{id}',[SupportController::class,'reply'])->name('reply');
    Route::post('store/{id}',[SupportController::class,'reply_store'])->name('reply_store');

    // Account Setting Route
    Route::get('account_index',[SettingController::class, 'index'])->name('account_index');
    Route::put('account_update/{id}',[SettingController::class, 'account_update'])->name('account_update');

    // Password Setting Route
    Route::get('password_setting',[SettingController::class,'password_setting'])->name('password_index');
    Route::post('change_password',[SettingController::class,'change_password'])->name('change_password');

    // General Setting Route
    Route::get('general_setting',[SettingController::class,'general_setting'])->name('general_index');
    Route::post('general_store',[SettingController::class,'general_store'])->name('general_store');


    // Company Setting Route
    Route::get('company_setting',[SettingController::class,'company_setting'])->name('company_index');
    Route::post('company_store',[SettingController::class,'company_store'])->name('company_store');

    // Email Setting Route
    Route::get('email_setting',[SettingController::class,'email_setting'])->name('email_index');
    Route::post('email_store',[SettingController::class,'email_store'])->name('email_store');

    // Plan Modules
    Route::resource('plan',PlanController::class);


    // Payment Route
    Route::get('razorpay-payment/page/{id}', [RazorpayController::class, 'index'])->name('razorpay.payment.index');
    Route::post('razorpay-payment/{id}', [RazorpayController::class, 'store'])->name('razorpay.payment.store');

//    // Plan Send Request
//    Route::get('send_request/{id}',[PlanController::class,'send_request'])->name('send_request');

    //Payment Setting
    Route::get('payment_setting',[SettingController::class,'payment_setting'])->name('payment_setting');
    Route::post('payment_store',[SettingController::class,'payment_store'])->name('payment_store');

 // coupon
    Route::resource('coupon',CouponController::class);
    Route::post('coupon_apply',[CouponController::class,'coupon_apply'])->name('coupon_apply');

    // language
    Route::resource('language',LanguageController::class);
    Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data');
    Route::get('language-data/{code}', [LanguageController::class, 'LanguageData'])->name('language.data');
    Route::get('change-langauge/{lang}',[LanguageController::class,'changeLanguage'])->name('change_language');



});
