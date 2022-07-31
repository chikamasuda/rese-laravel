<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
        $reservations = Reservation::with(['shops', 'users'])
            ->where('user_id', $user->id)
            ->where('date', '>=', date('Y-m-d'))
            ->get();

        return response()->json(['reservations' => $reservations], 200);
    }

    /**
     * 予約追加
     *
     * @param Request $request
     * @return void
     */
    public function store(ReservationRequest $request)
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
     * 予約詳細
     *
     * @param Favorite $favorite
     * @return void
     */
    public function show(Reservation $reservation)
    {
        $reservation = Reservation::with(['shops', 'users'])->where('id', $reservation->id)->get();

        if ($reservation) {
            return response()->json(['reservation' => $reservation], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
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

    /**
     * 予約変更
     *
     * @param Reservation $reservation
     * @return void
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $update = [
            "user_id" =>  $request->user_id,
            "shop_id" =>  $request->shop_id,
            "date"    =>  $request->date,
            "number"  =>  $request->number,
        ];

        $reservation = Reservation::where('id', $reservation->id)->update($update);

        if ($reservation) {
            return response()->json(['message' => 'Updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found', 404]);
        }
    }
}
