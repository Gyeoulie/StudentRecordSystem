<?php

use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.programs.index');
    Route::post('/programs', [ProgramController::class, 'store'])->name('admin.programs.store');
    Route::patch('/programs/{program}', [ProgramController::class, 'update'])->name('admin.programs.update');

    Route::resource('students', StudentController::class)->names([
        'index' => 'admin.students.index',
        'create' => 'admin.students.create',
        'store' => 'admin.students.store',
        'show' => 'admin.students.show',
        'edit' => 'admin.students.edit',
        'update' => 'admin.students.update',
        'destroy' => 'admin.students.destroy',
    ]);

    // 👇 Custom PATCH route for updating student image only
    Route::patch('students/{student}/image', [StudentController::class, 'updateImage'])
        ->name('admin.students.updateImage');

    Route::delete('students/{student}/image', [StudentController::class, 'deleteImage'])
        ->name('admin.students.deleteImage');

});

require __DIR__ . '/auth.php';
