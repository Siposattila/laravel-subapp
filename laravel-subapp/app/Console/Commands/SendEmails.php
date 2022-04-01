<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send {username} {websiteName} {email} {subject} {title} {content}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending emails to the users.';

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
        $username = $this->argument('username');
        $websiteName = $this->argument('websiteName');
        $email = $this->argument('email');
        $subject = $this->argument('subject');
        $title = $this->argument('title');
        $content = $this->argument('content');

        Mail::send('postsmail', [
            'username' => $username,
            'websiteName' => $websiteName,
            'title' => $title,
            'content' => $content
        ], function ($message) use ($email, $subject) {
            $message->from('xyz@gmail.com');
            $message->to($email)->subject($subject);
        });
        Log::info('The email is sent successfully!');
    }
}
