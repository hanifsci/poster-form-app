<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosterRegistrationController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/poster/register', [PosterRegistrationController::class, 'create'])
//     ->name('poster.register');

// Route::post('/poster/register', [PosterRegistrationController::class, 'storeDraft'])
//     ->name('poster.register.storeDraft');

// Route::get('/poster/preview/{token}', [PosterRegistrationController::class, 'preview'])
//     ->name('poster.preview');

// Route::post('/poster/submit/{token}', [PosterRegistrationController::class, 'submit'])
//     ->name('poster.submit');

// Route::get('/poster/success/{id}', [PosterRegistrationController::class, 'success'])
//     ->name('poster.success');

Route::get('/poster/register', [PosterRegistrationController::class, 'create'])
    ->name('poster.register'); // blank form

Route::get('/poster/register/{token}', [PosterRegistrationController::class, 'edit'])
    ->name('poster.register.edit'); // prefilled form

Route::post('/poster/register', [PosterRegistrationController::class, 'storeDraft'])
    ->name('poster.register.storeDraft'); // create OR update draft

Route::get('/poster/preview/{token}', [PosterRegistrationController::class, 'preview'])
    ->name('poster.preview');

Route::post('/poster/submit/{token}', [PosterRegistrationController::class, 'submit'])
    ->name('poster.submit');

Route::get('/poster/success/{id}', [PosterRegistrationController::class, 'success'])
    ->name('poster.success');

// AJAX route to check if email already exists
Route::get('/poster/check-email', [PosterRegistrationController::class, 'checkEmail'])
    ->name('poster.checkEmail');
