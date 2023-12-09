<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ProfileController;

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
    return view('auth.login');
});



// Seeker
Route::get('/seeker', [App\Http\Controllers\HomeController::class, 'indexseeker'])->name('seeker');
Route::get('seeker/melamar/{jobpostId}', [UserController::class, 'pelamar'])->name('pelamar.create');
Route::post('seeker/melamar', [UserController::class, 'pelamarStore'])->name('pelamar.store');
Route::get('/seeker/job', [App\Http\Controllers\HomeController::class, 'seekerjob'])->name('seeker.job');
Route::get('/seeker/profile', [HomeController::class, 'seekerprofile'])->name('seeker.profile');
Route::post('/seeker/profile/update', [HomeController::class, 'seekerupdateProfile'])->name('seeker.profile.update');
Route::get('/seeker/applications', [App\Http\Controllers\HomeController::class, 'applications'])->name('seeker.applications');
Route::get('/seeker/profile/edit/{profileId}', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('seeker.profile.edit');
Route::put('/seeker/profile/update/{profileId}', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('seeker/detail/{jobpostId}', [HomeController::class, 'detailseeker'])->name('seeker.detail');


// Recruter
Route::get('/recruter', [App\Http\Controllers\HomeController::class, 'indexrecruter'])->name('recruter');
Route::get('recruter/job', [App\Http\Controllers\JobPostController::class, 'index'])->name('recruter.job');
Route::get('recruter/create', [App\Http\Controllers\JobPostController::class, 'create'])->name('recruter.create');
Route::post('recruter/store', [App\Http\Controllers\JobPostController::class, 'store'])->name('recruter.store');
Route::get('recruter/edit/{jobpost}', [App\Http\Controllers\JobPostController::class, 'edit'])->name('recruter.edit');
Route::put('recruter/update', [App\Http\Controllers\JobPostController::class, 'update'])->name('recruter.update');
Route::put('recruter/updateimage/{jobpostId}', [JobPostController::class, 'updateImage'])->name('recruter.updateImage');
Route::delete('recruter/destroy/{jobpost}', [App\Http\Controllers\JobPostController::class, 'destroy'])->name('recruter.destroy');
Route::get('profiles/{jobPostId?}', [ProfileController::class, 'index'])->name('recruter.index');
Route::put('profiles/{profile}/approve', [ProfileController::class, 'approveProfile'])->name('recruter.profile.approve');
Route::put('profiles/{profile}/reject', [ProfileController::class, 'rejectProfile'])->name('recruter.profile.reject');
Route::delete('profiles/{profile}', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/recruter/profile', [HomeController::class, 'recruterprofile'])->name('recruter.profile');
Route::post('/recruter/profile/update', [HomeController::class, 'recruterupdateProfile'])->name('recruter.profile.update');
Route::get('recruter/detail/{jobpostId}', [HomeController::class, 'detailrecruter'])->name('recruter.detail');




// Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'indexadmin'])->name('admin');
    Route::get('admin/job', [AdminController::class, 'index'])->name('admin.job');
    Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/edit/{jobpost}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::put('admin/updateimage/{jobpostId}', [AdminController::class, 'updateImage'])->name('admin.updateImage');
    Route::delete('admin/destroy/{jobpost}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('admin/profiles/{jobPostId?}', [AdminController::class, 'indexprofile'])->name('admin.index');
    Route::put('admin/profiles/{profile}/approve', [ProfileController::class, 'approveProfile'])->name('admin.profile.approve');
    Route::put('admin/profiles/{profile}/reject', [ProfileController::class, 'rejectProfile'])->name('admin.profile.reject');
    Route::delete('admin/profiles/{profile}', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    Route::get("/admin/user", [AdminController::class, 'listUsers'])->name('admin.user');
    Route::delete('/admin/user/delete/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('admin/detail/{jobpostId}', [HomeController::class, 'detailadmin'])->name('admin.detail');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

