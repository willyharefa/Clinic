<?php

use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Pharmacist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [HomepageController::class, 'index']); //Halaman Depan Website
// Route::view('/dashboard/testing', 'layouts.dashboard_patient');

Route::middleware('guest:patient,web,doctor,pharmacist')->group(function () {
    Route::get('/login', [HomepageController::class, 'login'])->name('login');
    Route::get('/registration', [HomepageController::class, 'register'])->name('register');
    Route::post('/registration/patient', [RegisterController::class, 'create'])->name('registration_patient');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/authenticate/user', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'dashboardAdmin'])->name('dashboard_admin');
    Route::get('/dashboard/admin/list/patient', [AdminController::class, 'addUser'])->name('list_user');
    Route::post('/dashboard/admin/insert/patient', [AdminController::class, 'insertPatient'])->name('insert_patient');
    Route::get('/dashboard/admin/payment/list', [AdminController::class, 'paymentList'])->name('payment_list');
    Route::post('/dashboard/admin/update/patient/{id}', [AdminController::class, 'updatePatient'])->name('update_patient');
    Route::post('/dashboard/admin/update/doctor/{id}', [AdminController::class, 'updateDoctor'])->name('update_doctor');
    Route::post('/dashboard/admin/update/pharmacist/{id}', [AdminController::class, 'updatePharmacist'])->name('update_pharmacist');
    Route::get('/dashboard/admin/delete/patient/{id}', [AdminController::class, 'deletePatient']);
    Route::get('/dashboard/admin/delete/doctor/{id}', [AdminController::class, 'deleteDoctor']);
    Route::get('/dashboard/admin/delete/pharmacist/{id}', [AdminController::class, 'deletePharmacist']);
    Route::get('/dashboard/admin/payment/{id}', [AdminController::class, 'payment'])->name('payment');
    Route::post('/payment/checkup/{id}', [AdminController::class, 'insertPayment'])->name('insertPayment');
    Route::get('/download/invoice/payment/{id}', [AdminController::class, 'download'])->name('download_invoice');
    Route::post('/dashboard/admin/call/patient/{id}', [AdminController::class, 'call'])->name('call');
    Route::get('/dashboard/admin/trash', [AdminController::class, 'trash'])->name('trash');
    Route::get('/dashboard/admin/cancel/book/{id}', [AdminController::class, 'cancelBook']);
    Route::get('/dashboard/admin/trash/restore/{id}', [AdminController::class, 'trashRestore']);
    Route::get('/dashboard/admin/force/delete/{id}', [AdminController::class, 'deletePermanent']);
});

Route::middleware('auth:doctor')->group(function () {
    Route::get('/dashboard/doctor', [DashboardController::class, 'dashboardDoctor'])->name('dashboard_doctor');
    Route::get('/dashboard/doctor/schedule', [DoctorController::class, 'schedule'])->name('schedule');
    Route::post('/dashboard/doctor/schedule/create/{id}', [ScheduleController::class, 'insert'])->name('create_schedule');
    Route::post('/dashboard/doctor/schedule/update/{id}', [ScheduleController::class, 'update'])->name('update_schedule');
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'delete']);
    Route::get('/dashboard/doctor/patient/in', [DoctorController::class, 'patientIn'])->name('patient_in');
    Route::get('/dashboard/doctor/patient/checkup/{id}', [DoctorController::class, 'checkups'])->name('checkup');
    Route::post('/dashboard/checkup/{appointment_id}/{patient_id}/{doctor_id}', [DoctorController::class, 'checkupResult'])->name('checkup_result');
    Route::post('/dashboard/checkup/labs', [DoctorController::class, 'resultLab'])->name('result_lab');
    Route::post('/dashboard/checkup/prescription/{checkupId}', [DoctorController::class, 'prescription'])->name('prescription');
    Route::get('/medicine/unit/{id}', [DoctorController::class, 'unitID']);
    Route::get('/dashboard/checkup/history', [DoctorController::class, 'checkupHistory'])->name('checkup_history');
    Route::get('/dashboard/download/file/{id}', [DoctorController::class, 'download'])->name('download_file_checkups'); 
    Route::get('/download/file/recipe/{id}', [DoctorController::class, 'downloadRecipe'])->name('download_recipe_doctor');
    Route::get('/dashboard/doctor/recipe/pullback/{id}', [DoctorController::class, 'pullback']);
    Route::get('/dashboard/profile/doctor', [DoctorController::class, 'profileDoctor'])->name('profile_doctor');
});

Route::middleware('auth:pharmacist')->group(function () {
    Route::get('/dashboard/pharmacist', [DashboardController::class, 'dashboardPharmacist'])->name('dashboard_pharmacist');
    Route::get('/dashboard/pharmacist/medicine/add', [PharmacistController::class, 'entryData'])->name('entry_data');
    Route::post('/dashboard/medicine/insert', [PharmacistController::class, 'insert'])->name('insert_data');
    Route::get('/dashboard/pharmacist/reports/stock/in', [PharmacistController::class, 'stockIn'])->name('report_stock_in');
    Route::get('/dashboard/pharmacist/reports/stock/out', [PharmacistController::class, 'stockOut'])->name('report_stock_out');
    Route::get('/dashboard/pharmacist/input/stock', [PharmacistController::class, 'inputStock'])->name('input_stock');
    Route::post('/dashboard/insert/stock', [PharmacistController::class, 'insertStock'])->name('insert_stock');
    Route::post('/expired/update/stok/{id}', [PharmacistController::class, 'updateExpired'])->name('update_expired');
    Route::post('/stock/less/update/{id}', [PharmacistController::class, 'updateStockLess'])->name('update_stock_less');
    Route::get('/stock/expired/pull/{id}', [PharmacistController::class, 'stockPullTrash']);
    Route::post('/update/stock/{id}', [PharmacistController::class, 'updateStock'])->name('update_stock');
    Route::get('/stock/delete/{id}', [PharmacistController::class, 'deleteStock'])->name('delete_stock');
    Route::get('/download/stock/in', [PharmacistController::class, 'downloadStockIn'])->name('download_stock_in');
    Route::post('/download/stock/out', [PharmacistController::class, 'downloadStockOut'])->name('download_stock_out');
});

Route::middleware('auth:patient')->group(function () {
    Route::get('/dashboard/patient', [DashboardController::class, 'dashboardPatient'])->name('dashboard_patient');
    Route::get('/dashbaord/patient/print/no/order/{id}', [PasienController::class, 'printNoOrder']);
    Route::get('/dashboard/patient/history/medical', [PasienController::class, 'historyMedical'])->name('history_medical');
    Route::get('/dashboard/patient/history/prescription/{id}', [PasienController::class, 'historyPrescription'])->name('history_prescription');
    Route::get('/dashboard/patient/profile', [PasienController::class, 'profilePatient'])->name('profile_patient');
    Route::post('/dashboard/patient/update/{id}', [PasienController::class, 'updateProfile'])->name('update_profile_patient');
    Route::get('/dashboard/patient/schedule/doctor', [PasienController::class, 'scheduleDoctor'])->name('schedule_doctor');
    Route::post('/dashboard/patient/schedule/appointment', [PasienController::class, 'appointment'])->name('appointment');
});