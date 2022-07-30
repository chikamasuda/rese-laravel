<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\RemaindMail;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

class RemindMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールのタスク実行';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //当日の予約情報を取得
        $reservations = Reservation::whereDate('date', date('Y-m-d'))->get();

        //メール送信
        foreach ($reservations as $reservation) {
            Mail::to($reservation->users->email)->send(new RemaindMail($reservation));
        }
    }
}
