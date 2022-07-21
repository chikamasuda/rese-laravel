<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    /**
     * 店舗代表者作成
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $owners = Owner::create([
            "name"     =>  $request->name,
            "email"    =>  $request->email,
            "password" =>  $request->password,
        ]);

        return response()->json(['owners' => $owners], 201);
    }
}
