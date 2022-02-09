<?php

use App\Http\Controllers\API\AuthController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('login/{provider}', [AuthController::class, 'loginSocial']);
Route::get('login/{provider}/callback', [AuthController::class, 'handleSocialCallback']);

Route::group(['middleware' => ['VerifyAPIKey']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('profile', [AuthController::class, 'profile'])->name('user.profile');

        Route::group(['prefix' => 'master'], function () {
            //
            Route::group(['prefix' => 'heroes'], function () {
//                Route::get('/', [SetController::class, 'index'])->name('set.list');
//                Route::get('/list', [SetController::class, 'getListSetByCourse'])->name('set.list.by-course');
//                Route::get('/detail', [SetController::class, 'detail'])->name('set.detail');
            });
        });
//

//
//        Route::group(['prefix' => 'term'], function () {
//            Route::get('/', [TermController::class, 'getListTermBySet'])->name('term.list.by-set');
//        });
    });
});

