<?php

namespace App\Console;

use App\Models\Task;
use App\Notifications\TaskDeadlineNotification;
use Illuminate\Support\Facades\Notification;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Add your Artisan commands here
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tasks = Task::where('status', '!=', 'completed')
                         ->where('deadline', '<=', now()->addDays(2))
                         ->get();
    
            foreach ($tasks as $task) {
                Notification::route('mail', $task->user->email)
                            ->notify(new TaskDeadlineNotification($task));
            }
        })->daily();
    }
        /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
