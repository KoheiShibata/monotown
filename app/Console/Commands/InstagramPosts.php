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
    protected $description = 'InstagramグラフAPIを使用して、mensBrandの投稿内容を更新';

    /**
     * メンズブランドのinstagram投稿を取得
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

            file_put_contents("/var/www/html/monotown/public/instagram/{$key}.json", print_r($instagramPosts, true), LOCK_EX);
        }
    }
}
