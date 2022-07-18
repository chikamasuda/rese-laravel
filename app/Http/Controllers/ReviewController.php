<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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

    /**
     * 評価可能か確認
     *
     * @param Request $request
     * @return void
     */
    public function is_arrived(Request $request)
    {
        //来店すみの予約の数の確認
        $reservation = Reservation::where('user_id', $request->user_id)
            ->where('date', '<=', Carbon::now())
            ->where('shop_id', $request->shop_id)
            ->get();

        $reservation_count = count($reservation);

        //評価済みの店舗の数の確認
        $reviews = Review::where('user_id', $request->user_id)
            ->where('shop_id', $request->shop_id)
            ->get();

        $review_count = count($reviews);

        return response()->json(['review_count' => $review_count, 'reservation_count' => $reservation_count], 200);
    }
}
