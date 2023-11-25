<?php

use App\Http\Controllers\ChooseOrgUnitController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\PatientController;
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

Route::get('/choose-org', [ChooseOrgUnitController::class, 'index'])
    ->name('choose.org')
    ->middleware(['auth', 'verified']);

Route::post('/choose-org/{org_unit}', [ChooseOrgUnitController::class, 'save'])
    ->name('save.chosen.org')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'org.chosen'])->name('dashboard');

Route::middleware(['auth', 'org.chosen'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// DataEntries
Route::resource('dataentries', DataEntryController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified', 'org.chosen']);

// Patients
Route::resource('patients', PatientController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'verified', 'org.chosen']);

require __DIR__ . '/auth.php';
