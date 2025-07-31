<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;

class CleanUpOldGuestCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-old-guest-carts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old guest carts that are older than 2 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = Cart::whereNull('customer_id')
            ->where('created_at', '<', now()->subDays(2))
            ->delete();

        $this->info("Deleted {$deleted} old guest cart(s).");
    }
}
