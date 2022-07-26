<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
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
    public function login(Request $request)
    {
        //管理者情報取得
        $admin = Admin::where('email', $request->email)->first();

        //ログインチェック
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Login failed.'], 401);
        }

        //トークン発行
        $token = $admin->createToken('authToken')->accessToken;

        return response()->json(['admin' => $admin, 'token' => $token], 200);
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout()
    {
        $accessToken = Auth::guard('admin')->user()->token();
        $token = Auth::guard('admin')->user()->tokens->find($accessToken);
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
