<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Start extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the application by resetting the database, running migrations, and seeding data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('optimize:clear');

        $this->call('migrate:reset');
        $this->call('migrate');
        $this->call('db:seed');

        $this->info('Application is ready to use.');
    }
}
