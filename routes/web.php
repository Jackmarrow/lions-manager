<?php

use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\ClassePhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\StudioPhotoController;
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
// Route::redirect('/', '/login');

// Route Dashboard
Route::get('/dashboard', function () {
    return view('/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Auth middleware
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Classe Route Page
    Route::get('/admin/classe', [ClasseController::class, 'index'])->name('classe.index');

    // Admin Route Page
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/register', [AddUserController::class, 'index'])->name('admin_register.index');
    Route::post('/addmin/register/add_user', [AddUserController::class, 'store'])->name('add_user.store');
    Route::delete('/admin/register/{user}/delete', [AddUserController::class, 'destroy'])->name('user.destroy');

    // Tool Route Pages
    Route::get('/admin/tools', [ToolController::class, "index"])->name("tools.index");
    Route::get('/admin/tool/{tool}', [ToolController::class, "edittool"]);
    Route::get('/admin/tool/create', [ToolController::class, "create"])->name("tools.create");
    Route::get('/admin/tool/edit/{tool}', [ToolController::class, "edit"])->name("tools.edit");

    // Tools Route Functions
    Route::post('/admin/tool/store', [ToolController::class, "store"])->name("tools.store");
    Route::put('/admin/tool/update/{tool}', [ToolController::class, "update"])->name("tools.update");
    Route::delete('/admin/tool/{tool}/destroy', [ToolController::class, "destroy"])->name("tools.destroy");
});


// User Route Page
Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Reset password page
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password.index');
Route::put('/update_password', [ResetPasswordController::class, 'update'])->name('reset-password.update');

// for classes
Route::get('/', [ClasseController::class, 'index'])->name('home.index');
Route::get('/classes', [ClasseController::class, 'index'])->name('classe.index');
Route::post('/classes/store', [ClasseController::class, 'store'])->name('classe.store');
Route::get('/classes/show/{id}', [ClasseController::class, 'show'])->name('classes.show');
Route::put('/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');
Route::delete('/classes/{id}', [ClasseController::class, 'destroy'])->name('classe.destroy');
Route::put('/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');

// PhotoController for image uploads
Route::post('/classes/{id}/upload-images', [ClassePhotoController::class, 'uploadImages'])->name('upload.images');
// for upload images
Route::post('/classes/upload/{id}', [ClassePhotoController::class, 'upload'])->name('classe.upload');
//for image modal delete 
Route::delete('/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'destroy'])
    ->name('classe.destroy.photo');
    //for image modal update
Route::delete('/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'update'])
->name('classe.update.photo');

// Route for deleting a photo in a class
Route::delete('/classes/{classe}/photos/{photo}', [ClassePhotoController::class, 'destroy'])
    ->name('classe.destroy.photo');
// route for editing a photo in a class
    Route::put('/classes/{classe}/photos/{photo}/update', [ClassePhotoController::class, 'update'])
 ->name('classe.update.photo');


    

//^page studios___________________________________________________________________________________________
Route::get('/studio' , [StudioController::class , "index"])->name("studio.index");

//^ Function DB studios______________________________________________________________________________
Route::post('/studio/store' , [StudioController::class , "store"])->name("studios.store");
Route::put('/studio/{studio}/update' , [StudioController::class , "update"])->name("studios.update");
Route::delete('/studio/{studio}/destroy' , [StudioController::class , "destroy"])->name("studios.destroy");

//

//!studioPhoto
Route::post('/studio/store/photo/{studio}' , [StudioPhotoController::class , "store"])->name("studiophoto.store");
Route::put('/studio/photo/{studiophoto}/update' , [StudioPhotoController::class , "update"])->name("studiophoto.update");
Route::delete('/studio/photo/{studiophoto}/destroy' , [StudioPhotoController::class , "destroy"])->name("studiophoto.destroy");


// Route::middleware(['auth', 'checkPasswordReset'])->group(function () {
//     // Your protected routes go here
//     // User Route Page
//     Route::get('/user', [UserController::class, 'index'])->name('user.index');
// });

require __DIR__ . '/auth.php';
