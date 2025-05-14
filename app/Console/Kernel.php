<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  protected function schedule(Schedule $schedule)
  {
    $schedule->command('notificar:citas')->dailyAt('07:00');
    $schedule->command('ban:delete-expired')->everyMinute();
  }

  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }

  protected $middlewareGroups = [
    'web' => [
      // Otros middlewares...
      \App\Http\Middleware\BlockUserAfterAttempts::class,
    ],
  ];
}
