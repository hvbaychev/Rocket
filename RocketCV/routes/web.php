<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CvManager;
use App\Http\Controllers\CvManagerController;
use App\Http\Controllers\ProfileManager;

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

Route::get('/', function () { return view('home'); })->name('home');
Route::get('/about', function() { return view('about'); })->name('about');
Route::get('/category', function() { return view('category'); })->name('category');
Route::get('/contact', function() { return view('contact'); })->name('contact');
Route::get('/cv', function() { return view('cv'); })->name('cv');
Route::get('/job-details', function() { return view('job-details'); })->name('job-details');
Route::get('/job-list', function() { return view('job-list'); })->name('job-list');



Route::get('/login', [AuthController::class,'login'])->name('login')->middleware('alreadyLoggedIn');
Route::post('/login-user',[AuthController::class, 'loginUser'])->name('login-user');
Route::get('/register', [AuthController::class,'registration'])->name('register')->middleware('alreadyLoggedIn');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileManager::class,'profile'])->name('profile')->middleware('isLoggedIn')->middleware('share');
Route::post('/profile', [ProfileManager::class,'profilePost'])->name('profilePost')->middleware('isLoggedIn')->middleware('share');


Route::get('/new-cv', [CvManager::class , 'index'])->name('index')->middleware('isLoggedIn')->middleware('share');

Route::post('universities/create', [CvManager::class,'createUni'])->name('universities.create')->middleware('share');
Route::post('technologies/create', [CvManager::class,'createTech'])->name('technologies.create')->middleware('share');
Route::post('cv/create', [CvManager::class,'createCv'])->name('createCv.create')->middleware('share');


Route::get('/admin/dashboard', [CvManagerController::class, 'index'])->name('admin.dashboard')->middleware('share');
Route::get('/admin/cv', [CvManagerController::class, 'cv'])->name('admin.searchBd')->middleware('share');
Route::get('admin/cv/search_results', [CvManagerController::class, 'searchCvByPeriod'])->name('admin.cv_by_period')->middleware('share');


