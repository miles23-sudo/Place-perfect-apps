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
        $output = shell_exec('for /f "tokens=2 delims=:" %a in (\'ipconfig ^| findstr "IPv4" ^| findstr "192.168."\') do @echo %a');
        $output = trim($output); // <-- important

        if (blank($output)) {
            return $this->error('IPv4 address not found.');
        }

        $this->info("Running server on http://{$output}:8000 (Use this URL on your mobile device to access the application)" . PHP_EOL);

        $this->call('serve', ['--host' => $output, '--port' => 8000]);
    }
}
