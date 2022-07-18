<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * 評価作成
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $reviews = Review::create([
            "user_id"   =>  $request->user_id,
            "shop_id"   =>  $request->shop_id,
            "rating"    =>  $request->rating,
            "comment"   =>  $request->comment,
        ]);

        return response()->json(['reviews' => $reviews], 201);
    }
}
