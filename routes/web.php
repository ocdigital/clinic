<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/calendar', function () {
    return view('calendar');
})->middleware(['auth', 'verified'])->name('calendar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.index');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->middleware(['auth', 'verified']);
    Route::post('/events', [App\Http\Controllers\EventController::class, 'store']);
    Route::put('/events/{id}', [App\Http\Controllers\EventController::class, 'update']);
    Route::delete('/events/{id}', [App\Http\Controllers\EventController::class, 'destroy']);

    Route::get('/pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'show'])->name('pacientes.show');
    Route::post('/pacientes', [App\Http\Controllers\PacienteController::class, 'store'])->name('pacientes.store');
    Route::put('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'update'])->name('pacientes.update'); 
    Route::delete('/pacientes/{id}', [App\Http\Controllers\PacienteController::class, 'destroy'])->name('pacientes.destroy');

    //rota para chamar a view editar paciente
    Route::get('/pacientes/edit/{id}', [App\Http\Controllers\PacienteController::class, 'edit'])->name('pacientes.edit');

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users.index');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth')->name('users.destroy');

});




require __DIR__.'/auth.php';
