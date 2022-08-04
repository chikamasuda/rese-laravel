<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /**
     * 新規登録
     *
     * @param Request $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        $validated_data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        $validated_data['password'] = bcrypt($request->password);

        //ユーザー登録とメール送信
        event(new Registered($user = User::create($validated_data)));

        //トークン発行
        $user_token = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => $user, 'user_token' => $user_token], 201);
    }

    /**
     * ログイン
     *
     * @param Request $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        //ユーザー情報取得
        $user = User::where('email', $request->email)->first();

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
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        //トークン無効化
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
