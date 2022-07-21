<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OwnerAuthController extends Controller
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
        $owner = Owner::where('email', $request->email)->first();

        //ログインチェック
        if (!$owner || !Hash::check($request->password, $owner->password)) {
            return response()->json(['message' => 'Login failed.'], 401);
        }

        //トークン発行
        $token = $owner->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout()
    {
        $accessToken = Auth::guard('owner')->user()->token();
        $token = Auth::guard('owner')->user()->tokens->find($accessToken);
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
        $owner = Auth::guard('owner')->user();

        return response()->json(['owner' => $owner], 200);
    }
}
