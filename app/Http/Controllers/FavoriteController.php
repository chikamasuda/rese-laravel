<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * ログインユーザーのお気に入り一覧
     *
     * @param User $user
     * @return void
     */
    public function index(User $user)
    {
        $favorites = Favorite::with(['shops', 'shops.area', 'shops.genre'])->where('user_id', $user->id)->get();

        return response()->json(['favorites' => $favorites], 200);
    }

    /**
     * お気に入り追加
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $favorites = Favorite::create([
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
        ]);

        return response()->json(['favorites' => $favorites], 201);
    }

    /**
     * お気に入り削除
     *
     * @param Favorite $favorite
     * @return void
     */
    public function destroy(Favorite $favorite)
    {
        $favorite = Favorite::where('id', $favorite->id)->delete();

        if ($favorite) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
