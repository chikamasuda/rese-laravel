<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Shop;

class ShopController extends Controller
{
    /**
     * 店舗代表者の所属している店舗情報の取得
     *
     * @return void
     */
    public function index(Owner $owner)
    {
        $shop = Shop::where('owner_id', $owner->id)->get();

        return response()->json(['shop' => $shop], 200);
    }
}
