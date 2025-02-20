<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Notifications\RentalExpiredNotification;
use Illuminate\Console\Command;

class CheckExpiredRentals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rentals:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired rentals and send notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredRentals = Rental::where('status', 'active')
            ->where('end_time', '<', now())
            ->get();
            
        foreach($expiredRentals as $rental) {
            $rental->customer->notify(new RentalExpiredNotification($rental));
            $this->info("Notification sent for rental #{$rental->id}");
        }

        return Command::SUCCESS;
    }
}
