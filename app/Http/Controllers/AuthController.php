<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * 新規登録
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:191',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8'
        ]);

        $validated_data['password'] = bcrypt($request->password);

        //ユーザー情報登録
        $user = User::create($validated_data);

        //トークン発行
        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /**
     * ログイン
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:8'
        ]);

        //ユーザー情報取得
        $user = User::where('email', $request->email)->first();

        //ログインチェック
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login failed.'], 401);
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
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return response()->json(['message' => 'Logged out.'], 200);
    }

    /**
     * ユーザー情報を返す
     *
     * @return void
     */
    public function me()
    {
        $user = auth()->user();

        return response()->json(['user' => $user], 200);
    }
}
