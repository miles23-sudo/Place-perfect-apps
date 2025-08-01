<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeMobile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:mobile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on a mobile server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $output = trim(shell_exec('ipconfig | findstr /R "IPv4"'));
        preg_match('/(\d{1,3}\.){3}\d{1,3}/', $output, $matches);

        $ipv4 = $matches[0] ?? 'Not found';

        if ($ipv4 === 'Not found') {
            return $this->error('IPv4 address not found.');
        }

        $this->info("Running server on http://{$ipv4}:8000 (Use this URL on your mobile device to access the application)" . PHP_EOL);
        $this->call('serve', ['--host' => $ipv4, '--port' => 8000]);
    }
}
