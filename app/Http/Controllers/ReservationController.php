<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * 予約一覧
     *
     * @param User $user
     * @return void
     */
    public function index(User $user)
    {
        $reservations = Reservation::where('user_id', $user->id)->get();

        return response()->json(['reservations' => $reservations], 200);
    }

    /**
     * 予約追加
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $reservations = Reservation::create([
            "user_id" =>  $request->user_id,
            "shop_id" =>  $request->shop_id,
            "date"    =>  $request->date,
            "number"  =>  $request->number,
        ]);

        return response()->json(['reservations' => $reservations], 201);
    }

    /**
     * 予約削除
     *
     * @param Favorite $favorite
     * @return void
     */
    public function destroy(Reservation $reservation)
    {
        $reservation = Reservation::where('id', $reservation->id)->delete();

        if ($reservation) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
