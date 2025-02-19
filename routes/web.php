<?php

use App\Http\Controllers\FormCheckItemController;
use App\Http\Controllers\FormCheckPanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/formpanels', FormCheckPanelController::class)->names([
    'index' => 'formpanels.index',
    'create' => 'formpanels.create',
    'store' => 'formpanels.store',
    'show' => 'formpanels.show',
    'edit' => 'formpanels.edit',
    'update' => 'formpanels.update',
    'destroy' => 'formpanels.destroy',
]);

Route::resource('/formitems', FormCheckItemController::class)->names([
    'create' => 'formitems.create',
    'edit' => 'formitems.edit'
]);

Route::get('/formitems/create/{panel_id?}', [FormCheckItemController::class, 'create'])->name('formitems.create');
Route::patch('/formitems/{id}/update-check', [FormCheckItemController::class, 'updateCheck'])->name('updateCheck');

require __DIR__ . '/auth.php';
