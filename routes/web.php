<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SMSModuleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Backend\PermissionController;

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

Route::get('/', function () {
     return view('auth.login');
})->middleware(['auth']);

Auth::routes();
//Social media login
Route::group(['as'=>'login.','prefix'=>'login'],function(){
    Route::get('/{provider}',[LoginController::class,'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback',[LoginController::class,'handleProviderCallback'])->name('provider.callback');
});

//Backend Route

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function(){
    //Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    //resource Routes
    Route::resource('/module', ModuleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/users', UserController::class);
    Route::get('/check/user/is_active', [UserController::class,'checkActive'])->name('user.is_active');

    Route::resource('/backup', BackupController::class)->only(['index','store','destroy']);
    Route::get('/backup/download/{file_name}',[BackupController::class,'download'])->name('backup.download');
    //Profile Controller
    Route::get('/update-profile', [ProfileController::class,'index'])->name('user.profile');
    Route::post('/update-profile', [ProfileController::class,'updateProfile'])->name('user.profile.store');
    Route::get('/update-password', [ProfileController::class,'password'])->name('user.password');
    Route::post('/update-password', [ProfileController::class,'updatePassword'])->name('user.password.reset');
    //system setting
    Route::group(['as'=>'settings.','prefix'=>'settings'],function(){
        Route::get('general',[SettingController::class,'general'])->name('general');
        Route::post('general',[SettingController::class,'generalUpdate'])->name('general.update');
        //social Media
        Route::get('socialMedia',[SettingController::class,'socialMedia'])->name('socialMedia');
        Route::post('socialMedia',[SettingController::class,'socialMediaUpdate'])->name('socialMedia.update');
         //Mail setting
        Route::get('mail',[SettingController::class,'mailView'])->name('mail');
        Route::post('mail',[SettingController::class,'mailUpdate'])->name('mail.update');
         //Social Login setting
        Route::get('socialite',[SettingController::class,'socialiteView'])->name('socialite');
        Route::post('socialite',[SettingController::class,'socialiteUpdate'])->name('socialite.update');
        //sms module controller
        Route::get('smsconfig',[SMSModuleController::class,'sms_index'])->name('sms_index');
        Route::post('sms-module-update/{module}',[SMSModuleController::class,'sms_update'])->name('sms_module_update');

        //payment module controller
        Route::get('payment-method', [SettingController::class,'payment_index'])->name('payment_method');
        Route::post('payment-method-update/{payment_method}',[SettingController::class,'payment_update'])->name('payment_method_update');
    });

});

  /*paypal*/
    /*Route::get('/paypal', function (){return view('paypal-test');})->name('paypal');*/
    Route::post('pay-paypal', [PaypalPaymentController::class,'payWithpaypal'])->name('pay-paypal');
    Route::get('paypal-status', [PaypalPaymentController::class,'getPaymentStatus'])->name('paypal-status');
    Route::get('paypal-fail', [PaypalPaymentController::class,'paymentFail'])->name('payment-fail');
    Route::get('payment-success', [PaypalPaymentController::class,'paymentSuccess'])->name('payment-success');
    /*paypal*/

    //SSLCOMMERZ Start
    Route::post('sslcommerz/pay', [SslCommerzPaymentController::class,'index'])->name('pay-ssl');
    Route::post('sslcommerz/success',[SslCommerzPaymentController::class,'success'])->name('ssl-success');
    Route::post('sslcommerz/failure',[SslCommerzPaymentController::class,'fail'])->name('ssl-failure');
    Route::post('sslcommerz/cancel',[SslCommerzPaymentController::class,'cancel'])->name('ssl-cancel');
    Route::post('sslcommerz/ipn',[SslCommerzPaymentController::class,'ipn'])->name('ssl-ipn');
    //SSLCOMMERZ END
    //stripe payment Route

    // Route::get('pay-stripe', 'StripePaymentController@payment_process_3d')->name('pay-stripe');
    // Route::get('pay-stripe/success', 'StripePaymentController@success')->name('pay-stripe.success');
    // Route::get('pay-stripe/fail', 'StripePaymentController@success')->name('pay-stripe.fail');

    //bkash
    Route::group(['prefix'=>'bkash'], function () {
        // Payment Routes for bKash
        Route::post('get-token', [BkashPaymentController::class,'getToken'])->name('bkash-get-token');
        Route::post('create-payment', [BkashPaymentController::class,'createPayment'])->name('bkash-create-payment');
        Route::post('execute-payment', [BkashPaymentController::class,'executePayment'])->name('bkash-execute-payment');
        Route::get('query-payment', [BkashPaymentController::class,'queryPayment'])->name('bkash-query-payment');
        Route::post('success', [BkashPaymentController::class,'bkashSuccess'])->name('bkash-success');
    });
