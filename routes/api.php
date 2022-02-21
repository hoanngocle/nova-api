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

Route::controller(AuthController::class)->group(function (){
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::get('login/{provider}', 'loginSocial');
    Route::get('login/{provider}/callback', 'handleSocialCallback');
});

Route::group(['middleware' => ['VerifyAPIKey', 'auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile'])->name('user.profile');

        Route::group(['prefix' => 'master'], function () {
            //
            // Lets test contribute
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

