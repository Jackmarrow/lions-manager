<?php

use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Notifications\ResetPassword;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Redirect to login
Route::redirect('/', '/login');

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth middleware
Route::middleware('auth','role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','role:user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


// Admin Route Page
Route::get('/admin',[AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/register', [AddUserController::class, 'index'])->name('admin_register.index');
Route::post('/addmin/register/add_user', [AddUserController::class, 'store'])->name('add_user.store');
Route::delete('/admin/register/{user}/delete', [AddUserController::class, 'destroy'])->name('user.destroy');

// User Route Page
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Classe Route Page
Route::get('/admin/classe', [ClasseController::class, 'index'])->name('classe.index');

// Tool Route Pages
Route::get('/admin/tools' , [ToolController::class , "index"])->name("tools.index");
Route::get('/admin/tool/{tool}' , [ToolController::class , "edittool"]);
Route::get('/admin/tool/create' , [ToolController::class , "create"])->name("tools.create");
Route::get('/admin/tool/edit/{tool}' , [ToolController::class , "edit"])->name("tools.edit");

// Tools Route Functions
Route::post('/admin/tool/store' , [ToolController::class , "store"])->name("tools.store");
Route::put('/admin/tool/update/{tool}' , [ToolController::class , "update"])->name("tools.update");
Route::delete('/admin/tool/{tool}/destroy' , [ToolController::class , "destroy"])->name("tools.destroy");

// Reset password page
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');
Route::put('/update_password', [ResetPasswordController::class, 'update'])->name('reset-password.update');

require __DIR__.'/auth.php';
