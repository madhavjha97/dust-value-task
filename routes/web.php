<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRAuthController;


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

Route::get('/register', [\App\Http\Controllers\CandidateAuthController::class, 'showRegister'])->name('candidate.register');
//Route::get('/register', [\App\Http\Controllers\CandidateAuthController::class, 'showRegister'])->name('candidate.register');
Route::post('/register', [\App\Http\Controllers\CandidateAuthController::class, 'register'])->name('candidate.register.store');

Route::get('/login', [\App\Http\Controllers\CandidateAuthController::class, 'showLogin'])->name('candidate.login');
Route::post('/login', [\App\Http\Controllers\CandidateAuthController::class, 'login']);

Route::get('/logout', [\App\Http\Controllers\CandidateAuthController::class, 'logout'])->name('candidate.logout');



Route::middleware(['candidate.auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\CandidateDashboardController::class, 'index'])->name('candidate.dashboard');
    Route::post('/apply-job', [\App\Http\Controllers\CandidateDashboardController::class, 'applyForJob'])->name('candidate.apply');
});


Route::get('/hr/login', [HRAuthController::class, 'showLoginForm'])->name('hr.login');
Route::post('/hr/login', [HRAuthController::class, 'login'])->name('hr.login.submit');
Route::get('/hr/dashboard', [HRAuthController::class, 'dashboard'])->name('hr.dashboard');
Route::post('/hr/logout', [HRAuthController::class, 'logout'])->name('hr.logout');


Route::resource('candidates', \App\Http\Controllers\CandidateController::class);
Route::get('interview-scheduling', [\App\Http\Controllers\InterviewController::class, 'index'])->name('interviews.index');
Route::post('interview-scheduling', [\App\Http\Controllers\InterviewController::class, 'store'])->name('interviews.store');

Route::post('interview-scheduling-update', [\App\Http\Controllers\InterviewController::class, 'update'])->name('interviews.update');

Route::get('/hr/candidates', [\App\Http\Controllers\HrController::class, 'candidates'])->name('hr.candidates');
Route::get('/hr/jobs', [\App\Http\Controllers\HrController::class, 'jobs'])->name('hr.jobs');

Route::get('/jobs/create', [\App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [\App\Http\Controllers\JobController::class, 'store'])->name('jobs.store');
