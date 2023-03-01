<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstagramPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'InstagramグラフAPIを使用して、ブランドの投稿を取得';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $context = stream_context_create(
            [
                "http" =>
                [
                    "ignore_errors" => true
                ]
            ]
        );

        foreach (config(INSTAGRAM_MENS) as $key => $query) {
            $instagramPosts = file_get_contents(INSTAGRAM_API_URL . BUSINESS_ACCOUNT . $query . MEDIA_DATA . ACCESS_TOKEN, false, $context);

            if (property_exists($instagramPosts, "error")) {
                continue;
            }

            file_put_contents("public/instagram/{$key}.json", print_r($instagramPosts, true), LOCK_EX);
        }
    }
}
