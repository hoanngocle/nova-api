<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HeroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function (){
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::get('login/{provider}', 'loginSocial');
    Route::get('login/{provider}/callback', 'handleSocialCallback');
});

Route::group(['middleware' => ['VerifyAPIKey', 'auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile'])->name('user.profile');

        Route::controller(HeroController::class)->prefix('heroes')->group(function () {
            Route::get('', 'index')->name('hero.list');
            Route::get('{id}', 'detail')->name('hero.detail');
            Route::post('create', 'create')->name('hero.create');
            Route::post('{id}/update', 'update')->name('hero.update');
            Route::delete('{id}', 'store')->name('hero.delete');
        });
});

