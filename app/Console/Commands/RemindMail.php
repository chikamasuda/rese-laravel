<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\MailController;

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
        MailController::sendRemindMail();
    }
}
