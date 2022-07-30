<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailToUser;
use App\Mail\RemaindMail;
use Carbon\Carbon;

class MailController extends Controller
{
  /**
   * ユーザー一覧
   *
   * @return void
   */
  public function getUserList()
  {
    $users = User::all();

    return response()->json(['users' => $users], 200);
  }

  /**
   * ユーザー詳細
   *
   * @return void
   */
  public function getUserDetail(User $user)
  {
    $user = User::where('id', $user->id)->get();

    if ($user) {
      return response()->json(['user' => $user], 200);
    } else {
      return response()->json(['message' => 'Not found'], 404);
    }
  }

  /**
   * ユーザーへのメール送信
   *
   * @param Request $request
   * @return void
   */
  public function sendUserMail(Request $request)
  {
    $email = $request->email;
    $title =  $request->title;
    $content = $request->content;

    //メール送信
    Mail::to($email)->send(new EmailToUser($email, $title, $content));

    return response()->json(['message' => 'Email was successfully sent'], 200);
  }

  /**
   * 予約リマインドメール送信
   *
   * @return void
   */
  public static function sendRemindMail()
  {
    //当日の予約情報を取得
    $reservations = Reservation::whereDate('date', date('Y-m-d'))->get();

    //メール送信
    foreach ($reservations as $reservation) {
      Mail::to($reservation->users->email)->send(new RemaindMail($reservation));
    }

    return response()->json(['message' => 'Email was successfully sent'], 200);
  }
}
