<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

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
    $quotes = ['Le malade prend l\'avis du médecin. Le médecin prend la vie du malade.',
               'Les médecins, ça sait sur nous des choses qu\'on aimerait mieux ne pas savoir. Les médecins, ça fait peur.',
               'Un médecin n\'est pas un bon médecin s\'il n\'a été lui-même malade.',
               'Un grand médecin est d\'abord un guérisseur qui d\'autre part a appris la médecine.'];
    $quote = Arr::random($quotes);
    return view('welcome', compact('quote'));
});

// Dashboard
Route::get('/dashboard', App\Http\Controllers\DashboardController::class)->middleware(['auth'])->name('dash');

// Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware(['auth'])->name('profile');
Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'indexPassword'])->middleware(['auth'])->name('password');
Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->middleware(['auth'])->name('change.password');
Route::post('/change-profile/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->middleware(['auth'])->name('change.profile');

//Patients
Route::get('/patients', [App\Http\Controllers\PatientController::class, 'index'])->middleware(['auth'])->name('patients.index');
Route::post('/add-patient', [App\Http\Controllers\PatientController::class, 'store'])->middleware(['auth'])->name('add.patient');
Route::get('/patient/{id}', [App\Http\Controllers\PatientController::class, 'edit'])->middleware(['auth'])->name('patient.edit');
Route::post('/patient/{id}', [App\Http\Controllers\PatientController::class, 'update'])->middleware(['auth'])->name('patient.update');
Route::get('/patient/show/{id}', [App\Http\Controllers\PatientController::class, 'show'])->middleware(['auth'])->name('patient.show');
Route::get('/patient/delete/{id}', [App\Http\Controllers\PatientController::class, 'destroy'])->middleware(['auth'])->name('patient.delete');
Route::post('/add-file', [App\Http\Controllers\MedicalFileController::class, 'add_file'])->middleware(['auth'])->name('add.file');
Route::post('/update-file', [App\Http\Controllers\MedicalFileController::class, 'update_file'])->middleware(['auth'])->name('update.file');

//Appointments
Route::get('/appointments', [App\Http\Controllers\AppointmentController::class, 'index'])->middleware(['auth'])->name('appointments.index');
Route::post('/add-appointment', [App\Http\Controllers\AppointmentController::class, 'store'])->middleware(['auth'])->name('add.appointment');
Route::get('/appointment/show/{id}', [App\Http\Controllers\AppointmentController::class, 'show'])->middleware(['auth'])->name('appointment.show');
require __DIR__.'/auth.php';

// Prescriptions
Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->middleware(['auth'])->name('prescriptions.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
