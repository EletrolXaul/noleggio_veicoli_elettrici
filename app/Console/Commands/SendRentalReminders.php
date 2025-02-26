<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Notifications\RentalStartReminderNotification;
use App\Notifications\RentalEndingNotification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendRentalReminders extends Command
{
    protected $signature = 'rentals:send-reminders';
    protected $description = 'Invia promemoria per i noleggi in corso';

    public function handle()
    {
        // Promemoria inizio noleggio (24 ore prima)
        $this->sendStartReminders();
        
        // Promemoria fine noleggio (24 ore prima)
        $this->sendEndReminders();
        
        $this->info('Promemoria inviati con successo.');
    }

    protected function sendStartReminders()
    {
        $tomorrow = Carbon::tomorrow();
        $dayAfterTomorrow = Carbon::tomorrow()->addDay();
        
        $upcomingRentals = Rental::with('user', 'vehicle')
            ->where('status', 'active')
            ->whereBetween('start_time', [$tomorrow, $dayAfterTomorrow])
            ->get();
            
        foreach ($upcomingRentals as $rental) {
            $rental->user->notify(new RentalStartReminderNotification($rental));
            $this->info("Promemoria inizio inviato per noleggio #{$rental->id}");
        }
    }

    protected function sendEndReminders()
    {
        $tomorrow = Carbon::tomorrow();
        $dayAfterTomorrow = Carbon::tomorrow()->addDay();
        
        $endingRentals = Rental::with('user', 'vehicle')
            ->where('status', 'active')
            ->whereBetween('end_time', [$tomorrow, $dayAfterTomorrow])
            ->get();
            
        foreach ($endingRentals as $rental) {
            $rental->user->notify(new RentalEndingNotification($rental));
            $this->info("Promemoria fine inviato per noleggio #{$rental->id}");
        }
    }
}
