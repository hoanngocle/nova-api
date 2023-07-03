<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LoginSocialController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\ProfileController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Character\CharacterInfoController;
use App\Http\Controllers\API\HeroController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\MasterJobLevelController;
use App\Http\Controllers\API\MasterLevelController;
use App\Http\Controllers\API\WeaponController;
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

/**
 * Unauthenticated router
 */
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::controller(LoginSocialController::class)->group(function () {
    Route::get('login/{provider}', 'loginSocial');
    Route::get('login/{provider}/callback', 'handleSocialCallback');
});

/**
 * Authenticated router
 */
Route::group(['middleware' => ['VerifyAPIKey', 'auth:sanctum']], function () {
    Route::get('profile', ProfileController::class)->name('user.profile');
    Route::get('character-info', CharacterInfoController::class)->name('user.character.info');
    Route::post('logout', LogoutController::class)->name('user.logout');

    Route::controller(HeroController::class)->prefix('hero')->group(function () {
        Route::get('', 'index')->name('hero.list');
        Route::get('{id}', 'detail')->name('hero.detail');
        Route::post('create', 'create')->name('hero.create');
        Route::post('{id}/update', 'update')->name('hero.update');
        Route::delete('{id}', 'delete')->name('hero.delete');
    });

    Route::controller(WeaponController::class)->prefix('weapon')->group(function () {
        Route::get('', 'index')->name('weapon.list');
        Route::get('{id}', 'detail')->name('weapon.detail');
        Route::post('create', 'create')->name('weapon.create');
        Route::post('{id}/update', 'update')->name('weapon.update');
        Route::delete('{id}', 'delete')->name('weapon.delete');
        Route::post('sendMail', 'sendMail')->name('weapon.sendMail');
    });

    Route::controller(MasterLevelController::class)->prefix('master-level')->group(function () {
        Route::get('', 'index')->name('weapon.list');
        Route::get('{id}', 'detail')->name('weapon.detail');
    });

    Route::controller(MasterJobLevelController::class)->prefix('master-job-level')->group(function () {
        Route::get('', 'index')->name('weapon.list');
        Route::get('{id}', 'detail')->name('weapon.detail');
    });

    Route::controller(ImageController::class)->prefix('image')->group(function () {
        Route::get('', 'index')->name('image.list');
        Route::get('{id}', 'detail')->name('image.detail');
    });
});

