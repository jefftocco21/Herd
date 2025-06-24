<?php

use App\Models\Job;
use function Laravel\Prompts\clear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;

Route::get('test', function() {

    \Illuminate\support\facades\mail::to('jnt369@gmail.com')->send(new App\Mail\JobPosted);

    return ('Done');
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware(['auth', 'can:edit-job, job']);
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

Route::patch('jobs/{job}', [JobController::class, 'update']);
Route::delete('jobs/{job}', [JobController::class, 'destroy']);

//Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
