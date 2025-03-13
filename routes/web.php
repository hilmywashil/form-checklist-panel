<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FormCheckItemController;
use App\Http\Controllers\FormChecklistDailyController;
use App\Http\Controllers\FormCheckPanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Models\FormChecklistDaily;
use Illuminate\Support\Facades\Route;

//Welcome Page
Route::get('/', function () {
    return view('welcome');
});

//Dashboard Page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Middleware for Admin
Route::middleware('auth')->group(function () {

    //Admin Formpanel with Auth
    Route::get('/admin/formpanels', [FormCheckPanelController::class, 'index'])->name('adminFormpanels');
    Route::get('/admin/formpanel/create', [FormCheckPanelController::class, 'create'])->name('formpanelCreate');
    Route::post('/admin/formpanel/store', [FormCheckPanelController::class, 'store'])->name('formpanelStore');
    Route::get('/admin/formpanel/{id}', [FormCheckPanelController::class, 'show'])->name('adminFormpanelShow');
    Route::get('/admin/formpanel/edit/{id}', [FormCheckPanelController::class, 'edit'])->name('formpanelEdit');
    Route::put('/admin/formpanel/update/{id}', [FormCheckPanelController::class, 'update'])->name('formpanelUpdate');
    Route::delete('/admin/formpanel/{id}', [FormCheckPanelController::class, 'destroy'])->name('formpanelDelete');

    //Admin Formitem with Auth
    Route::get('/admin/formitem/create/{panel_id?}', [FormCheckItemController::class, 'create'])->name('formitemCreate');
    Route::post('/admin/formitem/store', [FormCheckItemController::class, 'store'])->name('formitemStore');
    Route::get('/admin/formitem/edit/{id}', [FormCheckItemController::class, 'edit'])->name('formitemEdit');
    Route::put('/admin/formitem/update/{id}', [FormCheckItemController::class, 'update'])->name('formitemUpdate');
    Route::delete('/admin/formitem/{id}', [FormCheckItemController::class, 'destroy'])->name('formitemDelete');
    Route::patch('/admin/formitem/update-check/{id}', [FormCheckItemController::class, 'updateCheck'])->name('updateCheck');

    //Admin Daily with Auth
    Route::get('/admin/formdailies', [FormChecklistDailyController::class, 'index'])->name('adminFormDaily');
    Route::get('/admin/formdaily/create', [FormChecklistDailyController::class, 'create'])->name('formCheckDailyCreate');
    Route::post('/admin/formdaily/store', [FormChecklistDailyController::class, 'store'])->name('formCheckDailyStore');
    Route::get('/admin/formdaily/edit/{id}', [FormChecklistDailyController::class, 'edit'])->name('formCheckDailyEdit');
    Route::put('/admin/formdaily/update{id}', [FormChecklistDailyController::class, 'update'])->name('formCheckDailyUpdate');

    //Admin Checklist with Auth
    Route::get('admin/checklist-daily', [FormChecklistDailyController::class, 'index'])->name('adminChecklistDaily');
    Route::post('/checklist-daily', [FormChecklistDailyController::class, 'store'])->name('checklistDailyStore');
    Route::patch('/checklist-daily/{id}', [FormChecklistDailyController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/checklist/{id}', [FormChecklistDailyController::class, 'destroy'])->name('formCheckDailyDestroy');
    
    //Profile    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User Formpanel without Auth
Route::get('/formpanels', [FormCheckPanelController::class, 'userPanels'])->name('userFormpanels');
Route::get('/formpanel/{id}', [FormCheckPanelController::class, 'userShow'])->name('userFormpanelShow');

//User Checklist without Auth
Route::get('/checklist-daily', [FormChecklistDailyController::class, 'userDaily'])->name('userChecklistDaily');
Route::get('/checklist-daily/{id}', [FormChecklistDailyController::class, 'show'])->name('userChecklistDailyShow');
Route::get('/checklist-table', [FormChecklistDailyController::class, 'table'])->name('dailyTableCheck');

//Download PDF (Both)
Route::get('/formpanels/{id}/pdf', [FormCheckPanelController::class, 'downloadPDF'])->name('formpanels.pdf');

//Guest Page
Route::get('/guest', function () {
    return view('user');
})->name('guest');

//Test QR (Not Important)
Route::get('/testqr', [QrCodeController::class, 'show']);

//Attendance (Not Important)
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::delete('/attendance/{employee_name}', [AttendanceController::class, 'destroy'])
    ->name('attendance.destroy');

//Checklist Daily

require __DIR__ . '/auth.php';
