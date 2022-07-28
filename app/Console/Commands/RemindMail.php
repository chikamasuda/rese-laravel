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
        $users = User::with('reservations')
            ->whereHas('reservations',  function ($query) {
                $query->whereDate('date', date('Y-m-d'));
            })->pluck('name');

        $email = User::with('reservations')
            ->whereHas('reservations',  function ($query) {
                $query->whereDate('date', date('Y-m-d'));
            })->pluck('email');

        $shops = Shop::with('reservations')
            ->whereHas('reservations',  function ($query) {
                $query->whereDate('date', date('Y-m-d'));
            })->pluck('name');

        $date = Reservation::whereDate('date', date('Y-m-d'))->pluck('date');
        $number = Reservation::whereDate('date', date('Y-m-d'))->pluck('number');

        Mail::to($email)->send(new RemaindMail($date, $number, $users, $shops));
    }
}
