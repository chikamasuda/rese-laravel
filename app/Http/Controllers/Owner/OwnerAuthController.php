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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('owner')->attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(Auth::guard('owner')->user());
        }

        return response()->json(['message' => 'ログインに失敗しました'], 401);
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::guard('owner')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'ログアウトしました']);
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
