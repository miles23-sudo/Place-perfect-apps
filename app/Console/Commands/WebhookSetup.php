<?php

namespace App\Console\Commands;

use Luigel\Paymongo\Facades\Paymongo;
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
    protected $description = 'Set up Paymongo webhook for payment events';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $webhookUrl = $this->ask('What is the webhook URL?');

        $this->registerWebhook($webhookUrl);
    }

    private function registerWebhook($webhookUrl)
    {
        try {
            Paymongo::webhook()->create([
                'url' => $webhookUrl,
                'events' => [
                    'payment.paid',
                    'payment.failed',
                ]
            ]);

            $this->info('Webhook setup complete.');
        } catch (\Exception $e) {
            $this->error('Failed to register webhook: ' . $e->getMessage());
        }
    }
}
