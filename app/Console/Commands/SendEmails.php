<?php

namespace App\Console\Commands;

use App\Mail\NewPostMail;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a post email to a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $post = Post::find($this->argument('post'));
        $website = Website::find($post->website_id);
        foreach($website->users as $user) {
            Mail::to($user)->send(new NewPostMail($post));
        }
    }
}
