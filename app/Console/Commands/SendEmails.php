<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Email;
use App\Models\User;
use App\Mail\OrderEmail;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send {--user-email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all emails pending';

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
     * @return int
     */
    public function handle()
    {
        $query = Email::where('status', 'pending');
        $userEmail = $this->option('user-email');

        /**
         * Check user-email option
         */
        if($userEmail !== null){
            $user = User::where('email', $userEmail)->first();
            /**
             * check if exitst user
             */
            if($user === null){
                $this->error("This user does not exist");
                return 0;
            }
            $query->where('user_id', $user->id);
        }

        $this->info("Sending {$userEmail} emails...");

        /**
         * Send emails
         */
        $query->get()->each( function($email) {
            Mail::to($email->email)->send(new OrderEmail($email));
            $email->status = 'sent';
            $email->save();
        });

        $this->info("Emails sent");
        return 0;
    }
}
