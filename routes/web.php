<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\tokerVerificationMiddleware;

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
// Page Routes
// ----auth
Route::get('/userLogin',[userController::class,'LoginPage']);
Route::get('/userRegistration',[userController::class,'RegistrationPage']);
Route::get('/sendOtp',[userController::class,'SendOtpPage']);
Route::get('/verifyOtp',[userController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[userController::class,'ResetPasswordPage'])->middleware([tokerVerificationMiddleware::class]);
Route::get('/logout',[userController::class,'userLogout']);

// -----dashboard
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([tokerVerificationMiddleware::class]);
Route::get('/profile',[DashboardController::class,'profilePage'])->middleware([tokerVerificationMiddleware::class]);


Route::get('/customer',[CustomerController::class,'CustomerPage'])->middleware([tokerVerificationMiddleware::class]);


// email campaign 
Route::get('Campaign-form', [CustomerController::class, 'emailCampaignForm'])->name('emailCampaignForm');
// Route::post('send-email', [CustomerController::class, 'sendPromotionalEmails']);
Route::post('/send-email', [CustomerController::class, 'sendPromotionalEmails'])->name('send-email');
// Route::post('send-email-campaigns', [CustomerController::class, 'sendEmailCampaign'])->name('email_campaigns.store');

// Route::get('/demo', [CustomerController::class, 'allEmail']);

// API Routes
// -------- auth
Route::post('/user_registration',[userController::class,'userRegistration']);
Route::post('/user_login',[userController::class,'userLogin']);
Route::post('/send_otp',[userController::class,'sendOTP']);
Route::post('/verify_otp',[userController::class,'verifyOTP']);
Route::post('/reset_password',[userController::class,'resetPass'])->middleware([tokerVerificationMiddleware::class]);



// ----------dashboard
Route::get('/get_profile',[DashboardController::class,'userProfile'])->middleware([tokerVerificationMiddleware::class]);
Route::post('/profile_update',[DashboardController::class,'updateProfile'])->middleware([tokerVerificationMiddleware::class]);




// Customer API
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([tokerVerificationMiddleware::class]);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([tokerVerificationMiddleware::class]);
Route::post("/delete-customer",[CustomerController::class,'CustomerDelete'])->middleware([tokerVerificationMiddleware::class]);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware([tokerVerificationMiddleware::class]);
Route::post("/customer-by-id",[CustomerController::class,'customerByID'])->middleware([tokerVerificationMiddleware::class]);





// Dashboard API

Route::get("/total-customer",[DashboardController::class,'TotalCustomer'])->middleware([tokerVerificationMiddleware::class]);