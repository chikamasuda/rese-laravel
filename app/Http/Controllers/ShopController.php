<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * 飲食店一覧取得
     *
     * @return void
     */
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();

        return response()->json(['shops' => $shops], 200);
    }

    /**
     * 飲食店詳細取得
     *
     * @param Shop $shop
     * @return void
     */
    public function show(Shop $shop)
    {
        $shop = Shop::where('id', $shop->id)->get();

        if ($shop) {
            return response()->json(['shop' => $shop], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * 飲食店検索
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $query = Shop::query();
        $area_id = $request->area_id;
        $genre_id = $request->genre_id;
        $keyword = $request->keyword;

        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }

        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }

        if (!empty($keyword)) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($keyword, 's');
            //キーワードを半角スペースごとに区切る
            $array_keyword = explode(' ', $spaceConversion);
            //キーワード絞り込み
            $query->where(function ($query) use ($array_keyword) {
                foreach ($array_keyword as $keyword_item) {
                    $query->orWhere('name', 'like', "%{$keyword_item}%")
                        ->orWhere('description', 'like', "%{$keyword_item}%");
                }
            });
        }

        $shops = $query->get();

        return response()->json(['shops' => $shops], 200);
    }
}
