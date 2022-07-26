<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Owner\OwnerAuthController;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VerifyEmailController;

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

//ユーザーログイン、新規登録
Route::controller(AuthController::class)->group(function () {
    Route::post('/v1/users/login', 'login');
    Route::post('/v1/users/registration', 'register');
});

//ユーザーのメール認証
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

//管理者ログイン
Route::controller(AdminAuthController::class)->group(function () {
    Route::post('/v1/admins/login', 'login');
});

//代表者ログイン
Route::controller(OwnerAuthController::class)->group(function () {
    Route::post('/v1/owners/login', 'login');
});

//飲食店情報
Route::controller(ShopController::class)->group(function () {
    //飲食店一覧
    Route::get('/v1/shops/', 'index');
    //飲食店検索
    Route::get('/v1/shops/search', 'search');
    //飲食店詳細
    Route::get('/v1/shops/{shop}', 'show');
});

//ユーザー機能（ログイン後）
Route::group(['middleware' => 'auth:user', 'verified'], function () {

    //ユーザー認証
    Route::controller(AuthController::class)->group(function () {
        //認証が成功した場合は、ユーザー情報を返す
        Route::get('/v1/users', 'me');
        //ログアウト
        Route::post('/v1/users/logout', 'logout');
    });

    //お気に入り機能
    Route::controller(FavoriteController::class)->group(function () {
        //お気に入り一覧
        Route::get('/v1/users/{user}/favorites', 'index');
        //お気に入り追加
        Route::post('/v1/favorites', 'store');
        //お気に入り削除
        Route::delete('/v1/favorites/{favorite}', 'destroy');
    });

    //予約機能
    Route::controller(ReservationController::class)->group(function () {
        //予約詳細
        Route::get('/v1/reservations/{reservation}', 'show');
        //予約変更
        Route::put('/v1/reservations/{reservation}', 'update');
        //予約削除
        Route::delete('/v1/reservations/{reservation}', 'destroy');
        //予約一覧
        Route::get('/v1/users/{user}/reservations', 'index');
        //予約追加
        Route::post('/v1/reservations/', 'store');
    });

    //評価
    Route::controller(ReviewController::class)->group(function () {
        //レビュー追加
        Route::post('/v1/reviews/', 'store');
        //来店したか確認
        Route::get('/v1/is-arrived/', 'is_arrived');
    });
});

//管理者機能（ログイン後）
Route::group(['middleware' => 'auth:admin'], function () {

    //管理者認証
    Route::controller(AdminAuthController::class)->group(function () {
        //認証が成功した場合は、ユーザー情報を返す
        Route::get('/v1/admins', 'me');
        //ログアウト
        Route::post('/v1/admins/logout', 'logout');
    });

    //店舗代表者に関する機能
    Route::controller(OwnerController::class)->group(function () {
        //店舗代表者作成
        Route::post('/v1/owners', 'store');
    });
});

//オーナー機能（ログイン後）
Route::group(['middleware' => 'auth:owner'], function () {

    //オーナー認証
    Route::controller(OwnerAuthController::class)->group(function () {
        //認証が成功した場合は、ユーザー情報を返す
        Route::get('/v1/owners', 'me');
        //ログアウト
        Route::post('/v1/owners/logout', 'logout');
    });

    Route::controller(OwnerReservationController::class)->group(function () {
        //認証が成功した場合は、ユーザー情報を返す
        Route::get('/v1/owners/{owner}/reservations', 'index');
    });
});
