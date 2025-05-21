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
use App\Http\Controllers\HrController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConsultancyApiController;
use App\Http\Controllers\Api\ConsultanctApiController;

// Route::group(['prefix' => 'api'], function () {
//     Route::post('auth/login', [AuthController::class, 'apiLogin']);
//     Route::get('getConsultancy', [ConsultancyApiController::class, 'getConsultancy']);
//     Route::post('add-consultancy', [ConsultancyApiController::class, 'add_consultancy']); 
//     Route::post('update-consultancy/{id}', [ConsultancyApiController::class, 'api_update_consultancy']);
//     Route::get('countries', [ConsultancyApiController::class, 'countries']);
//     Route::get('/states', [ConsultancyApiController::class, 'getStates']);
//     Route::delete('delete-consultancy/{id}', [ConsultancyApiController::class, 'api_delete_consultancy']);

// });

Route::group(['prefix' => 'api'], function () {

    Route::post('auth/login', [AuthController::class, 'apiLogin']);

    Route::middleware('auth:api')->group(function () {
        Route::get('getConsultancy', [ConsultancyApiController::class, 'getConsultancy']);
        Route::post('add-consultancy', [ConsultancyApiController::class, 'add_consultancy']); 
        Route::post('update-consultancy/{id}', [ConsultancyApiController::class, 'api_update_consultancy']);
        Route::delete('delete-consultancy/{id}', [ConsultancyApiController::class, 'api_delete_consultancy']);
        Route::get('countries', [ConsultancyApiController::class, 'countries']);
        Route::get('/states', [ConsultancyApiController::class, 'getStates']);
        Route::post('consultant/update-basic', [ConsultanctApiController::class, 'apiUpdateBasicDetailsConsultant']);
        Route::post('/consultant/dashboard/timeline', [ConsultanctApiController::class, 'getDashboardTimelineData']);

    });

});



Route::get('/', function () {
    return redirect()->route('login');
});

// Admin Login Routes
Route::get('login', [AdminController::class, 'showLoginForm'])->name('login'); // Required by auth middleware
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::match(['get', 'post'], 'insert-password/{id}', [ConsultancyController::class, 'insertPassword'])->name('insert.password');
// Route::get('/send-test-email', [ConsultancyController::class, 'sendTestEmail']);
  Route::get('/update-timesheet-status/{id}', [ConsultantController::class, 'updateTimesheetstatus']);
    Route::get('/get-timesheet-status-reporitng-manager', [ConsultantController::class, 'getTimesheetStatusReportingManager'])->name('get-timesheet-status-reporitng-manager');

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
    Route::get('consultant/information', [ConsultantController::class, 'information'])->name('consultant.information');
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
    Route::delete('consultancies/delete-client/{id}', [ConsultancyController::class, 'deleteClient']);


    Route::post('/save-consultant-data', [ConsultantController::class, 'addConsultantData'])->name('consultant.data.save');
    Route::post('/delete-consultant-claim', [ConsultantController::class, 'deleteClaim'])->name('consultant.claim.delete');
    Route::get('/get-timesheet-status', [ConsultantController::class, 'getTimesheetStatus'])->name('get-timesheet-status');
    Route::get('/get-claim-status', [ConsultantController::class, 'getClaimStatus'])->name('get-claim-status');
    Route::post('/consultant/update-basic-details', [ConsultantController::class, 'updateBasicDetailsConsultant'])->name('consultant.update.basic.details');
  


});


Route::middleware('auth')->group(function () {
    Route::get('hr/dashboard', [HrController::class, 'index'])->name('hr.dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/consultant/approve-sheet/{token}', [ConsultantController::class, 'approveConsultantSheet'])->name('consultant.approve.sheet');

});
Route::post('/consultant/approve-sheet/update-status', [App\Http\Controllers\ConsultantController::class, 'updateTimesheetStatusMail']);