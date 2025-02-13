<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormCheckPanelController;
use App\Http\Controllers\FormCheckItemController;
use App\Models\FormChecklistItem;

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

Route::resource('/formpanels', FormCheckPanelController::class);
Route::resource('/formitems', FormCheckItemController::class);
Route::get('/formitems/create/{panel_id?}', [FormCheckItemController::class, 'create'])->name('formitems.create');
Route::patch('/formitems/{id}/update-check', [FormCheckItemController::class, 'updateCheck'])->name('updateCheck');
