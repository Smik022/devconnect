<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperProfileController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\PendingApprovalController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\EmployerSearchController;
use App\Http\Controllers\EmployerController;

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/developer/profile', [DeveloperProfileController::class, 'edit'])->name('developer.profile.edit');
    Route::post('/developer/profile', [DeveloperProfileController::class, 'update'])->name('developer.profile.update');
});
// In web.php

Route::get('/resume/{filename}', function ($filename) {
    $path = storage_path('app/public/resumes/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File not found.');
    }

    return response()->file($path);
})->where('filename', '.*')->name('resume.view');


//Job Posts
// This route is for creating and storing job posts, accessible only to authenticated users

Route::middleware(['auth'])->group(function () {
    Route::get('/jobposts/create', [JobPostController::class, 'create'])->name('jobposts.create');
    Route::post('/jobposts/store', [JobPostController::class, 'store'])->name('jobposts.store');
});

Route::get('/jobposts', [JobPostController::class, 'index'])->name('jobposts.index');


#developer directory search
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.index');

#employers search
Route::get('/employers/search', [EmployerSearchController::class, 'search'])->name('employers.search');




//APURBO
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin_login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin_logout');

Route::get('/admin/dashboard', [AdminPanelController::class, 'index'])
    ->middleware('auth:admin')
    ->name('admin_dashboard');

Route::get('/search', [AdminPanelController::class, 'search'])->middleware('auth:admin')->name('search');

Route::get('/admin/profile', [AdminPanelController::class, 'profile'])
    ->middleware('auth:admin')
    ->name('admin_profile');

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/profile/update', [AdminPanelController::class, 'updateProfile'])->name('admin.profile.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/pending_approvals', [PendingApprovalController::class, 'index'])->name('pending_approvals');
    Route::delete('/admin/pending_approvals/{pendingApproval}', [PendingApprovalController::class, 'destroy'])->name('pending_approvals.destroy');
});


Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/approvals/{id}/approve', [JobPostController::class, 'approve']);    
    Route::get('/admin/job_postings', [JobPostController::class, 'job_index'])->name('job_postings');
    Route::get('/admin/job_postings/{job_posting}', [JobPostController::class, 'show'])->name('job_postings.show');
    Route::put('/admin/job_postings/{job_posting}', [JobPostController::class, 'update'])->name('job_postings.update');
    Route::delete('/admin/job_postings/{job_posting}', [JobPostController::class, 'destroy'])->name('job_postings.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/employers', [EmployerController::class, 'index'])->name('admin_employers');
    Route::get('/admin/employers/{employer}', [EmployerController::class, 'show'])->name('admin_employers.show');
    Route::put('/admin/employers/{user}', [EmployerController::class, 'update'])->name('admin_employers.update');
    Route::delete('/admin/employers/{employer}', [EmployerController::class, 'destroy'])->name('admin_employers.destroy');
});



