<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCateoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\mesinCuciController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BackupController;



use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:admin'])->group(function(){
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::resource('permission',PermissionController::class);
        Route::resource('category',CategoryController::class);
        Route::resource('subcategory',SubCateoryController::class);
        Route::resource('collection',CollectionController::class);
        Route::resource('product',ProductController::class);
        Route::resource('customer',CustomerController::class);
        Route::resource('services',ServicesController::class);
        Route::get('/transaction/{transaction}/print', [TransactionController::class, 'print'])->name('transaction.print');
        Route::resource('transaction',TransactionController::class);
        Route::resource('item',ItemController::class);
        Route::resource('mesincuci',MesinCuciController::class);
        Route::resource('company', \App\Http\Controllers\CompanyController::class);
        Route::get('/get/subcategory',[ProductController::class,'getsubcategory'])->name('getsubcategory');
        Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
        Route::get('/search/customers',[TransactionController::class,'searchCustomers'])->name('search.customers');
        
        // Report Routes
        Route::get('/report',[ReportController::class,'index'])->name('report.index');
        Route::get('/report/export-pdf',[ReportController::class,'exportPDF'])->name('report.exportPDF');
        Route::get('/report/export-excel',[ReportController::class,'exportExcel'])->name('report.exportExcel');

        // Backup Routes
        Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/backup', [BackupController::class, 'store'])->name('backup.store');
        Route::post('/backup/import', [BackupController::class, 'import'])->name('backup.import');
        Route::post('/backup/reset', [BackupController::class, 'resetDatabase'])->name('backup.reset');
        Route::get('/backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('/backup/{filename}', [BackupController::class, 'destroy'])->name('backup.destroy');
    });
});


Route::prefix('kasir')->name('kasir.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:kasir'])->group(function(){
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::resource('permission',PermissionController::class);
        Route::resource('category',CategoryController::class);
        Route::resource('subcategory',SubCateoryController::class);
        Route::resource('collection',CollectionController::class);
        Route::resource('product',ProductController::class);
        Route::resource('customer',CustomerController::class);
        Route::resource('services',ServicesController::class);
        Route::resource('transaction',TransactionController::class);
        Route::resource('item',ItemController::class);
        Route::resource('mesincuci',MesinCuciController::class);
        Route::get('/get/subcategory',[ProductController::class,'getsubcategory'])->name('getsubcategory');
        Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
        Route::get('/search/customers',[TransactionController::class,'searchCustomers'])->name('search.customers');
        
        // Report Routes
        Route::get('/report',[ReportController::class,'index'])->name('report.index');
        Route::get('/report/export-pdf',[ReportController::class,'exportPDF'])->name('report.exportPDF');
        Route::get('/report/export-excel',[ReportController::class,'exportExcel'])->name('report.exportExcel');
    });
});

Route::prefix('user')->name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:admin'])->group(function(){
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::resource('permission',PermissionController::class);
        Route::resource('category',CategoryController::class);
        Route::resource('subcategory',SubCateoryController::class);
        Route::resource('collection',CollectionController::class);
        Route::resource('product',ProductController::class);
        Route::resource('customer',CustomerController::class);
        Route::resource('services',ServicesController::class);
        Route::resource('transaction',TransactionController::class);
        Route::resource('item',ItemController::class);
        Route::get('/get/subcategory',[ProductController::class,'getsubcategory'])->name('getsubcategory');
        Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
    });
});

