<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
  /**
   * 店舗代表者の所属している店舗情報の取得
   *
   * @return void
   */
  public function index(Owner $owner)
  {
    $shop = Shop::with(['area', 'genre'])->where('owner_id', $owner->id)->get();

    return response()->json(['shop' => $shop], 200);
  }

  /**
   * 店舗情報作成
   *
   * @param Request $request
   * @return void
   */
  public function store(Request $request)
  {
    $area_id = Area::where('name', $request->area)->pluck('id');
    $genre_id = Genre::where('name', $request->genre)->pluck('id');
    $disk = Storage::disk('s3');
    $image_name = $request->file('image')->getClientOriginalName();
    $path = Storage::disk('s3')->putFile('', $request->file('image'), 'public'); //s3にアップ
    $image_name = $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('/', $image_name, 's3');

    $shops = Shop::create([
      "owner_id"    =>  $request->owner_id,
      "area_id"     =>  $area_id[0],
      "genre_id"    =>  $genre_id[0],
      "name"        =>  $request->name,
      "image_url"   =>  $disk->url($path) . $image_name,
      "description" =>  $request->description,
    ]);

    return response()->json(['shops' => $shops], 201);
  }

  /**
   * 店舗情報更新
   *
   * @param Request $request
   * @return void
   */
  public function update(Request $request, Shop $shop)
  {
    $area_id = Area::where('name', $request->area)->pluck('id');
    $genre_id = Genre::where('name', $request->genre)->pluck('id');

    if ($request->file('image')) {
      $disk = Storage::disk('s3');
      $image_name = $request->file('image')->getClientOriginalName();
      //s3にアップして保存
      $path = Storage::disk('s3')->putFile('', $request->file('image'), 'public');
      $request->file('image')->storeAs('/', $image_name, 's3');

      $update = [
        "owner_id"    =>  $request->owner_id,
        "area_id"     =>  $area_id[0],
        "genre_id"    =>  $genre_id[0],
        "name"        =>  $request->name,
        "image_url"   =>  $disk->url($path) . $image_name,
        "description" =>  $request->description,
      ];
    } else {
      $update = [
        "owner_id"    =>  $request->owner_id,
        "area_id"     =>  $area_id[0],
        "genre_id"    =>  $genre_id[0],
        "name"        =>  $request->name,
        "description" =>  $request->description,
      ];
    }

    $shop = Shop::where('id', $shop->id)->update($update);

    if ($shop) {
      return response()->json(['message' => 'Updated successfully'], 200);
    } else {
      return response()->json(['message' => 'Not found', 404]);
    }
  }
}
