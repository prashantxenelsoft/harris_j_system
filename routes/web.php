<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\ConsultancyController;
use App\Http\Controllers\ConsultantController;

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

// Admin Login Routes
Route::get('login', [AdminController::class, 'showLoginForm'])->name('login'); // Required by auth middleware
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::match(['get', 'post'], 'insert-password/{id}', [ConsultancyController::class, 'insertPassword'])->name('insert.password');
// Route::get('/send-test-email', [ConsultancyController::class, 'sendTestEmail']);

Route::get('/logout', [AdminController::class, 'logout']);
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return "Commands executed!";
});

Route::get('/run-artisan-commands', function () {
    \Artisan::call('config:cache');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    return "Commands executed!";
});


// Protected Routes with Auth Middleware
Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('bom/dashboard', [BomController::class, 'dashboard'])->name('bom.dashboard');
    Route::get('consultant/dashboard', [ConsultantController::class, 'index'])->name('consultant.dashboard');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('consultancies', ConsultancyController::class)->names([
        'index'   => 'consultancy.index',
        'create'  => 'consultancy.create',
        'store'   => 'consultancy.store',
        'edit'    => 'consultancy.edit',
        'update'  => 'consultancy.update',
        'destroy' => 'consultancy.delete',
        //'show'    => 'consultancy.show', // optional, if you are using show route
    ]);

    Route::post('/consultancies/add-client', [ConsultancyController::class, 'add_client'])->name('consultancy.add_client');
    Route::put('/consultancies/update-client/{id}', [ConsultancyController::class, 'update_client'])->name('consultancy.update_client');

    Route::post('/consultancies/add-user', [ConsultancyController::class, 'add_user'])->name('consultancy.add_user');
    Route::put('/consultancies/update-user/{id}', [ConsultancyController::class, 'update_user'])->name('consultancy.update_user');


    Route::post('/lookup/store', [ConsultancyController::class, 'storeLookup'])->name('lookup.store');
    Route::post('/lookup/update', [ConsultancyController::class, 'updateLookup'])->name('lookup.update');
    Route::delete('/lookup-header/{id}', [ConsultancyController::class, 'destroylookupHeader'])->name('lookup-header.destroy');
    Route::post('/lookup-option/store', [ConsultancyController::class, 'storelookup_option'])->name('lookup_option.store');
    Route::delete('/lookup-option/{id}', [ConsultancyController::class, 'destroylookupOption'])->name('lookup-option.destroy');
    Route::post('/update-lookup-option', [ConsultancyController::class, 'updateLookupOption'])->name('lookup-option.update');
    Route::get('consultancy/dashboard', [ConsultancyController::class, 'index'])->name('consultancy.dashboard');

});
