<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class restart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reboot the application by clearing caches and optimizing performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('optimize:clear');
        $this->call('filament:optimize');
        $this->call('icons:cache');

        $this->info('Application restarted successfully.');
    }
}
