<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;

class ReservationController extends Controller
{
    public function index(Owner $owner)
    {
        $reservations = Reservation::with('shops')
            ->where('owner_id', $owner->id)
            ->get();

        return response()->json(['reservations' => $reservations], 200);
    }
}
