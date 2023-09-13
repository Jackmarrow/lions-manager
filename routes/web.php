<?php

use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarClasseController;
use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\ClassePhotoController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\StudioPhotoController;
use App\Http\Controllers\ResvClasseController;
use App\Http\Controllers\ResvStudioController;
use App\Http\Controllers\UserCalendarController;
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


//Redirect to login
Route::redirect('/', '/login');

// Route Dashboard
// Route::get('/dashboard', function () {
//         return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Profile Authentification
Route::middleware('auth', 'checkPasswordReset')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth middleware for admin
Route::middleware('auth', 'role:admin')->group(function () {
    // Classe Route Page
    Route::get('/admin/classe', [ClasseController::class, 'index'])->name('classe.index');
    Route::get('/admin/classes', [ClasseController::class, 'index'])->name('classe.index');
    Route::post('/admin/classes/store', [ClasseController::class, 'store'])->name('classe.store');
    Route::get('/admin/classes/show/{id}', [ClasseController::class, 'show'])->name('classes.show');
    Route::put('/admin/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');
    Route::delete('/admin/classes/{id}', [ClasseController::class, 'destroy'])->name('classe.destroy');
    Route::put('/admin/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');
    // Class Photo Route
    Route::post('/admin/classes/{id}/upload-images', [ClassePhotoController::class, 'uploadImages'])->name('upload.images');
    Route::post('/admin/classes/upload/{id}', [ClassePhotoController::class, 'upload'])->name('classe.upload');
    Route::delete('/admin/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'destroy'])
        ->name('classe.destroy.photo');
    Route::delete('/admin/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'update'])
        ->name('classe.update.photo');
    Route::get('/admin/fullcalender/classe/{classe}', [CalendarClasseController::class, "showcal"])->name("calendarClasse.showcal");
    Route::delete('/admin/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'destroy'])
        ->name('classe.destroy.photo');
    Route::put('/admin/classes/{classe}/photos/{photo}/update', [ClassePhotoController::class, 'update'])
        ->name('classe.update.photo');
    // Admin Registration Route Page
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/register', [AddUserController::class, 'index'])->name('admin_register.index');
    Route::post('/addmin/register/add_user', [AddUserController::class, 'store'])->name('add_user.store');
    Route::delete('/admin/register/{user}/delete', [AddUserController::class, 'destroy'])->name('user.destroy');
    Route::put('/admin/register/{user}/update', [AddUserController::class, 'update'])->name('user.update');
    // Tool Route Pages
    Route::get('/admin/tools', [ToolController::class, "index"])->name("tools.index");
    Route::get('/admin/tool/{tool}', [ToolController::class, "edittool"]);
    Route::get('/admin/tool/create', [ToolController::class, "create"])->name("tools.create");
    Route::get('/admin/tool/edit/{tool}', [ToolController::class, "edit"])->name("tools.edit");
    // Tools Route Functions
    Route::post('/admin/tool/store', [ToolController::class, "store"])->name("tools.store");
    Route::put('/admin/tool/update/{tool}', [ToolController::class, "update"])->name("tools.update");
    Route::delete('/admin/tool/{tool}/destroy', [ToolController::class, "destroy"])->name("tools.destroy");
    // Studios Route
    Route::get('/admin/studios', [StudioController::class, "index"])->name("studio.index");
    Route::post('/admin/studio/store', [StudioController::class, "store"])->name("studios.store");
    Route::put('/admin/studio/{studio}/update', [StudioController::class, "update"])->name("studios.update");
    Route::delete('/admin/studio/{studio}/destroy', [StudioController::class, "destroy"])->name("studios.destroy");
    // Studios Photo
    Route::post('/admin/studio/store/photo/{studio}', [StudioPhotoController::class, "store"])->name("studiophoto.store");
    Route::put('/admin/studio/photo/{studiophoto}/update', [StudioPhotoController::class, "update"])->name("studiophoto.update");
    Route::delete('/admin/studio/photo/{studiophoto}/destroy', [StudioPhotoController::class, "destroy"])->name("studiophoto.destroy");
    // Calendar Route Function
    Route::controller(CalendarClasseController::class)->group(function () {
        Route::post('fullcalenderAjaxAdmin', 'ajax'); //for reservation & delete
    });
    // History Route page
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('history.index');
    // History Route Functions
    Route::post('/admin/history/send_history', [HistoryController::class, 'store'])->name('history.store');
});

// Auth User G.Classe
Route::middleware('auth', 'role:gestion classe', 'checkPasswordReset')->group(function () {
    // Calendar Route Page
    Route::get('/user/fullcalender/classe/{classe}', [UserCalendarController::class, "showcal"])->name("userCalendar.showcal");
    // Calendar Route Function
    Route::controller(UserCalendarController::class)->group(function () {
        Route::post('fullcalenderAjax', 'ajax'); //for reservation & delete
    });
    //
    Route::get('/user/lionsgeek_classes', [UserController::class, 'lionsGeekClass'])->name('lionsGeekClass.index');
});

// Auth User G.Studio
Route::middleware('auth', 'role:gestion studio', 'checkPasswordReset')->group(function () {
    // User Route Page
    Route::get('/user/studio_calendar', [ResvStudioController::class, 'index'])->name('studio_calendar.index');
    //
    Route::get('/user/lionsgeek_studios', [UserController::class, 'lionsGeekStudio'])->name('lionsGeekStudio.index');
});

// Reset password page
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');
Route::put('/update_password', [ResetPasswordController::class, 'update'])->name('reset-password.update');

require __DIR__ . '/auth.php';
