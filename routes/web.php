<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Actions\Logout;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('web')->group(function () {
    Route::get('/', fn () => view('welcome'))->name('home');
    Route::post('/logout', Logout::class)->name('logout');
});

use App\Livewire\Users\UserTable;
Route::get('/table', UserTable::class)->name('users.user-table');

use App\Livewire\Asistencias\AsistenciasLista;
Route::get('/asistencias', AsistenciasLista::class)->name('asistencias.asistencias-lista');

use App\Livewire\Estudiantes\EstudiantesLista;
Route::get('/estudiantes', EstudiantesLista::class)->name('estudiantes.estudiantes-lista');

require __DIR__.'/auth.php';
