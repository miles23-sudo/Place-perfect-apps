<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class WebhookSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webhook:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up Paymongo webhook...');

        // visit ngrok link to get the webhook URL
        Http::get(env('NGROK_URL') . '/api/webhook/paymongo/create');

        $this->info('Webhook setup complete. Please check the logs for details.');
    }
}
