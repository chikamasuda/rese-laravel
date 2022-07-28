<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemaindMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date, $users, $shops, $number)
    {
        $this->date = $date;
        $this->number = $number;
        $this->users = $users;
        $this->shops = $shops;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('予約当日のご確認')
            ->view('mail.remind')
            ->with([
                'users' => $this->users,
                'shops' => $this->shops,
                'date' => $this->date,
                'number' => $this->number,
            ]);
    }
}
