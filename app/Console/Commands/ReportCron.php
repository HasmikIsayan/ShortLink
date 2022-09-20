<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Mail;
use App\Mail\ReportMail;

class ReportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $key => $user)
        {
            $email = $user->email;
            Mail::to($email)->send(new ReportMail($user));
        }
    }
}
