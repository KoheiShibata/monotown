<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * instagram/*jsonを更新するArtisanコマンド
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\InstagramPosts::class,
    ];

    /**
     * コマンド実行スケジュール定義
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('instagram:posts')->dailyAt("4:00");
        $schedule->command('instagram:posts')->everyThreeMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
