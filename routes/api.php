<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;

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

//ログイン、新規登録
Route::controller(AuthController::class)->group(function () {
    Route::post('/v1/users/login', 'login');
    Route::post('/v1/users/registration', 'register');
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

Route::group(['middleware' => 'auth:api'], function () {

    //認証
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
        //来店済かチェック
        Route::get('/v1/is-arrived/', 'is_arrived');
    });
});
