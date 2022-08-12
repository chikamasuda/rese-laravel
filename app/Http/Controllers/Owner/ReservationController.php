<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
  /**
   * 管理画面の予約一覧
   *
   * @param Owner $owner
   * @return void
   */
  public function index(Owner $owner)
  {
    $reservations = Reservation::with(['shops', 'users'])
      ->whereHas('shops',  function ($query) use ($owner) {
        $query->where('owner_id', $owner->id);
      })
      ->where('date', '>=', Carbon::now())
      ->orderBy('date')
      ->get();

    return response()->json(['reservations' => $reservations], 200);
  }
}
