<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuapController;

Route::get('suap/redirect', [SuapController::class, 'receiveSuapCode'])
    ->name('suap.redirect');

Route::get('suap/login', [SuapController::class, 'redirectUserToLoginPageSuap'])
    ->name('suap.login');