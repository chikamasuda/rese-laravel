<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * ログイン
     *
     * @param Request $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        //ユーザー情報取得
        $user = Admin::where('email', $request->email)->first();

        //ログインチェック
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'メールアドレスまたはパスワードに誤りがあります。'], 401);
        }

        //トークン発行
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $accessToken =  Auth::guard('admin')->user()->token();
        $token = Auth::guard('admin')->user()->tokens->find($accessToken);
        //トークン無効化
        $token->revoke();
        return response()->json(['message' => 'Logged out.'], 200);
    }

    /**
     * 管理者情報を返す
     *
     * @return void
     */
    public function me()
    {
        $admin = Auth::guard('admin')->user();

        return response()->json(['admin' => $admin], 200);
    }
}
