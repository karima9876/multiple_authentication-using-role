<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Auth\TeacherRegisterController;
use App\Http\Controllers\Backend\TeacherDashboardController;
use App\Http\Controllers\Auth\AdminRegisterController;


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
    return view('welcome');
});
//backend routes
Route::get('admin/login',[AdminController::class,'adminLoginForm'])->name('admin.login.form');
Route::post('admin-login',[AdminController::class,'adminLogin'])->name('admin.login');

Route::get('admin/register',[AdminRegisterController::class,'adminRegisterForm'])->name('admin.register.form');
Route::post('admin-register',[AdminRegisterController::class,'adminRegister'])->name('admin.register');
// Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard',[DashboardController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout',[DashboardController::class,'adminLogout'])->name('admin.logout');

// });
//for teacher
Route::get('teacher/login',[TeacherController::class,'teacherLoginForm'])->name('teacher.login.form');
Route::post('teacher-login',[TeacherController::class,'teacherLogin'])->name('teacher.login');

Route::get('teacher/register',[TeacherRegisterController::class,'teacherRegisterForm'])->name('teacher.register.form');
Route::post('teacher-register',[TeacherRegisterController::class,'teacherRegister'])->name('teacher.register');
// Route::group(['middleware'=>'teacher'],function(){
    Route::get('teacher/dashboard',[TeacherDashboardController::class,'teacherDashboard'])->name('teacher.dashboard');
    Route::get('teacher/logout',[TeacherDashboardController::class,'teacherLogout'])->name('teacher.logout');

// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
